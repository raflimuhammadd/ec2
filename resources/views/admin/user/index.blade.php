@extends('admin.layout.appadmin')
@section('content')
<h1 class="mt-4">Users</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Tables</li>
</ol>

<div class="card mb-4">
    <div class="card-header ">
    
    </div>

    <div class="card-body">
        <div class="table-responsive ">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="2">
                <thead>
                    <tr >
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>role</th>
                    
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no = 1;
                    @endphp
                    @foreach ($user as $us)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $us->name }}</td>
                        <td>{{ $us->email }}</td>
                        <td>{{ $us->telepon }}</td>
                        <td>{{ $us->alamat }}</td>
                        <td>{{ $us->role }}</td>
                    
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endsection