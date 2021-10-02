@extends('dashboard.layouts.app')
@section('title', 'Data Orders')

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
    <form action="{{route('order.update',$order->id)}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="col-md-7">
            <div class="box box-info">
                <div class="box-header with-border" style="margin-left:0px;">
                    <h4 style="margin-top:0px; margin-bottom:0px;"><a href="#"><span class="fa fa-arrow-left"></span></a> Detail Order</h4>
                </div>
                    <div class="box-body">
                        <div class="form-group" style="margin-top:5px;margin-bottom:0px;">
                            <label for="">Order Number</label>
                            <input type="text" class="form-control" name="order_number" value="{{$order->order_number}}" readonly="true">
                        </div>
                        <div class="row">
                            <div class="col-md-5" style="margin-top:0px;">
                                <label for="">Foto Produk</label>
                                @if($order->foto == NULL)
                                    <img src="{{url('/uploads/' . $order->get_product->foto)}}" alt="..." style="width:200px;border:1px solid black;">
                                @elseif($order->foto != NULL)
                                <div id="image-preview" style="width:200px; background-image: url(/uploads/{{$order->foto}});background-size: cover;background-position: center center;">
                                    <label for="image-upload" id="image-label" style="color:#f0f0f0;">Choose File</label>
                                    <input type="file" name="foto" id="image-upload" />
                                </div>
                                @else
                                    <img src="{{url('/uploads/image_not_found.png')}}" alt="..." style="width:450px;border:1px solid black;">
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Harga</label>
                                    @if($order->harga != null)
                                    <input type="text" class="form-control" name="harga" value="{{$order->harga}}" readonly="true">
                                    @else
                                    <input type="text" class="form-control" name="harga" value="{{$order->harga}}" required>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Jumlah</label>
                                    <input type="text" class="form-control" name="jumlah" value="{{$order->jumlah}}" readonly="true">
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top:0px;">
                            <label for="">Jenis Bordir</label>
                            <input type="text" class="form-control" name="jenis_bordir" value="Bordir {{ucwords($order->jenis_bordir)}}" readonly="true">
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
                                    <label for="">Nama Customer</label>
                                    <input type="text" class="form-control" name="nama_pelanggan"  value="{{$order->nama_pelanggan}}" readonly="true">
                                </div>
                                <div class="form-group" style="margin-top:0px;">
                                    <label for="">Telepon</label>
                                    <input type="text" class="form-control" name="telepon"  value="{{$order->telepon}}" readonly="true">
                                </div>
                                <div class="form-group" style="margin-top:0px;">
                                    <label for="">Kecamatan</label>
                                    <input type="text" class="form-control" value="{{$order->cek_kecamatan->nama}}" readonly="true">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" style="margin-top:5px;margin-bottom:0px;">
                                    <label for="">Email <small>(optional)</small></label>
                                    <input type="text" class="form-control" name="nama_produk" >
                                </div>
                                <div class="form-group" style="margin-top:0px;">
                                    <label for="">Kabupaten/Kota</label>
                                    <input type="text" class="form-control"  value="{{$order->cek_kabupaten->nama}}" readonly="true">
                                </div>
                                <div class="form-group" style="margin-top:0px;">
                                    <label for="">Desa</label>
                                    <input type="text" class="form-control"  value="{{$order->cek_desa->nama}}" readonly="true">
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top:0px;">
                            <label for="">Alamat</label>
                            <textarea rows="3" class="form-control" name="alamat" placeholder="Jalan Kebenaran" readonly="true">{{$order->alamat}}</textarea>
                        </div>
                    </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="box box-info">
                    <div class="box-header with-border" style="margin-left:0px;">
                        <h4 style="margin-top:0px; margin-bottom:0px;">Status</h4>
                    </div>
                    <div class="box-body">
                        <div class="form-group" style="margin-top:5px;margin-bottom:0px;">
                            <label for="" style="margin-top:0px;margin-bottom:0px;">Status order</label>
                            <select name="status_order" class="form-control" {{auth()->user()->role == "pelanggan" ? 'disabled' : ''}}>
                                <option value="pending" {{$order->status_order == "pending" ? 'selected':''}}>Pending</option>
                                <option value="order" {{$order->status_order == "order" ? 'selected':''}}>Order</option>
                                @if($order->status_order == 'success')
                                <option value="success" {{$order->status_order == "success" ? 'selected':''}} disabled>Success</option>
                                @endif
                                <option value="cancel" {{$order->status_order == "cancel" ? 'selected':''}}>Cancel</option>
                            </select>
                        </div>
                    </div>
                </div>
                @if($order->status_order == 'order')
                <div class="box box-info">
                    <div class="box-header with-border" style="margin-left:0px;">
                        <h4 style="margin-top:0px; margin-bottom:0px;">Detail Pembayaran</h4>
                    </div>
                    <div class="box-body">
                        <div class="form-group" style="margin-top:0px;margin-bottom:0px;">
                            <label for="">Total Pembayaran</label>
                            <input type="text" name="total_pembayaran" class="form-control" readonly="true" value="{{$order->total}}">
                        </div>
                        <input type="text" name="id_pembayaran" readonly="true" value="" hidden="true">
                        <div class="form-group" style="margin-top:0px;margin-bottom:0px;">
                            <label for="">Tipe Pembayaran</label>
                            <select name="tipe_pembayaran" id="seeAnotherField" class="form-control">
                                <option value="">Pilih Tipe Pembayaran</option>
                                <option value="COD" {{$order->tipe_pembayaran == "COD" ? 'selected':''}}>Cash On Delivery(COD)</option>
                                <option value="transfer" {{$order->tipe_pembayaran == "transfer" ? 'selected':''}}>Transfer</option>
                            </select>
                        </div>
                        <div class="form-group" style="margin-top:0px;margin-bottom:0px;" id="rekeningFieldDiv">
                            <label for="rekeningField">Rekening Pembayaran</label>
                            <select name="rekening_id" id="rekeningField" class="form-control col-sm-12" disabled>
                                <option value="">Pilih Rekening</option>
                                @foreach($rekening as $rek)
                                <option value="{{$rek->id}}" {{$order->rekening_id == $rek->id ? 'selected':''}}>{{$rek->nama_bank.' - '.$rek->no_rekening}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" style="margin-top:0px;margin-bottom:0px;" id="tglFieldDiv">
                            <label for="tglField" style="margin-top:0px;margin-bottom:0px;">Tanggal Pembayaran</label>
                            <input type="text" name="tanggal_pembayaran" id="tglField" class="form-control datepicker" value="{{$order->tanggal_pembayaran}}" {{$order->tipe_pembayaran == 'transfer' ? 'disabled':''}}>
                        </div>
                        <div class="form-group" style="margin-top:0px;margin-bottom:0px;" id="statusFieldDiv">
                            <label for="statusField" style="margin-top:0px;margin-bottom:0px;">Status Pembayaran</label>
                            <select name="status_pembayaran" id="statusField" class="form-control">
                                <option value="">Pilih Status Pembayaran</option>
                                <option value="belum dibayar" {{$order->status_pembayaran == "belum dibayar" ? 'selected':''}}>Belum Dibayar</option>
                                <option value="sudah dibayar" {{$order->status_pembayaran == "sudah dibayar" ? 'selected':''}}>Sudah Dibayar</option>
                            </select>
                        </div>
                        <div class="row" id="buktiFieldDiv">
                            <div class="col-md-12" style="margin-top:0px;">
                                <label for="">Bukti Pembayaran</label>
                                <div id="image-preview" id="buktiField" style="background-image: url(/uploads/{{$order->bukti_transaksi}});background-size: cover;background-position: center center;">
                                    <label for="image-upload" id="image-label" style="color:#f0f0f0;">Choose File</label>
                                    <input type="file" name="bukti_pembayaran" id="image-upload" {{$order->tipe_pembayaran == 'transfer' ? 'disabled':''}}/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="box box-info">
                    <div class="box-header with-border" style="margin-left:0px;">
                        <h4 style="margin-top:0px; margin-bottom:0px;">Pengiriman</h4>
                    </div>
                    <div class="box-body">
                        <div class="form-group" style="margin-top:0px;margin-bottom:0px;">
                            <label for="" style="margin-top:0px;margin-bottom:0px;">Status Pengiriman</label>
                            <select name="status_pengiriman" class="form-control">
                                <option value="">Pilih Status Pengiriman</option>
                                <option value="belum dikirim" {{$order->status_pengiriman == 'belum dikirim' ? 'selected':''}}>Belum Dikirim</option>
                                <option value="sudah dikirim" {{$order->status_pengiriman == 'sudah dikirim' ? 'selected':''}}>Sudah Dikirim</option>
                            </select>
                        </div>
                        
                        <div class="form-group" style="margin-top:0px;margin-bottom:0px;">
                            <label for="" style="margin-top:0px;margin-bottom:0px;">Status Penerimaan</label>
                            <select name="status_penerima" class="form-control" disabled>
                                <option value="">Pilih Status </option>
                                <option value="belum diterima">Belum Diterima</option>
                                <option value="sudah diterima">Sudah Diterima</option>
                            </select>
                        </div>
                        
                    </div>
                </div>
                @endif
                
                <!-- <div class="box box-info">
                    <div class="box-header with-border" style="margin-left:0px;">
                        <h4 style="margin-top:0px; margin-bottom:0px;">Pengiriman</h4>
                    </div>
                    <div class="box-body">
                        <div class="form-group" style="margin-top:0px;margin-bottom:0px;">
                            <label for="" style="margin-top:0px;margin-bottom:0px;">Status Pengiriman</label>
                            <select name="status_pengiriman" class="form-control" disabled>
                                <option value="belum dikirim">Belum Dikirim</option>
                                <option value="sudah dikirim">Sudah Dikirim</option>
                            </select>
                        </div>
                        
                        <div class="form-group" style="margin-top:0px;margin-bottom:0px;">
                            <label for="" style="margin-top:0px;margin-bottom:0px;">Status Penerimaan</label>
                            <select name="status_penerima" class="form-control">
                                <option value="">Pilih Status </option>
                                <option value="belum diterima">Belum Diterima</option>
                                <option value="sudah diterima">Sudah Diterima</option>
                            </select>
                        </div>
                        
                    </div>
                </div> -->
                
                <div class="box box-info">
                    <div class="box-body">
                        <a href="{{route('order.index')}}" class="btn btn-warning btn-sm bg-red" style="width:155px;">Cancel</a>
                        <button type="submit" class="btn btn-success btn-sm bg-green" style="width:155px;">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
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
<script>
$("#seeAnotherField").change(function() {
  if ($(this).val() == "transfer") {
    $('#rekeningFieldDiv').show();
    $('#rekeningField').attr('required', '');
    $('#rekeningField').attr('data-error', 'This field is required.');
    $('#buktiFieldDiv').show();
    $('#buktiField').attr('required', '');
    $('#buktiField').attr('data-error', 'This field is required.');
    $('#tglFieldDiv').show();
    $('#tglField').attr('required', '');
    $('#tglField').attr('data-error', 'This field is required.');
    $('#statusFieldDiv').show();
    $('#statusField').attr('required', '');
    $('#statusField').attr('data-error', 'This field is required.');
  }else if($(this).val() == 'COD') {
    $('#tglFieldDiv').show();
    $('#tglField').attr('required', '');
    $('#tglField').attr('data-error', 'This field is required.');
    $('#rekeningFieldDiv').hide();
    $('#rekeningField').removeAttr('required');
    $('#rekeningField').removeAttr('data-error');
    $('#buktiFieldDiv').hide();
    $('#buktiField').removeAttr('required');
    $('#buktiField').removeAttr('data-error');
    $('#statusFieldDiv').show();
    $('#statusField').removeAttr('required');
    $('#statusField').removeAttr('data-error');
  }else{
    $('#rekeningFieldDiv').hide();
    $('#rekeningField').removeAttr('required');
    $('#rekeningField').removeAttr('data-error');
    $('#buktiFieldDiv').hide();
    $('#buktiField').removeAttr('required');
    $('#buktiField').removeAttr('data-error');
    $('#tglFieldDiv').hide();
    $('#tglField').removeAttr('required');
    $('#tglField').removeAttr('data-error');
    $('#statusFieldDiv').hide();
    $('#statusField').removeAttr('required');
    $('#statusField').removeAttr('data-error');
  }
});
$("#seeAnotherField").trigger("change");
</script>
@endpush