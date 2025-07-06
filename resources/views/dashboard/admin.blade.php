<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-100 font-sans">

<div class="flex h-screen">

  <!-- Sidebar -->
  <div class="w-64 bg-white border-r flex flex-col">
    <div class="p-6 border-b">
      <h1 class="text-2xl font-bold text-gray-800">Admin Panel</h1>
    </div>
    <nav class="flex-1 p-4 space-y-2">
      <button onclick="showSection('user')" class="w-full text-left px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-700">Akun</button>
      <button onclick="showSection('materi')" class="w-full text-left px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-700">Materi</button>
      <button onclick="showSection('feedback')" class="w-full text-left px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-700">Feedback</button>
    </nav>
    <div class="p-4 border-t">
      <button onclick="logout()" class="w-full bg-red-500 text-white py-2 rounded-lg hover:bg-red-600">Logout</button>
    </div>
  </div>

  <!-- Main Content -->
  <div class="flex-1 overflow-y-auto p-8 space-y-8">

    <h2 id="pageTitle" class="text-3xl font-bold text-gray-800">Manage Users</h2>

    <!-- User Management -->
    <div id="userManagement" class="space-y-4">
      <div class="text-right">
        <button onclick="openCreateModal()" class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Tambah User</button>
      </div>
      <div class="overflow-x-auto bg-white p-4 rounded-lg shadow">
        <table id="userTable" class="min-w-full table-auto">
          <thead class="bg-gray-100">
            <tr>
              <th class="px-4 py-2 text-left">Name</th>
              <th class="px-4 py-2 text-left">Email</th>
              <th class="px-4 py-2 text-left">Role</th>
              <th class="px-4 py-2 text-left">Actions</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>

    <!-- Materi Management -->
    <div id="materiManagement" class="space-y-4 hidden">
      <div class="text-right">
        <button onclick="openCreateMateriModal()" class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Tambah Materi</button>
      </div>
      <div class="overflow-x-auto bg-white p-4 rounded-lg shadow">
        <table id="materiTable" class="min-w-full table-auto">
          <thead class="bg-gray-100">
            <tr>
              <th class="px-4 py-2">Thumbnail</th>
              <th class="px-4 py-2">Title</th>
              <th class="px-4 py-2">Description</th>
              <th class="px-4 py-2">Video Materi</th>
              <th class="px-4 py-2">File Materi</th>
              <th class="px-4 py-2">Pelatih</th>
              <th class="px-4 py-2">Actions</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>

<!-- Feedback Management Section -->
<div id="feedbackManagement" class="space-y-4 hidden">
  <div class="text-right">
    <button onclick="fetchFeedbacks()" class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Refresh Feedback</button>
  </div>
  <div class="overflow-x-auto bg-white p-4 rounded-lg shadow">
    <table id="feedbackTable" class="min-w-full table-auto">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-4 py-2">Materi</th>
          <th class="px-4 py-2">User</th>
          <th class="px-4 py-2">Content</th>
          <th class="px-4 py-2">Tanggal</th>
          <th class="px-4 py-2">Actions</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>
</div>

<!-- Modal Edit Feedback -->
<div id="editFeedbackModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
  <div class="bg-white p-6 rounded-lg w-96">
    <h3 class="text-xl font-bold mb-4">Edit Feedback</h3>
    <form id="editFeedbackForm">
      <textarea id="editFeedbackContent" class="border w-full mb-4 p-2 rounded" required></textarea>
      <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">Update</button>
    </form>
    <button onclick="closeEditFeedbackModal()" class="mt-2 text-gray-500">Tutup</button>
  </div>
</div>

<!-- Modal Create User -->
<div id="createModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
  <div class="bg-white p-6 rounded-lg w-96">
    <h3 class="text-xl font-bold mb-4">Tambah User</h3>
    <form id="createUserForm" class="space-y-3">
      <div>
        <label for="name" class="block mb-1 font-medium">Nama</label>
        <input id="name" class="border w-full p-2 rounded" placeholder="Masukkan nama" required />
      </div>
      <div>
        <label for="email" class="block mb-1 font-medium">Email</label>
        <input id="email" class="border w-full p-2 rounded" placeholder="Masukkan email" required />
      </div>
      <div>
        <label for="password" class="block mb-1 font-medium">Password</label>
        <input id="password" type="password" class="border w-full p-2 rounded" placeholder="Password" required />
      </div>
      <div>
        <label for="password_confirmation" class="block mb-1 font-medium">Konfirmasi Password</label>
        <input id="password_confirmation" type="password" class="border w-full p-2 rounded" placeholder="Konfirmasi password" required />
      </div>
      <div>
        <label for="role" class="block mb-1 font-medium">Role</label>
        <select id="role" class="border w-full p-2 rounded">
          <option value="admin">Admin</option>
          <option value="pelatih">Pelatih</option>
          <option value="karyawan">Karyawan</option>
        </select>
      </div>
      <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">Simpan</button>
    </form>
    <button onclick="closeCreateModal()" class="mt-2 text-gray-500">Tutup</button>
  </div>
