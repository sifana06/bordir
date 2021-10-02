<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    protected $table = "desa";
    protected $fillable = [
        'id','kecamatan_id', 'nama'
    ];
}
