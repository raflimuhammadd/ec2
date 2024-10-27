<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class ShopController extends Controller
{
    public function index()
    {
        $produk = Produk::join('kategori', 'kategori_id', '=', 'kategori.id')
            ->select('produk.*', 'kategori.nama_kategori')
            ->get();
        return view('shop', compact('produk'));
    }

    public function cart()
    {
        return view('cart');
    }

    public function checkout(Request $request)
    {
        $produk = Produk::all();
        $transaksi = new Transaksi();

        $cart = session()->get('cart');

        $total = 0;
        $items = []; // Membuat array kosong untuk menyimpan detail setiap produk dalam transaksi

        if ($cart) {
            foreach ($cart as $key => $produk) { // Mengubah variabel $produk menjadi $produk
                $subtotal = $produk['harga'] * $produk['quantity'];
                $total += $subtotal;

                // Menambahkan detail produk ke dalam array $items
                $items[] = array(
                    'id' => $key,
                    'price' => $produk['harga'], // Mengubah 'price' menjadi 'harga'
                    'quantity' => $produk['quantity'],
                    'name' => $produk['nama_produk'],
                );
            }

            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = false;
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;

            // $pelanggan = Pelanggan::where('email', auth()->user()->email)->first(); // Mengambil data pelanggan berdasarkan email yang login
            $billing_address = array(
                'address'       => auth()->user()->alamat,
            );

            // Optional
            $shipping_address = array(
                'first_name' => auth()->user()->name,
                'phone' => auth()->user()->telepon,
                'address'       => auth()->user()->alamat,
            );
            $transaksi->users_id = auth()->user()->id;
            $transaksi->total = $total;
            $transaksi->save();

            foreach ($cart as $key => $produk) {
                $detailTransaksi = new DetailTransaksi();
                $detailTransaksi->trans_id = $transaksi->id;
                $detailTransaksi->produk_id = $key;
                $detailTransaksi->quantity = $produk['quantity'];
                $detailTransaksi->harga = $produk['harga'];
                $detailTransaksi->save();
            }
            if (auth()->user()->email) {
                $params = array(
                    'transaction_details' => array(
                        'order_id' => $transaksi->id,
                        'gross_amount' => $total,
                    ),

                    'item_details' => $items,
                    'customer_details' => array(
                        'first_name' => auth()->user()->name, // Menggunakan data pelanggan
                        'email' => auth()->user()->email, // Menggunakan data pelanggan
                        'phone' => auth()->user()->telepon, // Menggunakan data pelanggan
                        'billing_address' => $billing_address, // Menggunakan data pelanggan
                        'shipping_address' => $shipping_address, // Menggunakan data pelanggan
                        // Tambahkan informasi lain yang dibutuhkan dari tabel pelanggan
                    ),
                );

                $snapToken = \Midtrans\Snap::getSnapToken($params);

                return view('checkout', compact('snapToken','transaksi'));
            }
        }
    }

    public function transaksi()
    {
        return redirect()->route('checkout');
    }

    public function success($id)
    {
        $transaksi = Transaksi::whereId($id)->update([
            'status' => 'lunas'
        ]);

        session()->forget('cart');

        $transaksi = Transaksi::with('detailTransaksi.produk')
            ->where('id', $id)
            ->firstOrFail();

        $subtotal = $transaksi->detailTransaksi->sum(function ($detail) {
            return $detail->harga * $detail->quantity;
        });
        $ppn = $subtotal * 0.1;

        $pdf = PDF::loadView('pdf', [
            'transaksi' => $transaksi,
            'subtotal' => $subtotal,
            'ppn' => $ppn,
        ])->setPaper('a4', 'landscape');

        $filePath = storage_path('app/public/invoice.pdf');
        $pdf->save($filePath);

        return view('succes', ['pdfPath' => asset('storage/invoice.pdf')]);
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function addToCart($id)
    {
        $product = Produk::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "nama_produk" => $product->nama_produk,
                "quantity" => 1,
                "harga" => $product->harga,
                "foto" => $product->foto
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back();
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }

    public function detail(){
        $transaksi = Transaksi::join('users', 'users_id', '=', 'users.id')
            ->select('trans.*', 'users.name as nama', 'users.telepon as telp', 'users.email as email')
            ->where('trans.users_id', auth()->user()->id)
            ->get();
        // $detail = DetailTransaksi::join('trans', 'trans_id', '=', 'trans.id')
        //     ->join('produk', 'produk_id', '=', 'produk.id')
        //     ->select('detail.*', 'trans.status as status', 'trans.total as total', 'produk.nama_produk as nama_produk')
        //     ->where('detail.trans_id', $id)
        //     ->get();
        return view('detail', compact('transaksi'));

    }
}
