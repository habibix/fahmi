<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Input extends Model
{

	protected $table = 'input';

    protected $fillable = [
        'nama', 'npm', 'judul', 'lokasi', 'kecamatan', 'kabupaten', 'provinsi', 'keperluan', 'north', 'south', 'east', 'west'
    ];

    public function singkapan(){
        return $this->hasMany('App\Singkapan');
    }
}
