@extends('dashboard.layouts.app')
@section('title', 'Laporan Pesanan')

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
          <h4 style="margin-top: 0px; margin-bottom: 0px;">Laporan Pesanan</h4>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <a href="{{route('dashboard.cetakPesanan')}}" class="btn btn-primary bg-red btn-sm" target="_blank">Cetak Pesanan</a>
        <table id="transaksi-table" class="table table-bordered table-striped" style="width:100%!important;">
          <thead>
            <tr>
                <th width="10">No</th>
                <th>Order Number</th>
                <th>Customers</th>
                <th>Products</th>
                <th>Status</th>
                <th>Pembayaran</th>
                <th>Total</th>
            </tr>
          </thead>
          <tbody>
          @foreach($pesanan as $p)
            <tr>
                <th width="10">{{$loop->iteration}}</th>
                <th>{{$p->order_number}}<div><span class="text-warning"><b>Deadline : {{Carbon\Carbon::parse($p->deadline)->format('d/M/y')}}</b></span></div></th>
                <th>{{$p->nama_pelanggan}}</th>
                <th>{{$p->product->nama}}<div>Jenis Bordir: {{$p->jenis_bordir}}</div></th>
                <th>
                    @php
                        switch ($p->status_order) {
                        case 'order':
                            $class = 'style="color:#00c0ef;"';
                        break;
                        case 'cancel':
                            $class = 'style="color:#f56954;"';
                        break;
                        case 'pending':
                            $class = 'style="color:#f1c40f;"';
                        break;
                        case 'success':
                            $class = 'style="color:#00a65a;"';
                        break;
                        default:
                            $class = $p->status_order;
                        break;
                    }
                    switch ($p->status_pengiriman) {
                        case 'belum dikirim':
                            $class_pengiriman = 'style="color:#f1c40f;"';
                        break;
                        case 'sudah dikirim':
                            $class_pengiriman = 'style="color:#00a65a;"';
                        break;
                        default:
                            $class_pengiriman = $p->status_pengiriman;
                        break;
                    }
                    switch ($p->status_pengiriman) {
                        case 'belum dikirim':
                            $status_pengiriman = "Belum Dikirim";
                        break;
                        case 'sudah dikirim':
                            $status_pengiriman = "Sudah Dikirim";
                        break;
                        default:
                            $status_pengiriman = '----------';
                        break;
                    }
                    @endphp
                    <div class="small text-muted">Status Pesanan </div><div> <small><li class="fa fa-circle fa-xs" {{$class}}></li></small> {{ucwords($p->status_order)}}</div>
                    <div class="small text-muted">Status Pengiriman </div><div> <small><li class="fa fa-circle fa-xs" {{$class_pengiriman}}></li></small> {{$status_pengiriman}}<div>
                </th>
                <th>
                @php
                    switch ($p->status_pembayaran) {
                        case 'belum dibayar':
                            $class = 'style="color:#f1c40f;"';
                        break;
                        case 'sudah dibayar':
                            $class = 'style="color:#00a65a;"';
                        break;
                        default:
                            $class = $p->status_pembayaran;
                        break;
                    }
                    
                @endphp
                    @if($p->status_pembayaran == NULL)
                        <div class="small text-muted">Status Pembayaran </div><div> <small><li class="fa fa-circle fa-xs" {{$class}}></li></small> --------</div>
                    @else
                        <div class="small text-muted">Status Pembayaran </div><div> <small><li class="fa fa-circle fa-xs" {{$class}}></li></small> {{ucwords($p->status_pembayaran)}}</div>
                    @endif
                </th>
                <th>Rp. {{$p->total}}</th>
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
