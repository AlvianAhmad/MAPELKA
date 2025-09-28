<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class MateriController extends Controller
{
    // Tampilkan semua materi
    public function index()
    {
        $user = Auth::user();

        $materis = $user->role === 'pelatih'
            ? Materi::with('user')->where('user_id', $user->id)->get()
            : Materi::with('user')->get();

        return response()->json($materis);
    }

    // Tambah materi
    public function store(Request $request)
    {
        if (!in_array(Auth::user()->role, ['admin', 'pelatih'])) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $rules = [
            'title'        => 'required|string|max:255',
            'description'  => 'required|string',
            'thumbnail'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'file'         => 'nullable|mimes:pdf,docx,doc,ppt,pptx|max:10240',
            'video_file'   => 'nullable|mimes:mp4,mov,avi,wmv|max:204800'
        ];

        if (Auth::user()->role === 'admin') {
            $rules['user_id'] = 'required|exists:users,id';
        }

        $request->validate($rules);

        $materi = new Materi();
        $materi->title       = $request->title;
        $materi->description = $request->description;
        $materi->user_id     = Auth::user()->role === 'admin' ? $request->user_id : Auth::id();

        if ($request->hasFile('thumbnail')) {
            $materi->thumbnail = $request->file('thumbnail')->store('thumbnails', 'public');
        }
        if ($request->hasFile('file')) {
            $materi->file = $request->file('file')->store('materis', 'public');
        }
        if ($request->hasFile('video_file')) {
            $materi->video_file = $request->file('video_file')->store('videos', 'public');
        }

        $materi->save();

        return response()->json($materi, 201);
    }

    // Update materi
    public function update(Request $request, Materi $materi)
    {
        if (!in_array(Auth::user()->role, ['admin', 'pelatih'])) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $rules = [
            'title'        => 'required|string|max:255',
            'description'  => 'required|string',
            'thumbnail'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'file'         => 'nullable|mimes:pdf,docx,doc,ppt,pptx|max:10240',
            'video_file'   => 'nullable|mimes:mp4,mov,avi,wmv|max:102400'
        ];

        if (Auth::user()->role === 'admin') {
            $rules['user_id'] = 'required|exists:users,id';
        }

        $request->validate($rules);

        // Update file jika ada
        if ($request->hasFile('thumbnail')) {
            if ($materi->thumbnail) {
                Storage::disk('public')->delete($materi->thumbnail);
            }
            $materi->thumbnail = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        if ($request->hasFile('file')) {
            if ($materi->file) {
                Storage::disk('public')->delete($materi->file);
            }
            $materi->file = $request->file('file')->store('materis', 'public');
        }

        if ($request->hasFile('video_file')) {
            if ($materi->video_file) {
                Storage::disk('public')->delete($materi->video_file);
            }
            $materi->video_file = $request->file('video_file')->store('videos', 'public');
        }

        // Update data lain
        $materi->title       = $request->title;
        $materi->description = $request->description;

        if (Auth::user()->role === 'admin') {
            $materi->user_id = $request->user_id;
        }

        $materi->save();

        return response()->json($materi);
    }

    // Hapus materi
    public function destroy(Materi $materi)
    {
        if ($materi->thumbnail) {
            Storage::disk('public')->delete($materi->thumbnail);
        }
        if ($materi->file) {
            Storage::disk('public')->delete($materi->file);
        }
        if ($materi->video_file) {
            Storage::disk('public')->delete($materi->video_file);
        }

        $materi->delete();

        return response()->json(['message' => 'Materi berhasil dihapus.']);
    }

    // Tampilkan materi by ID
    public function show(Materi $materi)
    {
        return response()->json($materi->load('user'));
    }

    // Tampilkan 5 materi terbaru
    public function latestMateris()
    {
        $materis = Materi::with('user')->latest()->take(5)->get();
        return response()->json($materis);
    }

    // Tampilkan view detail materi (opsional)
    public function apishow(Materi $materi)
    {
        return view('materi.show', compact('materi'));
    }
}
