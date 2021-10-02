<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = 'stores';
    protected $fillable = [
        'pemilik_id', 'nama', 'alamat', 'phone', 'kabupaten', 'kecamatan', 'desa', 'foto','aktif'
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function pemilik()
    {
        return $this->belongsTo('App\User', 'pemilik_id', 'id');
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
