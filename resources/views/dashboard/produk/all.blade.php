@extends('dashboard.layouts.app')
@section('title', 'Data Produk')

@section('content')
<div class="row">
  <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <a href="{{route('product.create')}}" class="btn btn-secondary bg-green btn-sm pull-left" style="margin-top: 0px; margin-bottom: 0px;"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Produk</a>
        </div>
      </div>
    </div>

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
          <div class="box-body">
              <table id="produk-table" class="table table-bordered table-striped" style="width:100%!important;">
              <thead>
                  <tr>
                  <th width="10">No</th>
                  <th width="250">Produk</th>
                  <th width="250">Nama Toko</th>
                  <th width="150">Jenis Bordir</th>
                  <th>Deskripsi</th>
                  <th width="50">Action</th>
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
      $('#produk-table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: '{!! route('product.getdata') !!}',
        columns: [
        { data: 'DT_RowIndex', orderable: false, searchable: false },
        { data: 'nama_produk', name: 'nama_produk' },
        { data: 'nama_toko', name: 'nama_toko' },
        { data: 'jenis', name: 'jenis' },
        { data: 'deskripsi', name: 'deskripsi' },
        { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
      });
    });
  </script>
@endpush
