<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Lapangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lapangans = Lapangan::all();
        $user = Auth::user();
        return view('form_pemesanan', compact('lapangans', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $lapangans = Lapangan::all();
        
        $selectedLapanganId = $request->get('id');
        $selectedLapangan = null;
        $user = Auth::user();
        
        if ($selectedLapanganId) {
            $selectedLapangan = Lapangan::find($selectedLapanganId);
        }
        
        return view('form_pemesanan', compact('lapangans', 'selectedLapangan', 'user'));
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

    public function adminCreate()
    {
        $lapangans = Lapangan::all();
        return view('pemesanan', compact('lapangans'));
    }

    public function adminStore(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'no_hp' => 'required',
            'tgl_main' => 'required|date',
            'waktu_main' => 'required',
            'lapangan_id' => 'required|exists:lapangans,id',
        ]);

        Pemesanan::create($validatedData);

        return redirect()->route('admin.welcome')->with('success', 'Data berhasil ditambahkan.');
    }

    public function adminIndex()
    {
        $pemesanans = Pemesanan::with('lapangan')->latest()->get();
        return view('admin.pemesanan.index', compact('pemesanans'));
    }


    public function edit(Pemesanan $pemesanan)
    {
        $lapangans = Lapangan::all();
        return view('edit', compact('pemesanan', 'lapangans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemesanan $pemesanan)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'lapangan_id' => 'required|exists:lapangans,id',
            'tgl_main' => 'required|date',
            'waktu_main' => 'required',
        ]);

        // Update data
        $pemesanan->update($validatedData);

        // Redirect ke halaman admin
        return redirect()->route('admin.welcome')->with('success', 'Pemesanan berhasil diperbarui.');
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
