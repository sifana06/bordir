@extends('dashboard.layouts.app')
@section('title', 'Laporan Transaksi')

@section('content')
<div class="row">
  <div class="col-md-12">
    <!-- Horizontal Form -->
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
      <button type="button" class="close" data-dismiss="alert">×</button>    
      <strong>{{ $message }}</strong>
    </div>
    @endif
    @if ($message = Session::get('message'))
    <div class="alert alert-warning alert-block">
      <button type="button" class="close" data-dismiss="alert">×</button>    
      <strong>{{ $message }}</strong>
    </div>
    @endif
    @if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block">
      <button type="button" class="close" data-dismiss="alert">×</button>    
      <strong>{{ $message }}</strong>
    </div>
    @endif
    <div class="box box-info">
      <div class="box-header with-border">
        <div class="box-title">
          <h4 style="margin-top: 0px; margin-bottom: 0px;">Laporan Transaksi</h4>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <a href="{{route('dashboard.cetakTransaksi')}}" class="btn btn-primary bg-red btn-sm" target="_blank">Cetak Transaksi</a>
        <table id="transaksi-table" class="table table-bordered table-striped" style="width:100%!important;">
          <thead>
            <tr>
              <th width="10">No</th>
              <th>Order ID</th>
              <th>Produk</th>
              <th>Toko</th>
              <th width="150">Total Pembayaran</th>
              <th width="150">Tanggal Pembayaran</th>
            </tr>
          </thead>
          <tbody>
          @foreach($transaksi as $tr)
            <tr>
              <th width="10">{{$loop->iteration}}</th>
              <th>{{$tr->order->order_number}}</th>
              <th>{{$tr->product->nama}}</th>
              <!-- <th>
                @if($tr->rekening_id != null)
                    <span class="text-primary">{{$tr->rekening->nama_bank}} </span><br><span class="text-dark"> {{$tr->rekening->nama_pemilik}} - {{$tr->rekening->no_rekening}}; 
                @else
                    <span>-</span>
                @endif
              </th> -->
              <th>{{$tr->store->nama}}</th>
              <th>Rp. {{$tr->order->total}}</th>
              <th>{{$tr->order->tanggal_pembayaran}}</th>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!--/.col (right) -->
@endsection

@push('header')
<link rel="stylesheet" href="/assets/material/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endpush

@push('footer')
<script src="/assets/material/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/assets/material/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
@endpush
