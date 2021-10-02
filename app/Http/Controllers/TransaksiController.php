<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use DataTables;

class TransaksiController extends Controller
{

    public function index()
    {
        $data['transaksi'] = Transaksi::all();
        return view('dashboard.transaksi.all',$data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function getData()
    {
        $pemilik_id = auth()->user()->id;
        $query = Transaksi::select(["id", "order_id","pemilik_id","pelanggan_id","product_id","rekening_id","toko_id","bukti_pembayaran","tanggal_transaksi"])->where('pemilik_id', $pemilik_id);
        
        return DataTables::of($query)
            ->addColumn('order_id', function($transaksi){
                $output = $transaksi->order->order_number;
                return $output;
            })
            ->addColumn('produk', function($order){
                return $order->product->nama;
            })
            ->addColumn('rekening', function($order){
                $output = '';
                if($order->rekening_id != null){
                    $output .= '<span class="text-primary">'.$order->rekening->nama_bank.'</span><span class="text-dark">'.$order->rekening->nama_pemilik.' - '.$order->rekening->no_rekening; 
                }else{
                    $output .= '-';
                }
                return $output; 
            })
            ->addColumn('toko', function($order){
                return '<span class="text-primary">'.$order->store->nama.'</span>';
            })
            ->addColumn('total', function($order){
                return $order->order->total;
            })
            ->addColumn('tanggal', function($order){
                return $order->order->tanggal_pembayaran;
            })
            // ->addColumn('toko', function($order){
            //     switch ($order->status_order) {
            //         case 'order':
            //             $class = 'style="color:#00c0ef;"';
            //         break;
            //         case 'cancel':
            //             $class = 'style="color:#f56954;"';
            //         break;
            //         case 'pending':
            //             $class = 'style="color:#f1c40f;"';
            //         break;
            //         case 'success':
            //             $class = 'style="color:#00a65a;"';
            //         break;
            //         default:
            //             $class = $order->status_order;
            //         break;
            //     }
            //     switch ($order->status_pengiriman) {
            //         case 'belum dikirim':
            //             $class_pengiriman = 'style="color:#f1c40f;"';
            //         break;
            //         case 'sudah dikirim':
            //             $class_pengiriman = 'style="color:#00a65a;"';
            //         break;
            //         default:
            //             $class_pengiriman = $order->status_pengiriman;
            //         break;
            //     }
            //     switch ($order->status_pengiriman) {
            //         case 'belum dikirim':
            //             $status_pengiriman = "Belum Dikirim";
            //         break;
            //         case 'sudah dikirim':
            //             $status_pengiriman = "Sudah Dikirim";
            //         break;
            //         default:
            //             $status_pengiriman = '----------';
            //         break;
            //     }
            //     return '<div class="small text-muted">Status Pesanan </div><div> <small><li class="fa fa-circle fa-xs" '.$class.'></li></small> '.ucwords($order->status_order).'</div>
            //     <div class="small text-muted">Status Pengiriman </div><div> <small><li class="fa fa-circle fa-xs" '.$class_pengiriman.'></li></small> '.$status_pengiriman.'<div>';
            // })
            // ->addColumn('total', function($order){
            //     switch ($order->status_pembayaran) {
            //         case 'belum dibayar':
            //             $class = 'style="color:#f1c40f;"';
            //         break;
            //         case 'sudah dibayar':
            //             $class = 'style="color:#00a65a;"';
            //         break;
            //         default:
            //             $class = $order->status_pembayaran;
            //         break;
            //     }
                
            //     if($order->status_pembayaran == NULL){
            //         $output = '<div class="small text-muted">Status Pembayaran </div><div> <small><li class="fa fa-circle fa-xs" '.$class.'></li></small> --------</div>';
            //     }else{
            //         $output = '<div class="small text-muted">Status Pembayaran </div><div> <small><li class="fa fa-circle fa-xs" '.$class.'></li></small> '.ucwords($order->status_pembayaran).'</div>';
            //     }
            //     return $output;
            // })
            // ->addColumn('tanggal', function($order){
            //     return 'Rp. '.$order->total;
            // })
            // ->editColumn('action', function ($order) {
            //     return '<div class="text-center"><a href="'.route('order.edit',$order->id).'" title="Terima"><span class="fa fa-pencil text-success" style="margin-right:5px;"> </span> </a></div>';
            // })
            // ->rawColumns(['order_id', 'produk', 'rekening', 'toko', 'total', 'tanggal', 'action'])
            ->rawColumns(['order_id','produk','rekening','toko','total'])
            ->addIndexColumn()
            ->make(true);
    }

    public function getDataHistory()
    {
        
    }
}
