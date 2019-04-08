<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    protected $table = 'wilayah_2018';

    public function wilayah($id) {
        $wilayah = $this->where('kode', '=', $id)->firstOrFail();
        return $wilayah;
        //return ucwords($user->name);
    }
}
