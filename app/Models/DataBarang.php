<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBarang extends Model
{
    use HasFactory;

    protected $table = "data_barang";

    public function data_peminjam(){
        return $this->belongsToMany('App\Models\DataPeminjam', 'peminjaman', 'id_barang', 'id_peminjam');
    }

    public function data_vendor(){
        return $this->belongsTo('App\Models\DataVendor', 'id_vendor');
    }

    public function peminjaman(){
        return $this->hasMany('App\Models\Peminjaman', 'id_barang');
    }
}
