<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materi;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Store Feedback
    |--------------------------------------------------------------------------
    |
    | Menyimpan feedback dari karyawan ke materi terkait.
    |
    */
    public function store(Request $request, Materi $materi)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Feedback::create([
            'content'    => $request->content,
            'user_id'    => auth()->id(),
            'materi_id'  => $materi->id,
        ]);

        return redirect()->back()->with('success', 'Feedback berhasil dikirim.');
    }

    /*
    |--------------------------------------------------------------------------
    | Get Feedbacks for Pelatih
    |--------------------------------------------------------------------------
    |
    | Mengambil semua feedback untuk materi yang dibuat oleh pelatih yang login.
    |
    */
    public function getFeedbacks()
    {
        $feedbacks = Feedback::with(['user', 'materi'])
            ->whereHas('materi', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($feedbacks);
    }

    /*
    |--------------------------------------------------------------------------
    | Get All Feedbacks for Admin
    |--------------------------------------------------------------------------
    |
    | Mengambil semua feedback yang ada di sistem.
    |
    */
    public function getAllFeedbacks()
    {
        $feedbacks = Feedback::with(['user', 'materi'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($feedbacks);
    }

    /*
    |--------------------------------------------------------------------------
    | Update Feedback
    |--------------------------------------------------------------------------
    |
    | Memperbarui isi feedback.
    |
    */
    public function update(Request $request, Feedback $feedback)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $feedback->update([
            'content' => $request->content,
        ]);

        return response()->json(['message' => 'Feedback berhasil diupdate']);
    }

    /*
    |--------------------------------------------------------------------------
    | Delete Feedback
    |--------------------------------------------------------------------------
    |
    | Menghapus data feedback.
    |
    */
    public function destroy(Feedback $feedback)
    {
        $feedback->delete();

        return response()->json(['message' => 'Feedback berhasil dihapus']);
    }
}
