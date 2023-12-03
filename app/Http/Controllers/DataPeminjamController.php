<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DataPeminjam;
use App\Models\JenisKelamin;
use App\Models\User;
use App\Models\Peminjaman;
use Session;
use Storage;

class DataPeminjamController extends Controller
{
    public function index(){
        $jumlah_peminjam = DataPeminjam::count();
        $data_peminjam = DataPeminjam::orderBy('id', 'asc')->paginate(5);
        $no = 0;
         return view('data_peminjam.index', compact('data_peminjam', 'no', 'jumlah_peminjam'));
    }

    public function create(){
        $list_jenis_kelamin = JenisKelamin::pluck('nama_jenis_kelamin', 'id_jenis_kelamin');
        return view('data_peminjam.create', compact('list_jenis_kelamin'));
    }

    public function store(Request $request){
        $lastPeminjam = DataPeminjam::latest()->first();
        $lastPeminjamId = $lastPeminjam ? $lastPeminjam->id : 0;

        $kodePeminjam = 'P' . str_pad($lastPeminjamId + 1, 4, '0', STR_PAD_LEFT);

        $this->validate($request,[
            'nama_peminjam' => 'required|string|max:30',
            'tanggal_lahir' => 'required|date'
        ]);
        if($request->has('foto')){
            $this->validate($request,[
                'foto' => 'required|image|mimes:jpeg,jpg,png',
            ]);
            $foto_peminjam = $request->foto;
            $nama_file = time().'.'.$foto_peminjam->getClientOriginalExtension();
            $foto_peminjam->move('foto_peminjam/', $nama_file);

            $data_peminjam = new DataPeminjam;
            $data_peminjam->kode_peminjam = $kodePeminjam;
            $data_peminjam->nama_peminjam = $request->nama_peminjam;
            $data_peminjam->id_jenis_kelamin = $request->id_jenis_kelamin;
            $data_peminjam->tanggal_lahir = $request->tanggal_lahir;
            $data_peminjam->alamat = $request->alamat;
            $data_peminjam->pekerjaan = $request->pekerjaan;
            $data_peminjam->foto = $nama_file;
            $data_peminjam->user_id = $request->user_id;
            $data_peminjam->nomor_telepon = $request->nomor_telepon;
            $data_peminjam->save();
        } else {
            $data_peminjam = new DataPeminjam;
            $data_peminjam->kode_peminjam = $kodePeminjam;
            $data_peminjam->nama_peminjam = $request->nama_peminjam;
            $data_peminjam->id_jenis_kelamin = $request->id_jenis_kelamin;
            $data_peminjam->tanggal_lahir = $request->tanggal_lahir;
            $data_peminjam->alamat = $request->alamat;
            $data_peminjam->pekerjaan = $request->pekerjaan;
            $data_peminjam->user_id = $request->user_id;
            $data_peminjam->nomor_telepon = $request->nomor_telepon;
            $data_peminjam->save();
        }
        return redirect('/');
    }

    public function edit($id){
        if (Auth::user()->level == 'peminjam') {
            $cari_id = Auth::id();
            $peminjam_id = DataPeminjam::where('user_id', $cari_id)->value('id');
            $peminjam = DataPeminjam::find($peminjam_id);
        } else{
            $peminjam = DataPeminjam::find($id);
        }
        $list_jenis_kelamin = JenisKelamin::pluck('nama_jenis_kelamin', 'id_jenis_kelamin');
        return view('data_peminjam.edit', compact('peminjam', 'list_jenis_kelamin'));
    }

    public function update(Request $request, $id){
        $data_peminjam = DataPeminjam::find($id);
        if($request->has('foto')){
            $this->validate($request,[
                'foto' => 'required|image|mimes:jpeg,jpg,png',
            ]);
            $foto_peminjam = $request->foto;
            $nama_file = time().'.'.$foto_peminjam->getClientOriginalExtension();
            $foto_peminjam->move('foto_peminjam/', $nama_file);
            $data_peminjam->kode_peminjam = $request->kode_peminjam;
            $data_peminjam->nama_peminjam = $request->nama_peminjam;
            $data_peminjam->id_jenis_kelamin = $request->id_jenis_kelamin;
            $data_peminjam->tanggal_lahir = $request->tanggal_lahir;
            $data_peminjam->alamat = $request->alamat;
            $data_peminjam->pekerjaan = $request->pekerjaan;
            $data_peminjam->foto = $nama_file;
            $data_peminjam->nomor_telepon = $request->nomor_telepon;
            $data_peminjam->update();

            $cari_user_id = DataPeminjam::where('id', $id)->pluck('user_id');
            $user = User::where('id', $cari_user_id);
            $user->update([
                'name' => $request->nama_peminjam,
            ]);
        } else{
            $data_peminjam->kode_peminjam = $request->kode_peminjam;
            $data_peminjam->nama_peminjam = $request->nama_peminjam;
            $data_peminjam->id_jenis_kelamin = $request->id_jenis_kelamin;
            $data_peminjam->tanggal_lahir = $request->tanggal_lahir;
            $data_peminjam->alamat = $request->alamat;
            $data_peminjam->pekerjaan = $request->pekerjaan;
            $data_peminjam->nomor_telepon = $request->nomor_telepon;
            $data_peminjam->update();

            $cari_user_id = DataPeminjam::where('id', $id)->pluck('user_id');
            $user = User::where('id', $cari_user_id);
            $user->update([
                'name' => $request->nama_peminjam,
            ]);
        }
        
        Session::flash('flash_message', 'Data peminjam berhasil diupdate');

        if (Auth::user()->level == 'peminjam') {
            return redirect('peminjaman');
        } else {
            return redirect('data_peminjam');
        }

        
    }

    public function destroy($id){
        $data_peminjam = DataPeminjam::find($id);
        $cari_peminjaman = Peminjaman::where('id_peminjam', $data_peminjam->id)->get();
        foreach ($cari_peminjaman as $peminjaman) {
            $peminjaman->delete();
        }

        $cari_user_id = DataPeminjam::where('id', $id)->pluck('user_id');
        $user_id = User::where('id', $cari_user_id);
        $user_id->delete();

        
        $data_peminjam->delete();

        return redirect('data_peminjam');
    }
}
