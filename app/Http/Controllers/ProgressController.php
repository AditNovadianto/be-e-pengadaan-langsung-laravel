<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function index()
    {
        return response()->json(Progress::with('pengadaan')->get());
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'persentase_progress' => 'required|string',
            'keterangan_progress' => 'required|string',
            'id_pengadaan' => 'required|integer'
        ]);

        $progress = Progress::create($validatedData);

        return response()->json($progress, 201);
    }

    public function show($id)
    {
        $progress = Progress::with('pengadaan')->findOrFail($id);
        return response()->json($progress);
    }

    public function update(Request $request, $id)
    {
        $progress = Progress::findOrFail($id);

        $validatedData = $request->validate([
            'persentase_progress' => 'sometimes|required|string',
            'keterangan_progress' => 'sometimes|required|string',
        ]);

        $progress->update($validatedData);

        return response()->json($progress);
    }

    public function destroy($id)
    {
        $progress = Progress::findOrFail($id);
        $progress->delete();

        return response()->json(['message' => 'Progress deleted successfully']);
    }
}
