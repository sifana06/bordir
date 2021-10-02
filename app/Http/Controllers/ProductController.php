<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Store;
use DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        return view('dashboard.produk.all');
    }

    public function create()
    {
        $pemilik_id = auth()->user()->id;
        $data['toko'] = Store::where('pemilik_id',$pemilik_id)->get();
        return view('dashboard.produk.create', $data);
    }

    public function store(Request $request)
    {
        //ambil id user yg sedang login
        $pemilik_id = auth()->user()->id;
        /**
         * Baris ini untuk menampilkan pesan saat validasi tidak sesuai
         */
        // $messages = [
        //     'required' => ':attribute tidak boleh kosong.'
        // ];

        $messages = [
            'required' => ':atribute tidak boleh kosong',
            'numeric' => ':atribute harus berupa angka',
            'mimes' => ':atribut diisi yang benar jpg,png,jpeg,gif,svg',
            'regex' => ':atribute harus berupa huruf',

        ];
        // /**
        //  * CustomAttributes -> untuk mengubah nama attribute
        //  * misal nama field di tabel database phone terus mau di ubah jadi nomor hp, dll.
        $customAttributes = [

            'foto' => 'Foto',
            'nama' => 'Nama',
            'jenis_bordir' => 'Jenis Bordir',
            'harga' => 'Harga',
            'deskripsi' => 'Keterangan Produk',
        ];
        /**
         * rule validasi (contoh: required->harus di isi)
         * liat di dokumentasi validation laravel.com
        */
        $valid = $request->validate([
            'foto' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
            'nama' => 'required|regex:/(^[A-Za-z ]+$)+/',
            'jenis_bordir' => 'required',
            'harga' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'deskripsi' => 'required',
        ]);

        //cek foto
        $cover = $request->file('foto');
        $extension = $cover->getClientOriginalExtension();

        // $img = Image::make($image->getRealPath());
        // $img->resize(120, 120, function ($constraint) {
        //     $constraint->aspectRatio();                 
        // });

        Storage::disk('public')->put($cover->getFilename().'.'.$extension,  File::get($cover));
    
        //Cek apakah validasi di atas benar
        if($valid == true){
            $data_produk = new Product([
                'store_id' => $request->get('store_id'),
                'pemilik_id' => $pemilik_id,
                'nama' => $request->get('nama'),
                'jenis_bordir' => $request->get('jenis_bordir'),
                'harga' => $request->get('harga'),
                'foto' => $cover->getFilename().'.'.$extension,
                'deskripsi' => $request->get('deskripsi'),
            ]);
            
            $data_produk->save();
            
            return redirect()->route('product.index')->with('success','Produk berhasil ditambahkan.');
        }
        else {
            return view('dashboard.produk.create')->withInput();
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $pemilik_id = auth()->user()->id;
        $data['toko'] = Store::where('pemilik_id',$pemilik_id)->get();
        $data['produk'] = Product::find($id);
        return view('dashboard.produk.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'required' => ':atribute tidak boleh kosong',
            'numeric' => ':atribute harus berupa angka',
            'mimes' => ':atribut diisi yang benar jpg,png,jpeg,gif,svg',
            'image' => ':atribute harus gambar',
            'regex' => ':atribute harus berupa huruf',

        ];
        // /**
        //  * CustomAttributes -> untuk mengubah nama attribute
        //  * misal nama field di tabel database phone terus mau di ubah jadi nomor hp, dll.
        $customAttributes = [

            'foto' => 'Foto',
            'nama' => 'Nama',
            'jenis_bordir' => 'Jenis Bordir',
            'harga' => 'Harga',
            'deskripsi' => 'Keterangan Produk',
        ];
        if($request->foto != null){
            $valid = $request->validate([
                'foto' => 'required|mimes:jpg,png,jpeg,gif,svg',
                'nama' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'jenis_bordir' => 'required',
                'harga' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'deskripsi' => 'required',
            ]);
        }else{
            $valid = $request->validate([
                'nama' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'jenis_bordir' => 'required',
                'harga' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'deskripsi' => 'required',
            ]);
        }

    
        //Cek apakah validasi di atas benar
        if($valid == true){
            if($request->foto == NULL){
                $data_produk = Product::find($id);
                $data_produk->store_id = $request->store_id;
                $data_produk->nama = $request->nama;
                $data_produk->harga = $request->harga;
                $data_produk->jenis_bordir = $request->jenis_bordir;
                $data_produk->deskripsi = $request->deskripsi;
                $data_produk->save();
            }else{
                //cek foto
                $cover = $request->file('foto');
                $extension = $cover->getClientOriginalExtension();
                Storage::disk('public')->put($cover->getFilename().'.'.$extension,  File::get($cover));
                $data_produk = Product::find($id);
                $data_produk->store_id = $request->store_id;
                $data_produk->nama = $request->nama;
                $data_produk->harga = $request->harga;
                $data_produk->jenis_bordir = $request->jenis_bordir;
                $data_produk->foto = $cover->getFilename().'.'.$extension;
                $data_produk->deskripsi = $request->deskripsi;
                $data_produk->save();
            }
            return redirect()->route('product.index')->with('success','Produk berhasil diubah.');
        }
        else {
            return view('dashboard.produk.edit')->withInput();
        }
    }

    public function destroy($id)
    {
        $produk = Product::find($id);
        $produk->delete();
        return redirect()->route('product.index')->with('success', 'Produk berhasil dihapus');
    }

    public function getData()
    {
        $pemilik_id = auth()->user()->id;
        $query = Product::with('store')->select(['id', 'store_id', 'pemilik_id', 'harga', 'foto', 'nama', 'jenis_bordir', 'deskripsi', 'created_at'])->where('pemilik_id', $pemilik_id);

        return DataTables::of($query)
            ->addColumn('nama_produk', function($product){
                if($product->foto != NULL){
                    $output = '<img src="/uploads/' . $product->foto . '" alt="' . $product->nama . '" class="pull-left" style="border:1px solid black;width:60px;height:60px;margin-right:5px;">';
                    $output .= '<span> </span>';
                    $output .= '<div class="pt-1"><a href="' . route('product.edit',$product->id) . '">' . ucwords($product->nama) . '</a><br></div>';
                    $output .= '<span>Rp. '.$product->harga.'</span>';
                }else{
                    $output = '<img src="/uploads/image_not_found.png" alt="' . $product->nama . '" width="60px;height:60px;" class="mr-3 pull-left" style="border:1px solid black;width:60px;height:60px;margin-right:5px;">';
                    $output .= '<span> </span>';
                    $output .= '<div class="pt-1"><a href="' . route('product.edit',$product->id) . '">' . ucwords($product->nama) . '</a><br></div>';
                    $output .= '<span>Rp. '.$product->harga.'</span>';
                }
                return $output;
            })
            ->addColumn('nama_toko', function($product){
                return ucwords($product->store->nama);
            })
            ->addColumn('jenis', function($product){
                return ucwords($product->jenis_bordir);
            })
            ->addColumn('deskripsi', function($product){
                return ucwords($product->deskripsi);
            })
            ->editColumn('action', function ($product) {
                return '
                <a href="' . route('product.edit',$product->id) . '" title="Edit"><span class="fa fa-pencil" style="margin-right:5px;"> </span> </a> | 
                <a type="javascript:;" data-toggle="modal" data-target="#konfirmasi_hapus" data-href="' . route('product.delete',['id'=>$product->id]) . '" title="Delete"> <span class="fa fa-trash" style="margin-left:5px;"> </span></a>';
            })
            ->rawColumns(['nama_produk', 'nama_toko', 'jenis', 'deskripsi', 'action'])
            ->addIndexColumn()
            ->make(true);
    }

    
}
