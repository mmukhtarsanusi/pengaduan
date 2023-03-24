<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\Masyarakat;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetugasController extends Controller
{
    public function landing()
    {
        $totalPengaduan = Pengaduan::count();
        $aduanProses = Pengaduan::where('status', 'proses')->count();
        $aduanSelesai = Pengaduan::where('status', 'selesai')->count();
        $masyarakats = Masyarakat::latest()->paginate(5);
        return view('petugas.landing', compact('masyarakats', 'totalPengaduan', 'aduanProses', 'aduanSelesai'));
    }

    public function index()
    {
        $petugass = Petugas::latest()->paginate(5);
        return view('petugas.index', compact('petugass'));
    }

    public function create()
    {
        if (Auth::guard('petugas')->user()->level == "Petugas") {
            return back()->with('error', 'Tidak bisa menambah petugas. Level Anda harus admin');
        }
        return view('petugas.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:petugas',
            'password' => 'required',
            'telp' => 'required',
            'level' => 'required',
        ]);
        $validateData['password'] = bcrypt($validateData['password']);

        Petugas::create($validateData);

        return redirect()->route('petugas.index')->with('success', 'Berhasil menambahkan petugas');
    }

    public function edit($id)
    {
        if (Auth::guard('petugas')->user()->level == "Petugas") {
            return back()->with('error', 'Tidak bisa menguba petugas. Level Anda harus admin');
        }

        $petugas = Petugas::findOrFail($id);
        return view('petugas.edit', compact('petugas'));
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'nama' => 'required',
            'password' => 'required',
            'telp' => 'required',
            'level' => 'required',
        ]);
        $validateData['password'] = bcrypt($validateData['password']);

        $petugas = Petugas::findOrFail($id);
        $petugas->update($validateData);

        return redirect()->route('petugas.index')->with('success', 'Berhasil mengubah petugas');
    }

    public function delete($id)
    {
        if (Auth::guard('petugas')->user()->level == "Petugas") {
            return back()->with('error', 'Tidak bisa menguba petugas. Level Anda harus admin');
        }

        $petugas = Petugas::findOrFail($id);
        if ($petugas) {
            $petugas->delete();
            return redirect()->route('petugas.index')->with('success', 'Berhasil menghapus petugas.');
        }
        return redirect()->route('petugas.index')->with('error', 'Gagal menghapus petugas.');
    }
}
