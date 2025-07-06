<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/output.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
    <link rel="icon" href="{{ asset('assets/images/logos/mapelkalogo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,100..900&display=swap" />
    <title>Home | MAPELKA</title>
</head>

<style>
/* Styles yang Anda masukkan sebelumnya tetap digunakan di sini */

.wrapper {
  padding: 20px 10px;
  margin: 0 60px 35px;
  overflow: hidden;
}
.wrapper .card {
  background: #fff;
  display: flex;
  height: auto;
  flex-direction: column;
  border-radius: 20px;
  box-shadow: 0 10px 10px rgba(0, 0, 0, 0.05);
  transition: transform 0.3s ease;
}
.wrapper .card:hover {
  transform: translateY(-10px);
}
.card .card-image {
  position: relative;
}
.card .card-image img {
  width: 100%;
  padding: 10px;
  border-radius: 22px;
  object-fit: cover;
  aspect-ratio: 16 / 9;
}
.card .card-image .card-tag {
  position: absolute;
  top: 25px;
  left: 25px;
  font-size: 0.75rem;
  color: #6366f1;
  padding: 5px 15px;
  border-radius: 30px;
  font-weight: 600;
  letter-spacing: 0.5px;
  text-transform: uppercase;
  background: rgba(255, 255, 255, 0.9);
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}
.card .card-content {
  flex: 1;
  display: flex;
  flex-direction: column;
  padding: 10px 25px 25px;
}
.card .card-content .card-title {
  color: #111111;
  font-size: 1.25rem;
  font-weight: 700;
  line-height: 1.3;
  margin-bottom: 15px;
}
.card .card-content .card-text {
  color: #747474;
  font-size: 0.95rem;
  line-height: 1.6;
  margin-bottom: 20px;
}
.card .card-footer {
  display: flex;
  margin-top: auto;
  align-items: center;
  padding-top: 15px;
  justify-content: space-between;
  border-top: 1px solid rgba(0, 0, 0, 0.08);
}
.card .card-footer .card-profile {
  display: flex;
  align-items: center;
}
.card .card-profile .card-profile-info {
  display: flex;
  flex-direction: column;
}
.card .card-profile .card-profile-name {
  font-size: 0.875rem;
  font-weight: 600;
  color: #202020;
}
.card .card-profile .card-profile-role {
  font-size: 0.8rem;
  color: #7A7A7A;
}
.card .card-profile img {
  width: 35px;
  height: 35px;
  margin-right: 10px;
  object-fit: cover;
  border-radius: 50%;
  border: 2px solid #fff;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}
.card .card-button {
  color: #fff;
  padding: 10px 20px;
  border-radius: 30px;
  font-size: 0.81rem;
  font-weight: 600;
  text-decoration: none;
  background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
  box-shadow: 0 4px 10px rgba(99, 102, 241, 0.2);
  transition: all 0.3s ease;
}
.card .card-button:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 15px rgba(99, 102, 241, 0.3);
}
.wrapper .swiper-pagination-bullet {
  height: 15px;
  width: 15px;
  opacity: 1;
  overflow: hidden;
  position: relative;
  background: #B1B3F8;
}
.wrapper .swiper-pagination-bullet-active {
  background: #a4a7fd;
}
/* Auto-play loading indicator */
.wrapper .swiper-pagination-bullet-active::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  background: #6366f1;
  transform-origin: left center;
  transform: scaleX(0);
  animation: autoplay-loading 5s linear forwards;
}
.container:hover .wrapper .swiper-pagination-bullet-active::before {
  animation-play-state: paused;
}
@keyframes autoplay-loading {
  0% {
    transform: scaleX(0);
  }
  100% {
    transform: scaleX(1);
  }
}
.wrapper :where(.swiper-button-prev, .swiper-button-next) {
  color: #6366f1;
  margin-top: -35px;
  transition: all 0.3s ease;
}
.wrapper :where(.swiper-button-prev, .swiper-button-next):hover {
  color: #8b5cf6;
}
/* Responsive media query code for small screens */
@media (max-width: 768px) {
  .wrapper {
    margin: 0 10px 25px;
  }
  .wrapper :where(.swiper-button-prev, .swiper-button-next) {
    display: none;
  }
}
</style>

