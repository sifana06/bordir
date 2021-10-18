@extends('layouts.app')
@section('title', 'Order Produk')

<script defer lang="ts">
    const regexForPrice = /^[1-9][0-9]*$/;
    const regexForPhoneWithLength = /^[0-9]{12,13}$/; //ganti panjang no hp disini
    const regexForNorekening = /^[0-9]{8,30}$/; //ganti panjang rek disini
    const regex = /^[a-zA-Z ]*$/;
    const validateOnSubmit = () => {
        try {
            document.getElementById('IJumlahErr').style.display = 'none';
            const jumlah = document.getElementById('IJumlah').value;
            if(!regexForPrice.test(jumlah)){
                document.getElementById('IJumlahErr').style.display = 'block';
                document.getElementById('IJumlahErr').innerHTML = 'Jumlah harus terdiri angka';
                return false;
            }
            return true;
        } catch (error) {
            alert(error.message);
            console.log(error.message)
            return false;
        }

</script>

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
    <form action="{{route('po.checkout')}}" method="post" onsubmit="return validateOnSubmit();">
        @csrf
        <div class="col-md-8">
            <div class="box box-info">
                <div class="box-header with-border" style="margin-left:0px;">
                    <h4 style="margin-top:0px; margin-bottom:0px;"><a href="{{route('home')}}"><span
                                class="fa fa-arrow-left"></span></a> Produk</h4>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-5" style="margin-top:0px;">
                            <label for="">Foto Produk</label>
                            <!-- <div id="image-preview" style="width:200px;">
                                    <label for="image-upload" id="image-label" style="color:#f0f0f0;">Choose File</label>
                                    <input type="file" name="foto" id="image-upload" />
                                </div> -->
                            @if($ambilProduk->foto != NULL)
                            <img src="{{url('/uploads/' . $ambilProduk->foto)}}" alt="..."
                                style="width:200px;border:1px solid black;">
                            @else
                            <img src="{{url('/uploads/image_bot_found.png')}}" alt="..."
                                style="width:450px;border:1px solid black;">
                            @endif
                        </div>
                    </div>
                    <input type="text" name="product_id" value="{{$ambilProduk->id}}" hidden="true">
                    <input type="text" name="pemilik_id" value="{{$ambilProduk->pemilik_id}}" hidden="true">
                    <input type="text" name="store_id" value="{{$ambilProduk->store_id}}" hidden="true">
                    <div class="form-group" style="margin-top:5px;margin-bottom:0px;">
                        <label for="">Nama Produk</label>
                        <input type="text" class="form-control" name="nama_produk" value="{{$ambilProduk->nama}}"
                            readonly="true">
                    </div>
                    <div class="form-group">
                        <label for="">Harga</label>
                        <input type="text" class="form-control" name="harga" value="{{$ambilProduk->harga}}"
                            readonly="true">
                    </div>
                    <div class="form-group">
                        <label for="">Jenis Bordir</label>
                        <input type="text" class="form-control" name="jenis_bordir"
                            value="Bordir {{ucwords($ambilProduk->jenis_bordir)}}" readonly="true">
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
                                <input type="text" class="form-control" readonly="true" name="nama_pelanggan"
                                    placeholder="Sifana" value="{{$user->name ?? ''}}">
                            </div>
                            <div class="form-group">
                                <label for="">Telepon</label>
                                <input type="text" class="form-control" readonly name="telepon"
                                    placeholder="081234565432" value="{{$user->phone ?? ''}}">
                            </div>
                            <div class="form-group">
                                <label for="">Kecamatan</label>
                                <select required name="kecamatan" class="form-control">
                                    <option>-- Kecamatan --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" style="margin-top:5px;margin-bottom:0px;">
                                <label for="">Email <small>(optional)</small></label>
                                <input type="email" readonly" class="form-control" value="{{$user->email ?? ''}}"
                                    name="email">
                            </div>
                            <div class="form-group">
                                <label for="">Kabupaten/Kota</label>
                                <select required name="kabupaten" class="form-control">
                                    <option value="">--- Kabupaten ---</option>
                                    @foreach ($kabupaten as $value)
                                    <option value="{{ $value->id }}">{{ $value->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Desa</label>
                                <select required name="desa" class="form-control">
                                    <option>-- Desa --</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <textarea required rows="3" class="form-control" name="alamat"
                            placeholder="Jalan Kebenaran">{{old('nama_pelanggan')}}</textarea>
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
                            <label for="">Jumlah</label>
                            <input id="IJumlah" required type="number" class="form-control" name="jumlah" min="1" value="1">
                            <p id="IJumlahErr" style="color:red;display:none;"></p>
                        </div>
                        <div class="form-group">
                            <label for="">Deadline</label>
                            <input required type="date" class="form-control" name="deadline"
                                value="{{old('deadline')}}">
                        </div>
                        <div class="form-group">
                            <label for="">Catatan</label>
                            <textarea required class="form-control" name="catatan"
                                rows="3">{{old('catatan')}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="box box-info">
                    <div class="box-body">
                        <button type="submit" class="btn btn-success btn-sm bg-green"
                            style="width:175px;">Order</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('header')
<link rel="stylesheet" href="/assets/material/bower_components/bootstrap-daterangepicker/daterangepicker.css">
<link rel="stylesheet"
    href="/assets/material/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

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
    const regexForPhone2 = /^[0-9]*$/;
    const regexForPrice2 = /^[1-9][0-9]*$/;
    const regexForPhoneWithLength2 = /^[0-9]{12,13}$/; //ganti panjang no hp disini
    const regexname = /^[a-zA-Z ]*$/;
    function validateEmail(email) {
        const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }
    // $('#Inama').on( "keyup", function( event ) {
    //     $(this).val(regexname.test($(this).val()) ? $(this).val():'');
    // });
    //
    // $('#IBank').on( "keyup", function( event ) {
    //     $(this).val(regexname.test($(this).val()) ? $(this).val():'');
    // });
    // $('#IEmail').on( "keyup", function( event ) {
    //     $('#IEmailErr').css({display:validateEmail($(this).val())?'none':'block'})
    // });

    // $('#IPhone').on( "keyup", function( event ) {
    //     $(this).val(regexForPhone2.test($(this).val()) ? $(this).val():'');
    // });

    //rekening
    $('#IJumlah').on( "keyup", function( event ) {
        $(this).val(regexForPhone2.test($(this).val()) ? $(this).val():'');
    });

    //price
    // $('#IPhone').on( "keyup", function( event ) {
    //     $(this).val(regexForPrice2.test($(this).val()) ? $(this).val():'');
    // });
</script>
@endpush
