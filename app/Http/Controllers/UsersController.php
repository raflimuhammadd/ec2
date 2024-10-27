<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use PDF;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = Users::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view ('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
        
            'username' => 'required|unique:users| max:45',
            'password' => 'required|unique:users| max:45',
            'role' => 'required|max:15',
        ],
        [
            'username.required' => 'username wajib diisi',
            'username.unique' => 'username sudah ada silahkan tambahkan username lain',
            'password.required' => 'password wajib diisi',
            'password.unique' => 'password sudah ada silahkan tambahkan password lain',
            'role.required' => 'role wajib diisi',  
        ]);
        DB::table('users')->insert([
            'username' => $request->username,
            'password' => $request->password,
            'role' => $request->role,

        ]);
        return redirect('admin/users');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $users = Users::all()->where('id',$id);
        return view('admin.users.detail', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $users = Users::all()->where('id', $id);
        return view('admin.users.edit', compact('users'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'username' => 'required| max:45',
            'password' => 'required| max:45',
            'role' => 'required|max:15',
        ],
        [
            'username.required' => 'username wajib diisi',
            'password.required' => 'password wajib diisi',
            'role.required' => 'role wajib diisi',  
        ]);
        DB::table('users')->where('id',$request->id)->update([
            'username' => $request->username,
            'password' => $request->password,
            'role' => $request->role,

        ]);

        $users = Users::find($request->id);
        $users->username = $request->username;
        $users->password = $request->password;
        $users->role = $request->role;
        $users->save();
        return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        DB::table('users')->where('id',$id)->delete();
        return redirect(('admin/users'));
    }
    public function usersPDF()
    {
        $users = Users::all();
        $pdf = PDF::loadView('admin.users.usersPDF', ['users' => $users])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
    public function generatePDF()
    {
        $data = [
            'title' => 'Welcomme to export PDF',
            'date' => date("Y-d-m H:i:s"),
            'users' => Users::all(),
        ];
        $pdf = PDF::loadView('admin.users.myPDF', $data);
        return $pdf->download('testdowload.pdf');
    }
    
    public function showPDF(string $id)
    {
        $users = Users::all()->where('id',$id);
            $pdf = PDF::loadView('admin.users.usersPDF_show',['users' => $users]);
            return $pdf->stream();
    }
}
