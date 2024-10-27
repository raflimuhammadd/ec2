@extends('admin.layout.appadmin')
@section('content')
    <h1 class="mt-4">Semua Transaksi</h1>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('admin/produk/import') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            {{ csrf_field() }}
                            <input type="file" name="file" required="required">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    <!-- batas modal -->

    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive ">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="2">
                    <thead>
                        <tr align="center">
                            <th>No</th>
                            <th>Nama Pembeli</th>
                            <th>No Telepon</th>
                            <th>Status Pembayaran</th>
                            <th>Total Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($transaksi as $tran)
                            <tr align="center">
                                <td>{{ $no++ }}</td>
                                <td>{{ $tran->nama }}</td>
                                <td>{{ $tran->telp }}</td>
                                @if ($tran->status == 'tidak')
                                <td>Unpaid</td>
                                @else
                                <td>Paid</td>
                                @endif
                                <td>{{ $tran->total }}</td>
                                <td>
                                    <a href="{{ url('admin/transaksi/show/' . $tran->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <!-- <a href="{{ url('admin/transaksi/edit/' . $tran->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a> -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <h1 class="mt-5">Transaksi Lunas</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Tables</li>
    </ol>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('admin/produk/import') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            {{ csrf_field() }}
                            <input type="file" name="file" required="required">

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    <!-- batas modal -->

    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive ">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="2">
                    <thead>
                        <tr align="center">
                            <th>No</th>
                            <th>Nama Pembeli</th>
                            <th>No Telepon</th>
                            <th>Status Pembayaran</th>
                            <th>Total Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($transaksiLunas as $tran)
                            <tr align="center">
                                <td>{{ $no++ }}</td>
                                <td>{{ $tran->nama }}</td>
                                <td>{{ $tran->telp }}</td>
                                @if ($tran->status == 'tidak')
                                <td>Unpaid</td>
                                @else
                                <td>Paid</td>
                                @endif
                                <td>{{ $tran->total }}</td>
                                <td>
                                    <a href="{{ url('admin/transaksi/show/' . $tran->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ url('admin/transaksi/edit/' . $tran->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
