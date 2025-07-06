<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard Pelatih</title>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="font-['Roboto'] bg-gray-100">

  <div class="flex h-screen">
    <!-- Sidebar -->
    <div class="w-64 bg-white shadow-lg flex flex-col">
      <div class="text-center py-6 border-b">
        <h1 class="text-2xl font-bold text-gray-800">Pelatih</h1>
      </div>
      <nav class="flex-1 p-4 space-y-2">
        <button onclick="showSection('materi')" class="w-full text-left px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-100 hover:text-blue-600 font-medium transition">Materi</button>
        <button onclick="showSection('feedback')" class="w-full text-left px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-100 hover:text-blue-600 font-medium transition">Feedback</button>
        <button onclick="logout()" class="w-full text-left px-4 py-3 rounded-lg text-red-600 hover:bg-red-100 font-medium transition">Logout</button>
      </nav>
      <div class="text-center text-sm text-gray-500 p-4 border-t">
        &copy; 2025 Dashboard Pelatih
      </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 overflow-y-auto p-8">
      <h2 id="pageTitle" class="text-3xl font-bold text-gray-800 mb-6">Materi Saya</h2>

<!-- Materi Management -->
<div id="materiManagement">
  <div class="flex justify-end mb-4">
    <button onclick="openCreateMateriModal()" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">Tambah Materi</button>
  </div>
  <div class="overflow-x-auto bg-white rounded-lg shadow p-4">
    <table class="w-full table-auto text-left text-gray-700">
      <thead>
        <tr class="border-b">
          <th class="py-3">Thumbnail</th>
          <th class="py-3">Title</th>
          <th class="py-3">Description</th>
          <th class="py-3">Video</th>
          <th class="py-3">File Materi</th>
          <th class="py-3">Actions</th>
        </tr>
      </thead>
      <tbody id="materiTableBody"></tbody>
    </table>
  </div>
</div>

<!-- Feedback Management -->
<div id="feedbackManagement" class="hidden">
  <div class="overflow-x-auto bg-white rounded-lg shadow p-4">
    <table class="w-full table-auto text-left text-gray-700">
      <thead>
        <tr class="border-b">
          <th class="py-3">Tanggal</th>
          <th class="py-3">Karyawan</th>
          <th class="py-3">Materi</th>
          <th class="py-3">Feedback</th>
          <th class="py-3">Actions</th>

        </tr>
      </thead>
      <tbody id="feedbackTableBody"></tbody>
    </table>
  </div>
</div>


  <!-- Modals -->
<div id="createMateriModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
  <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg space-y-4">
    <h2 class="text-xl font-bold">Tambah Materi</h2>
    <form id="createMateriForm" enctype="multipart/form-data" class="space-y-3">
      <div>
        <label for="materiTitle" class="font-medium">Judul Materi</label>
        <input type="text" id="materiTitle" required class="w-full border p-2 rounded">
      </div>
      <div>
        <label for="materiDescription" class="font-medium">Deskripsi Materi</label>
        <textarea id="materiDescription" required class="w-full border p-2 rounded"></textarea>
      </div>
      <div>
        <label for="materiThumbnail" class="font-medium">Thumbnail</label>
        <input type="file" id="materiThumbnail" accept="image/*" class="w-full">
      </div>
      <div>
        <label for="materiVideoFile" class="font-medium">Upload Video Materi (MP4/MOV/AVI)</label>
        <input type="file" id="materiVideoFile" accept="video/*" class="w-full">
      </div>
      <div>
        <label for="materiFile" class="font-medium">File Materi (PDF/DOCX/PPT)</label>
        <input type="file" id="materiFile" accept=".pdf,.docx,.ppt,.pptx" class="w-full">
      </div>
      <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Tambah</button>
      <button type="button" onclick="closeCreateMateriModal()" class="w-full bg-red-500 text-white py-2 rounded hover:bg-red-600">Tutup</button>
    </form>
  </div>
</div>


<div id="editMateriModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
  <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg space-y-4">
    <h2 class="text-xl font-bold">Edit Materi</h2>
    <form id="editMateriForm" enctype="multipart/form-data" class="space-y-4">
      <div>
        <label for="editMateriTitle" class="block font-medium mb-1">Judul Materi</label>
        <input type="text" id="editMateriTitle" placeholder="Judul Materi" required class="w-full border p-2 rounded">
      </div>
      <div>
        <label for="editMateriDescription" class="block font-medium mb-1">Deskripsi Materi</label>
        <textarea id="editMateriDescription" placeholder="Deskripsi Materi" required class="w-full border p-2 rounded"></textarea>
      </div>
      <div>
        <label for="editMateriThumbnail" class="block font-medium mb-1">Thumbnail</label>
        <input type="file" id="editMateriThumbnail" accept="image/*" class="w-full">
      </div>
        <div>
            <label for="editMateriVideoFile" class="block font-medium mb-1">Upload Video Materi</label>
            <input type="file" id="editMateriVideoFile" accept="video/*" class="w-full">
        </div>
      <div>
        <label for="editMateriFile" class="block font-medium mb-1">File Materi</label>
        <input type="file" id="editMateriFile" accept=".pdf,.docx,.ppt,.pptx" class="w-full">
      </div>
      <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Simpan</button>
      <button type="button" onclick="closeEditMateriModal()" class="w-full bg-red-500 text-white py-2 rounded hover:bg-red-600">Tutup</button>
    </form>
  </div>
