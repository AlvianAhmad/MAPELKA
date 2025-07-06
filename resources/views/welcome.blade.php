<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome | MAPELKA</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" href="{{ asset('assets/images/logos/mapelkalogo.png') }}">
</head>
<body class="bg-cover bg-center bg-no-repeat min-h-screen text-white" style="background-image: url('{{ asset('assets/images/photos/lab.jpeg') }}');">

  <!-- Overlay (agar konten tidak terlalu silau) -->
  <div class="bg-black bg-opacity-60 min-h-screen">

    <!-- Navbar -->
    <nav class="flex items-center justify-between p-6 max-w-7xl mx-auto">
      <div class="flex items-center space-x-3">
        <img src="{{ asset('assets/images/logos/mapelkalogo.png') }}" class="h-8 w-auto" alt="Logo">
        <span class="text-2xl font-semibold text-white">MAPELKA</span>
      </div>
      <a href="{{ route('login') }}" class="px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 transition">Login</a>
    </nav>

    <!-- Hero Section -->
    <header class="text-center py-32 px-4">
      <h1 class="text-4xl md:text-6xl font-bold mb-4">Selamat Datang di MAPELKA</h1>
      <p class="text-lg max-w-2xl mx-auto text-gray-200">Platform pelatihan karyawan berbasis digital untuk meningkatkan keterampilan dan performa tim Anda.</p>
      <a href="{{ route('login') }}" class="mt-8 inline-block px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Mulai Pelatihan</a>
    </header>

    <!-- Fitur Section -->
    <section class="max-w-6xl mx-auto px-4 py-20 grid md:grid-cols-3 gap-12 text-center text-white">
      <div>
        <div class="text-indigo-400 mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </div>
        <h3 class="text-xl font-semibold mb-2">Pelatihan Interaktif</h3>
        <p class="text-gray-300">Materi dan pelatihan interaktif yang dapat diakses kapan saja.</p>
      </div>
      <div>
        <div class="text-indigo-400 mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V3" />
          </svg>
        </div>
        <h3 class="text-xl font-semibold mb-2">Download Sertifikat</h3>
        <p class="text-gray-300">Setiap pelatihan berakhir dengan sertifikat digital.</p>
      </div>
      <div>
        <div class="text-indigo-400 mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a4 4 0 00-8 0v2M5 13h14v7H5v-7z" />
          </svg>
        </div>
        <h3 class="text-xl font-semibold mb-2">Akses Khusus Login</h3>
        <p class="text-gray-300">Hanya user terdaftar yang dapat mengakses materi dan sertifikat.</p>
      </div>
    </section>

    <!-- Footer -->
    <footer class="text-center text-sm text-gray-400 border-t border-gray-600 py-8 mt-20">
      © 2025 MAPELKA. All rights reserved.
    </footer>
  </div>

</body>
</html>
