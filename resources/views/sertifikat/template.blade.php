<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sertifikat Pelatihan</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
  <style>
    @page { size: A4; margin: 20mm; }
    body { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
    .font-cursive { font-family: 'Great Vibes', cursive; }
    .font-display { font-family: 'Playfair Display', serif; }
  </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-8">

  <main class="relative w-full max-w-4xl bg-white border-8 border-blue-600 rounded-2xl shadow-2xl p-12 text-center overflow-visible">

    <!-- Frame border inside -->
    <div class="absolute inset-4 border-4 border-blue-400 rounded-xl pointer-events-none"></div>

    <div class="relative z-10">

      <h1 class="text-6xl font-display text-gray-900 mb-2 select-none tracking-wider">SERTIFIKAT</h1>
      <p class="text-lg uppercase text-gray-600 tracking-widest mb-8 select-none">Penghargaan Resmi</p>

      <p class="text-lg text-gray-700 mb-4 select-none">Diberikan dengan bangga kepada:</p>
      <h2 class="text-5xl font-cursive text-blue-600 my-8 select-text">{{ $user->name }}</h2>

      <p class="text-lg text-gray-600 mb-2 font-medium uppercase tracking-wide select-none">Sebagai Peserta Pelatihan</p>

      <p class="text-base text-gray-700 max-w-2xl mx-auto select-none">
        Atas partisipasi aktif dalam menyelesaikan pelatihan <strong>{{ $materi->title }}</strong> dengan pencapaian yang sangat baik dan dedikasi luar biasa.
      </p>

      <!-- Garis -->
      <div class="my-12 border-t-2 border-gray-300 w-2/3 mx-auto"></div>

      <!-- TTD Area -->
      <div class="flex justify-around mt-16 text-center">
        <!-- Mentor -->
        <div class="flex flex-col items-center">
          <div class="w-40 h-16 border-b-2 border-gray-400 mb-2"></div>
          <p class="font-semibold text-gray-800">{{ $materi->user->name }}</p>
          <p class="text-sm text-gray-500">Mentor</p>
        </div>

        <!-- CEO -->
        <div class="flex flex-col items-center">
          <div class="w-40 h-16 border-b-2 border-gray-400 mb-2"></div>
          <p class="font-semibold text-gray-800">Alvian Ahmad Febrian</p>
          <p class="text-sm text-gray-500">CEO MAPELKA</p>
        </div>
      </div>

      <!-- Footer Kode Sertifikat -->
      <p class="mt-12 text-xs text-gray-400">Nomor Sertifikat: MAPELKA-{{ date('Ymd') }}-{{ $user->id }}</p>

    </div>

  </main>

</body>
</html>
