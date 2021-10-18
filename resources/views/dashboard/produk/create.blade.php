@extends('dashboard.layouts.app')
@section('title', 'Data Produk')
<script defer>
    const regexForPhone = /^[0-9]*$/;
    const regexForPrice = /^[1-9][0-9]*$/;
    const regexForPhoneWithLength = /^[0-9]{12,13}$/; //ganti panjang no hp disini
    const regex = /^[a-zA-Z ]*$/;
    const validateOnSubmit = () => {
        try {
            document.getElementById('InamaErr').style.display = 'none';
            document.getElementById('IPhoneErr').style.display = 'none';
            const nama = document.getElementById('Inama').value;
            const phone = document.getElementById('IPhone').value;
            if(!regex.test(nama)){
                document.getElementById('InamaErr').style.display = 'block';
                document.getElementById('InamaErr').innerHTML = 'Input harus terdiri dari huruf';
                return false;
            }
            if(nama.length > 50){
                document.getElementById('InamaErr').style.display = 'block';
                document.getElementById('InamaErr').innerHTML = 'Input tidak boleh lebih dari 50';
                return false;
            }
            if(!regexForPrice.test(phone)){
                document.getElementById('IPhoneErr').style.display = 'block';
                document.getElementById('IPhoneErr').innerHTML = 'Harga harus terdiri angka dan tidak diawali dengan 0';
                return false;
            }
                return true;
        } catch (error) {
            alert(error.message);
            console.log(error.message)
            return false;
        }

    }
</script>
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
        <div class="box box-info">
            <div class="box-header with-border" style="margin-left:0px;">
                <h4 style="margin-top:0px; margin-bottom:0px;"><a href="{{route('toko.index')}}"><span
                            class="fa fa-arrow-left"></span></a> Tambah Toko</h4>
            </div>
            <form method="post" action="{{route('product.store')}}" enctype="multipart/form-data"
                onsubmit="return validateOnSubmit();">
                @csrf
                <div class="box-body">
                    <div class="row" style="margin-top:0px;">
                        <div class="col-sm-3" style="margin-top: 0px;">
                            <div class="form-group" style="margin-top:0px;">
                                <label style="margin-bottom:10px;">Foto Produk</label>
                                <div id="image-preview">
                                    <label for="image-upload" id="image-label" style="color:#f0f0f0;">Choose
                                        File</label>
                                    <input required type="file" name="foto" id="image-upload" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top:0px;">
                        <label>Nama Produk</label>
                        <input required id="Inama" type="text" class="form-control" name="nama"
                            placeholder="Bordir tepi logo" value="{{old('nama')}}">
                        <p id="InamaErr" style="color:red;display:none;"></p>
                    </div>
                    <div class="form-group" style="margin-top:0px;">
                        <label>Toko</label>
                        <select required name="store_id" class="form-control">
                            <option value="">-- Pilih Toko --</option>
                            @foreach($toko as $t)
                            <option value="{{$t->id}}">{{$t->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" style="margin-top:0px;">
                        <label>Jenis Bordir</label>
                        <select required name="jenis_bordir" class="form-control">
                            <option value="">-- Pilih Jenis --</option>
                            <option value="logo">Bordir Logo</option>
                            <option value="kaos">Bordir Kaos</option>
                        </select>
                    </div>
                    <div class="form-group" style="margin-top:0px;">
                        <label>Harga</label>
                        <input required id="IPhone" type="text" name="harga" class="form-control"
                            value="{{old('harga')}}">
                        <p id="IPhoneErr" style="color:red;display:none;"></p>
                    </div>
                    <div class="form-group" style="margin-top:0px;">
                        <label>Deskripsi</label>
                        <textarea required class="form-control" rows="3" name="deskripsi"
                            placeholder="Deskripsi Produk">{{old('deskripsi')}}</textarea>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="reset" class="btn btn-primary btn-sm bg-navy">Reset</button>
                    <button type="submit" class="btn btn-success btn-sm bg-green">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--/.col (right) -->
<div class="modal fade" id="konfirmasi_hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center">
                <b>Anda yakin ingin menghapus Permanen data ini ?</b>
                <br><br>
                <a class="btn btn-danger btn-ok"> Hapus</a><button type="button" class="btn btn-primary"
                    data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('header')
<link rel="stylesheet" href="/assets/material/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
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
<script src="/assets/material/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/assets/material/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="/resource/js/image-prerview.js"></script>
<script>
    const regexForPhone2 = /^[0-9]*$/;
    const regexForPrice2 = /^[1-9][0-9]*$/;
    const regexForPhoneWithLength2 = /^[0-9]{12,13}$/; //ganti panjang no hp disini
    const regexname = /^[a-zA-Z ]*$/;
    function validateEmail(email) {
        const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }
    $('#Inama').on( "keyup", function( event ) {
        $(this).val(regexname.test($(this).val()) ? $(this).val():'');
    });
    // $('#IEmail').on( "keyup", function( event ) {
    //     $('#IEmailErr').css({display:validateEmail($(this).val())?'none':'block'})
    // });

    // $('#IPhone').on( "keyup", function( event ) {
    //     $(this).val(regexForPhone2.test($(this).val()) ? $(this).val():'');
    // });

    //price
    $('#IPhone').on( "keyup", function( event ) {
        $(this).val(regexForPrice2.test($(this).val()) ? $(this).val():'');
    });
</script>
@endpush
