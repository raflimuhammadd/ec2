@extends('admin.layout.appadmin')
@section('content')
<h1 class="mt-4">Pelanggan</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Tables</li>
</ol>

<div class="card mb-4">
    <div class="card-header ">
        <a href="{{url('admin/pelanggan/create')}}" class="btn btn-primary" type="submit">
            Tambah
        </a>
        <a href="{{ url('admin/pelanggan/pelangganPDF') }}" class="btn btn-danger" type="submit">
            <i class="fas fa-file-pdf"></i>
        </a>
        <a href="{{ url('admin/pelanggan/generatePDF') }}" class="btn btn-info" type="submit">
            <i class="fas fa-file-pdf"></i> Dowload Data
        </a>
        <a href="{{url('admin/pelanggan/export')}}" class="btn btn-success"><i class="fas fa-file-excel"></i> Excel</a>
    </div>
    <div class="card-body">
        <div class="table-responsive ">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="2">
                <thead>
                    <style>
                        .table-responsive {
                            overflow-x: auto;
                        }

                        .table {
                            width: 100%;
                            margin-bottom: 1rem;
                            color: #212529;
                        }

                        /* Additional styles for the Action column */
                        .action-column {
                            width: 150px;
                            /* Adjust the width as needed */
                        }
                    </style>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no = 1;
                    @endphp
                    @foreach ($pelanggan as $pel)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $pel->nama_pelanggan }}</td>
                        <td>{{ $pel->email }}</td>
                        <td>{{ $pel->telepon }}</td>
                        <td>{{ $pel->alamat }}</td>
                        <td class="action-column">
                            <a href="{{url('admin/pelanggan/show/'.$pel->id)}}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{url('admin/pelanggan/edit/'.$pel->id)}}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{ url('admin/pelanggan/pdfshow/' . $pel->id) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-file-pdf"></i>
                            </a>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal{{ $pel->id }}" style="margin-top: 5px;">
                                <i class="fas fa-trash"></i>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $pel->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            apakah anda yakin akan menghapus data {{ $pel->nama_pelanggan }} ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a href="{{url('admin/pelanggan/delete/'.$pel->id)}}" type="button" class="btn btn-danger">Delete</a>
                                        </div>
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