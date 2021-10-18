@extends('dashboard.layouts.app')
@section('title', 'Data Rekening')
<script defer>
    const regexForPhone = /^[0-9]*$/;
    const regexForPrice = /^[1-9][0-9]*$/;
    const regexForPhoneWithLength = /^[0-9]{12,13}$/; //ganti panjang no hp disini
    const regexForNorekening = /^[0-9]{8,30}$/; //ganti panjang rek disini
    const regex = /^[a-zA-Z ]*$/;
    const validateOnSubmit = () => {
        try {
            document.getElementById('InamaErr').style.display = 'none';
            document.getElementById('IPhoneErr').style.display = 'none';
            document.getElementById('IbankErr').style.display = 'none';
            const nama = document.getElementById('Inama').value;
            const phone = document.getElementById('IPhone').value;
            const bank = document.getElementById('IBank').value;
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
            if(!regex.test(bank)){
                document.getElementById('IbankErr').style.display = 'block';
                document.getElementById('IbankErr').innerHTML = 'Input harus terdiri dari huruf';
                return false;
            }
            if(!regexForPhone.test(phone)){
                document.getElementById('IPhoneErr').style.display = 'block';
                document.getElementById('IPhoneErr').innerHTML = 'Nomor rekening harus terdiri angka';
                return false;
            }
            if(!regexForNorekening.test(phone)){
                document.getElementById('IPhoneErr').style.display = 'block';
                document.getElementById('IPhoneErr').innerHTML = 'Nomor Rekening tidak boleh kurang dari 8 dan lebih dari 30';
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
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="box-title">
                    <h4 style="margin-top: 0px; margin-bottom: 0px;"><a href="{{route('rekening.index')}}"><span
                                class="fa fa-arrow-left"></span></a> Edit Nomor Rekaning</h4>
                </div>
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
            <!-- /.box-header -->
            <!-- form start -->
            <form method="post" action="{{ route('rekening.update',$rekening->id)}}" enctype="multipart/form-data"
                autocomplete="off" onsubmit="return validateOnSubmit();">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="box-body">
                    <div class="form-group">
                        <label>Nama Bank</label>
                        <input required id="IBank" type="text" class="form-control" name="nama_bank" placeholder="Bank BRI"
                            value="{{$rekening->nama_bank}}">
                        <p id="IbankErr" style="color:red;display:none;"></p>
                    </div>
                    <div class="form-group">
                        <label>No Rekening</label>
                        <input required id="IPhone" type="text" class="form-control" name="no_rekening" placeholder="5556238261"
                            value="{{$rekening->no_rekening}}">
                        <p id="IPhoneErr" style="color:red;display:none;"></p>
                    </div>
                    <div class="form-group">
                        <label>Nama Pemilik Rekening</label>
                        <input required id="Inama" type="text" class="form-control" placeholder="Ahmad Rojali" name="nama_pemilik"
                            value="{{$rekening->nama_pemilik}}">
                        <p id="InamaErr" style="color:red;display:none;"></p>
                    </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="reset" class="btn btn-warning">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
                <!-- /.box-footer -->
            </form>
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
    @endpush

    @push('footer')
    <script src="/assets/material/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/assets/material/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
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

            $('#IBank').on( "keyup", function( event ) {
                $(this).val(regexname.test($(this).val()) ? $(this).val():'');
            });
            // $('#IEmail').on( "keyup", function( event ) {
            //     $('#IEmailErr').css({display:validateEmail($(this).val())?'none':'block'})
            // });

            // $('#IPhone').on( "keyup", function( event ) {
            //     $(this).val(regexForPhone2.test($(this).val()) ? $(this).val():'');
            // });

            //rekening
            $('#IPhone').on( "keyup", function( event ) {
                $(this).val(regexForPhone2.test($(this).val()) ? $(this).val():'');
            });

            //price
            // $('#IPhone').on( "keyup", function( event ) {
            //     $(this).val(regexForPrice2.test($(this).val()) ? $(this).val():'');
            // });
        </script>
    @endpush
