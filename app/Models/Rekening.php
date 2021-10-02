<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    protected $table = 'rekening';
    protected $fillable = [
        'pemilik_id','nama_bank','no_rekening','nama_pemilik'
    ];
}