<body>
    <header>
       <nav class="flex items-center justify-between ps-[24px] md:px-[40px] lg:px-[120px] pt-10">
  <!-- Logo -->
  <div>
    <a href="">
      <div class="flex items-center space-x-[12px]">
        <img src="{{ asset('assets/images/logos/mapelkalogo.png') }}" alt="" class="lg:w-[48px] lg:h-[34px] shrink-0">
        <p class="text-[28px] font-semibold">MAPELKA</p>
      </div>
    </a>
  </div>

  <!-- Menu -->
  <div class="hidden lg:inline-block">
    <ul class="text-base flex items-center space-x-[60px]">
      <li class="font-semibold"><a href="">Home</a></li>
      <li><a href="#" onclick="openPopup()" class="hover:font-semibold duration-300 transition-all">Materi</a></li>
      <li><a href="#" onclick="openPopupSertifikat()" class="hover:font-semibold duration-300 transition-all">Sertifikat</a></li>
    </ul>
  </div>

<!-- User Avatar & Dropdown -->
<div class="relative inline-block text-left ml-4">
  <button onclick="toggleUserMenu()"
    class="flex items-center justify-center w-10 h-10 rounded-full bg-indigo-600 text-white text-lg font-semibold focus:outline-none">
    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
  </button>

  <div id="userMenu"
    class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg py-2 z-50">
    <div class="px-4 py-2 text-gray-700 font-semibold">
      {{ Auth::user()->name }}
    </div>
    <hr class="border-gray-200">
    <a href="#" onclick="openProfile()" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil Saya</a>

    <form method="POST" action="{{ route('logout') }}" class="block">
      @csrf
      <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-100">Logout</button>
    </form>
  </div>
</div>

<!-- Modal Profil -->
<div id="profileModal" class="hidden fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50">
  <div class="bg-white rounded-lg p-6 w-96">
    <h2 class="text-xl font-bold mb-4">Profil Saya</h2>

    <p class="mb-2"><strong>Nama:</strong> {{ Auth::user()->name }}</p>
    <p class="mb-2"><strong>Email:</strong> {{ Auth::user()->email }}</p>
    <p class="mb-2"><strong>Role:</strong> {{ Auth::user()->role }}</p>

    <button onclick="closeProfile()" class="mt-4 bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Tutup</button>
  </div>
</div>


