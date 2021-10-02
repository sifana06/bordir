@extends('dashboard.layouts.app')
@section('title', 'Data Transaksi')

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
          <h4 style="margin-top: 0px; margin-bottom: 0px;">All Users</h4>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="transaksi-table" class="table table-bordered table-striped" style="width:100%!important;">
          <thead>
            <tr>
              <th width="10">No</th>
              <th width="150">Order ID</th>
              <th>Produk</th>
              <th>Rekening</th>
              <th>Toko</th>
              <th>Total Pembayaran</th>
              <th>Tanggal Pembayaran</th>
              <!-- <th width="50">Action</th> -->
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
  <!--/.col (right) -->

  <div class="modal fade" id="konfirmasi_hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
     <div class="modal-content">
      <div class="modal-body text-center">
       <b>Anda yakin ingin menghapus Permanen data ini ?</b>
       <br><br>
       <a class="btn btn-danger btn-ok"> Hapus</a><button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
     </div>
   </div>
 </div>
</div>
@endsection

@push('header')
<link rel="stylesheet" href="/assets/material/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endpush

@push('footer')
<script src="/assets/material/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/assets/material/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript"> 
    //Hapus Data
    $(document).ready(function() {
      $('#konfirmasi_hapus').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
      });
    });
  </script>
  <script>
    $(function() {
      $('#transaksi-table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: '{!!route('transaksi.getdata')!!}',
        columns: [
        { data: 'DT_RowIndex', orderable: false, searchable: false },
        { data: 'order_id', name: 'order_id' },
        { data: 'produk', name: 'produk' },
        { data: 'rekening', name: 'rekening' },
        { data: 'toko', name: 'toko' },
        { data: 'total', name: 'total' },
        { data: 'tanggal', name: 'tanggal' }
        ]
      });
    });
  </script>
  @endpush
