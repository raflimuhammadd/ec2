@extends('admin.layout.appadmin')
@section('content')
    <h1 class="mt-4">Produk</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Tables</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header ">
            <a href="{{ url('admin/produk/create') }}" class="btn btn-primary" type="submit">
                <i class="fas fa-plus"></i> Tambah
            </a>
            <a href="{{ url('admin/produk/produkPDF') }}" class="btn btn-danger" type="submit">
                <i class="fas fa-file-pdf"></i> PDF
            </a>
            {{-- <a href="{{ url('admin/produk/produkPDF') }}" class="btn btn-danger" type="submit">
        <i class="fas fa-file-pdf">
            </a> --}}
            <a href="{{ url('admin/produk/generatePDF') }}" class="btn btn-info" type="submit">
                <i class="fas fa-file-pdf"></i> Dowload PDF
            </a>
            <a href="{{ url('admin/produk/export') }}" class="btn btn-success"><i class="fas fa-file-excel"></i> Excel</a>
        </div>
        <div class="card-body">
            <div class="table-responsive ">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="2">
                    <thead>
                        <tr align="center">
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Foto</th>
                            <th>Deskripsi</th>
                            <th>Kategori</th>
                            <th class="col-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($produk as $pr)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $pr->kode }}</td>
                                <td>{{ $pr->nama_produk }}</td>
                                <td>{{ $pr->harga }}</td>
                                <td>{{ $pr->foto }}</td>
                                <td>{{ $pr->deskripsi }}</td>
                                <td>{{ $pr->kategori->nama_kategori }}</td>

                                <td class="d-flex justify-content-evenly">
                                    <a href="{{ url('admin/produk/show/' . $pr->id) }}" class="btn btn-sm btn-info"><i
                                            class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ url('admin/produk/edit/' . $pr->id) }}" class="btn btn-sm btn-warning"><i
                                            class="far fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                        data-target="#exampleModal{{ $pr->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{ $pr->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah anda yakin ingin menghapus data {{ $pr->nama_produk }} ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <a href="{{ url('admin/produk/delete/' . $pr->id) }}" type="button"
                                                        class="btn btn-danger">Delete</a>
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
