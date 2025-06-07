<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LapanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lapangans = Lapangan::latest()->get();
        return view('admin.lapangan.index', compact('lapangans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.lapangan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lapangan' => 'required|string|max:255',
            'tipe' => 'required|string|max:255',
            'spesifikasi' => 'nullable|string',
            'harga_per_jam' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/lapangan'), $filename);
            $data['gambar'] = $filename;
        }

        Lapangan::create($data);

        return redirect()->route('admin.lapangan.index')
                        ->with('success', 'Data lapangan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lapangan = Lapangan::findOrFail($id);
        return view('admin.lapangan.show', compact('lapangan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $lapangan = Lapangan::findOrFail($id);
        return view('admin.lapangan.edit', compact('lapangan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $lapangan = Lapangan::findOrFail($id);
        
        $request->validate([
            'nama_lapangan' => 'required|string|max:255',
            'tipe' => 'required|string|max:255',
            'spesifikasi' => 'nullable|string',
            'harga_per_jam' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($lapangan->gambar && file_exists(public_path('images/lapangan/' . $lapangan->gambar))) {
                unlink(public_path('images/lapangan/' . $lapangan->gambar));
            }
            
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/lapangan'), $filename);
            $data['gambar'] = $filename;
        }

        $lapangan->update($data);

        return redirect()->route('admin.lapangan.index')
                        ->with('success', 'Data lapangan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lapangan = Lapangan::findOrFail($id);
        
        if ($lapangan->gambar && file_exists(public_path('images/lapangan/' . $lapangan->gambar))) {
            unlink(public_path('images/lapangan/' . $lapangan->gambar));
        }
        
        $lapangan->delete();

        return redirect()->route('admin.lapangan.index')
                        ->with('success', 'Data lapangan berhasil dihapus!');
    }
}