<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class PengaduanController extends Controller
{
    public function index()
    {
        $pengaduans = Pengaduan::where('nik', Auth::guard('masyarakat')->user()->nik)->latest()->paginate(5);
        return view('pengaduan.index', compact('pengaduans'));
    }

    public function indexPetugas()
    {

        $pengaduans = Pengaduan::latest()->with('masyarakat')->paginate(5);
        return view('pengaduan.indexPetugas', compact('pengaduans'));
    }

    public function create()
    {
        return view('pengaduan.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'tgl_pengaduan' => 'required',
            'isi_laporan' => 'required',
            'foto' => 'image|mimes:jpg,svg,png',
            'nik' => 'required',
        ]);

        if ($request->file('foto')) {
            $fileImage = hexdec(uniqid()) . "." . $request->foto->extension();
            Image::make($request->file('foto'))->save('assets/images/' . $fileImage);
            $pengaduanImage = 'assets/images/' . $fileImage;

            $validateData['foto'] = $pengaduanImage;
            $validateData['status'] = "0";

            Pengaduan::create($validateData);
        } else {
            $validateData['foto'] = "-";
            $validateData['status'] = "0";

            Pengaduan::create($validateData);
        }

        return redirect()->route('pengaduan.index')->with('success', 'Berhasil melaporkan pengaduan.');
    }

    public function edit($id)
    {
        $pengaduan = Pengaduan::find($id);
        if ($pengaduan->status == "Selesai") {
            return back()->with('error', 'Status pengaduan sudah selesai. Tidak dapat mengubah pengaduan.');
        }
        return view('pengaduan.edit', compact('pengaduan'));
    }

    public function update(Request $request, $id)
    {
        if ($request->file('foto')) {
            $fileImage = hexdec(uniqid()) . "." . $request->foto->extension();
            Image::make($request->file('foto'))->save('assets/images/' . $fileImage);
            $pengaduanImage = 'assets/images/' . $fileImage;

            $data = Pengaduan::findOrFail($id);
            $data->tgl_pengaduan = $request->tgl_pengaduan;
            $data->isi_laporan = $request->isi_laporan;
            $data->foto = $pengaduanImage;
            $data->update();
        } else {
            $data = Pengaduan::findOrFail($id);
            $data->tgl_pengaduan = $request->tgl_pengaduan;
            $data->isi_laporan = $request->isi_laporan;
            $data->foto = $request->foto_lama;
            $data->update();
        }
        return redirect()->route('pengaduan.index')->with('success', 'Berhasil mengubah pengaduan.');
    }

    public function delete($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        if ($pengaduan) {
            $pengaduan->delete();
            return redirect()->route('pengaduan.index')->with('success', 'Berhasil menghapus pengaduan.');
        }
        return redirect()->route('pengaduan.index')->with('error', 'Gagal menghapus pengaduan.');
    }
}
