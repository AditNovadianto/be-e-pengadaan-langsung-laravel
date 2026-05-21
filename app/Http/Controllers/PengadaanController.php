<?php

namespace App\Http\Controllers;

use App\Models\Pengadaan;
use Illuminate\Http\Request;

class PengadaanController extends Controller
{
    public function index()
    {
        $pengadaan = Pengadaan::with(['user', 'penyedia', 'progress', 'laporan'])->get();
        return response()->json($pengadaan);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_pengadaan' => 'required|string',
            'pagu_anggaran' => 'required|string',
            'id_user' => 'required|integer',
            'id_penyedia' => 'required|integer'
        ]);

        $validatedData['status_pengadaan'] = 'DRAFT';

        $pengadaan = Pengadaan::create($validatedData);

        // Auto create progress 10%
        $pengadaan->progress()->create([
            'persentase_progress' => '10%',
            'keterangan_progress' => 'Paket baru dibuat'
        ]);

        return response()->json($pengadaan->load('progress'), 201);
    }

    public function show($id)
    {
        $pengadaan = Pengadaan::with(['user', 'penyedia', 'progress', 'laporan'])->findOrFail($id);
        return response()->json($pengadaan);
    }

    public function update(Request $request, $id)
    {
        $pengadaan = Pengadaan::findOrFail($id);

        $validatedData = $request->validate([
            'nama_pengadaan' => 'sometimes|required|string',
            'pagu_anggaran' => 'sometimes|required|string',
            'nilai_penawaran' => 'nullable|string',
            'nilai_kontrak' => 'nullable|string',
        ]);

        if ($request->has('nilai_kontrak')) {
            $validatedData['status_pengadaan'] = 'SELESAI';
            $pengadaan->progress()->create([
                'persentase_progress' => '100%',
                'keterangan_progress' => 'Kontrak ditetapkan'
            ]);
        } elseif ($request->has('nilai_penawaran')) {
            $validatedData['status_pengadaan'] = 'PENAWARAN MASUK';
            $pengadaan->progress()->create([
                'persentase_progress' => '40%',
                'keterangan_progress' => 'Vendor kirim harga'
            ]);
        }

        $pengadaan->update($validatedData);

        return response()->json($pengadaan);
    }

    public function destroy($id)
    {
        $pengadaan = Pengadaan::findOrFail($id);
        $pengadaan->delete();

        return response()->json(['message' => 'Pengadaan deleted successfully']);
    }
}
