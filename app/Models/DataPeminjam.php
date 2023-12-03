<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPeminjam extends Model
{
    use HasFactory;

    protected $table = 'data_peminjam';

    public function jenis_kelamin(){
        return $this->belongsTo('App\Models\JenisKelamin', 'id_jenis_kelamin');

    }
    
    public function data_barang(){
        return $this->belongsToMany('App\Models\DataBarang', 'peminjaman', 'id_peminjam', 'id_barang');
    }

    public function peminjaman(){
        return $this->hasMany('App\Models\Peminjaman', 'id_peminjam');
    }
}