</nav>



        <section class="w-full px-[24px] lg:ps-[160px] lg:pe-[122px] lg:flex lg:items-center lg:justify-between mt-[50px] md:mt-[100px] max-w-[1512px] lg:mx-auto">
            <div class="flex flex-col items-start md:items-center lg:items-start">
                <h1 class="text-[38px] md:text-[55px] font-bold  md:max-w-[443px] text-start md:text-center lg:text-start leading-[57px] md:leading-[83px]">Pelatihan Karyawan</h1>
                <p class="text-base leading-[32px] text-[#575455] w-full md:max-w-[423px] mt-[20px] text-start md:text-center lg:text-start">Pelatihan karyawan bertujuan meningkatkan keterampilan dan kinerja agar lebih efektif dalam tugas dan kontribusi tim.</p>
            </div>
            <div class="hidden lg:inline-block max-w-full flex-none">
                <img src="{{ asset('assets/images/photos/lab.jpeg') }}" alt="" class="w-full h-[400px] object-cover rounded-lg shadow-md">
            </div>

        </section>
    </header>

    <main class="">
        <section class="w-full px-[24px] lg:ps-[160px] lg:pe-[189px] flex flex-col lg:flex-row md:items-center lg:justify-between mt-[50px] md:mt-[70px] max-w-[1512px] mx-auto">
            <div>
                <h6 class="text-base font-semibold w-full lg:max-w-[152px]">dipercaya <br class="hidden lg:inline">Perusahaan Global</h6>
            </div>
            <div class="flex flex-wrap items-center gap-[24px] md:gap-[50px] mt-[30px] lg:mt-0">
                <img src="{{ asset('assets/images/logos/apple.svg') }}" alt="" class="w-[77.28px] md:w-[87.7px] h-[26.44px] md:h-[30px] shrink-0">
                <img src="{{ asset('assets/images/logos/adobe.svg') }}" alt="" class="w-[110.62px] md:w-[125.54px] h-[26.44px] md:h-[30px] shrink-0">
                <img src="{{ asset('assets/images/logos/slack.svg') }}" alt="" class="w-[104.47px] md:w-[118.56px] h-[26.44px] md:h-[30px] shrink-0">
                <img src="{{ asset('assets/images/logos/spotify.svg') }}" alt="" class="w-[88.14px] md:w-[100.02px] h-[26.44px] md:h-[30px] shrink-0">
                <img src="{{ asset('assets/images/logos/google.svg') }}" alt="" class="w-[80.99px] md:w-[91.91px] h-[26.44px] md:h-[30px] shrink-0">
            </div>
        </section>

                <section class="w-full px-[31px] md:px-[65px] lg:px-[204px] flex flex-col md:items-center lg:justify-center mt-[80px] md:mt-[130px] max-w-[1512px] lg:mx-auto">
            <div>
                <p class="text-base font-bold text-[#F75C4E] text-center">Bekerja Lebih Baik</p>
            </div>
            <div class="mt-[5px]">
                <h2 class="text-[28px] md:text-[36px] font-bold text-center">Untuk Bisnis Anda</h2>
            </div>
            <div class="mt-[20px]">
                <p class="text-base leading-[32px] md:px-0 w-full md:max-w-[386px] text-center text-[#575455]">Kami telah meneliti kebutuhan perusahaan Anda dan siap menyediakan solusi untuk kemajuan Anda</p>
            </div>
            <div class="mt-[50px] md:mt-[70px] grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 md:gap-x-[80px] gap-y-[60px]">
                <!-- Share Insight (Card 1) -->
                <div class="w-full order-1 md:order-1 lg:order-1">
                    <div class="flex items-start gap-x-[24px]">
                        <div class="bg-[#1F7CFF] w-[60px] h-[60px] flex items-center justify-center rounded-full flex-none">
                            <img src="{{ asset('assets/images/icons/bacg.svg') }}" alt="" class="w-[24px] h-[24px] shrink-0">
                        </div>
                        <div class="space-y-[12px]">
                            <h6 class="text-[20px] font-semibold">Bagikan Wawasan</h6>
                            <p class="text-base leading-[32px] text-[#575455]">Bekerja sama dengan tim Anda untuk membuat keputusan.</p>
                        </div>
                    </div>
                </div>

                <!-- Offline Mode (Card 2) -->
                <div class="w-full order-2 md:order-3 lg:order-3">
                    <div class="flex items-start gap-x-[24px]">
                        <div class="bg-[#191046] w-[60px] h-[60px] flex items-center justify-center rounded-full flex-none">
                            <img src="{{ asset('assets/images/icons/offline.svg') }}"" alt="" class="w-[24px] h-[24px] shrink-0">
                        </div>
                        <div class="space-y-[12px]">
                            <h6 class="text-[20px] font-semibold">Mode Offline</h6>
                            <p class="text-base leading-[32px] text-[#575455]">tetap produktif tanpa gangguan.</p>
                        </div>
                    </div>
                </div>

                <!-- Track Leads (Card 3) -->
                <div class="w-full order-4 md:order-2 lg:order-2">
                    <div class="flex items-start gap-x-[24px]">
                        <div class="bg-[#F75C4E] w-[60px] h-[60px] flex items-center justify-center rounded-full flex-none">
                            <img src="{{ asset('assets/images/icons/plane.svg') }}" alt="" class="w-[24px] h-[24px] shrink-0">
                        </div>
                        <div class="space-y-[12px]">
                            <h6 class="text-[20px] font-semibold">Lacak Kemajuan</h6>
                            <p class="text-base leading-[32px] text-[#575455]">Pantau kemana uang Anda pergi dan datang dalam bisnis.</p>
                        </div>
                    </div>
                </div>

                <!-- Kanban Mode (Card 4) -->
                <div class="w-full order-3 md:order-5 lg:order-4">
                    <div class="flex items-start gap-x-[24px]">
                        <div class="bg-[#FF1FB3] w-[60px] h-[60px] flex items-center justify-center rounded-full flex-none">
                            <img src="{{ asset('assets/images/icons/paper.svg') }}" alt="" class="w-[24px] h-[24px] shrink-0">
                        </div>
                        <div class="space-y-[12px]">
                            <h6 class="text-[20px] font-semibold">Mode Kanban</h6>
                            <p class="text-base leading-[32px] text-[#575455]">Atur laporan dengan cara yang mudah dipahami.</p>
                        </div>
                    </div>
                </div>

                <!-- Reward System (Card 5) -->
                <div class="w-full order-6 md:order-6 lg:order-5">
                    <div class="flex items-start gap-x-[24px]">
                        <div class="bg-[#5C4EF7] w-[60px] h-[60px] flex items-center justify-center rounded-full flex-none">
                            <img src="{{ asset('assets/images/icons/gift.svg') }}" alt="" class="w-[24px] h-[24px] shrink-0">
                        </div>
                        <div class="space-y-[12px]">
                            <h6 class="text-[20px] font-semibold">Sistem Penghargaan</h6>
                            <p class="text-base leading-[32px] text-[#575455]">Motivasi tim Anda untuk bekerja lebih keras dan menerima hadiah.</p>
                        </div>
                    </div>
                </div>

                <!-- 189 Country (Card 6) -->
                <div class="w-full order-5 md:order-4 lg:order-6">
                    <div class="flex items-start gap-x-[24px]">
                        <div class="bg-[#F7954E] w-[60px] h-[60px] flex items-center justify-center rounded-full flex-none">
                            <img src="{{ asset('assets/images/icons/globe.svg') }}" alt="" class="w-[24px] h-[24px] shrink-0">
                        </div>
                        <div class="space-y-[12px]">
                            <h6 class="text-[20px] font-semibold">Global</h6>
                            <p class="text-base leading-[32px] text-[#575455]">Bekerja sama dengan orang-orang di seluruh dunia dari mana saja.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Materi Cards -->
        <section>
            <div class="container swiper">
                <div class="wrapper">
                    <div class="card-list swiper-wrapper">
    @foreach ($materis->take(5) as $materi)
        <div class="card swiper-slide">
            <div class="card-image">
                <img src="{{ asset('storage/' . $materi->thumbnail) }}" alt="{{ $materi->title }}" />
                <div class="card-tag">{{ $materi->category }}</div>
            </div>
            <div class="card-content">
                <h3 class="card-title">{{ $materi->title }}</h3>
                <p class="card-text">{{ $materi->description }}</p>
                <div class="card-footer">
                    <div class="card-profile">
                        <div class="card-profile-info">
                            <span class="card-profile-name">{{ $materi->user->name }}</span>
                            <span class="card-profile-role">{{ $materi->user->role }}</span>
                        </div>
                    </div>
                    <a href="{{ url('/materi/' . $materi->id) }}" class="card-button">Read More</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </section>

