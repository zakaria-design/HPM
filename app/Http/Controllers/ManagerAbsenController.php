<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\Izin;
use App\Models\Absen;
use App\Models\Hadir;
use App\Models\Sakit;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class ManagerAbsenController extends Controller
{
    // Halaman Hadir
    public function index()
    {
        return view('ManagerAbsen.hadir.index');
    }

    // Halaman Izin
    public function izin()
    {
        return view('ManagerAbsen.izin.index');
    }

    // Halaman Sakit
    public function sakit()
    {
        return view('ManagerAbsen.sakit.index');
    }

    // Logika Presensi Hadir
    public function store(Request $request)
    {
        $userId = Auth::id();
        $today = Carbon::today();

        // Cek ketiga tabel sekaligus
        $alreadyPresensi = Hadir::where('user_id', $userId)->whereDate('waktu', $today)->exists()
            || Izin::where('user_id', $userId)->whereDate('waktu', $today)->exists()
            || Sakit::where('user_id', $userId)->whereDate('waktu', $today)->exists();

        if ($alreadyPresensi) {
            return redirect()->route('manager.presensi.index')
                ->with('error', 'Anda sudah melakukan presensi hari ini!');
        }

        $request->validate([
            'foto' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        // Simpan foto
        $fotoData = str_replace('data:image/png;base64,', '', $request->foto);
        $fotoData = str_replace(' ', '+', $fotoData);
        $fotoName = 'absen_' . time() . '.png';
        File::put(public_path('absen/' . $fotoName), base64_decode($fotoData));

        // Ambil alamat dari koordinat via OpenStreetMap
        $lat = $request->latitude;
        $lng = $request->longitude;

        $response = Http::get("https://nominatim.openstreetmap.org/reverse", [
            'lat' => $lat,
            'lon' => $lng,
            'format' => 'json',
            'addressdetails' => 1,
        ]);

        $data = $response->json();
        $alamat = $data['display_name'] ?? 'Alamat tidak ditemukan';

        $now = Carbon::now('Asia/Jakarta');

        Hadir::create([
            'user_id'   => $userId,
            'foto'      => $fotoName,
            'latitude'  => $lat,
            'longitude' => $lng,
            'alamat'    => $alamat,
            'waktu'     => $now,
            'jam'       => $now->toTimeString(),
        ]);

        return redirect()->route('manager.presensi.index')
            ->with('success', 'Presensi hadir berhasil!');
    }

    // Logika Presensi Izin
    public function storeIzin(Request $request)
    {
        $userId = Auth::id();
        $today = Carbon::today();

        // Cek ketiga tabel sekaligus
        $alreadyPresensi = Hadir::where('user_id', $userId)->whereDate('waktu', $today)->exists()
            || Izin::where('user_id', $userId)->whereDate('waktu', $today)->exists()
            || Sakit::where('user_id', $userId)->whereDate('waktu', $today)->exists();

        if ($alreadyPresensi) {
            return redirect()->route('manager.presensi.index')
                ->with('error', 'Anda sudah melakukan presensi hari ini!');
        }

        $validated = $request->validate([
            'alasan_izin' => 'required|string|max:255',
            'foto_bukti' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $fotoBukti = null;
        if ($request->hasFile('foto_bukti')) {
            $file = $request->file('foto_bukti');
            $fotoBukti = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('absen'), $fotoBukti);
        }

        $now = Carbon::now('Asia/Jakarta');

        Izin::create([
            'user_id' => $userId,
            'alasan_izin' => $validated['alasan_izin'],
            'foto_bukti' => $fotoBukti,
            'waktu' => $now,
            'jam' => $now->toTimeString(),
        ]);

        return redirect()->route('manager.presensi.index')
            ->with('success', 'Presensi izin berhasil!');
    }

    // Logika Presensi Sakit
    public function storeSakit(Request $request)
    {
        $userId = Auth::id();
        $today = Carbon::today();

        // Cek ketiga tabel sekaligus
        $alreadyPresensi = Hadir::where('user_id', $userId)->whereDate('waktu', $today)->exists()
            || Izin::where('user_id', $userId)->whereDate('waktu', $today)->exists()
            || Sakit::where('user_id', $userId)->whereDate('waktu', $today)->exists();

        if ($alreadyPresensi) {
            return redirect()->route('manager.presensi.index')
                ->with('error', 'Anda sudah melakukan presensi hari ini!');
        }

        $validated = $request->validate([
            'alasan_sakit' => 'required|string|max:255',
            'foto_bukti' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $fotoBukti = null;
        if ($request->hasFile('foto_bukti')) {
            $file = $request->file('foto_bukti');
            $fotoBukti = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('absen'), $fotoBukti);
        }

        $now = Carbon::now('Asia/Jakarta');

        Sakit::create([
            'user_id' => $userId,
            'alasan_sakit' => $validated['alasan_sakit'],
            'foto_bukti' => $fotoBukti,
            'waktu' => $now,
            'jam' => $now->toTimeString(),
        ]);

        return redirect()->route('manager.presensi.index')
            ->with('success', 'Presensi sakit berhasil!');
    }
}