@extends('admin.layout.appadmin')
@section('content')
    <h1 class="mt-4">Pesanan Items</h1>
    <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Tables</li>
</ol>

<div class="card mb-4">
<div class="card-header ">
    <a href="{{url('admin/pesananItems/create')}}" class="btn btn-primary" type="submit">
    <i class="fas fa-plus"></i> Tambah
        </a>
        <a href="{{ url('admin/pesananItems/pesananItemsPDF') }}" class="btn btn-danger" type="submit">
            <i class="fas fa-file-pdf"></i> PDF
        </a>
        {{-- <a href="{{ url('admin/pesananItems/pesananItemsPDF') }}" class="btn btn-danger" type="submit">
        <i class="fas fa-file-pdf">
            </a> --}}
            <a href="{{ url('admin/pesananItems/generatePDF') }}" class="btn btn-info" type="submit">
                <i class="fas fa-file-pdf"></i> Dowload Data
            </a>
            <a href="{{url('admin/pesananItems/export')}}" class="btn btn-success"><i class="fas fa-file-excel"></i> Excel</a>
    </div>
    <div class="card-body">
        <div class="table-responsive ">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="2">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Nama Produk</th>
                        <th>Tanggal Pesan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <!-- <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Produk_id</th>
                        <th>Pesanan_id</th>
                    </tr>
                </tfoot> -->
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($pesananItems as $pesi)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $pesi->qty }}</td>
                            <td>{{ $pesi->harga }}</td>
                            <td>{{ $pesi->produk->nama_produk }}</td>
                            <td>{{ $pesi->pesanan->tanggal_pesanan }}</td>
                            <td>
                            <a href="{{url('admin/pesananItems/show/'.$pesi->id)}}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{url('admin/pesananItems/edit/'.$pesi->id)}}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{ url('admin/pesananItems/pdfshow/' . $pesi->id) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-file-pdf"></i>
                            </a>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal{{ $pesi->id }}">
                                <i class="fas fa-trash"></i>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $pesi->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            apakah anda yakin akan menghapus data {{ $pesi->produk->nama_produk }}  ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a href="{{url('admin/pesananItems/delete/'.$pesi->id)}}" type="button" class="btn btn-danger">Delete</a>
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
