<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //index
    public function index()
    {
        $user = DB::table('users')->get();
        return view('admin.user.index', compact('user'));

    }
    public function show()
    {
        // $pelanggan = DB::table('pelanggan')->get();
        $user = User::findOrFail(Auth::id());
        return view('profile', compact('user'));
    }


    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            // Handle if user is not found
            return redirect()->back()->with('error', 'User not found');
        }

        // Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'telepon' => 'nullable|string',
            'alamat' => 'nullable|string',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update user data
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->telepon = $request->input('telepon');
        $user->alamat = $request->input('alamat');

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoName = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('fotos'), $fotoName); // Moves the file to public/fotos directory
            $user->foto = $fotoName;
        }


        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }
}
