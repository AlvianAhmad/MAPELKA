<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>{{ $materi->title }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-50 font-[Inter] text-slate-800">

<div class="max-w-4xl mx-auto p-6 md:p-12 bg-white rounded-xl shadow-xl mt-10">

  <a href="{{ url('/karyawan/dashboard') }}"
     class="inline-block mb-6 px-4 py-2 bg-slate-500 text-white text-sm font-semibold rounded hover:bg-slate-600 transition">
    &larr; Kembali ke Dashboard
  </a>

  <h1 class="text-3xl font-bold text-center mb-6">{{ $materi->title }}</h1>

  @if($materi->thumbnail)
    <img src="{{ asset('storage/' . $materi->thumbnail) }}" alt="Thumbnail"
         class="w-64 mx-auto rounded-xl shadow mb-8 object-cover">
  @endif

  <p class="text-lg text-slate-600 mb-8 leading-relaxed text-justify">
    {{ $materi->description }}
  </p>

  @if ($materi->video_file)
    <div class="aspect-video w-full rounded-lg overflow-hidden shadow mb-8">
      <video id="materiVideo" controls class="w-full h-full rounded">
        <source src="{{ asset('storage/' . $materi->video_file) }}" type="video/mp4">
        Browser kamu tidak mendukung pemutaran video.
      </video>
    </div>
  @endif

  @if ($materi->file)
    <div class="mb-8">
      <a href="{{ asset('storage/' . $materi->file) }}" target="_blank"
         class="inline-flex items-center gap-2 px-5 py-3 bg-green-600 text-white rounded font-semibold hover:bg-green-700 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4" />
        </svg>
        Download File Materi
      </a>
    </div>
  @endif

  @php
    $cert = \App\Models\Certificate::where('user_id', auth()->id())
            ->where('materi_id', $materi->id)
            ->first();
  @endphp

  @if(auth()->check() && auth()->user()->role === 'karyawan')
    @if($cert && $cert->progress == 100)
      <a href="{{ asset($cert->file_path) }}"
         class="inline-block px-5 py-3 bg-blue-600 text-white rounded font-semibold hover:bg-blue-700 transition mb-8">
        Download Sertifikat
      </a>
    @else
      <p class="text-slate-500 mb-8">Tonton video hingga selesai untuk mendapatkan sertifikat.</p>
    @endif
  @endif

  <h2 class="text-2xl font-bold mb-4">Feedback Peserta</h2>

  <div class="space-y-4 mb-8">
    @forelse ($materi->feedbacks as $feedback)
      <div class="bg-gray-100 border-l-4 border-blue-500 p-4 rounded shadow-sm">
        <p class="font-semibold text-slate-800">{{ $feedback->user->name }}</p>
        <p class="text-slate-600 whitespace-pre-line">{{ $feedback->content }}</p>
      </div>
    @empty
      <p class="text-slate-500 italic">Belum ada feedback untuk materi ini.</p>
    @endforelse
  </div>

  @if (auth()->check() && auth()->user()->role === 'karyawan')
    <form action="{{ route('feedback.store', $materi->id) }}" method="POST" class="space-y-4">
      @csrf
      <textarea name="content" rows="5"
                class="w-full border border-gray-300 rounded-lg p-3 text-slate-700 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                required placeholder="Tulis feedback di sini..."></textarea>
      <button type="submit"
              class="px-5 py-3 bg-blue-600 text-white rounded font-semibold hover:bg-blue-700 transition">
        Kirim Feedback
      </button>
    </form>
  @endif

</div>

@if (auth()->check() && auth()->user()->role === 'karyawan')
<script>
  const video = document.getElementById('materiVideo');
  if (video) {
    video.addEventListener('ended', () => {
      fetch("{{ route('certificate.progress', $materi->id) }}", {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ progress: 100 })
      })
      .then(response => response.json())
      .then(data => {
        alert("Selamat! Kamu sudah menyelesaikan materi ini.");
        location.reload();
      })
      .catch(error => console.error('Error:', error));
    });
  }
</script>
@endif

</body>
</html>
