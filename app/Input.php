<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Input extends Model
{
    protected $fillable = [
        'nama', 'npm', 'judul', 'lokasi', 'kecamatan', 'kabupaten', 'provinsi', 'keperluan', 'koordinat'
    ];
}