</div>


<!-- Modal Edit User -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
  <div class="bg-white p-6 rounded-lg w-96">
    <h3 class="text-xl font-bold mb-4">Edit User</h3>
    <form id="editUserForm" class="space-y-3">
      <div>
        <label for="editName" class="block mb-1 font-medium">Nama</label>
        <input id="editName" class="border w-full p-2 rounded" placeholder="Masukkan nama" required />
      </div>
      <div>
        <label for="editEmail" class="block mb-1 font-medium">Email</label>
        <input id="editEmail" class="border w-full p-2 rounded" placeholder="Masukkan email" required />
      </div>
      <div>
        <label for="editPassword" class="block mb-1 font-medium">Password Baru</label>
        <input id="editPassword" type="password" class="border w-full p-2 rounded" placeholder="Kosongkan jika tidak diubah" />
      </div>
      <div>
        <label for="editPassword_confirmation" class="block mb-1 font-medium">Konfirmasi Password Baru</label>
        <input id="editPassword_confirmation" type="password" class="border w-full p-2 rounded" placeholder="Kosongkan jika tidak diubah" />
      </div>
      <div>
        <label for="editRole" class="block mb-1 font-medium">Role</label>
        <select id="editRole" class="border w-full p-2 rounded">
          <option value="admin">Admin</option>
          <option value="pelatih">Pelatih</option>
          <option value="karyawan">Karyawan</option>
        </select>
      </div>
      <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">Update</button>
    </form>
    <button onclick="closeEditModal()" class="mt-2 text-gray-500">Tutup</button>
  </div>
</div>


<!-- Modal Create Materi -->
<div id="createMateriModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
  <div class="bg-white p-6 rounded-lg w-96 overflow-y-auto max-h-screen">
    <h3 class="text-xl font-bold mb-4">Tambah Materi</h3>
    <form id="createMateriForm" class="space-y-3">
      <div>
        <label for="materiTitle" class="block mb-1 font-medium">Judul Materi</label>
        <input id="materiTitle" class="border w-full p-2 rounded" placeholder="Masukkan judul" required />
      </div>
      <div>
        <label for="materiDescription" class="block mb-1 font-medium">Deskripsi</label>
        <textarea id="materiDescription" class="border w-full p-2 rounded" placeholder="Deskripsi materi" required></textarea>
      </div>
      <div>
        <label for="materiThumbnail" class="block mb-1 font-medium">Thumbnail</label>
        <input type="file" id="materiThumbnail" class="border w-full p-2 rounded" required />
      </div>
<div>
  <label for="materiVideoFile" class="block mb-1 font-medium">Upload Video Materi</label>
  <input type="file" id="materiVideoFile" accept="video/*" class="border w-full p-2 rounded" />
</div>

      <div>
        <label for="materiFile" class="block mb-1 font-medium">File Materi</label>
        <input type="file" id="materiFile" class="border w-full p-2 rounded" required />
      </div>
      <div>
        <label for="materiPelatih" class="block mb-1 font-medium">Pelatih</label>
        <select id="materiPelatih" class="border w-full p-2 rounded"></select>
      </div>
      <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">Simpan</button>
    </form>
    <button onclick="closeCreateMateriModal()" class="mt-2 text-gray-500">Tutup</button>
  </div>
</div>

