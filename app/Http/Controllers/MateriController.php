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

        $thumbnailPath = $request->file('thumbnail')?->store('thumbnails', 'public');
        $filePath      = $request->file('file')?->store('materis', 'public');
        $videoPath     = $request->file('video_file')?->store('videos', 'public');

        $materi = Materi::create([
            'title'       => $request->title,
            'description' => $request->description,
            'thumbnail'   => $thumbnailPath,
            'file'        => $filePath,
            'video_file'  => $videoPath,
            'user_id'     => Auth::user()->role === 'admin' ? $request->user_id : Auth::id(),
        ]);

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
            'video_file' => 'nullable|mimes:mp4,mov,avi,wmv|max:100000000' // 100 GB

        ];

        if (Auth::user()->role === 'admin') {
            $rules['user_id'] = 'required|exists:users,id';
        }

        $request->validate($rules);

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

        $materi->update([
            'title'       => $request->title,
            'description' => $request->description,
            'user_id'     => Auth::user()->role === 'admin' ? $request->user_id : $materi->user_id,
        ]);

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

        return response()->json(['message' => 'Materi deleted successfully']);
    }

    // Tampilkan 5 materi terbaru
    public function show(Materi $materi)
    {
        $materis = Materi::with('user')->latest()->take(5)->get();
        return response()->json($materi->load('user'));
    }

    // Tampilkan detail materi (view)
    public function apishow(Materi $materi)
    {
        return view('materi.show', compact('materi'));
    }
}