<!-- Popup Semua Materi -->
<div id="allMateriPopup" class="hidden fixed z-50 inset-0 bg-black bg-opacity-80 overflow-y-auto p-6">
  <!-- Header -->
  <div class="flex items-center mb-6 text-white">
    <button class="border border-white px-4 py-2 rounded-full hover:bg-white hover:text-indigo-700 transition" onclick="closePopup()">&#8592; Kembali</button>
    <h2 class="text-2xl font-bold ml-5">Daftar Semua Materi</h2>
  </div>

  <!-- Search Bar Kecil & Transparan -->
  <div class="mb-4 flex justify-end">
    <input
      type="text"
      id="materiSearch"
      placeholder="🔍 Cari..."
      class="w-48 px-3 py-1.5 text-sm rounded-full bg-white bg-opacity-20 placeholder-white text-white focus:outline-none focus:ring-2 focus:ring-white focus:bg-opacity-30 transition"
      onkeyup="filterMateri()"
    >
  </div>

  <!-- Grid Materi -->
  <div id="materiGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    @foreach ($materis as $materi)
      <div data-title="{{ strtolower($materi->title) }}" onclick="location.href='{{ url('/materi/' . $materi->id) }}'" class="materi-card bg-white rounded-xl shadow-lg hover:shadow-xl overflow-hidden cursor-pointer flex flex-col transition-all duration-300 border border-gray-200">
        @if ($materi->thumbnail)
          <img src="{{ asset('storage/' . $materi->thumbnail) }}" alt="Thumbnail" class="w-full h-44 object-cover transition duration-300 ease-in-out hover:scale-105">
        @else
          <img src="{{ asset('images/default-thumbnail.jpg') }}" alt="Default Thumbnail" class="w-full h-44 object-cover transition duration-300 ease-in-out hover:scale-105">
        @endif
        <div class="p-4 flex flex-col flex-grow">
          <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $materi->title }}</h3>
          <p class="text-sm font-medium text-indigo-600 mt-auto">Pelatih: {{ $materi->user->name }}</p>
        </div>
      </div>
    @endforeach
  </div>
</div>


  <!-- Popup Sertifikat -->