</div>


  <div id="editFeedbackModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
  <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg space-y-4">
    <h2 class="text-xl font-bold">Edit Feedback</h2>
    <form id="editFeedbackForm" class="space-y-3">
      <textarea id="editFeedbackContent" required class="w-full border p-2 rounded"></textarea>
      <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Simpan</button>
      <button type="button" onclick="closeEditFeedbackModal()" class="w-full bg-red-500 text-white py-2 rounded hover:bg-red-600">Tutup</button>
    </form>
  </div>
</div>


<script>
function fetchMateris() {
  axios.get('/pelatih/materis')
    .then(response => {
      let materis = response.data;
      let tbody = document.getElementById("materiTableBody");
      tbody.innerHTML = '';
      materis.forEach(materi => {
        tbody.innerHTML += `
          <tr class="border-b">
            <td class="py-2"><img src="/storage/${materi.thumbnail}" alt="Thumbnail" class="w-12 h-12 object-cover rounded"></td>
            <td class="py-2">${materi.title}</td>
            <td class="py-2">${materi.description}</td>
            <td class="py-2">${materi.video_file ? `<video src="/storage/${materi.video_file}" controls class="w-32 rounded"></video>` : '-'}</td>
            <td class="py-2">${materi.file ? `<a href="/storage/${materi.file}" target="_blank" class="text-blue-500 hover:underline">Download</a>` : '-'}</td>
            <td class="py-2 flex gap-2">
              <button onclick="editMateri(${materi.id})" class="p-2 bg-yellow-400 hover:bg-yellow-500 text-white rounded-full transition" title="Edit">
                <i data-lucide="edit" class="w-4 h-4"></i>
              </button>
              <button onclick="deleteMateri(${materi.id})" class="p-2 bg-red-500 hover:bg-red-600 text-white rounded-full transition" title="Hapus">
                <i data-lucide="trash-2" class="w-4 h-4"></i>
              </button>
            </td>
          </tr>`;
      });
      lucide.createIcons();
    })
    .catch(console.log);
}



document.getElementById("createMateriForm").addEventListener("submit", function(e) {
  e.preventDefault();
  const tambahButton = this.querySelector("button[type=submit]");
  tambahButton.disabled = true;
  tambahButton.innerText = "Mengunggah...";

  const data = new FormData();
  data.append("title", document.getElementById("materiTitle").value);
  data.append("description", document.getElementById("materiDescription").value);
  const thumb = document.getElementById("materiThumbnail").files[0];
  if (thumb) data.append("thumbnail", thumb);
  const videoFile = document.getElementById("materiVideoFile").files[0];
  if (videoFile) data.append("video_file", videoFile);
  const file = document.getElementById("materiFile").files[0];
  if (file) data.append("file", file);

  axios.post('/pelatih/materis', data)
    .then(() => {
      alert("Materi berhasil ditambahkan!");
      fetchMateris();
      closeCreateMateriModal();
      this.reset();
    })
    .catch(err => {
      alert("Gagal upload. Cek server limit upload size di phpinfo()!");
      console.error(err);
    })
    .finally(() => {
      tambahButton.disabled = false;
      tambahButton.innerText = "Tambah";
    });
});

