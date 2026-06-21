<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pendaftar — MANIFEST Admin</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-[#f5f5f7] min-h-screen text-[#1d1d1f] p-6">

    <div class="max-w-6xl mx-auto space-y-6">
        <header class="flex justify-between items-center bg-white p-6 rounded-2xl shadow-xs border border-gray-100">
            <div>
                <h1 class="text-xl font-black tracking-tight">MANIFEST 2026 Admin Hub</h1>
                <p class="text-xs text-gray-400 mt-0.5">Manajemen Berkas & Registrasi Peserta</p>
            </div>
            <div class="flex gap-2">
                <a href="index.php" class="bg-indigo-50 text-indigo-700 text-xs font-bold px-4 py-2 rounded-xl border border-indigo-100">Data Pendaftar</a>
                <a href="referral.php" class="bg-white text-gray-600 text-xs font-bold px-4 py-2 rounded-xl border border-gray-200 hover:bg-gray-50">Kelola Referral</a>
            </div>
        </header>

        <main class="bg-white rounded-2xl border border-gray-100 shadow-xs overflow-hidden">
            <div class="p-6 border-b border-gray-50 flex justify-between items-center bg-gray-50/50">
                <h2 class="font-bold text-gray-800 text-sm">Semua Tim Terregistrasi</h2>
                <span class="text-xs font-semibold text-gray-400" id="total_teams">Loading...</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-gray-500">
                    <thead class="text-gray-400 bg-gray-50/30 uppercase text-[10px] tracking-wider border-b border-gray-100">
                        <tr>
                            <th class="py-3.5 px-6">Kategori</th>
                            <th class="py-3.5 px-6">Nama Tim</th>
                            <th class="py-3.5 px-6">Ketua Tim</th>
                            <th class="py-3.5 px-6">Total Bayar</th>
                            <th class="py-3.5 px-6 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="registrationTable" class="divide-y divide-gray-100 text-gray-700">
                        </tbody>
                </table>
            </div>
        </main>
    </div>

    <div id="detailModal" class="fixed inset-0 bg-black/30 backdrop-blur-xs hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl w-full max-w-2xl shadow-xl overflow-hidden max-h-[90vh] flex flex-col animate-in fade-in zoom-in-95 duration-150">
            <div class="p-5 border-b flex justify-between items-center bg-gray-50">
                <div>
                    <h3 class="font-bold text-gray-900 text-sm">Review & Edit Data Registrasi</h3>
                    <p class="text-[11px] text-gray-400" id="md_comp_type">Kategori: -</p>
                </div>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 font-bold text-sm">✕</button>
            </div>

            <form id="editRegForm" class="p-6 space-y-4 overflow-y-auto flex-1 text-xs">
                <input type="hidden" name="id" id="md_id">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-bold text-gray-500 uppercase text-[10px]">Nama Tim</label>
                        <input type="text" name="team_name" id="md_team_name" class="w-full mt-1 p-2 border rounded-xl bg-white focus:ring-1 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block font-bold text-gray-500 uppercase text-[10px]">Metode / Pemilik Rekening</label>
                        <input type="text" id="md_payment_info" readonly class="w-full mt-1 p-2 border rounded-xl bg-gray-50 text-gray-400 cursor-not-allowed">
                    </div>
                </div>

                <div class="p-4 bg-indigo-50/40 rounded-2xl border border-indigo-50 grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div class="md:col-span-2 font-bold text-indigo-900">Data Ketua (Member 1)</div>
                    <div>
                        <label class="block text-gray-500 font-medium">Nama Lengkap</label>
                        <input type="text" name="leader_name" id="md_leader_name" class="w-full mt-1 p-2 border bg-white rounded-lg">
                    </div>
                    <div>
                        <label class="block text-gray-500 font-medium">WhatsApp</label>
                        <input type="text" name="leader_whatsapp" id="md_leader_wa" class="w-full mt-1 p-2 border bg-white rounded-lg">
                    </div>
                </div>

                <div class="p-4 bg-emerald-50/40 rounded-2xl border border-emerald-50 grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div class="md:col-span-2 font-bold text-emerald-900">Data Anggota 2</div>
                    <div>
                        <label class="block text-gray-500 font-medium">Nama Lengkap</label>
                        <input type="text" name="member_name" id="md_member_name" class="w-full mt-1 p-2 border bg-white rounded-lg">
                    </div>
                    <div>
                        <label class="block text-gray-500 font-medium">WhatsApp</label>
                        <input type="text" name="member_whatsapp" id="md_member_wa" class="w-full mt-1 p-2 border bg-white rounded-lg">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block font-bold text-gray-500 uppercase text-[10px]">Dokumen & Bukti Bayar Terunggah</label>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 text-center text-[11px] font-semibold text-indigo-600">
                        <a id="lnk_proof" target="_blank" class="p-2.5 bg-gray-100 rounded-xl hover:bg-indigo-50 border transition-all">🖼️ Bukti Bayar</a>
                        <a id="lnk_id1" target="_blank" class="p-2.5 bg-gray-100 rounded-xl hover:bg-indigo-50 border transition-all">📄 ID Ketua</a>
                        <a id="lnk_id2" target="_blank" class="p-2.5 bg-gray-100 rounded-xl hover:bg-indigo-50 border transition-all">📄 ID Anggota 2</a>
                        <a id="lnk_ig" target="_blank" class="p-2.5 bg-gray-100 rounded-xl hover:bg-indigo-50 border transition-all">📄 Bukti Follow</a>
                        <a id="lnk_feed" target="_blank" class="p-2.5 bg-gray-100 rounded-xl hover:bg-indigo-50 border transition-all">📄 Bukti Feed</a>
                        <a id="lnk_twibbon" target="_blank" class="p-2.5 bg-gray-100 rounded-xl hover:bg-indigo-50 border transition-all">📄 Twibbon</a>
                    </div>
                </div>

                <div class="pt-4 border-t flex justify-end gap-2">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-100 font-medium rounded-xl hover:bg-gray-200">Tutup</button>
                    <button type="submit" class="px-5 py-2 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 shadow-xs">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", loadRegistrations);

        function loadRegistrations() {
           fetch('../api/admin/registration.php?action=list')
        .then(res => res.json())
        .then(data => {
                document.getElementById('total_teams').textContent = "Total: " + data.length + " Tim";
                const tbody = document.getElementById('registrationTable');
                tbody.innerHTML = '';
                
                if(data.length === 0) {
                    tbody.innerHTML = `<tr><td colspan="5" class="text-center py-8 text-gray-400">Belum ada tim yang mendaftar.</td></tr>`;
                    return;
                }

                data.forEach(row => {
                    // Badge warna dinamis berdasarkan tipe lomba
                    let badgeClass = row.competition_type === 'EBPC' ? 'bg-purple-50 text-purple-700 border-purple-100' : 'bg-indigo-50 text-indigo-700 border-indigo-100';
                    
                    tbody.innerHTML += `
                        <tr class="hover:bg-gray-50/50 transition-all border-b border-gray-50">
                            <td class="py-4 px-6"><span class="px-2 py-0.5 border rounded-md text-[10px] font-black ${badgeClass}">${row.competition_type}</span></td>
                            <td class="py-4 px-6 font-bold text-gray-900">${row.team_name}</td>
                            <td class="py-4 px-6">${row.leader_name}</td>
                            <td class="py-4 px-6 font-bold text-gray-900">Rp ${parseInt(row.final_amount).toLocaleString('id-ID')}</td>
                            <td class="py-4 px-6 text-right">
                                <button onclick="openDetail(${row.id})" class="text-indigo-600 font-bold bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-lg border border-indigo-100 cursor-pointer">Review & Edit</button>
                            </td>
                        </tr>
                    `;
                });
            });
        }

        function openDetail(id) {
            fetch(`../api/admin/registration.php?action=detail&id=${id}`)
            .then(res => res.json())
            .then(data => {
                document.getElementById('md_id').value = data.id;
                document.getElementById('md_comp_type').textContent = "Kategori Lomba: " + data.competition_type;
                document.getElementById('md_team_name').value = data.team_name;
                document.getElementById('md_payment_info').value = data.payment_method + " a/n " + data.account_holder;
                
                document.getElementById('md_leader_name').value = data.leader_name;
                document.getElementById('md_leader_wa').value = data.leader_whatsapp;
                
                document.getElementById('md_member_name').value = data.member_name;
                document.getElementById('md_member_wa').value = data.member_whatsapp;

                // Atur link file uploads secara dinamis (mengarah ke direktori uploads sistem)
                const baseUrl = "../../uploads/";
                document.getElementById('lnk_proof').href = baseUrl + data.payment_proof;
                document.getElementById('lnk_id1').href = baseUrl + data.leader_id_scan;
                document.getElementById('lnk_id2').href = baseUrl + data.member_id_scan;
                document.getElementById('lnk_ig').href = baseUrl + data.proof_follow_ig;
                document.getElementById('lnk_feed').href = baseUrl + data.proof_repost_feed;
                document.getElementById('lnk_twibbon').href = baseUrl + data.proof_twibbon;

                document.getElementById('detailModal').classList.remove('hidden');
            });
        }

        function closeModal() {
            document.getElementById('detailModal').classList.add('hidden');
        }

        // Submit form edit update data tim
        document.getElementById('editRegForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch('../api/admin/registrations.php?action=update', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                alert(data.message);
                if (data.status === 'success') {
                    closeModal();
                    loadRegistrations(); // Refresh list data tabel
                }
            });
        });
    </script>
</body>
</html>