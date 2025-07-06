<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Register - MAPELKA</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;700&display=swap" rel="stylesheet">
<style>
  /* Copas semua CSS dari halaman login tadi ke sini — sama persis */
  /* ... isi CSS login kamu di sini tanpa perubahan ... */
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@500;700&display=swap');

  :root {
    --background-color-light: #ffffff;
    --background-color-dark: #1f2937;
    --text-color-light: #374151;
    --text-color-dark: #ffffff;
    --text-muted: #6b7280;
    --input-bg-light: #f9fafb;
    --input-bg-dark: #374151;
    --input-border-light: #d1d5db;
    --input-border-dark: #4b5563;
    --input-border-focus: #2563eb;
    --btn-bg: #2563eb;
    --btn-bg-hover: #1d4ed8;
    --btn-text: #ffffff;
    --shadow-light: rgba(0, 0, 0, 0.1);
    --radius: 0.75rem;
  }
  * { box-sizing: border-box; }
  body {
    margin: 0;
    font-family: 'Inter', Arial, sans-serif;
    background-color: var(--background-color-light);
    color: var(--text-color-light);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 2rem;
    transition: background-color 0.3s, color 0.3s;
  }
  .container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    max-width: 1200px;
    width: 100%;
    border-radius: var(--radius);
    box-shadow: 0 8px 24px var(--shadow-light);
    background-color: var(--background-color-light);
    overflow: hidden;
    transition: transform 0.3s ease, background-color 0.3s;
  }
  .left-side {
    padding: 4rem 3rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }
  .right-side {
    background-image: url('assets/images/lab.jpeg');
    background-size: cover;
    background-position: center;
    min-height: 450px;
    transition: opacity 0.3s ease;
  }
  h1 { font-weight: 700; font-size: 2.5rem; margin-bottom: 1.25rem; color: var(--text-muted); }
  p.subtitle { color: var(--text-muted); font-size: 1.1rem; margin-bottom: 2.5rem; }
  form { display: flex; flex-direction: column; }
  label { font-weight: 600; margin-bottom: 0.5rem; font-size: 1rem; }
  input, select {
    background-color: var(--input-bg-light);
    border: 1.5px solid var(--input-border-light);
    border-radius: 0.5rem;
    padding: 0.75rem 1rem;
    font-size: 1rem;
    color: var(--text-color-light);
    margin-bottom: 1.5rem;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
  }
  input:focus, select:focus {
    outline: none;
    border-color: var(--input-border-focus);
    box-shadow: 0 0 5px var(--btn-bg);
  }
  button[type="submit"] {
    background-color: var(--btn-bg);
    color: var(--btn-text);
    font-weight: 700;
    font-size: 1.125rem;
    padding: 0.9rem 1.5rem;
    border: none;
    border-radius: 0.75rem;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.3s ease;
    align-self: flex-start;
  }
  button[type="submit"]:hover {
    background-color: var(--btn-bg-hover);
    transform: scale(1.05);
  }
  @media (max-width: 768px) {
    .container { grid-template-columns: 1fr; max-width: 450px; box-shadow: none; border-radius: 0; }
    .left-side { padding: 2.5rem 2rem; }
    .right-side { min-height: 200px; opacity: 0.8; }
  }
  .left-side:hover { transform: translateY(-5px); }
  body.dark-mode {
    background-color: var(--background-color-dark);
    color: var(--text-color-dark);
  }
  body.dark-mode .container { background-color: var(--background-color-dark); }
  body.dark-mode h1, body.dark-mode p, body.dark-mode label { color: var(--text-color-dark); }
  body.dark-mode input, body.dark-mode select {
    background-color: var(--input-bg-dark);
    border-color: var(--input-border-dark);
    color: var(--text-color-dark);
  }
  body.dark-mode button[type="submit"] { background-color: #1e40af; }
  .dark-mode-toggle {
    position: absolute;
    top: 20px;
    right: 20px;
    z-index: 999;
  }
  .dark-mode-toggle input { display: none; }
  .dark-mode-toggle label {
    display: flex;
    align-items: center;
    cursor: pointer;
    width: 60px;
    height: 30px;
    background-color: #d1d5db;
    border-radius: 999px;
    position: relative;
    transition: background-color 0.3s ease;
  }
  .dark-mode-toggle label .toggle-ball {
    content: "";
    position: absolute;
    top: 3px;
    left: 3px;
    width: 24px;
    height: 24px;
    background-color: #ffffff;
    border-radius: 50%;
    transition: transform 0.3s ease;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
  }
  .dark-mode-toggle input:checked + label { background-color: #2563eb; }
  .dark-mode-toggle input:checked + label .toggle-ball { transform: translateX(30px); }
</style>
</head>

<body>
  <main class="container">
    <section class="left-side">
      <h1>MAPELKA</h1>
      <p class="subtitle">Register</p>

      @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
          <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ url('/register') }}" method="POST">
        @csrf
        <label for="name">Nama</label>
        <input id="name" type="text" name="name" placeholder="Nama lengkap" required>

        <label for="email">Email</label>
        <input id="email" type="email" name="email" placeholder="email@gmail.com" required>

        <label for="password">Password</label>
        <input id="password" type="password" name="password" placeholder="********" required>

        <label for="password_confirmation">Konfirmasi Password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" placeholder="********" required>

        <label for="role">Role</label>
        <select id="role" name="role" required>
          <option value="karyawan">Karyawan</option>
          <option value="pelatih">Pelatih</option>
        </select>

        <button type="submit">Daftar</button>
      </form>

      <p class="mt-4 text-sm text-gray-600">
        Sudah punya akun? <a href="{{ url('/login') }}" class="text-blue-600 hover:underline">Login di sini</a>
      </p>
    </section>
    <section class="right-side"></section>
  </main>

  <div class="dark-mode-toggle">
    <input type="checkbox" id="toggleDark" onchange="toggleDarkMode()" />
    <label for="toggleDark">
      <span class="toggle-ball"></span>
    </label>
  </div>

  <script>
    function toggleDarkMode() {
      document.body.classList.toggle('dark-mode');
      if (document.body.classList.contains('dark-mode')) {
        localStorage.setItem('theme', 'dark');
      } else {
        localStorage.setItem('theme', 'light');
      }
    }
    window.onload = function() {
      if (localStorage.getItem('theme') === 'dark') {
        document.body.classList.add('dark-mode');
        document.getElementById('toggleDark').checked = true;
      }
    }
  </script>
</body>
</html>
