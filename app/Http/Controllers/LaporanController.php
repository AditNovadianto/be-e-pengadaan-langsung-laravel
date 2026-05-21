<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        return response()->json(Laporan::with('pengadaan')->get());
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_laporan' => 'required|string',
            'file_path_laporan' => 'required|string',
            'id_pengadaan' => 'required|integer'
        ]);

        $laporan = Laporan::create($validatedData);

        return response()->json($laporan, 201);
    }

    public function show($id)
    {
        $laporan = Laporan::with('pengadaan')->findOrFail($id);
        return response()->json($laporan);
    }

    public function update(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);

        $validatedData = $request->validate([
            'nama_laporan' => 'sometimes|required|string',
            'file_path_laporan' => 'sometimes|required|string',
        ]);

        $laporan->update($validatedData);

        return response()->json($laporan);
    }

    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->delete();

        return response()->json(['message' => 'Laporan deleted successfully']);
    }
}
