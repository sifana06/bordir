@extends('layouts.app')
@section('title', 'Order Produk')

@section('content')
<div class="row">
    @if ($errors->any())
    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif
    <form action="{{route('order.store')}}" method="post" enctype="multipart/form-data"3>
    @csrf
        <div class="col-md-8">
            <div class="box box-info">
                <div class="box-header with-border" style="margin-left:0px;">
                    <h4 style="margin-top:0px; margin-bottom:0px;"><a href="{{route('po.index')}}"><span class="fa fa-arrow-left"></span></a> Produk</h4>
                </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-5" style="margin-top:0px;">
                                <label for="">Foto Produk</label>
                                <div id="image-preview" style="width:200px;">
                                    <label for="image-upload" id="image-label" style="color:#f0f0f0;">Choose File</label>
                                    <input type="file" name="foto" id="image-upload" value="{{old('foto')}}" />
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-group" style="margin-top:5px;margin-bottom:0px;">
                            <label for="" style="margin-top:0px;margin-bottom:0px;">Nama Produk</label>
                            <input type="text" class="form-control" name="nama_produk" style="margin-top:0px;margin-bottom:0px;" readonly="true">
                        </div>
                        <div class="form-group" style="margin-top:0px;margin-bottom:0px;">
                            <label for="" style="margin-top:0px;margin-bottom:0px;">Harga</label>
                            <input type="text" class="form-control" name="harga" style="margin-top:0px;margin-bottom:0px;" readonly="true">
                        </div> -->
                        <div class="form-group" style="margin-top:0px;margin-bottom:0px;">
                            <label for="" style="margin-top:0px;margin-bottom:0px;">Jenis Bordir</label>
                            <select name="jenis_bordir" class="form-control" style="margin-top:0px;margin-bottom:0px;">
                                <option value="">Pilih Jenis Bordir</option>
                                <option value="logo">Bordir Logo</option>
                                <option value="kaos">Bordir Kaos</option>
                            </select>
                        </div>
                        <div class="form-group" style="margin-top:0px;margin-bottom:0px;">
                            <label for="" style="margin-top:0px;margin-bottom:0px;">Keterangan</label>
                            <textarea class="form-control" name="keterangan" rows="3">{{old('keterangan')}}</textarea>
                        </div>
                    </div>
            </div>
            <div class="box box-info">
                <div class="box-header with-border" style="margin-left:0px;">
                    <h4 style="margin-top:0px; margin-bottom:0px;">Customer</h4>
                </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" style="margin-top:5px;margin-bottom:0px;">
                                    <label for="" style="margin-top:0px;margin-bottom:0px;">Nama Customer</label>
                                    <input type="text" class="form-control" name="nama_pelanggan" style="margin-top:0px;margin-bottom:0px;" value="{{old('nama_pelanggan')}}">
                                </div>
                                <div class="form-group" style="margin-top:0px;margin-bottom:0px;">
                                    <label for="" style="margin-top:0px;margin-bottom:0px;">Telepon</label>
                                    <input type="text" class="form-control" name="telepon" style="margin-top:0px;margin-bottom:0px;" value="{{old('telepon')}}">
                                </div>
                                <div class="form-group" style="margin-top:5px;margin-bottom:0px;">
                                    <label for="" style="margin-top:0px;margin-bottom:0px;">Kecamatan</label>
                                        <select name="kecamatan" class="form-control">
                                            <option>-- Kecamatan --</option>
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" style="margin-top:5px;margin-bottom:0px;">
                                    <label for="" style="margin-top:0px;margin-bottom:0px;">Email</label>
                                    <input type="text" class="form-control" name="email" style="margin-top:0px;margin-bottom:0px;" value="{{old('email')}}">
                                </div>
                                <div class="form-group" style="margin-top:5px;margin-bottom:0px;">
                                    <label for="" style="margin-top:0px;margin-bottom:0px;">Kabupaten/Kota</label>
                                    <select name="kabupaten" class="form-control">
                                        <option value="">--- Kabupaten  ---</option>
                                        @foreach ($kabupaten as $value)
                                            <option value="{{ $value->id }}">{{ $value->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" style="margin-top:5px;margin-bottom:0px;">
                                    <label for="" style="margin-top:0px;margin-bottom:0px;">Desa</label>
                                    <select name="desa" class="form-control">
                                        <option>-- Desa --</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top:0px;margin-bottom:0px;">
                            <label for="" style="margin-top:0px;margin-bottom:0px;">Alamat</label>
                            <textarea name="alamat" rows="3" class="form-control" placeholder="Jalan Kebenaran">{{old('alamat')}}</textarea>
                        </div>
                    </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="box box-info">
                    <div class="box-header with-border" style="margin-left:0px;">
                        <h4 style="margin-top:0px; margin-bottom:0px;">Detail</h4>
                    </div>
                    <div class="box-body">
                        <div class="form-group" style="margin-top:5px;margin-bottom:0px;">
                            <label for="" style="margin-top:0px;margin-bottom:0px;">Jumlah</label>
                            <input type="number" class="form-control" name="jumlah" min="1" value="1">
                        </div>
                        <div class="form-group" style="margin-top:0px;margin-bottom:0px;">
                            <label for="" style="margin-top:0px;margin-bottom:0px;">Deadline</label>
                            <input type="text" class="form-control datepicker" name="deadline" style="margin-top:0px;margin-bottom:0px;" value="{{old('deadline')}}">
                        </div>
                        <div class="form-group" style="margin-top:0px;margin-bottom:0px;">
                            <label for="" style="margin-top:0px;margin-bottom:0px;">Catatan</label>
                            <textarea class="form-control" name="catatan" rows="3">{{old('catatan')}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="box box-info">
                    <div class="box-header with-border" style="margin-left:0px;">
                        <h4 style="margin-top:0px; margin-bottom:0px;">Toko</h4>
                    </div>
                    <div class="box-body">
                        <div class="form-group" style="margin-top:5px;margin-bottom:0px;">
                            <select name="store_id" class="form-control">
                                <option value="">Pilih Toko</option>
                                @foreach($ambilStore as $store)
                                <option value="{{$store->id}}">{{$store->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="box box-info">
                    <div class="box-body">
                        <button type="reset" class="btn btn-warning btn-sm bg-yellow" style="width:175px;">Cancel</button>
                        <button type="submit" class="btn btn-success btn-sm bg-green" style="width:175px;">Order</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    const regexForPhone2 = /^[0-9]*$/;
    const regexForPrice2 = /^[1-9][0-9]*$/;
    const regexForPhoneWithLength2 = /^[0-9]{12,13}$/; //ganti panjang no hp disini
    const regexname = /^[a-zA-Z ]*$/;
</script>
@endsection

@push('header')
<link rel="stylesheet" href="/assets/material/bower_components/bootstrap-daterangepicker/daterangepicker.css">
<link rel="stylesheet" href="/assets/material/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

<style>
    /** Image preview */
#image-preview {
    width: 100%;
    height: 160px;
    position: relative;
    overflow: hidden;
    background-color: #e6ecf3;
    color: #4a5152;
    border: 2px dashed #ccc;
    border-radius: 2px;
}
#image-preview input {
    line-height: 150px;
    font-size: 18px;
    position: absolute;
    opacity: 0;
    z-index: 10;
}
#image-preview label {
    position: absolute;
    z-index: 5;
    opacity: 0.8;
    cursor: pointer;
    background-color: #bdc3c7;
    width: 110px;
    height: 40px;
    font-size: 12px;
    line-height: 3.4em;
    text-transform: uppercase;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    margin: auto;
    text-align: center;
}
</style>
@endpush

@push('footer')
<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
<script type="text/javascript" src="/js/jquery.uploadPreview.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $.uploadPreview({
        input_field: "#image-upload",
        preview_box: "#image-preview",
        label_field: "#image-label"
    });
});
</script>
<script src="/assets/material/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="/assets/material/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
  $(function () {
    //Date picker
    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',
        showInputs: false,
        todayHighlight:'TRUE',
        startDate: '-0d',
        autoclose: true,
    });
  })
</script>
<!-- Input Kecamatan -->
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="kabupaten"]').on('change', function() {
            var kabupatenID = $(this).val();
            if(kabupatenID) {
                $.ajax({
                    url: '/kabupaten/kecamatan/'+kabupatenID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="kecamatan"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="kecamatan"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                    }
                });
            }else{
                $('select[name="kecamatan"]').empty();
            }
        });
    });

    $(document).ready(function() {
        $('select[name="kecamatan"]').on('change', function() {
            var kabupatenID = $(this).val();
            if(kabupatenID) {
                $.ajax({
                    url: '/kecamatan/desa/'+kabupatenID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="desa"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="desa"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                    }
                });
            }else{
                $('select[name="desa"]').empty();
            }
        });
    });
</script>

@endpush