<!-- Modal Edit Materi -->
<div id="editMateriModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
  <div class="bg-white p-6 rounded-lg w-96 overflow-y-auto max-h-screen">
    <h3 class="text-xl font-bold mb-4">Edit Materi</h3>
    <form id="editMateriForm" class="space-y-3">
      <div>
        <label for="editMateriTitle" class="block mb-1 font-medium">Judul Materi</label>
        <input id="editMateriTitle" class="border w-full p-2 rounded" placeholder="Masukkan judul" required />
      </div>
      <div>
        <label for="editMateriDescription" class="block mb-1 font-medium">Deskripsi</label>
        <textarea id="editMateriDescription" class="border w-full p-2 rounded" placeholder="Deskripsi materi" required></textarea>
      </div>
      <div>
        <label for="editMateriThumbnail" class="block mb-1 font-medium">Thumbnail (Opsional)</label>
        <input type="file" id="editMateriThumbnail" class="border w-full p-2 rounded" />
      </div>
<div>
  <label for="editMateriVideoFile" class="block mb-1 font-medium">Upload Video Materi</label>
  <input type="file" id="editMateriVideoFile" accept="video/*" class="border w-full p-2 rounded" />
</div>

      <div>
        <label for="editMateriFile" class="block mb-1 font-medium">File Materi (Opsional)</label>
        <input type="file" id="editMateriFile" class="border w-full p-2 rounded" />
      </div>
      <div>
        <label for="editMateriPelatih" class="block mb-1 font-medium">Pelatih</label>
        <select id="editMateriPelatih" class="border w-full p-2 rounded"></select>
      </div>
      <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">Update</button>
    </form>
    <button onclick="closeEditMateriModal()" class="mt-2 text-gray-500">Tutup</button>
  </div>
</div>


<script>
// Fetch users data from the API
function fetchUsers() {
    axios.get('/admin/users')
        .then(response => {
            let users = response.data;
            let tbody = document.querySelector("#userTable tbody");
            tbody.innerHTML = '';
            users.forEach(user => {
                tbody.innerHTML += `
                    <tr>
                        <td class="py-2">${user.name}</td>
                        <td class="py-2">${user.email}</td>
                        <td class="py-2">${user.role}</td>
                        <td class="py-2 flex gap-2">
                            <button onclick="editUser(${user.id})" class="p-2 bg-yellow-400 hover:bg-yellow-500 text-white rounded-full transition" title="Edit">
                                <i data-lucide="edit" class="w-4 h-4"></i>
                            </button>
                            <button onclick="deleteUser(${user.id})" class="p-2 bg-red-500 hover:bg-red-600 text-white rounded-full transition" title="Hapus">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </td>
                    </tr>
                `;
            });
            lucide.createIcons();  // aktifkan ikon setelah DOM update
        })
        .catch(error => console.log('Error fetching users:', error));
}


function fetchMateris() {
  axios.get('/admin/materis')
    .then(response => {
      let materis = response.data;
      let tbody = document.querySelector("#materiTable tbody");
      tbody.innerHTML = '';
      materis.forEach(materi => {
        tbody.innerHTML += `
          <tr class="border-b">
            <td class="px-4 py-2"><img src="/storage/${materi.thumbnail}" alt="Thumbnail" class="w-14 h-14 object-cover rounded"></td>
            <td class="px-4 py-2">${materi.title}</td>
            <td class="px-4 py-2">${materi.description}</td>
            <td class="px-4 py-2">
  ${materi.video_file
    ? `<video src="/storage/${materi.video_file}" controls class="w-32 rounded"></video>`
    : '-'}
</td>
            <td class="px-4 py-2">${materi.file ? `<a href="/storage/${materi.file}" target="_blank" class="text-blue-500 hover:underline">Download</a>` : '-'}</td>
<td class="px-4 py-2">${materi.user ? materi.user.name : '-'}</td>

            <td class="px-4 py-2 flex gap-2">
              <button onclick="editMateri(${materi.id})" class="p-2 bg-yellow-400 hover:bg-yellow-500 text-white rounded-full" title="Edit">
                <i data-lucide="edit" class="w-4 h-4"></i>
              </button>
              <button onclick="deleteMateri(${materi.id})" class="p-2 bg-red-500 hover:bg-red-600 text-white rounded-full" title="Hapus">
                <i data-lucide="trash-2" class="w-4 h-4"></i>
              </button>
            </td>
          </tr>
        `;
      });
      lucide.createIcons();
    })
    .catch(console.log);
}



