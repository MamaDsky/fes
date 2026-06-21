<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - MANIFEST</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 min-h-screen text-gray-800 font-sans p-6">

    <div class="max-w-6xl mx-auto space-y-8">
        <header class="flex justify-between items-center bg-white p-6 rounded-xl shadow-sm border-b">
            <div>
                <h1 class="text-2xl font-black text-gray-900">MANIFEST Admin Control Panel</h1>
                <p class="text-sm text-gray-500">Kelola pendaftaran peserta dan pengaturan diskon kode referral.</p>
            </div>
            <span class="bg-indigo-100 text-indigo-800 text-xs font-bold px-3 py-1 rounded-full">Admin Active</span>
        </header>

        <!-- BAGIAN CRUD KODE REFERRAL (Sesuai Request) -->
        <section class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Form Input Tambah Referral -->
            <div class="bg-white p-6 rounded-xl shadow-sm border">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Tambah Kode Referral</h2>
                <form id="addRefForm" class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-600 uppercase">Kode</label>
                        <input type="text" name="code" placeholder="Contoh: MANIFESTMABA" required class="w-full mt-1 p-2 border rounded-lg text-sm uppercase">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-600 uppercase">Diskon (%)</label>
                        <input type="number" name="discount" min="1" max="100" placeholder="Contoh: 15" required class="w-full mt-1 p-2 border rounded-lg text-sm">
                    </div>
                    <button type="submit" class="w-full bg-indigo-600 text-white font-semibold p-2 rounded-lg text-sm hover:bg-indigo-700">Simpan Kode</button>
                </form>
            </div>

            <!-- Tabel Live Data Kode Referral -->
            <div class="bg-white p-6 rounded-xl shadow-sm border md:col-span-2">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Daftar Aktif Kode Referral</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="py-3 px-4">Kode Promo</th>
                                <th class="py-3 px-4">Diskon (%)</th>
                                <th class="py-3 px-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="referralList">
                            <!-- Diisi via Async JS Fetch -->
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <!-- JS Logic Control Panel Admin -->
    <script>
        document.addEventListener("DOMContentLoaded", loadReferrals);

        // Ambil Data dari API Admin
        function loadReferrals() {
            fetch('../api/admin/referral.php?action=list')
            .then(res => res.json())
            .then(data => {
                const tbody = document.getElementById('referralList');
                tbody.innerHTML = '';
                if(data.length === 0) {
                    tbody.innerHTML = `<tr><td colspan="3" class="text-center py-4 text-gray-400">Belum ada kode referral yang terdaftar.</td></tr>`;
                    return;
                }
                data.forEach(item => {
                    tbody.innerHTML += `
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-4 font-bold text-indigo-700">${item.code}</td>
                            <td class="py-3 px-4 font-semibold text-gray-900">${item.discount_percentage}%</td>
                            <td class="py-3 px-4 text-right">
                                <button onclick="deleteRef(${item.id})" class="text-red-500 hover:text-red-700 font-bold text-xs bg-red-50 px-2 py-1 rounded">Hapus</button>
                            </td>
                        </tr>
                    `;
                });
            });
        }

        // Kirim Input Form Tambah Referral Baru Ke API Admin
        document.getElementById('addRefForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            fetch('../api/admin/referral.php?action=add', { method: 'POST', body: formData })
            .then(res => res.json())
            .then(data => {
                alert(data.message);
                if(data.status === 'success') {
                    this.reset();
                    loadReferrals();
                }
            });
        });

        // Request Hapus Kode via API Admin
        function deleteRef(id) {
            if(confirm("Apakah Anda yakin ingin menghapus kode referral ini?")) {
                const formData = new FormData();
                formData.append('id', id);
                fetch('../api/admin/referral.php?action=delete', { method: 'POST', body: formData })
                .then(res => res.json())
                .then(data => {
                    alert(data.message);
                    loadReferrals();
                });
            }
        }
    </script>
</body>
</html>