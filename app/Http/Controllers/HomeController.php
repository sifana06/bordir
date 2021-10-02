<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Store;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Desa;
use DB;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index()
    {
        $data['produk'] = Product::paginate(12);
        $data['kecamatan'] = Kecamatan::all();
        $data['desa'] = Desa::all();
        return view('pelanggan.home',$data); 
    }

    public function show($id)
    {
        $data['produk']     = Product::with('store')->find($id);
        $data['kabupaten']  = Kabupaten::all();
        $data['kecamatan']  = Kecamatan::all();
        $data['desa']       = Desa::all();
        return view('pelanggan.produk.view', $data);
    }

    public function getToko()
    {
        $data['toko'] = Store::paginate(12);
        return view('pelanggan.toko.all',$data);
    }

    public function filterProduk(Request $request)
    {
        $data['produk'] = Product::where('jenis_bordir', $request->r3)->paginate(12);
        $data['kecamatan'] = Kecamatan::all();
        $data['desa'] = Desa::all();
        return view('pelanggan.home',$data);
    }
    
    public function filterStore(Request $request)
    {
        if($request->filter_kecamatan != null && $request->filter_desa != null){
            $data['toko'] = Store::where('kecamatan', $request->filter_kecamatan)->where('desa',$request->filter_desa)->paginate(12);
        }elseif($request->filter_kecamatan != null && $request->filter_desa == null){
            $data['toko'] = Store::where('kecamatan', $request->filter_kecamatan)->where('desa',$request->filter_desa)->paginate(12);
        }elseif($request->filter_kecamatan == null && $request->filter_desa != null){
            $data['toko'] = Store::where('kecamatan', $request->filter_desa)->where('desa',$request->filter_desa)->paginate(12);
        }else{
            $data['toko'] = Store::paginate(12);
        }
        $data['kecamatan'] = Kecamatan::all();
        $data['desa'] = Desa::all();
        return view('pelanggan.toko.all',$data);
    }
}
