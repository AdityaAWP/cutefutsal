<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Lapangan;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allPemesanan = Pemesanan::with('lapangans')->get();
        $lapangans = \App\Models\Lapangan::all();
        return view('admin_welcome', compact('allPemesanan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lapangans = \App\Models\Lapangan::all();
        return view('admin_welcome', compact('lapangans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'no_hp' => 'required',
            'tgl_main' => 'required',
            'waktu_main' => 'required',
            'lapangan_id' => 'required',
        ]);

        Pemesanan::create($request->all());
        return redirect()->route('pemesanans.index')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemesanan $pemesanan)
    {
        return view('pemesanan.show', compact('pemesanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function adminIndex()
    {
        $pemesanans = Pemesanan::with('lapangans')->latest()->get();
        return view('admin.pemesanan.index', compact('pemesanans'));
    }

    
    public function edit(Pemesanan $pemesanan)
    {
        $lapangans = Lapangan::all();
        return view('pemesanans.edit', compact('pemesanan', 'lapangans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemesanan $pemesanan)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
        ]);
        //Simpan Data
        $pemesanan->update($validatedData);

        //redirect ke index pemesanan
        return redirect()->route('pemesanans.index')->with('success', 'Pemesanan berhasil ditambahkan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Pemesanan::findOrFail($id)->delete();
        return back()->with('success', 'Data berhasil dihapus.');
    }
}
