@extends('dashboard.layouts.app')
@section('title', 'Data Users')

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
          if(!regexForPhone.test(phone)){
              document.getElementById('IPhoneErr').style.display = 'block';
              document.getElementById('IPhoneErr').innerHTML = 'Nomor hp harus terdiri angka';
              return false;
          }
          if(!regexForPhoneWithLength.test(phone)){
              document.getElementById('IPhoneErr').style.display = 'block';
              document.getElementById('IPhoneErr').innerHTML = 'Nomor HP tidak boleh kurang dari 12 dan lebih dari 13';
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
  <!-- left column -->
  <div class="col-md-4">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <div class="box-title">
          <h4 style="margin-top: 0px; margin-bottom: 0px;">Invite New Users</h4>
        </div>
      </div>
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
      <!-- /.box-header -->
      <!-- form start -->
      <form method="post" class="form-horizontal" action="{{ route('user.store')}}" enctype="multipart/form-data" autocomplete="off" onsubmit="return validateOnSubmit();">
        <div class="box-body">
          <div class="form-group">
            @csrf
            <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
            <div class="col-sm-10">
              <input required id="Inama" type="text" class="form-control" name="name" placeholder="Nama akun">
              <p id="InamaErr" style="color:red;display:none;"></p>
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
              <input required id="IEmail" type="email" class="form-control" name="email" placeholder="email@emai.com">
                <p id="IEmailErr" style="color:red;display: none">Email Harus Valid</p>
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Telepon</label>
            <div class="col-sm-10">
              <input required id="IPhone" type="number" class="form-control" placeholder="6283453234555" name="phone">
              <p id="IPhoneErr" style="color:red;display:none;"></p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Jenis Kelamin</label>
            <div class="col-sm-10">
              <select required name="jenis_kelamin" class="form-control">
                <option value="">Pilih Jenis Kelamin</option>
                <option value="laki-laki">Laki-laki</option>
                <option value="perempuan">Perempuan</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Role</label>
            <div class="col-sm-10">
              <select required name="role" class="form-control">
                <option value="">Pilih role</option>
                <option value="admin">Admin</option>
                <option value="pemilik">Pemilik</option>
                <option value="pelanggan">Pelanggan</option>
              </select>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button type="reset" class="btn btn-default">Batal</button>
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
        <!-- /.box-footer -->
      </form>
    </div>
  </div>
  <!--/.col (left) -->
  <!-- right column -->
  <div class="col-md-8">
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
        <table id="user-table" class="table table-bordered table-striped" style="width:100%!important;">
          <thead>
            <tr>
              <th width="10">No</th>
              <th width="150">Nama</th>
              <th>Kontak</th>
              <th>Alamat</th>
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
      $('#IEmail').on( "keyup", function( event ) {
          $('#IEmailErr').css({display:validateEmail($(this).val())?'none':'block'})
      });
      $('#IPhone').on( "keyup", function( event ) {
          $(this).val(regexForPhone2.test($(this).val()) ? $(this).val():'');
      });
    $(function() {
      $('#user-table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: '{!! route('user.getdata') !!}',
        columns: [
        { data: 'DT_RowIndex', orderable: false, searchable: false },
        { data: 'name', name: 'name' },
        { data: 'kontak', name: 'kontak' },
        { data: 'alamat', name: 'alamat' },
        { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
      });
    });
  </script>
  @endpush
