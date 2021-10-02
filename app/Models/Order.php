<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'user_id','pemilik_id','store_id','product_id','rekening_id','order_number','foto','jenis_bordir','keterangan','nama_pelanggan','email','telepon','kabupaten','kecamatan','desa','alamat','catatan','deadline','jumlah','harga','total','status_order','status_pembayaran','tipe_pembayaran','order_at','bukti_transaksi','received_at'
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function get_product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id','id');
    }

    public function user_customer()
    {
        return $this->belongsTo('App\User');
    }

    public function store_product()
    {
        return $this->belongsTo('App\Models\Store');
    }

    public function cek_kabupaten()
    {
        return $this->belongsTo('App\Models\Kabupaten','kabupaten', 'id');
    }

    public function cek_kecamatan()
    {
        return $this->belongsTo('App\Models\Kecamatan','kecamatan', 'id');
    }

    public function cek_desa()
    {
        return $this->belongsTo('App\Models\Desa', 'desa', 'id');
    }
}
