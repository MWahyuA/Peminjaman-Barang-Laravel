<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataVendor extends Model
{
    use HasFactory;

    protected $table = "data_vendor";

    public function data_barang(){
        return $this->hasMany('App\Models\DataBarang', 'id_vendor');
    }
}