// Fetch Pelatih untuk dropdown
function fetchPelatih() {
    axios.get('/admin/pelatih')
        .then(response => {
            const pelatihSelect = document.getElementById("materiPelatih");
            pelatihSelect.innerHTML = '';
            response.data.forEach(pelatih => {
                const option = document.createElement("option");
                option.value = pelatih.id;
                option.textContent = pelatih.name;
                pelatihSelect.appendChild(option);
            });

            const editPelatihSelect = document.getElementById("editMateriPelatih");
            if (editPelatihSelect) {
                editPelatihSelect.innerHTML = '';
                response.data.forEach(pelatih => {
                    const option = document.createElement("option");
                    option.value = pelatih.id;
                    option.textContent = pelatih.name;
                    editPelatihSelect.appendChild(option);
                });
            }
        })
        .catch(error => console.log('Error fetching pelatih:', error));
}

// Handle create user
document.getElementById("createUserForm").addEventListener("submit", function(e) {
    e.preventDefault();
    const data = {
        name: document.getElementById("name").value,
        email: document.getElementById("email").value,
        password: document.getElementById("password").value,
        password_confirmation: document.getElementById("password_confirmation").value,
        role: document.getElementById("role").value
    };
    axios.post('/admin/users', data)
        .then(() => {
            alert("User added!");
            fetchUsers();
            closeCreateModal();
            this.reset();
        })
        .catch(err => console.log('Error creating user:', err));
});

// Handle create materi
document.getElementById("createMateriForm").addEventListener("submit", function(e) {
    e.preventDefault();
    const data = new FormData();
    data.append("title", document.getElementById("materiTitle").value);
    data.append("description", document.getElementById("materiDescription").value);
    data.append("thumbnail", document.getElementById("materiThumbnail").files[0]);
const videoFile = document.getElementById("materiVideoFile").files[0];
if (videoFile) data.append("video_file", videoFile);

    data.append("file", document.getElementById("materiFile").files[0]);
    data.append("user_id", document.getElementById("materiPelatih").value);

    axios.post('/admin/materis', data)
        .then(() => {
            alert("Materi added!");
            fetchMateris();
            closeCreateMateriModal();
            this.reset();
        })
        .catch(err => console.log('Error creating materi:', err));
});

// Edit user
function editUser(id) {
    axios.get(`/admin/users/${id}`)
        .then(res => {
            const user = res.data;
            document.getElementById("editName").value = user.name;
            document.getElementById("editEmail").value = user.email;
            document.getElementById("editRole").value = user.role;
            document.getElementById("editUserForm").onsubmit = function(e) {
                e.preventDefault();
                const data = {
                    name: document.getElementById("editName").value,
                    email: document.getElementById("editEmail").value,
                    role: document.getElementById("editRole").value
                };
                const pass = document.getElementById("editPassword").value;
                if (pass) {
                    data.password = pass;
                    data.password_confirmation = document.getElementById("editPassword_confirmation").value;
                }
                axios.put(`/admin/users/${id}`, data)
                    .then(() => {
                        alert("User updated!");
                        fetchUsers();
                        closeEditModal();
                    })
                    .catch(err => console.log('Error updating user:', err));
            };
            openEditModal();
        })
        .catch(err => console.log('Error fetching user:', err));
}

// Edit materi
function editMateri(id) {
    axios.get(`/admin/materis/${id}`)
        .then(res => {
            const materi = res.data;
            document.getElementById("editMateriTitle").value = materi.title;
            document.getElementById("editMateriDescription").value = materi.description;
            document.getElementById("editMateriYoutubeLink").value = materi.youtube_link;
            document.getElementById("editMateriPelatih").value = materi.user_id;

            document.getElementById("editMateriForm").onsubmit = function(e) {
                e.preventDefault();
                const data = new FormData();
                data.append("title", document.getElementById("editMateriTitle").value);
                data.append("description", document.getElementById("editMateriDescription").value);
                const videoFile = document.getElementById("editMateriVideoFile").files[0];
if (videoFile) data.append("video_file", videoFile);
                data.append("user_id", document.getElementById("editMateriPelatih").value);

                const thumbnail = document.getElementById("editMateriThumbnail").files[0];
                if (thumbnail) data.append("thumbnail", thumbnail);

                const file = document.getElementById("editMateriFile").files[0];
                if (file) data.append("file", file);

                axios.post(`/admin/materis/${id}?_method=PUT`, data)
                    .then(() => {
                        alert("Materi updated!");
                        fetchMateris();
                        closeEditMateriModal();
                    })
                    .catch(err => console.log('Error updating materi:', err));
            };
            fetchPelatih();
            openEditMateriModal();
        })
        .catch(err => console.log('Error fetching materi:', err));
}

