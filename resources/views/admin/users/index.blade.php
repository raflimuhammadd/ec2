@extends('admin.layout.appadmin')
@section('content')
<h1 class="mt-4">Users</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Tables</li>
</ol>

<div class="card mb-4">
    <div class="card-header ">
        <a href="{{url('admin/users/create')}}" class="btn btn-primary" type="submit">
            Tambah
        </a>
        <a href="{{ url('admin/users/usersPDF') }}" class="btn btn-danger" type="submit">
            <i class="fas fa-file-pdf"></i>
        </a>
        {{-- <a href="{{ url('admin/users/usersPDF') }}" class="btn btn-danger" type="submit">
        <i class="fas fa-file-pdf">
            </a> --}}
            <a href="{{ url('admin/users/generatePDF') }}" class="btn btn-info" type="submit">
                <i class="fas fa-file-pdf"></i> Dowload Data
            </a>
        </div>

    <div class="card-body">
        <div class="table-responsive ">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="2">
                <thead>
                    <tr >
                        <th>No</th>
                        <th>username</th>
                        <th>Email</th>
                        <th>password</th>
                        <th>role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <!-- <tfoot>
                    <tr>
                        <th>No</th>
                        <th>username</th>
                        <th>password</th>
                        <th>role</th>
                    </tr>
                </tfoot> -->
                <tbody>
                    @php
                    $no = 1;
                    @endphp
                    @foreach ($users as $use)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $use->name }}</td>
                        <td>{{ $use->email }}</td>
                        <td>{{ $use->password }}</td>
                        <td>{{ $use->role }}</td>
                        <td>
                        <a href="{{url('admin/users/show/'.$use->id)}}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                        
                        
                            <a href="{{url('admin/users/edit/'.$use->id)}}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                            

                        <a href="{{ url('admin/users/pdfshow/' . $use->id) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-file-pdf"></i>
                            </a>
                                          
                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal{{$use->id}}">
                            <i class="fas fa-trash"></i>
                        </button> 
                        </td>
                        <div class="modal fade" id="exampleModal{{$use->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah anda yakin ingin menghapus data {{$use->username}} ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a href="{{url('admin/users/delete/'.$use->id)}}" type="button" class="btn btn-danger">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endsection