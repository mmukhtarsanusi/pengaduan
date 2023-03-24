<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasyarakatController extends Controller
{
    public function landing()
    {
        return view('masyarakat.landing');
    }

    public function index()
    {
        $masyarakats = Masyarakat::latest()->paginate(5);
        return view('masyarakat.index', compact('masyarakats'));
    }

    public function delete($id)
    {
        if (Auth::guard('petugas')->user()->level == "Petugas") {
            return back()->with('error', 'Tidak bisa menguba petugas. Level Anda harus admin');
        }

        $masyarakat = Masyarakat::findOrFail($id);
        if ($masyarakat) {
            $masyarakat->delete();
            return redirect()->route('petugas.index')->with('success', 'Berhasil menghapus masyarakat.');
        }
        return redirect()->route('petugas.index')->with('error', 'Gagal menghapus masyarakat.');
    }
}