// Delete user
function deleteUser(id) {
    if (confirm("Yakin mau hapus user ini?")) {
        axios.delete(`/admin/users/${id}`)
            .then(() => {
                alert("User dihapus!");
                fetchUsers();
            })
            .catch(err => console.log('Error deleting user:', err));
    }
}

// Delete materi
function deleteMateri(id) {
    if (confirm("Yakin mau hapus materi ini?")) {
        axios.delete(`/admin/materis/${id}`)
            .then(() => {
                alert("Materi dihapus!");
                fetchMateris();
            })
            .catch(err => console.log('Error deleting materi:', err));
    }
}

function fetchFeedbacks() {
  axios.get('/admin/feedbacks')
    .then(res => {
      let tbody = document.querySelector('#feedbackTable tbody');
      tbody.innerHTML = '';
      res.data.forEach(item => {
        tbody.innerHTML += `
          <tr>
            <td class="px-4 py-2">${item.materi.title}</td>
            <td class="px-4 py-2">${item.user.name}</td>
            <td class="px-4 py-2">${item.content}</td>
            <td class="px-4 py-2">${new Date(item.created_at).toLocaleString()}</td>
            <td class="px-4 py-2 space-x-2">
              <button onclick="openEditFeedbackModal(${item.id}, '${item.content.replace(/'/g, "\'")}')" class="px-2 py-1 bg-yellow-400 text-white rounded">Edit</button>
              <button onclick="deleteFeedback(${item.id})" class="px-2 py-1 bg-red-500 text-white rounded">Hapus</button>
            </td>
          </tr>`;
      });
    });
}

let currentFeedbackId = null;
function openEditFeedbackModal(id, content) {
  currentFeedbackId = id;
  document.getElementById('editFeedbackContent').value = content;
  document.getElementById('editFeedbackModal').classList.remove('hidden');
}

// Modal control
function openCreateModal() {
    document.getElementById("createModal").style.display = "flex";
}
function closeCreateModal() {
    document.getElementById("createModal").style.display = "none";
}
function openEditModal() {
    document.getElementById("editModal").style.display = "flex";
}
function closeEditModal() {
    document.getElementById("editModal").style.display = "none";
}
function openCreateMateriModal() {
    document.getElementById("createMateriModal").style.display = "flex";
    fetchPelatih(); // Fetch pelatih when opening the modal
}
function closeCreateMateriModal() {
    document.getElementById("createMateriModal").style.display = "none";
}
function openEditMateriModal() {
    document.getElementById("editMateriModal").style.display = "flex";
}
function closeEditMateriModal() {
    document.getElementById("editMateriModal").style.display = "none";
}


function closeEditFeedbackModal() {
  document.getElementById('editFeedbackModal').classList.add('hidden');
}

document.getElementById('editFeedbackForm').addEventListener('submit', function(e) {
  e.preventDefault();
  axios.put(`/admin/feedbacks/${currentFeedbackId}`, {
    content: document.getElementById('editFeedbackContent').value
  })
  .then(() => {
    fetchFeedbacks();
    closeEditFeedbackModal();
  });
});

function deleteFeedback(id) {
  if (confirm('Yakin ingin hapus feedback ini?')) {
    axios.delete(`/admin/feedbacks/${id}`)
      .then(() => fetchFeedbacks());
  }
}

// Section control
function showSection(section) {
    document.getElementById("userManagement").style.display = "none";
    document.getElementById("materiManagement").style.display = "none";
    document.getElementById("feedbackManagement").style.display = "none";

    if (section === 'user') {
        document.getElementById("userManagement").style.display = "block";
        document.getElementById("pageTitle").innerText = "Manage Users";
        fetchUsers();
    } else if (section === 'materi') {
        document.getElementById("materiManagement").style.display = "block";
        document.getElementById("pageTitle").innerText = "Manage Materi";
        fetchMateris();
    } else if (section === 'feedback') {
        document.getElementById("feedbackManagement").style.display = "block";
        document.getElementById("pageTitle").innerText = "Manage Feedback";
    }
}

// Logout
function logout() {
    axios.post('/logout').then(() => window.location = '/login');
}

// Init
window.onload = fetchUsers;
</script>

</body>
</html>
