@extends('layouts.app')
@section('title', 'Data Produk')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border" style="margin-left:0px;">
                <h4 style="margin-top:0px; margin-bottom:0px;"><a href="{{route('home')}}"><span class="fa fa-arrow-left"></span></a> Detail Produk</h4>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-md-5" style="margin-top:20px;margin-bottom:20px;">
                    @if($produk->foto != NULL)
                        <img src="{{url('/uploads/' . $produk->foto)}}" alt="..." style="width:450px;border:1px solid black;">
                    @else
                        <img src="{{url('/uploads/image_bot_found.png')}}" alt="..." style="width:450px;border:1px solid black;">
                    @endif
                    </div>
                    <div class="col-md-7">
                        <div style="margin-left:20px;">
                            <h3 class="text-black" style="font-size:30px;"><b>{{ucwords($produk->nama)}}</b></h3>
                            <br>
                            <div class="row">
                                <div class="col-sm-3">
                                    <span>Jenis Bordir</span>                                
                                </div>
                                <div class="col-sm-5">
                                    <span>Bordir {{ucwords($produk->jenis_bordir)}}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <span>Harga</span>                                
                                </div>
                                <div class="col-sm-5">
                                    <span>Rp. {{$produk->harga}}</span>
                                </div>
                            </div>
                            <div class="row" style="margin-top:10px;">
                                <div class="col-sm-3">
                                    <span>Deskripsi</span>                                
                                </div>
                                <div class="col-sm-5">
                                    <span>{{ucwords($produk->deskripsi)}}</span>
                                </div>
                            </div>
                            <div class="row" style="margin-top:10px;">
                                <div class="col-sm-3">
                                    <span>Nama Toko</span>                                
                                </div>
                                <div class="col-sm-5">
                                    <span>{{$produk->store->nama}}</span>
                                </div>
                            </div>
                            <div class="row" style="margin-top:10px;">
                                <div class="col-sm-3">
                                    <span>Lokasi</span>                                
                                </div>
                                <div class="col-sm-5">
                                    <span>{{ucwords($produk->store->alamat)}}</span>
                                </div>
                            </div>
                            <a href="{{route('po.create', $produk->id)}}" class="btn btn-success bg-green btn-sm">Pesan Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-sm-1">
                        <div style="margin-top:20px;margin-bottom:20px;margin-left:10px;">
                        @if($produk->store->foto == NULL)
                            <img src="{{url('/uploads/image_not_found.png')}}" alt="..." style="border:1px solid black;width:120px;">
                        @else
                            <img src="{{url('uploads/'. $produk->store->foto)}}" alt="..." style="border:1px solid black;width:120px;">
                        @endif
                        </div>
                    </div>
                    <div class="col-sm-11">
                        <div style="margin-top:20px;margin-bottom:20px;margin-left:50px;margin-right:50px;">
                            <h3>{{ucwords($produk->store->nama)}}</h3>
                            @foreach($kabupaten as $kab)
                                @if($produk->store->kabupaten == $kab->id)
                                    @foreach($kecamatan as $kec)
                                        @if($produk->store->kecamatan == $kec->id)
                                            @foreach($desa as $des)
                                                @if($produk->store->desa == $des->id)
                                                    <span>{{$kab->nama}}, {{$kec->nama}}, {{$des->nama}}</span>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                            <div>
                                <a href="{{route('store.detail', $produk->store_id)}}" class="btn btn-primary bg-blue btn-sm"> Lihat Toko</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('header')

@endpush

@push('footer')

@endpush
