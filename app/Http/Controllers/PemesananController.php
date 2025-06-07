<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Lapangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PemesananController extends Controller
{
    public function index()
    {
        $lapangans = Lapangan::all();
        $user = Auth::user();
        return view('form_pemesanan', compact('lapangans', 'user'));
    }

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

    public function checkAvailability(Request $request)
    {
        $tanggal = $request->tanggal;
        $lapanganId = $request->lapangan_id;

        $conflictingBookings = Pemesanan::where('lapangan_id', $lapanganId)
            ->where('tgl_main', $tanggal)
            ->get(['waktu_main', 'waktu_selesai']);

        $bookedTimes = [];
        foreach ($conflictingBookings as $booking) {
            $start = Carbon::parse($booking->waktu_main);
            $end = Carbon::parse($booking->waktu_selesai);
            $current = $start;

            while ($current < $end) {
                $bookedTimes[] = $current->format('H:i');
                $current->addMinutes(30);
            }
        }

        return response()->json([
            'available' => true,
            'bookedTimes' => $bookedTimes
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'tgl_main' => 'required|date|after_or_equal:today',
            'waktu_main' => 'required',
            'waktu_selesai' => 'required|after:waktu_main',
            'lapangan_id' => 'required|exists:lapangans,id',
        ], [
            'tgl_main.after_or_equal' => 'Tanggal main harus hari ini atau setelahnya',
            'waktu_selesai.after' => 'Waktu selesai harus setelah waktu mulai',
        ]);

        $conflictingBookings = Pemesanan::where('lapangan_id', $request->lapangan_id)
            ->where('tgl_main', $request->tgl_main)
            ->where(function ($query) use ($request) {
                $query->where(function ($subQuery) use ($request) {
                    $subQuery->where('waktu_main', '<', $request->waktu_selesai)
                             ->where('waktu_selesai', '>', $request->waktu_main);
                });
            })->exists();

        if ($conflictingBookings) {
            return back()->withErrors(['waktu' => 'Jadwal yang dipilih sudah terboking. Silakan pilih waktu lain.'])
                        ->withInput();
        }

        Pemesanan::create($request->all());

        return redirect()->route('pemesanans.index')->with('success', 'Pemesanan berhasil dibuat!');
    }

    public function show(Pemesanan $pemesanan)
    {
        return view('pemesanan.show', compact('pemesanan'));
    }

    public function adminCreate()
    {
        $lapangans = Lapangan::all();
        return view('pemesanan', compact('lapangans'));
    }

    public function adminStore(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'tgl_main' => 'required|date',
            'waktu_main' => 'required',
            'waktu_selesai' => 'required|after:waktu_main',
            'lapangan_id' => 'required|exists:lapangans,id',
        ]);

        $conflictingBookings = Pemesanan::where('lapangan_id', $request->lapangan_id)
            ->where('tgl_main', $request->tgl_main)
            ->where(function ($query) use ($request) {
                $query->where(function ($subQuery) use ($request) {
                    $subQuery->where('waktu_main', '<', $request->waktu_selesai)
                             ->where('waktu_selesai', '>', $request->waktu_main);
                });
            })->exists();

        if ($conflictingBookings) {
            return back()->withErrors(['waktu' => 'Jadwal yang dipilih sudah terboking.'])->withInput();
        }

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

    public function update(Request $request, Pemesanan $pemesanan)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'lapangan_id' => 'required|exists:lapangans,id',
            'tgl_main' => 'required|date',
            'waktu_main' => 'required',
            'waktu_selesai' => 'required|after:waktu_main',
        ]);

        $conflictingBookings = Pemesanan::where('lapangan_id', $request->lapangan_id)
            ->where('tgl_main', $request->tgl_main)
            ->where('id', '!=', $pemesanan->id)
            ->where(function ($query) use ($request) {
                $query->where(function ($subQuery) use ($request) {
                    $subQuery->where('waktu_main', '<', $request->waktu_selesai)
                             ->where('waktu_selesai', '>', $request->waktu_main);
                });
            })->exists();

        if ($conflictingBookings) {
            return back()->withErrors(['waktu' => 'Jadwal yang dipilih sudah terboking.'])->withInput();
        }

        $pemesanan->update($validatedData);

        return redirect()->route('admin.welcome')->with('success', 'Pemesanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Pemesanan::findOrFail($id)->delete();
        return back()->with('success', 'Data berhasil dihapus.');
    }

    public function getSchedule(Request $request)
    {
        $lapanganId = $request->lapangan_id;
        $tanggal = $request->tanggal;

        $bookings = Pemesanan::where('lapangan_id', $lapanganId)
            ->where('tgl_main', $tanggal)
            ->orderBy('waktu_main')
            ->get(['waktu_main', 'waktu_selesai', 'nama']);

        return response()->json($bookings);
    }
}