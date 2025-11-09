<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf; // ✅ ini yang benar, bukan PhpSpreadsheet

class DaftarSuratController extends Controller
{
    public function exportPdf(Request $request)
{
    $userId = Auth::user()->user_id;
    $search = $request->get('search', '');
    $kategori = $request->get('kategori', 'semua');
    $jenis = $request->get('jenis', 'semua');

    // 🔹 Query dasar
    $sph = DB::table('sph')
        ->select('nomor_surat', 'nama_customer', 'nominal', 'created_at', DB::raw("'surat penawaran harga' as jenis_surat"))
        ->where('user_id', $userId);

    $inv = DB::table('inv')
        ->select('nomor_surat', 'nama_customer', 'nominal', 'created_at', DB::raw("'surat invoice' as jenis_surat"))
        ->where('user_id', $userId);

    $skt = DB::table('skt')
        ->select('nomor_surat', 'nama_customer', DB::raw('NULL as nominal'), 'created_at', DB::raw("'surat keterangan' as jenis_surat"))
        ->where('user_id', $userId);

    $unionQuery = $sph->unionAll($inv)->unionAll($skt);

    $query = DB::table(DB::raw("({$unionQuery->toSql()}) as daftar_surat"))
        ->mergeBindings($unionQuery)
        ->orderBy('created_at', 'desc');

    // 🔍 Filter pencarian
    if (!empty($search)) {
        $query->where('nama_customer', 'like', '%' . $search . '%');
    }

    // 🏷️ Filter kategori
    if ($kategori === 'perusahaan') {
        $query->whereRaw("LOWER(nama_customer) REGEXP '(^|\\s)(pt|cv|ud|firma)'");
    } elseif ($kategori === 'perorangan') {
        $query->whereRaw("LOWER(nama_customer) NOT REGEXP '(^|\\s)(pt|cv|ud|firma)'");
    }

    // 📄 Filter jenis surat
    if ($jenis !== 'semua') {
        $query->where('jenis_surat', $jenis);
    }

    $dataSurat = $query->get();

    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.daftarsurat', compact('dataSurat'))
        ->setPaper('a4', 'portrait');

    return $pdf->stream('daftar-surat.pdf');
}
}