function editMateri(id) {
  axios.get(`/pelatih/materis/${id}`)
    .then(res => {
      const m = res.data;
      document.getElementById("editMateriTitle").value = m.title;
      document.getElementById("editMateriDescription").value = m.description;

      const existingPreview = document.querySelector("#editMateriVideoFilePreview");
      if (existingPreview) existingPreview.remove();

      if (m.video_file) {
        const videoPreview = document.createElement('video');
        videoPreview.src = "/storage/" + m.video_file;
        videoPreview.id = "editMateriVideoFilePreview";
        videoPreview.controls = true;
        videoPreview.className = "w-full mt-2 rounded";
        document.getElementById("editMateriVideoFile").parentElement.appendChild(videoPreview);
      }

      // Remove old listener
      const form = document.getElementById("editMateriForm");
      const newForm = form.cloneNode(true);
      form.parentNode.replaceChild(newForm, form);

      newForm.addEventListener("submit", function(e) {
        e.preventDefault();
        const data = new FormData();
        data.append("title", document.getElementById("editMateriTitle").value);
        data.append("description", document.getElementById("editMateriDescription").value);
        const videoFile = document.getElementById("editMateriVideoFile").files[0];
        if (videoFile) data.append("video_file", videoFile);
        const thumb = document.getElementById("editMateriThumbnail").files[0];
        if (thumb) data.append("thumbnail", thumb);
        const file = document.getElementById("editMateriFile").files[0];
        if (file) data.append("file", file);

        axios.post(`/pelatih/materis/${id}?_method=PUT`, data)
          .then(() => {
            alert("Materi diupdate!");
            fetchMateris();
            closeEditMateriModal();
          }).catch(console.log);
      });

      openEditMateriModal();
    }).catch(console.log);
}



function deleteMateri(id) {
  if (confirm("Yakin ingin hapus materi ini?")) {
    axios.delete(`/pelatih/materis/${id}`)
      .then(() => {
        alert("Materi dihapus.");
        fetchMateris();
      }).catch(console.log);
  }
}

function fetchFeedbacks() {
  axios.get('/pelatih/feedbacks')
    .then(response => {
      let feedbacks = response.data;
      let tbody = document.getElementById("feedbackTableBody");
      tbody.innerHTML = '';
      feedbacks.forEach(feedback => {
        tbody.innerHTML += `
          <tr class="border-b">
            <td class="py-2">${new Date(feedback.created_at).toLocaleDateString()}</td>
            <td class="py-2">${feedback.user.name}</td>
            <td class="py-2">${feedback.materi.title}</td>
            <td class="py-2">${feedback.content}</td>
            <td class="py-2 flex gap-2">
              <button onclick="editFeedback(${feedback.id}, \`${feedback.content.replace(/`/g, "\\`")}\`)" class="p-2 bg-yellow-400 hover:bg-yellow-500 text-white rounded-full transition" title="Edit">
                <i data-lucide="edit" class="w-4 h-4"></i>
              </button>
              <button onclick="deleteFeedback(${feedback.id})" class="p-2 bg-red-500 hover:bg-red-600 text-white rounded-full transition" title="Hapus">
                <i data-lucide="trash-2" class="w-4 h-4"></i>
              </button>
            </td>
          </tr>`;
      });
      lucide.createIcons();
    })
    .catch(console.log);
}


let currentEditFeedbackId = null;

function editFeedback(id, content) {
  currentEditFeedbackId = id;
  document.getElementById("editFeedbackContent").value = content;
  openEditFeedbackModal();
}

document.getElementById("editFeedbackForm").addEventListener("submit", function(e) {
  e.preventDefault();
  const content = document.getElementById("editFeedbackContent").value;
  axios.put(`/pelatih/feedbacks/${currentEditFeedbackId}`, { content })
    .then(() => {
      alert("Feedback berhasil diupdate!");
      fetchFeedbacks();
      closeEditFeedbackModal();
    })
    .catch(console.log);
});

function deleteFeedback(id) {
  if (confirm("Yakin ingin menghapus feedback ini?")) {
    axios.delete(`/pelatih/feedbacks/${id}`)
      .then(() => {
        alert("Feedback dihapus!");
        fetchFeedbacks();
      })
      .catch(console.log);
  }
}

function openEditFeedbackModal() {
  document.getElementById("editFeedbackModal").classList.remove("hidden");
}
function closeEditFeedbackModal() {
  document.getElementById("editFeedbackModal").classList.add("hidden");
}
function openCreateMateriModal() {
  document.getElementById("createMateriModal").classList.remove("hidden");
}
function closeCreateMateriModal() {
  document.getElementById("createMateriModal").classList.add("hidden");
}
function openEditMateriModal() {
  document.getElementById("editMateriModal").classList.remove("hidden");
}
function closeEditMateriModal() {
  document.getElementById("editMateriModal").classList.add("hidden");
}
function showSection(section) {
  document.getElementById("materiManagement").classList.toggle("hidden", section !== 'materi');
  document.getElementById("feedbackManagement").classList.toggle("hidden", section !== 'feedback');
  document.getElementById("pageTitle").textContent = section === 'materi' ? 'Materi Saya' : 'Feedback dari Peserta';

  if (section === 'materi') fetchMateris();
  if (section === 'feedback') fetchFeedbacks();
}

function logout() {
  alert("Logout berhasil!");
  window.location.href = "/login";
}

showSection('materi');
</script>

</body>
</html>
