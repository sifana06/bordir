@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-top:0px;margin-bottom:0px;">Filter</h3>
            </div>
            <div class="box-body">
                <form action="{{route('filter.produk')}}" method="post">
                    @csrf
                    <h5 class="box-title" style="margin-top:0px;">Jenis Bordir</h5>
                    <div class="form-group"  style="margin-top:0px;">
                        <label>
                        <input type="radio" name="r3" class="flat-red" value="logo">
                        <small>Bordir Logo</small>
                        </label>
                        <br>
                        <label>
                        <input type="radio" name="r3" class="flat-red" value="kaos">
                        <small>Bordir Kaos</small>
                        </label>
                    </div>
                <!-- <hr style="margin-top:5px;margin-bottom:5px;">
                <h5 class="box-title" style="margin-top:0px;">Kecamatan</h5>
                <div class="form-group" style="margin-top:0px;">
                    <select class="form-control select2" style="width: 100%;">
                        <option value="">Select Kecamatan</option>
                        @foreach($kecamatan as $kcm)
                            <option value="{{$kcm->id}}">{{$kcm->nama}}</option>
                        @endforeach
                    </select>
                </div>
                <hr style="margin-top:5px;margin-bottom:5px;">
                <h5 class="box-title" style="margin-top:0px;">Desa</h5>
                <div class="form-group" style="margin-top:0px;">
                    <select name="" class="form-control select2" style="margin-top:0px;">
                        <option value="">Select Desa</option>
                        @foreach($desa as $ds)
                        <option value="{{$ds->id}}">{{$ds->nama}}</option>
                        @endforeach
                    </select>
                </div> -->
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-blue btn-sm bg-blue" style="width:100%;">Cari</button>
            </div>
            </form>
        </div>
    </div>

    <div class="col-md-9">
    @foreach($produk as $pro)
        <div class="card" style="width: 20rem; margin-right: 3px; margin-bottom: 5px;">
            @if($pro->foto == NULL)
            <img src="{{url('uploads/image_not_found.png')}}" class="card-img-top" style="border:1px solid black;width:200px;height:150px;">
            @else
            <img src="{{url('uploads/'. $pro->foto)}}" class="card-img-top" style="border:1px solid black;width:200px;height:150px;">
            @endif
            <div class="card-body">
                <h5 class="card-title"><a href="{{route('product.lihat',$pro->id)}}">{{$pro->nama}}</a></h5>
                <span class="text-success">Rp. {{$pro->harga}}</span>
                <p class="card-text">{{substr($pro->deskripsi,0,50)}}</p>
                <div class="text-center">
                    <a href="{{route('po.create',$pro->id)}}" class="text-center">Pesan</a>
                </div>
            </div>
        </div>
    @endforeach
    {{ $produk->links() }}
    </div>
</div>
@endsection

@push('header')
<style>
.rating {
    float:left;
    width:300px;
}
.rating span { float:right; position:relative; }
.rating span input {
    position:absolute;
    top:0px;
    left:0px;
    opacity:0;
}
.rating span label {
    display:inline-block;
    width:30px;
    height:30px;
    text-align:center;
    color:#FFF;
    background:#ccc;
    font-size:30px;
    margin-right:2px;
    line-height:30px;
    border-radius:50%;
    -webkit-border-radius:50%;
}
.rating span:hover ~ span label,
.rating span:hover label,
.rating span.checked label,
.rating span.checked ~ span label {
    background:#F90;
    color:#FFF;
}
</style>

<link rel="stylesheet" href="/assets/material/bower_components/select2/dist/css/select2.min.css">
@endpush

@push('footer')
<script src="/assets/material/bower_components/select2/dist/js/select2.full.min.js"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  });
</script>
@endpush