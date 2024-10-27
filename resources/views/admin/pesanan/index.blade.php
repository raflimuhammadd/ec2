@extends('admin.layout.appadmin')
@section('content')
<h1 class="mt-4">Pesanan</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Tables</li>
</ol>

<div class="card mb-4">
<div class="card-header ">
        <a href="{{url('admin/pesanan/create')}}" class="btn btn-primary" type="submit">
        <i class="fas fa-plus"></i> Tambah
        </a>
        <a href="{{ url('admin/pesanan/pesananPDF') }}" class="btn btn-danger" type="submit">
            <i class="fas fa-file-pdf"></i> PDF
        </a>
        {{-- <a href="{{ url('admin/pesanan/pesananPDF') }}" class="btn btn-danger" type="submit">
        <i class="fas fa-file-pdf">
            </a> --}}
            <a href="{{ url('admin/pesanan/generatePDF') }}" class="btn btn-info" type="submit">
                <i class="fas fa-file-pdf"></i> Dowload Data
            </a>
            <a href="{{url('admin/pesanan/export')}}" class="btn btn-success"><i class="fas fa-file-excel"></i> Excel</a>
    </div>
    <div class="card-body">
        <div class="table-responsive ">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="2">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Pesanan</th>
                        <th>Status</th>
                        <th>Nama Pelanggan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <!-- <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Pesanan</th>
                        <th>Status</th>
                        <th>Pelanggan_id</th>
                    </tr>
                </tfoot> -->
                <tbody>
                    @php
                    $no = 1;
                    @endphp
                    @foreach ($pesanan as $pes)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $pes->tanggal_pesanan }}</td>
                        <td>{{ $pes->status }}</td>
                        <td>{{ $pes->pelanggan->nama_pelanggan }}</td>
                        <td>
                            <a href="{{url('admin/pesanan/show/'.$pes->id)}}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{url('admin/pesanan/edit/'.$pes->id)}}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{ url('admin/pesanan/pdfshow/' . $pes->id) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-file-pdf"></i>
                            </a>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal{{ $pes->id }}">
                                <i class="fas fa-trash"></i>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $pes->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            apakah anda yakin akan menghapus data {{ $pes->tanggal_pesanan }}  ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a href="{{url('admin/pesanan/delete/'.$pes->id)}}" type="button" class="btn btn-danger">Delete</a>
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