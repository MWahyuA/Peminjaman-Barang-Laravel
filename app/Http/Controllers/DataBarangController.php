<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DataBarang;
use App\Models\DataVendor;
use Session;

class DataBarangController extends Controller
{
    public function index(){
        $jumlah_barang = DataBarang::count();
        $data_barang = DataBarang::orderBy('id', 'asc')->paginate(5);
        $no = 0;
        return view('data_barang.index', compact('data_barang', 'no', 'jumlah_barang'));
    }

    public function create(){
        $list_vendor = DataVendor::pluck('nama_vendor', 'id');
        return view('data_barang.create', compact('list_vendor'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'nama_barang' => 'required|string',
            'id_vendor' => 'required|integer'
        ]);
        $lastBarang = DataBarang::latest()->first();
        $lastBarangId = $lastBarang ? $lastBarang->id : 0;

        $kodeBarang = 'BRG' . str_pad($lastBarangId + 1, 4, '0', STR_PAD_LEFT);

        if($request->has('foto')){
            $this->validate($request,[
                'foto' => 'required|image|mimes:jpeg,jpg,png',
            ]);
            $foto_barang = $request->foto;
            $nama_file = time().'.'.$foto_barang->getClientOriginalExtension();
            $foto_barang->move('foto_barang/', $nama_file);
            $data_barang = new DataBarang;
            $data_barang->kode_barang = $kodeBarang;
            $data_barang->nama_barang = $request->nama_barang;
            $data_barang->id_vendor = $request->id_vendor;
            $data_barang->stok = $request->stok;
            $data_barang->foto = $nama_file;
            $data_barang->save();
        } else {
            $data_barang = new DataBarang;
            $data_barang->kode_barang = $kodeBarang;
            $data_barang->nama_barang = $request->nama_barang;
            $data_barang->id_vendor = $request->id_vendor;
            $data_barang->stok = $request->stok;
            $data_barang->save();
        }
        Session::flash('flash_message', 'Barang berhasil ditambah');
        return redirect('data_barang');
    }
    public function edit($id){
        $barang = DataBarang::find($id);
        $list_vendor = DataVendor::pluck('nama_vendor', 'id');
        return view('data_barang.edit', compact('barang', 'list_vendor'));
    }

    public function update(Request $request, $id){
        $data_barang = DataBarang::find($id);
        if($request->has('foto')){
            $this->validate($request,[
                'foto' => 'required|image|mimes:jpeg,jpg,png',
            ]);
            $foto_barang = $request->foto;
            $nama_file = time().'.'.$foto_barang->getClientOriginalExtension();
            $foto_barang->move('foto_barang/', $nama_file);
            $data_barang->kode_barang = $request->kode_barang;
            $data_barang->nama_barang = $request->nama_barang;
            $data_barang->id_vendor = $request->id_vendor;
            $data_barang->stok = $request->stok;
            $data_barang->foto = $nama_file;
            $data_barang->update();

        } else{
            $data_barang->kode_barang = $request->kode_barang;
            $data_barang->nama_barang = $request->nama_barang;
            $data_barang->id_vendor = $request->id_vendor;
            $data_barang->stok = $request->stok;
            $data_barang->update();
        }
        Session::flash('flash_message', 'Barang berhasil diupdate');
        return redirect('data_barang');
    }

    public function destroy($id){
        $data_barang = DataBarang::find($id);
        $data_barang->delete();

        return redirect('data_barang');
    }

    public function detail_barang($id){
        $halaman = 'data_barang';
        $data_barang = DataBarang::findOrFail($id);
        return view('data_barang.detail_barang', compact('halaman', 'data_barang'));
    }
}
