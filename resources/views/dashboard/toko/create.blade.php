@extends('dashboard.layouts.app')
@section('title', 'Data Toko')
@section('content')
<script defer>
   const regexForPhone = /^[0-9]*$/;
    const regexForPhoneWithLength = /^[0-9]{12,13}$/; //ganti panjang no hp disini
    const regex = /^[a-zA-Z ]*$/;

    const validateOnSubmit = () => {
        document.getElementById('InamaErr').style.display = 'none';
        document.getElementById('IPhoneErr').style.display = 'none';
        const nama = document.getElementById('Inama').value ?? '';
        const phone = document.getElementById('IPhone').value ?? '';
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
        if(!regexForPhone.test(phone)){
            document.getElementById('IPhoneErr').style.display = 'block';
            document.getElementById('IPhoneErr').innerHTML = 'Nomor hp harus terdiri angka';
            return false;
        }
        if(!regexForPhoneWithLength.test(phone)){
            document.getElementById('IPhoneErr').innerHTML = 'panjang nomor hp minimal 12 dan maksimal 13';
            return false;
        }
        return true;
    }
</script>
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
            <div class="box-header with-border" style="margin-left:0px;">
                <h4 style="margin-top:0px; margin-bottom:0px;"><a href="{{route('toko.index')}}"><span
                            class="fa fa-arrow-left"></span></a> Tambah Toko</h4>
            </div>
            @if($errors->any())
            <div class="alert alert-warning alert-dismissble">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>

                    @endforeach
                </ul>
            </div>
            @endif
            <form method="post" action="{{route('toko.store')}}" enctype="multipart/form-data" onsubmit="return validateOnSubmit();">
                @csrf
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-3" style="margin-top: 0px;">
                            <div class="form-group" style="margin-top:0px;">
                                <label style="margin-bottom:10px;">Foto Toko</label>
                                <div id="image-preview">
                                    <label for="image-upload" id="image-label" style="color:#f0f0f0;">Choose
                                        File</label>
                                    <input type="file" name="foto" id="image-upload" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top:0px;">
                        <label>Nama Toko</label>
                        <input required id="Inama" type="text" class="form-control" name="nama" placeholder="Gunting Emas">
                        <p id="InamaErr" style="color:red;display:none;"></p>
                    </div>
                    <div class="form-group" style="margin-top:0px;">
                        <label>No. Telepon</label>
                        <input required type="text" id="IPhone" class="form-control"
                            name="phone" placeholder="082328321344">
                        <p id="IPhoneErr" style="color:red;display:none;"></p>
                    </div>
                    <div class="row" style="margin-top:0px;">
                        <div class="col-md-4" style="margin-top:0px;">
                            <div class="form-group" style="margin-top:0px;">
                                <label>Kabupaten</label>
                                <select required name="kabupaten" class="form-control">
                                    <option value="">--- Kabupaten ---</option>
                                    @foreach ($kabupaten as $value)
                                    <option value="{{ $value->id }}">{{ $value->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4" style="margin-top:0px;">
                            <div class="form-group" style="margin-top:0px;">
                                <label>Kecamatan</label>
                                <!-- <input type="text" class="form-control" name="kecamatan" placeholder="Kecamatan Tarub"> -->
                                <select required name="kecamatan" class="form-control">
                                    <option>-- Kecamatan --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4" style="margin-top:0px;">
                            <div class="form-group" style="margin-top:0px;">
                                <label>Desa</label>
                                <select required name="desa" class="form-control">
                                    <option>-- Desa --</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top:0px;">
                        <label>Alamat</label>
                        <textarea required class="form-control" rows="3" name="alamat"
                            placeholder="Jalan Mawar Merah No 69"></textarea>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="reset" class="btn btn-primary btn-sm bg-navy">Clear</button>
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
<script src="/assets/material/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/assets/material/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

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
@endpush