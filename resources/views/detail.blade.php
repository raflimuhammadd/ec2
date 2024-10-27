@extends('frontend.app')
@section('frontend')
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Detail Order</h1>
                </div>
            </div>
            <div class="col-lg-7">
            </div>
        </div>
    </div>
</div>

<style>
    #myTable {
    width: 100%;
    margin: 1em 0;
    font-size: 14px;
}

/* Gaya untuk header tabel */
#myTable thead {
    background-color: #f2f2f2;
}

/* Gaya untuk sel header tabel */
#myTable th {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

/* Gaya untuk sel data tabel */
#myTable td {
    padding: 8px;
    border-bottom: 1px solid #ddd;
}

/* Gaya hover untuk baris tabel */
#myTable tbody tr:hover {
    background-color: #f5f5f5;
}

/* Mengubah warna tombol Show entries */
.dataTables_length select {
    padding-right: 20px;
    color: #000000;
    background-color: #fff;
    border: 1px solid #808080;
}

/* Mengubah warna latar belakang tombol ketika dihover */
.dataTables_length select:hover {
    background-color: #ffcb39;
    border: 1px solid #ffcb39;
}

/* Mengubah warna tombol ketika aktif atau terpilih */
.dataTables_length select:active,
.dataTables_length select:focus {
    background-color: #2980b9;
    border-color: #2980b9;
}

.dataTables_length select option {
    color: #333333;
}

</style>

<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

<section class="section" style="margin-bottom: 130px;" >
<div class="card mb-4" >
        <div class="card-body">
            <div class="table-responsive ">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="2">
                    <thead>
                        <tr align="center">
                            <th>No</th>
                            <th>Nama Pembeli</th>
                            <th>No Telepon</th>
                            <th>Total Harga</th>
                            <th>Status Pembayaran</th>

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
                                <td>Rp. {{number_format($tran->total,0,',','.')}}</td>
                                @if ($tran->status == 'tidak')
                                <td>Unpaid</td>
                                @else
                                <td>Paid</td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="{{asset('admin/js/datatables-simple-demo.js')}}"></script>
    <script src="{{asset('admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('admin/js/demo/datatables-demo.js')}}"></script>






@endsection
