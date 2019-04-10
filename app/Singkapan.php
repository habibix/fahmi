<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Singkapan extends Model
{

	public $timestamps = true;
	
    protected $table = 'singkapan';

    protected $fillable = [
        'input_id', 'singkapan_kode', 'singkapan_nama_batuan', 'singkapan_jenis_batuan', 'singkapan_lat', 'singkapan_lng', 'singkapan_elevasi', 'singkapan_attach'
    ];
}
