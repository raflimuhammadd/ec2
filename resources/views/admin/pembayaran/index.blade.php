@extends('admin.layout.appadmin')
@section('content')
    <h1 class="mt-4">Pembayaran</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Tables</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header ">
            <a href="{{ url('admin/pembayaran/create') }}" class="btn btn-primary" type="submit">
                Tambah
            </a>
            <a href="{{ url('admin/pembayaran/pembayaranPDF') }}" class="btn btn-danger" type="submit">
                <i class="fas fa-file-pdf"></i>
            </a>
            <a href="{{ url('admin/pembayaran/generatePDF') }}" class="btn btn-info" type="submit">
                <i class="fas fa-file-pdf"></i> Dowload Data
            </a>
            <a href="{{ url('admin/pembayaran/export') }}" class="btn btn-success" type="submit">
                <i class="fas fa-file-excel"></i>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive ">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="2">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Pembayaran</th>
                            <th>Jumlah Pembayaran</th>
                            <th>Tanggal Pesanan</th>
                            <th>Status Pesanan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <!-- <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Pembayaran</th>
                                    <th>Jumlah Pembayaran</th>
                                    <th>Pesanan_id</th>
                                </tr>
                            </tfoot> -->
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($pembayaran as $pem)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $pem->tanggal_pembayaran }}</td>
                                <td>{{ $pem->jumlah_bayar }}</td>
                                <td>{{ $pem->pesanan->tanggal_pesanan }}</td>
                                <td>{{ $pem->pesanan->status }}</td>
                                <td>
                                    <div class="text-center">
                                        <a href="{{ url('admin/pembayaran/show/' . $pem->id) }}"
                                            class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ url('admin/pembayaran/edit/' . $pem->id) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ url('admin/pembayaran/pdfshow/' . $pem->id) }}"
                                            class="btn btn-sm btn-info">
                                            <i class="fas fa-file-pdf"></i>
                                        </a>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                            data-target="#exampleModal{{ $pem->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{ $pem->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        apakah anda yakin akan menghapus data
                                                        {{ $pem->tanggal_pembayaran }} ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <a href="{{ url('admin/pembayaran/delete/' . $pem->id) }}"
                                                            type="button" class="btn btn-primary">Delete</a>
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
