<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Peminjaman;
use App\Models\DataPeminjam;
use App\Models\DataBarang;
use Session;

class PeminjamanController extends Controller
{
    public function index(){
        if (Auth::user()->level == 'admin') {
            $data_peminjaman = Peminjaman::all()->sortBy('id');
        } else {
            $cari_id = Auth::id();
            $list_data_peminjam = DataPeminjam::where('user_id', $cari_id)->value('id');
            $data_peminjaman = Peminjaman::where('id_peminjam', $list_data_peminjam)->get();
        }
        $jumlah_peminjaman = $data_peminjaman->count();
        return view('peminjaman.index', compact('data_peminjaman', 'jumlah_peminjaman'));
    }

    public function create(){
        if (Auth::user()->level == 'admin') {
            $list_data_peminjam = DataPeminjam::pluck('nama_peminjam', 'id');
            $list_data_barang = DataBarang::pluck('nama_barang', 'id');
            return view('peminjaman.create', compact('list_data_peminjam', 'list_data_barang'));
        } else{
            $cari_id = Auth::id();
            $list_data_peminjam = DataPeminjam::where('user_id', $cari_id)->value('id');
            $nama_peminjam = DataPeminjam::where('user_id', $cari_id)->value('nama_peminjam');
            $list_data_barang = DataBarang::pluck('nama_barang', 'id');
            return view('peminjaman.create', compact('list_data_peminjam', 'list_data_barang', 'nama_peminjam'));
        }
        
    }

    public function store(Request $request){
        $this->validate($request, [
            'id_peminjam' => 'required|integer',
            'id_barang' => 'required|integer'
        ]);

        $lastPeminjaman = Peminjaman::latest()->first();
        $lastPeminjamanId = $lastPeminjaman ? $lastPeminjaman->id : 0;

        $kodePeminjaman = 'PNJ' . str_pad($lastPeminjamanId + 1, 4, '0', STR_PAD_LEFT);

        $data_barang = DataBarang::find($request->id_barang);
        if ($data_barang->stok >= $request->jml_pinjam) {
            $peminjaman = new Peminjaman;
            $peminjaman->kode_peminjaman = $kodePeminjaman;
            $peminjaman->id_peminjam = $request->id_peminjam;
            $peminjaman->id_barang = $request->id_barang;
            $peminjaman->jml_pinjam = $request->jml_pinjam;
            $peminjaman->tgl_peminjaman = $request->tgl_peminjaman;
            $peminjaman->tgl_pengembalian = $request->tgl_pengembalian;
            $peminjaman->status = $request->status;
            $peminjaman->save();

            $data_barang->stok -= $request->jml_pinjam;
            $data_barang->update();
            Session::flash('flash_message', 'Data peminjam berhasil diupdate');
            
        } else {
            Session::flash('flash_message', 'Stok Kurang');
            Session::flash('penting', true);
            return redirect('peminjaman');
        }

        return redirect('peminjaman');
    }

    public function update($id){
        $peminjaman = Peminjaman::find($id);
        $peminjaman->status = '2';
        $peminjaman->update();

        $cari_id_barang = $peminjaman->id_barang;
        $data_barang = DataBarang::find($cari_id_barang);
        $data_barang->stok += $peminjaman->jml_pinjam;
        $data_barang->update();

        Session::flash('flash_message', 'Barang Sudah Dikembalikan');
        return redirect('peminjaman');

    }
}
