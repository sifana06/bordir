@extends('layouts.app')
@section('title', 'Toko')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-top:0px;margin-bottom:0px;">Filter</h3>
            </div>
            <div class="box-body">
            <form action="{{route('filter.store')}}" method="post">
            @csrf
                <h5 class="box-title" style="margin-top:0px;">Kecamatan</h5>
                <div class="form-group" style="margin-top:0px;">
                    <select name="filter_kecamatan" class="form-control select2" style="width: 100%;">
                        <option value="">Pilih Kecamatan</option>
                        @foreach($kecamatan as $kec)
                        <option value="{{$kec->id}}">{{$kec->nama}}</option>
                        @endforeach
                    </select>
                </div>
                <hr style="margin-top:5px;margin-bottom:5px;">
                <h5 class="box-title" style="margin-top:0px;">Desa</h5>
                <div class="form-group" style="margin-top:0px;">
                    <select name="filter_desa" class="form-control select2" style="margin-top:0pxwidth:100%;">
                        <option value="">Pilih Desa</option>
                        @foreach($desa as $d)
                        <option value="{{$d->id}}">{{$d->nama}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-blue btn-sm bg-blue" style="width:100%;">Cari</button>
            </div>
            </form>
        </div>
    </div>

    <div class="col-md-9">
    @foreach($toko as $t)
        <div class="card" style="width: 20rem; margin-right: 3px; margin-bottom: 5px;">
            @if($t->foto == NULL)
            <img src="{{url('uploads/image_not_found.png')}}" class="card-img-top" style="border:1px solid black;width:200px;height:150px;">
            @else
            <img src="{{url('uploads/'. $t->foto)}}" class="card-img-top" style="border:1px solid black;width:200px;height:150px;">
            @endif
            <div class="card-body">
                <h5 class="card-title"><a href="{{route('store.detail', $t->id)}}">{{$t->nama}}</a></h5>
                <p class="card-text">{{$t->alamat}}</p>
            </div>
        </div>
    @endforeach
    {{ $toko->links() }}
    </div>
</div>
@endsection


@push('header')
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