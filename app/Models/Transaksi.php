<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = "transactions";
    protected $fillable = [
        "order_id","pemilik_id","pelanggan_id","product_id","rekening_id","toko_id","bukti_pembayaran","tanggal_transaksi",
    ];

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }
    
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function rekening()
    {
        return $this->belongsTo('App\Models\Rekening','rekening_id');
    }
    
    public function store()
    {
        return $this->belongsTo('App\Models\Store','toko_id');
    }
}
