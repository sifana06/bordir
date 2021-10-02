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
  <div class="col-lg-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <div class="box-title">
          <h4 style="margin-top: 0px; margin-bottom: 0px;">Edit Users</h4>
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
      <form method="post" class="form-horizontal" action="{{ route('user.update',$user->id)}}" enctype="multipart/form-data" autocomplete="off" onsubmit="return validateOnSubmit();">
        {{csrf_field()}}
        {{method_field('put')}}
        <div class="box-body">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
            <div class="col-sm-10">
              <input type="text" id="Inama" required class="form-control" name="name" placeholder="Nama akun" value="{{$user->name}}">
              <p id="InamaErr" style="color:red;display:none;"></p>
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
              <input type="email" required class="form-control" name="email" placeholder="email@emai.com" value="{{$user->email}}">
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Telepon</label>
            <div class="col-sm-10">
              <input type="number" id="IPhone" required class="form-control" placeholder="6283453234555" name="phone" value="{{$user->phone}}">
              <p id="IPhoneErr" style="color:red;display:none;"></p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Jenis Kelamin</label>
            <div class="col-sm-10">
              <select required name="jenis_kelamin" class="form-control">
                <option value="">Pilih Jenis Kelamin</option>
                <option value="laki-laki" {{$user->jenis_kelamin == 'laki-laki' ? 'selected':''}}>Laki-laki</option>
                <option value="perempuan" {{$user->jenis_kelamin == 'perempuan' ? 'selected':''}}>Perempuan</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Role</label>
            <div class="col-sm-10">
              <select required name="role" class="form-control">
                <option value="">Pilih role</option>
                <option value="admin" {{$user->role == 'admin' ? 'selected':''}}>Admin</option>
                <option value="pemilik" {{$user->role == 'pemilik' ? 'selected':''}}>Pemilik</option>
                <option value="pelanggan"  {{$user->role == 'pelanggan' ? 'selected':''}}>Pelanggan</option>
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

@endsection

@push('header')
@endpush

@push('footer')
@endpush
