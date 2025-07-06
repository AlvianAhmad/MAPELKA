<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificate;
use App\Models\Materi;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class CertificateController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Update Progress & Generate Certificate
    |--------------------------------------------------------------------------
    |
    | Method untuk update progress user di materi, dan generate sertifikat
    | dalam bentuk PDF jika progress sudah 100% dan file sertifikat belum ada.
    |
    */

    public function updateProgress(Request $request, Materi $materi)
{
    $cert = Certificate::firstOrNew([
        'user_id'   => Auth::id(),
        'materi_id' => $materi->id,
    ]);

    $cert->progress = $request->progress;

    if ($cert->progress == 100 && !$cert->file_path) {
        $dir = public_path('certificates');

        if (!file_exists($dir)) {
            mkdir($dir, 0775, true);
        }

        $pdf = Pdf::loadView('sertifikat.template', [
            'user'   => Auth::user(),
            'materi' => $materi
        ]);

        $fileName = 'sertifikat_' . time() . '.pdf';
        $pdf->save($dir . '/' . $fileName);

        $cert->file_path = 'certificates/' . $fileName;
    }

    $cert->save();

    // ✅ Kembalikan response JSON biar bisa di-handle di JS
    return response()->json([
        'success' => true,
        'progress' => $cert->progress,
        'file_path' => $cert->file_path
    ]);
}


    /*
    |--------------------------------------------------------------------------
    | View All Certificates (Karyawan)
    |--------------------------------------------------------------------------
    |
    | Method untuk menampilkan semua sertifikat milik user yang sedang login.
    |
    */

    public function viewCertificates()
    {
        // Ambil semua sertifikat user yang login
        $sertifikats = Certificate::where('user_id', Auth::id())->get();

        // Tampilkan ke halaman karyawan.sertifikat
        return view('karyawan.sertifikat', compact('sertifikats'));
    }

}
