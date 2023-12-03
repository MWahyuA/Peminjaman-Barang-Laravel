<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DataVendor;
use App\Models\DataBarang;
use Session;

class DataVendorController extends Controller
{
    public function index(){
        $jumlah_vendor = DataVendor::count();
        $data_vendor = DataVendor::orderBy('id', 'asc')->paginate(5);
        $no = 0;
         return view('data_vendor.index', compact('data_vendor', 'no', 'jumlah_vendor'));
    }

    public function create(){
        return view('data_vendor.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'nama_vendor' => 'required|string'
        ]);
        $lastVendor = DataVendor::latest()->first();
        $lastVendorId = $lastVendor ? $lastVendor->id : 0;

        $kodeVendor = 'VDR' . str_pad($lastVendorId + 1, 4, '0', STR_PAD_LEFT);

        $data_vendor = new DataVendor;
        $data_vendor->kode_vendor = $kodeVendor;
        $data_vendor->nama_vendor = $request->nama_vendor;
        $data_vendor->nomor_telepon = $request->nomor_telepon;
        $data_vendor->email = $request->email;
        $data_vendor->alamat = $request->alamat;
        $data_vendor->save();
        Session::flash('flash_message', 'Vendor berhasil ditambah');
        return redirect('data_vendor');
    }

    public function edit($id){
        $vendor = DataVendor::find($id);
        return view('data_vendor.edit', compact('vendor'));
    }

    public function update(Request $request, $id){
        $data_vendor = DataVendor::find($id);
        $data_vendor->kode_vendor = $request->kode_vendor;
        $data_vendor->nama_vendor = $request->nama_vendor;
        $data_vendor->nomor_telepon = $request->nomor_telepon;
        $data_vendor->email = $request->email;
        $data_vendor->alamat = $request->alamat;
        $data_vendor->update();
        Session::flash('flash_message', 'Vendor berhasil diupdate');
        return redirect('data_vendor');
    }

    public function destroy($id){

        $data_vendor = DataVendor::find($id);
        $cari_barang = DataBarang::where('id_vendor', $data_vendor->id)->get();
        foreach ($cari_barang as $barang) {
            $barang->delete();
        }
        $data_vendor->delete();

        return redirect('data_vendor');
    }

    public function detail_vendor($id){
        $halaman = 'data_vendor';
        $data_vendor = DataVendor::findOrFail($id);
        return view('data_vendor.detail_vendor', compact('halaman', 'data_vendor'));
    }
}
