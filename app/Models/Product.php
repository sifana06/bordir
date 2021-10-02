<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'nama','jenis_bordir','harga','deskripsi','store_id','pemilik_id', 'foto'
    ];

    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }

    // public function kabupaten()
    // {
    //     return $this->belongsTo('App\Models\Kabupaten','kabupaten');
    // }

    // public function kecamatan()
    // {
    //     return $this->belongsTo('App\Models\Kecamatan','kecamatan');
    // }

    // public function desa()
    // {
    //     return $this->belongsTo('App\Models\Desa','desa');
    // }
}
