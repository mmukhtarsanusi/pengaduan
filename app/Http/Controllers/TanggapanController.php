<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class TanggapanController extends Controller
{
    public function index()
    {
        $tanggapans = Tanggapan::latest()->with('getNamaPetugas', 'getStatusPengaduan')->paginate(5);
        return view('tanggapan.index', compact('tanggapans'));
    }

    public function create($id_pengaduan)
    {
        $pengaduan = Pengaduan::find($id_pengaduan);
        if ($pengaduan->status == "Selesai") {
            return back()->with('error', 'Status pengaduan sudah Selesai. Tidak dapat memberi tanggapan.');
        }
        return view('tanggapan.create', compact('pengaduan'));
    }

    public function store(Request $request, $id_pengaduan)
    {
        $request->validate([
            'id_pengaduan' => 'required',
            'tgl_tanggapan' => 'required',
            'tanggapan' => 'required',
            'id_petugas' => 'required',
        ]);


        $updateStatus = Pengaduan::findOrFail($id_pengaduan);
        $updateStatus->status = $request->status;
        $updateStatus->update();

        $data = new Tanggapan;
        $data->id_pengaduan = $id_pengaduan;
        $data->tgl_tanggapan = $request->tgl_tanggapan;
        $data->tanggapan = $request->tanggapan;
        $data->id_petugas = $request->id_petugas;
        $data->save();

        return redirect()->route('tanggapan.index')->with('success', 'Berhasil memberi tanggapan.');
    }

    public function edit($id_tanggapan)
    {
        $tanggapan = Tanggapan::find($id_tanggapan);
        $pengaduan = Pengaduan::find($tanggapan->id_pengaduan);
        return view('tanggapan.edit', compact('pengaduan', 'tanggapan'));
    }

    public function update(Request $request, $id_tanggapan)
    {
        $request->validate([
            'id_pengaduan' => 'required',
            'tgl_tanggapan' => 'required',
            'tanggapan' => 'required',
            'id_petugas' => 'required',
        ]);

        $updateStatus = Pengaduan::findOrFail($request->id_pengaduan);
        $updateStatus->status = $request->status;
        $updateStatus->update();

        $data = Tanggapan::findOrFail($id_tanggapan);
        $data->tgl_tanggapan = $request->tgl_tanggapan;
        $data->tanggapan = $request->tanggapan;
        $data->id_petugas = $request->id_petugas;
        $data->update();

        return redirect()->route('tanggapan.index')->with('success', 'Berhasil memberi tanggapan.');
    }

    public function delete($id_tanggapan)
    {
        $tanggapan = Tanggapan::findOrFail($id_tanggapan);
        if ($tanggapan) {
            $tanggapan->delete();
            return redirect()->route('tanggapan.index')->with('success', 'Berhasil menghapus pengaduan.');
        }
        return redirect()->route('tanggapan.index')->with('error', 'Gagal menghapus pengaduan.');
    }

    public function generatePDF()
    {
        $admin = Auth::guard('petugas')->user()->nama;
        $tanggapans = Tanggapan::latest()->with('getNamaPetugas', 'getStatusPengaduan')->get();
        // return $tanggapans;
        
        $data = [
            'judul' => "Generate Tanggapan dan Pengaduan",
            'admin' => $admin,
            'tanggapans' => $tanggapans,
        ];

        $pdf = Pdf::loadView('tanggapan.generate_pdf', $data)->setPaper('a4', 'landscape');
        // return $pdf->download(Str::random(20) . '.pdf');
        return $pdf->stream();
    }
}
