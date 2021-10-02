<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Product;
use App\Models\Order;
use App\Models\Store;
use App\Models\Kabupaten;
use Carbon\Carbon;
use App\Models\Transaksi;
use App\Models\Rekening;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
class OrderController extends Controller
{

    public function index()
    {
        $check = auth()->user()->role;
        $check_id = auth()->user()->id;
        $order = Order::find($check_id);
        if($check == "pelanggan"){
            return view('pelanggan.order.all', ['order' => $order]);
        }else{
            return view('dashboard.order.all', ['order' => $order]);
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data['order'] = Order::with(['get_product','cek_kabupaten','cek_kecamatan','cek_desa'])->find($id);
        // $data['kabupaten'] = Kabupaten::select(['id','nama'])->get();
        $data['order'] = Order::find($id);
        $cek = Order::find($id);
        $data['rekening'] = Rekening::where('pemilik_id', $cek->pemilik_id)->get();

        return view('dashboard.order.edit', $data);
    }

    public function update(Request $request, $id)
    {
        // $messages = [
        //     'required' => ':attribute tidak boleh kosong.'
        // ];
        // $customAttributes = [
        //     'user_id' => 'User ID',
        //     'store_id'=> 'Store ID',
        //     'product_id' => 'Product ID',
        //     'order_number' => 'Order Number',
        //     'foto'=> 'Foto Bordir',
        //     'jenis_bordir' => 'Jenis Bordir',
        //     'keterangan' => 'Keterangan',
        //     'nama_pelanggan'=> 'Nama Pelanggan',
        //     'email' => 'Email',
        //     'telepon' => 'Telepon',
        //     'kabupaten'=> 'Kabupaten',
        //     'kecamatan' => 'Kecamatan',
        //     'desa' => 'Desa',
        //     'alamat'=> 'Alamat',
        //     'catatan' => 'Catatan',
        //     'deadline' => 'Deadline',
        //     'jumlah'=> 'Jumlah',
        //     'harga' => 'Harga',
        // ];

        // $valid = $request->validate([
        //     'product_id' => 'required',
        //     'jenis_bordir' => 'required',
        //     'nama_pelanggan' => 'required',
        //     'telepon' => 'required',
        //     'kabupaten' => 'required',
        //     'kecamatan' => 'required',
        //     'desa' => 'required',
        //     'alamat' => 'required',
        //     'catatan' => 'required',
        //     'deadline' => 'required',
        //     'jumlah' => 'required',
        //     'harga' => 'required',
        // ],$messages,$customAttributes);

        // if($valid == true){
            $order = Order::find($id);
            if($request->harga != null){
                $total = $request->jumlah*$request->harga;
                $order->harga = $request->harga;
                $order->total = $total;
            }
            $order->status_order = $request->status_order;
            $order->status_pembayaran = $request->status_pembayaran;
            $order->tipe_pembayaran = $request->tipe_pembayaran;
            $order->tanggal_pembayaran = Carbon::parse($request->tanggal_pembayaran)->format('y/m/d');
            $order->status_pengiriman = $request->status_pengiriman;
            if($order->order_at == NULL){
                $order->order_at = Carbon::now();
            }
            $order->save();
        // }
        return redirect()->route('order.index');
    }

    public function destroy($id)
    {
        //
    }

    public function getData()
    {
        $pemilik_id = auth()->user()->id;
        $query = Order::with(['product','user_customer','store_product'])->select(['id', 'user_id','store_id','product_id','order_number','foto','jenis_bordir','keterangan','nama_pelanggan','email','telepon','kabupaten','kecamatan','desa','alamat','catatan','deadline','jumlah','harga','total','status_order','status_pembayaran','status_pengiriman','tipe_pembayaran','order_at','received_at', 'created_at'])->where('pemilik_id', $pemilik_id)->orderBy('created_at', 'DESC');

        return DataTables::of($query)
            ->addColumn('order_number', function($order){
                // $output = '';
                // $date_now = Carbon::now();
                // $date = Carbon::parse($order->deadline);
                // if ($date->diffInDays($date_now) > 2) {
                //     $output = $order->order_number.'<div><span class="text-primary"><b>Deadline : '.Carbon::parse($order->deadline)->format('d/M/y').'</b></span></div>';
                // }elseif($date->diffInDays($date_now) == 1){
                //     $output = $order->order_number.'<div><span class="text-waring"><b>Deadline : '.Carbon::parse($order->deadline)->format('d/M/y').'</b></span></div>';
                // }else{
                //     $output = $order->order_number.'<div><span class="text-danger"><b>Deadline : '.Carbon::parse($order->deadline)->format('d/M/y').'</b></span></div>';
                // }
                if (Carbon::now()->between(Carbon::parse($order->created_at), Carbon::parse($order->deadline))){
                    $output = $order->order_number.'<div><span class="text-primary"><b>Deadline : '.Carbon::parse($order->deadline)->format('d/M/y').'</b></span></div>';
                }else{
                    $output = $order->order_number.'<div><span class="text-danger"><b>Deadline : '.Carbon::parse($order->deadline)->format('d/M/y').'</b></span></div>';
                }
                return $output;
            })
            ->addColumn('customers', function($order){
                return $order->nama_pelanggan;
            })
            ->addColumn('products', function($order){
                if($order->product_id != null){
                    $output = $order->product->nama.'<div>Jenis Bordir: '.$order->jenis_bordir.'</div>';
                }else{
                    $output = '<div>Jenis Bordir: '.$order->jenis_bordir.'</div>';
                }

                return $output;
            })
            ->addColumn('status', function($order){
                switch ($order->status_order) {
                    case 'order':
                        $class = 'style="color:#00c0ef;"';
                    break;
                    case 'cancel':
                        $class = 'style="color:#f56954;"';
                    break;
                    case 'pending':
                        $class = 'style="color:#f1c40f;"';
                    break;
                    case 'success':
                        $class = 'style="color:#00a65a;"';
                    break;
                    default:
                        $class = $order->status_order;
                    break;
                }
                switch ($order->status_pengiriman) {
                    case 'belum dikirim':
                        $class_pengiriman = 'style="color:#f1c40f;"';
                    break;
                    case 'sudah dikirim':
                        $class_pengiriman = 'style="color:#00a65a;"';
                    break;
                    default:
                        $class_pengiriman = $order->status_pengiriman;
                    break;
                }
                switch ($order->status_pengiriman) {
                    case 'belum dikirim':
                        $status_pengiriman = "Belum Dikirim";
                    break;
                    case 'sudah dikirim':
                        $status_pengiriman = "Sudah Dikirim";
                    break;
                    default:
                        $status_pengiriman = '----------';
                    break;
                }
                return '<div class="small text-muted">Status Pesanan </div><div> <small><li class="fa fa-circle fa-xs" '.$class.'></li></small> '.ucwords($order->status_order).'</div>
                <div class="small text-muted">Status Pengiriman </div><div> <small><li class="fa fa-circle fa-xs" '.$class_pengiriman.'></li></small> '.$status_pengiriman.'<div>';
            })
            ->addColumn('pembayaran', function($order){
                switch ($order->status_pembayaran) {
                    case 'belum dibayar':
                        $class = 'style="color:#f1c40f;"';
                    break;
                    case 'sudah dibayar':
                        $class = 'style="color:#00a65a;"';
                    break;
                    default:
                        $class = $order->status_pembayaran;
                    break;
                }
                
                if($order->status_pembayaran == NULL){
                    $output = '<div class="small text-muted">Status Pembayaran </div><div> <small><li class="fa fa-circle fa-xs" '.$class.'></li></small> --------</div>';
                }else{
                    $output = '<div class="small text-muted">Status Pembayaran </div><div> <small><li class="fa fa-circle fa-xs" '.$class.'></li></small> '.ucwords($order->status_pembayaran).'</div>';
                }
                return $output;
            })
            ->addColumn('total', function($order){
                return 'Rp. '.$order->total;
            })
            ->editColumn('action', function ($order) {
                return '<div class="text-center"><a href="'.route('order.edit',$order->id).'" title="Terima"><span class="fa fa-pencil text-success" style="margin-right:5px;"> </span> </a></div>';
            })
            ->rawColumns(['order_number', 'customers', 'products', 'status', 'pembayaran', 'total', 'action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function order()
    {

        return view('pelanggan.order.all');
    }

    public function createOrder($id)
    {
        $data['kabupaten'] = Kabupaten::select(['id','nama'])->get();
        $data['ambilProduk'] = Product::find($id);
        $data['user'] = Auth()->user();
        return view('pelanggan.order.checkout', $data);
    }
    
    public function buatOrder()
    {
        $data['kabupaten'] = Kabupaten::select(['id','nama'])->get();
        $data['ambilStore'] = Store::all();
        return view('pelanggan.order.create', $data);
    }

    public function saveCheckout(Request $request)
    {
        $user_id = auth()->user()->id;
        $messages = [
            'required' => ':attribute tidak boleh kosong.'
        ];
        $customAttributes = [
            'user_id' => 'User ID',
            'store_id'=> 'Store ID',
            'product_id' => 'Product ID',
            'order_number' => 'Order Number',
            'foto'=> 'Foto Bordir',
            'jenis_bordir' => 'Jenis Bordir',
            'keterangan' => 'Keterangan',
            'nama_pelanggan'=> 'Nama Pelanggan',
            'email' => 'Email',
            'telepon' => 'Telepon',
            'kabupaten'=> 'Kabupaten',
            'kecamatan' => 'Kecamatan',
            'desa' => 'Desa',
            'alamat'=> 'Alamat',
            'catatan' => 'Catatan',
            'deadline' => 'Deadline',
            'jumlah'=> 'Jumlah',
            'harga' => 'Harga',
        ];

        $valid = $request->validate([
            'product_id' => 'required',
            // 'foto' => 'required',
            'jenis_bordir' => 'required',
            'nama_pelanggan' => 'required|regex:/(^[A-Za-z ]+$)+/',
            'telepon' => 'required|numeric|digits_between:11,13',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'alamat' => 'required',
            'catatan' => 'required',
            'deadline' => 'required|date',
            'jumlah' => 'required',
            'harga' => 'required',
        ],$messages,$customAttributes);

        // //cek foto
        // $cover = $request->file('foto');
        // $extension = $cover->getClientOriginalExtension();
        // Storage::disk('public')->put($cover->getFilename().'.'.$extension,  File::get($cover));
    
        //Cek apakah validasi di atas benar
        if($valid == true){
            $total = $request->jumlah*$request->harga;
            $data_store = Order::create([
                'user_id' => $user_id,
                'store_id' => $request->get('store_id'),
                'product_id' => $request->get('product_id'),
                'pemilik_id' => $request->get('pemilik_id'),
                'order_number' =>  "RO".Carbon::now()->format('Y/m/d')."-".Carbon::now()->format('His'),
                'jenis_bordir' => $request->get('jenis_bordir'),
                'keterangan' => $request->get('keterangan'),
                'nama_pelanggan' => $request->get('nama_pelanggan'),
                'email' => $request->get('email'),
                'telepon' => $request->get('telepon'),
                'kabupaten' => $request->get('kabupaten'),
                'kecamatan' => $request->get('kecamatan'),
                'desa' => $request->get('desa'),
                'alamat' => $request->get('alamat'),
                'catatan' => $request->get('catatan'),
                'deadline' => Carbon::parse($request->get('deadline'))->format('y/m/d'),
                'jumlah' => $request->get('jumlah'),
                'harga' => $request->get('harga'),
                'total' => $total,
                'status_order' => "pending",
            ]);
            
            return redirect()->route('po.index')->with('success','Pesanan Berhasil Dibuat.');
        }
        else {
            return view('pelanggan.order.checkout')->withInput();
        }
    }

    public function saveOrder(Request $request)
    {
        $user_id = auth()->user()->id;
        $messages = [
            'required' => ':attribute tidak boleh kosong.'
        ];
        $customAttributes = [
            'user_id' => 'User ID',
            'store_id'=> 'Store ID',
            'product_id' => 'Product ID',
            'order_number' => 'Order Number',
            'foto'=> 'Foto Bordir',
            'jenis_bordir' => 'Jenis Bordir',
            'keterangan' => 'Keterangan',
            'nama_pelanggan'=> 'Nama Pelanggan',
            'email' => 'Email',
            'telepon' => 'Telepon',
            'kabupaten'=> 'Kabupaten',
            'kecamatan' => 'Kecamatan',
            'desa' => 'Desa',
            'alamat'=> 'Alamat',
            'catatan' => 'Catatan',
            'deadline' => 'Deadline',
            'jumlah'=> 'Jumlah',
            'harga' => 'Harga',
        ];

        $valid = $request->validate([
            'foto' => 'required',
            'jenis_bordir' => 'required',
            'nama_pelanggan' => 'required|regex:/(^[A-Za-z ]+$)+/',
            'telepon' => 'required|numeric|digits_between:11,13',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'alamat' => 'required',
            'catatan' => 'required',
            'deadline' => 'required',
            'jumlah' => 'required',
        ],$messages,$customAttributes);

        
        //Cek apakah validasi di atas benar
        if($valid == true){
            $getPemilik = Store::find($request->store_id);
            if($request->tipe_pembayaran == 'transfer'){
                $total = $request->jumlah*$request->harga+$request->ongkir;
            }else{
                $total = $request->jumlah*$request->harga;
            }
            // //cek foto
            $cover = $request->file('foto');
            $extension = $cover->getClientOriginalExtension();
            Storage::disk('public')->put($cover->getFilename().'.'.$extension,  File::get($cover));
            
            $data_store = Order::create([
                'user_id' => $user_id,
                'store_id' => $request->get('store_id'),
                'pemilik_id' => $getPemilik->pemilik_id,
                'order_number' =>  "RO".Carbon::now()->format('Y/m/d')."-".Carbon::now()->format('His'),
                'foto' => $cover->getFilename().'.'.$extension,
                'jenis_bordir' => $request->get('jenis_bordir'),
                'keterangan' => $request->get('keterangan'),
                'nama_pelanggan' => $request->get('nama_pelanggan'),
                'email' => $request->get('email'),
                'telepon' => $request->get('telepon'),
                'kabupaten' => $request->get('kabupaten'),
                'kecamatan' => $request->get('kecamatan'),
                'desa' => $request->get('desa'),
                'alamat' => $request->get('alamat'),
                'catatan' => $request->get('catatan'),
                'deadline' => Carbon::parse($request->get('deadline'))->format('y/m/d'),
                'jumlah' => $request->get('jumlah'),
                'harga' => $request->get('harga'),
                'total' => $total,
                'status_order' => "pending",
            ]);
            
            return redirect()->route('po.index')->with('success','Pesanan Berhasil Dibuat.');
        }
        else {
            return view('pelanggan.order.checkout')->withInput();
        }
    }

    public function editOrder($id)
    {
        $data['kabupaten'] = Kabupaten::select(['id','nama'])->get();
        $data['order'] = Order::find($id);
        $cek = Order::find($id);
        // $pemilik_id = $cek->pemilik_id;
        $data['rekening'] = Rekening::where('pemilik_id', $cek->pemilik_id)->get();

        return view('pelanggan.order.edit',$data);
    }

    public function updateOrder(Request $request, $id)
    {
        // //cek foto
        if($request->bukti_pembayaran != NULL){
            $cover = $request->file('bukti_pembayaran');
            $extension = $cover->getClientOriginalExtension();
            Storage::disk('public')->put($cover->getFilename().'.'.$extension,  File::get($cover));
            
            $order = Order::find($id);
            $order->rekening_id = $request->rekening_id;
            $order->tipe_pembayaran = $request->tipe_pembayaran;
            $order->status_penerima = $request->status_penerima;
            if($request->status_penerima != NULL){
                $order->received_at = Carbon::now();
            }
            if($request->status_pembayaran != NULL){
                $order->status_pembayaran = $request->status_pembayaran;
            }else{
                $order->status_pembayaran = "belum bayar";
            }
            $order->total = $request->total_pembayaran_b;
            $order->tanggal_pembayaran = Carbon::parse($request->tanggal_pembayaran)->format('y/m/d');
            $order->bukti_transaksi = $cover->getFilename().'.'.$extension;
            $order->save();

            if($order->status_pembayaran == "sudah dibayar"){
                $transaksi = new Transaksi([
                    'order_id' => $order->id,
                    'pemilik_id' => $order->pemilik_id,
                    'pelanggan_id' => $order->user_id,
                    'toko_id' => $order->store_id,
                    'product_id' => $order->product_id,
                    'rekening_id' => $order->rekening_id,
                    'toko_id' => $order->store_id,
                    'bukti_pembayaran' => $order->bukti_transaksi,
                    'tanggal_transaksi' => $order->tanggal_pembayaran,
                ]);
                $transaksi->save();
            }
        }else{
            $order = Order::find($id);
            $order->rekening_id = $request->rekening_id;
            $order->tipe_pembayaran = $request->tipe_pembayaran;
            $order->status_penerima = $request->status_penerima;
            if($request->status_penerima != NULL){
                $order->received_at = Carbon::now();
            }
            if($request->status_pembayaran != NULL){
                $order->status_pembayaran = $request->status_pembayaran;
            }else{
                $order->status_pembayaran = "belum bayar";
            }
            $order->total = $request->total_pembayaran_a;
            $order->tanggal_pembayaran = Carbon::parse($request->tanggal_pembayaran)->format('y/m/d');
            $order->save();

            if($order->status_pembayaran == "sudah dibayar"){
                $transaksi = new Transaksi([
                    'order_id' => $order->id,
                    'pemilik_id' => $order->pemilik_id,
                    'pelanggan_id' => $order->user_id,
                    'product_id' => $order->product_id,
                    'toko_id' => $order->store_id,
                    'rekening_id' => $order->rekening_id,
                    'toko_id' => $order->store_id,
                    'bukti_pembayaran' => $order->bukti_transaksi,
                    'tanggal_transaksi' => $order->tanggal_pembayaran,
                ]);
                $transaksi->save();
            }
        }
        return redirect()->route('po.index');
    }

    public function getDataPelanggan()
    {
        $user_id = auth()->user()->id;
        $query = Order::with(['product','user_customer','store_product'])->select(['id', 'user_id','store_id','product_id','order_number','foto','jenis_bordir','keterangan','nama_pelanggan','email','telepon','kabupaten','kecamatan','desa','alamat','catatan','deadline','jumlah','harga','total','status_order','status_pembayaran','tipe_pembayaran','status_pengiriman','order_at','received_at', 'created_at'])->where('user_id', $user_id)->orderBy('created_at','DESC');

        return DataTables::of($query)
            ->addColumn('order', function($order){
                $output = $order->order_number;
                return $output;
            })
            ->addColumn('customer', function($order){
                return $order->nama_pelanggan;
            })
            ->addColumn('produk', function($order){
                $output = '';
                if($order->product_id != null){
                    $output .= $order->product->nama.'<div>Jenis Bordir: '.$order->jenis_bordir.'</div>';
                }else{
                    $output .= '<div>Jenis Bordir: '.$order->jenis_bordir.'</div>';
                }

                return $output;
            })
            ->addColumn('status', function($order){
                switch ($order->status_order) {
                    case 'order':
                        $class = 'style="color:#00c0ef;"';
                    break;
                    case 'cancel':
                        $class = 'style="color:#f56954;"';
                    break;
                    case 'pending':
                        $class = 'style="color:#f1c40f;"';
                    break;
                    case 'success':
                        $class = 'style="color:#00a65a;"';
                    break;
                    default:
                        $class = $order->status;
                    break;
                }
                switch ($order->status_pengiriman) {
                    case 'belum dikirim':
                        $class_pengiriman = 'style="color:#f1c40f;"';
                        $status_pengiriman = "Belum Dikirim";
                    break;
                    case 'sudah dikirim':
                        $class_pengiriman = 'style="color:#00a65a;"';
                        $status_pengiriman = "Sudah Dikirim";
                    break;
                    default:
                        $class_pengiriman = 'style="color:#000000;"';
                        $status_pengiriman = '----------';
                    break;
                }
                return '<div class="small text-muted">Status Pesanan </div><div> <small><li class="fa fa-circle fa-xs" '.$class.'></li></small> '.ucwords($order->status_order).'</div>
                <div class="small text-muted">Status Pengiriman </div><div> <small><li class="fa fa-circle fa-xs" '.$class_pengiriman.'></li></small> '.$status_pengiriman.'<div>';
            })
            ->addColumn('pembayaran', function($order){
                switch ($order->status_pembayaran) {
                    case 'belum dibayar':
                        $class = 'style="color:#f1c40f;"';
                    break;
                    case 'sudah dibayar':
                        $class = 'style="color:#00a65a;"';
                    break;
                    default:
                        $class = $order->status_pembayaran;
                    break;
                }
                
                if($order->status_pembayaran == NULL){
                    $output = '<div class="small text-muted">Status Pembayaran </div><div> <small><li class="fa fa-circle fa-xs" '.$class.'></li></small> --------</div>';
                }else{
                    $output = '<div class="small text-muted">Status Pembayaran </div><div> <small><li class="fa fa-circle fa-xs" '.$class.'></li></small> '.ucwords($order->status_pembayaran).'</div>';
                }
                return $output;
            })
            ->addColumn('total', function($order){
                return '<span>'.$order->jumlah.' Pcs</span><div><span>Rp. '.$order->total.'</span></div>';
            })
            ->editColumn('action', function ($store) {
                return '<a href="' . route('po.editOrder',$store->id) . '"><span class="fa fa-pencil" style="margin-right:5px;"> </span> </a> | <a type="javascript:;" data-toggle="modal" data-target="#konfirmasi_hapus" data-href="' . route('toko.delete',['id'=>$store->id]) . '" title="Delete"> <span class="fa fa-trash" style="margin-left:5px;"> </span></a>';
            })
            ->rawColumns(['order', 'customer', 'produk', 'status', 'total','action'])
            ->addIndexColumn()
            ->make(true);
    }
}