<div id="sertifikatPopup" class="hidden fixed z-50 inset-0 bg-black bg-opacity-80 overflow-y-auto p-6">
    <div class="flex items-center mb-6 text-white">
        <button class="border border-white px-4 py-2 rounded-full hover:bg-white hover:text-indigo-700 transition" onclick="closePopupSertifikat()">&#8592; Kembali</button>
        <h2 class="text-2xl font-bold ml-5">Daftar Sertifikat</h2>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @foreach ($sertifikats as $sertifikat)
            <div class="bg-white rounded-xl shadow-lg hover:shadow-xl overflow-hidden cursor-pointer flex flex-col transition-all duration-300 border border-gray-200">
                <div class="p-4 flex flex-col flex-grow">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $sertifikat->materi->title }}</h3>
                    <p class="text-sm font-medium text-indigo-600 mt-auto">Diterbitkan: {{ $sertifikat->created_at->format('d M Y') }}</p>
                    <a href="{{ asset($sertifikat->file_path) }}" class="text-blue-500 hover:underline mt-2">Download Sertifikat</a>
                </div>
            </div>
        @endforeach
    </div>
</div>



            <section class="w-full lg:px-[192px] flex flex-col lg:flex-row items-center lg:justify-between mt-[80px] md:mt-[130px] mb-[44px] md:mb-[72px] lg:mb-[124px] max-w-[1512px] mx-auto">
            <div class="max-w-[321.61px] h-[227.9px] md:max-w-[522px] md:h-[369.9px] lg:max-w-[635.04px] lg:h-[450px] relative flex items-center justify-center">
            <div class="flex w-[321.61px] h-[227.9px] md:w-[522px] md:h-[369.9px] lg:w-[635.04px] lg:h-[450px] object-cover shrink-0 rounded-[20.26px] md:rounded-[32.88px] lg:rounded-[40px] overflow-hidden">
    <iframe src="https://www.youtube.com/embed/KttBV97iZXM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="w-full h-full"></iframe>
</div>

        </div>
            <div class="flex flex-col items-center lg:items-start mt-[40px] md:mt-[50px] lg:mt-0">
                <p class="text-base font-bold text-[#F75C4E]">HEMAT LEBIH BANYAK</p>
                <h2 class="text-[28px] md:text-[36px] font-bold mt-[6px]">Tingkatkan Produktivitas</h2>
                <p class="text-base leading-[32px] text-[#575455] w-full text-center lg:text-start lg:max-w-[388px] mt-[20px] px-[24px] md:px-[220px] lg:px-0">Karyawan Anda dapat membawa kesuksesan ke dalam bisnis Anda, jadi kita perlu merawat mereka.</p>
                <div class="mt-[40px] w-full">
                </div>
            </div>
        </section>
    </main>



<footer class="bg-white rounded-lg shadow-sm dark:bg-gray-900 m-4">
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            <a href="#" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('assets/images/logos/mapelkalogo.png') }}" class="h-8" alt="MAPELKA Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">MAPELKA</span>
            </a>
            <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">Home</a>
                </li>
                <li>
                    <a href="#" onclick="openPopup()" class="hover:underline me-4 md:me-6">Materi</a>
                </li>
                <li>
                    <a href="#" onclick="openPopupSertifikat()" class="hover:underline">Sertifikat</a>
                </li>
            </ul>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2025 MAPELKA™. All Rights Reserved.</span>
    </div>
</footer>


    <script src="{{ asset('assets/js/videoPlay.js') }}"></script>
    <script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        new Swiper(".wrapper", {
            loop: true,
            spaceBetween: 30,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
                dynamicBullets: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                0: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
        });

function toggleUserMenu() {
  const menu = document.getElementById('userMenu');
  menu.classList.toggle('hidden');
}

window.addEventListener('click', function(e) {
  const button = document.querySelector('[onclick="toggleUserMenu()"]');
  const menu = document.getElementById('userMenu');
  if (!menu.contains(e.target) && !button.contains(e.target)) {
    menu.classList.add('hidden');
  }
});

function openProfile() {
  document.getElementById('userMenu').classList.add('hidden');
  document.getElementById('profileModal').classList.remove('hidden');
}

function closeProfile() {
  document.getElementById('profileModal').classList.add('hidden');
}


    function openPopup() {
        document.getElementById('allMateriPopup').classList.remove('hidden');
    }

    function closePopup() {
        document.getElementById('allMateriPopup').classList.add('hidden');
    }

    function openPopupSertifikat() {
        document.getElementById('sertifikatPopup').classList.remove('hidden');
}

function closePopupSertifikat() {
    document.getElementById('sertifikatPopup').classList.add('hidden');
}

function filterMateri() {
    const input = document.getElementById('materiSearch').value.toLowerCase();
    const cards = document.querySelectorAll('#materiGrid .materi-card');

    cards.forEach(card => {
      const title = card.getAttribute('data-title');
      card.style.display = title.includes(input) ? 'block' : 'none';
    });
  }

    </script>

</body>
</html>
