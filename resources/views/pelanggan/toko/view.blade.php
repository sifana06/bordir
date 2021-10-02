@extends('layouts.app')
@section('title', 'Data Toko')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border" style="margin-left:0px;">
                <h4 style="margin-top:0px; margin-bottom:0px;"><a href="#"><span class="fa fa-arrow-left"></span></a> Detail Toko</h4>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-md-3" style="margin-top:20px;margin-bottom:20px;">
                        @if($ptoko->foto != NULL) 
                        <img src="{{url('uploads/' . $ptoko->foto)}}" alt="..." style="margin-left:25px;width:250px;border:1px solid black;">
                        @else
                        <img src="{{url('uploads/image_not_found.png')}}" alt="..." style="margin-left:25px;width:250px;border:1px solid black;">
                        @endif
                    </div>
                    <div class="col-md-9">
                        <div style="margin-left:20px;margin-top:20px;">
                            <h3 class="text-black" style="font-size:25px;">{{$ptoko->nama}}</h3>
                            <div class="row fontawesome-icon-list" style="margin-top:10px;">
                                <div class="row">
                                    <div class="col-md-6">'
                                        <div class="col-md-6 col-sm-4">
                                            <i class="fa fa-fw fa-dropbox"></i> Produk : <span class="text-info">{{count($tproduk)}}</span>
                                        </div>
                                        <br>
                                        <div class="col-md-6 col-sm-4"><i class="fa fa-fw fa-user"></i> Nama Pemilik : <span class="text-info">{{ucwords($ptoko->pemilik->name)}}</span></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col-md-8 col-sm-4"><i class="fa fa-fw fa-user-plus"></i> Bergabung : <span class="text-info">{{$ptoko->created_at}}</span></div>
                                        <br>
                                        <div class="col-md-12 col-sm-4"><i class="fa fa-fw fa-map-pin"></i> Lokasi  : <span class="text-info">{{ucwords($ptoko->alamat)}} <br> {{ucwords($ptoko->cek_desa->nama)}}, {{ucwords($ptoko->cek_kecamatan->nama)}}, {{ucwords($ptoko->cek_kabupaten->nama)}}</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
    @foreach($tproduk as $pt)
        <div class="card" style="width: 20rem; margin-right: 3px; margin-bottom: 5px;">
            @if($pt->foto != NULL)
            <img src="{{url('uploads/'. $pt->foto)}}" class="card-img-top" style="border:1px solid black;width:200px;height:150px;">
            @else
            <img src="{{url('uploads/image_not_found.png')}}" class="card-img-top" style="border:1px solid black;width:200px;height:150px;">
            @endif
            <div class="card-body">
                <h5 class="card-title"><a href="{{route('product.lihat',$pt->id)}}">{{$pt->nama}}</a></h5>
                <p class="card-text">{{$pt->deskripsi}}</p>
                <div class="text-center">
                    <a href="{{route('po.create', $pt->id)}}" class="text-center btn btn-info bg-blue btn-xs">Pesan</a>
                </div>
            </div>
        </div>
    @endforeach
    {{ $tproduk->links() }}
    </div>
</div>
@endsection

@push('header')

@endpush

@push('footer')

@endpush
