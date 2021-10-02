<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use DataTables;
use App\Models\Product;
use App\Models\Store;

class HistoryController extends Controller
{

    public function index()
    {
        $user_id = auth()->user()->id;
        $data['history'] = Order::with(['product','user_customer','store_product'])->where('user_id', '=', $user_id)->where('status_penerima', '=', 'sudah diterima')->get();
        // dd($data['history']);
        return view('pelanggan.history.all', $data);
    }
    
    public function getData()
    {
        $user_id = auth()->user()->id;
        $query = Order::select(['id', 'user_id','store_id','pemilik_id','product_id','order_number','foto','jenis_bordir','keterangan','nama_pelanggan','email','telepon','kabupaten','kecamatan','desa','alamat','catatan','deadline','jumlah','harga','total','status_order','status_pembayaran','tipe_pembayaran','status_penerima','status_pengiriman','order_at','received_at', 'created_at'])->where('user_id', '=', $user_id)->where('status_penerima', '=', 'sudah diterima');

        return DataTables::of($query)
            ->addColumn('order', function($order){
                $output = $order->order_number;
                return $output;
            })
            ->addColumn('customer', function($order){
                return $order->nama_pelanggan;
            })
            ->addColumn('produk', function($order){
                return $order->product->nama.'<div>Jenis Bordir: '.$order->jenis_bordir.'</div>';
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
                        $class = 'style="color:#000000;"';
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
                        $class_pengiriman = 'style="color:#000000;"';
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
                return '<span>'.$order->jumlah.' Pcs</span><div><span>Rp. '.$order->total.'</span></div>';
            })
            ->rawColumns(['order', 'customer', 'produk', 'status', 'total'])
            ->addIndexColumn()
            ->make(true);
    }
}
