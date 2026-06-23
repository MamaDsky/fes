<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MANIFEST Admin Hub — Data Pendaftar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        heading: ['"Alte Haas Grotesk"', 'Arial', 'sans-serif'],
                        body: ['"Alte Haas Grotesk"', 'Arial', 'sans-serif'],
                        accent: ['"Instrument Serif"', 'serif'],
                    },
                    colors: {
                        manifest: {
                            dark: '#220701',       // Hitam Kopi Pekat GSM
                            cream: '#D8CEA8',      // Cream Gold Muted
                            burgundy: '#520000',   // Merah Marun Tua
                            rose: '#9C4F51',       // Marun Kalem / Rose Muted
                            forest: '#1F312F',     // Hijau Hutan Gelap
                            milk: '#F5F0E3',       // Putih Susu Base
                        }
                    }
                }
            }
        }
    </script>
    
    <style>
        body {
            background-color: #F5F0E3;
            color: #220701;
            letter-spacing: -0.01em;
        }
        ::-webkit-scrollbar { width: 4px; height: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #220701; border-radius: 10px; }

        .gsm-texture {
            position: fixed; inset: 0; z-index: 999; pointer-events: none; opacity: 0.25; mix-blend-mode: multiply;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.15'/%3E%3C/svg%3E");
        }
        .sidebar-blur {
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
        .header-blur {
            background: rgba(245, 240, 227, 0.8);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
    </style>
</head>
<body class="h-full overflow-hidden font-body antialiased flex">

    <div class="gsm-texture"></div>

    <aside class="w-64 border-r border-manifest-dark/10 sidebar-blur flex flex-col justify-between z-20 shrink-0">
        <div class="p-6">
            <div class="mb-8">
                <h1 class="text-xl font-bold tracking-tighter uppercase text-manifest-dark">MANIFEST 2026<span class="text-manifest-rose">.</span></h1>
                <p class="font-accent italic text-lg text-manifest-rose leading-none mt-0.5">Admin Central</p>
            </div>

            <nav class="space-y-1">
                <span class="text-[9px] font-bold uppercase tracking-widest text-manifest-dark/30 block mb-2 px-3">Data Management</span>
                <a href="index.php" class="flex items-center gap-3 bg-manifest-dark text-white text-[11px] font-bold uppercase tracking-wider px-4 py-3 rounded-xl shadow-xs transition-all">
                    <i class="fa-solid fa-chart-simple w-4 text-center"></i> Data Pendaftar
                </a>
                <a href="referral.php" class="flex items-center gap-3 text-manifest-dark/60 hover:text-manifest-dark text-[11px] font-bold uppercase tracking-wider px-4 py-3 rounded-xl transition-all">
                    <i class="fa-solid fa-ticket w-4 text-center"></i> Referral Code
                </a>
            </nav>
        </div>

        <div class="p-6 border-t border-manifest-dark/5 flex flex-col gap-2">
            <button onclick="exportTableToCSV('manifest-pendaftar-2026.csv')" class="w-full bg-white hover:bg-white/60 text-manifest-dark border border-manifest-dark/10 text-[9px] font-bold uppercase tracking-widest py-3 rounded-xl transition-all flex items-center justify-center gap-2">
                <i class="fa-solid fa-file-csv text-xs"></i> Export CSV Data
            </button>
            <a href="logout.php" class="w-full bg-red-100 hover:bg-red-200 text-red-700 text-[9px] font-bold uppercase tracking-widest py-3 rounded-xl transition-all flex items-center justify-center gap-2 border border-red-200/50">
                <i class="fa-solid fa-right-from-bracket text-xs"></i> Log Out
            </a>
        </div>
    </aside>

    <div class="flex-1 flex flex-col h-full overflow-hidden relative z-10">
        
        <header class="h-20 border-b border-manifest-dark/10 header-blur px-8 flex justify-between items-center shrink-0">
            <div>
                <h2 class="text-sm font-bold tracking-tight uppercase text-manifest-dark">Dashboard Hub</h2>
                <p class="text-[10px] text-manifest-dark/40">Manajemen Registrasi Berkas & Validasi Keuangan</p>
            </div>

            <div class="bg-manifest-dark/5 px-4 py-2 rounded-xl text-right">
                <span class="text-[8px] uppercase tracking-widest text-manifest-dark/40 block">Estimated Revenue</span>
                <span class="text-sm font-bold tracking-tight text-manifest-dark" id="stat_revenue">Rp 0</span>
            </div>
        </header>

        <div class="p-6 border-b border-manifest-dark/5 grid grid-cols-2 lg:grid-cols-4 gap-4 bg-white/10 shrink-0">
            <div class="bg-white/50 p-4 rounded-2xl border border-manifest-dark/[0.04]">
                <span class="text-[9px] text-manifest-dark/40 block uppercase font-bold tracking-wider">Total Tim Terdaftar</span>
                <span class="font-accent italic text-3xl font-bold mt-1 block" id="side_total">0</span>
            </div>
            <div class="bg-white/50 p-4 rounded-2xl border border-manifest-dark/[0.04]">
                <span class="text-[9px] text-manifest-rose block uppercase font-bold tracking-wider">Business Plan (BPC)</span>
                <span class="font-accent italic text-3xl font-bold text-manifest-rose mt-1 block" id="side_bpc">0</span>
            </div>
            <div class="bg-white/50 p-4 rounded-2xl border border-manifest-dark/[0.04]">
                <span class="text-[9px] text-manifest-burgundy block uppercase font-bold tracking-wider">Business Case (BCC)</span>
                <span class="font-accent italic text-3xl font-bold text-manifest-burgundy mt-1 block" id="side_bcc">0</span>
            </div>
            <div class="bg-white/50 p-4 rounded-2xl border border-manifest-dark/[0.04]">
                <span class="text-[9px] text-manifest-forest block uppercase font-bold tracking-wider">Economics BPC (EBPC)</span>
                <span class="font-accent italic text-3xl font-bold text-manifest-forest mt-1 block" id="side_ebpc">0</span>
            </div>
        </div>

        <div class="p-6 border-b border-manifest-dark/5 flex flex-col sm:flex-row gap-4 items-center justify-between bg-white/5 shrink-0">
            <div class="relative w-full sm:w-80">
                <span class="absolute inset-y-0 left-4 flex items-center text-manifest-dark/30 text-xs">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input type="text" id="searchInput" placeholder="Cari Nama Tim, Ketua, atau Billing..." class="w-full bg-white text-xs pl-10 pr-4 py-2.5 rounded-xl border border-manifest-dark/10 focus:outline-none focus:border-manifest-rose text-manifest-dark transition-all placeholder-manifest-dark/30">
            </div>
            
            <div class="flex gap-1 w-full sm:w-auto overflow-x-auto">
                <button onclick="filterCategory('ALL')" class="filter-btn text-[9px] font-bold uppercase tracking-widest px-4 py-2.5 rounded-lg bg-manifest-dark text-white transition-all" data-cate="ALL">All Movements</button>
                <button onclick="filterCategory('BPC')" class="filter-btn text-[9px] font-bold uppercase tracking-widest px-4 py-2.5 rounded-lg bg-white/60 text-manifest-dark border border-manifest-dark/5 hover:bg-white transition-all" data-cate="BPC">Business Plan</button>
                <button onclick="filterCategory('BCC')" class="filter-btn text-[9px] font-bold uppercase tracking-widest px-4 py-2.5 rounded-lg bg-white/60 text-manifest-dark border border-manifest-dark/5 hover:bg-white transition-all" data-cate="BCC">Business Case</button>
                <button onclick="filterCategory('EBPC')" class="filter-btn text-[9px] font-bold uppercase tracking-widest px-4 py-2.5 rounded-lg bg-white/60 text-manifest-dark border border-manifest-dark/5 hover:bg-white transition-all" data-cate="EBPC">Economics BPC</button>
            </div>
        </div>

        <div class="flex-1 overflow-auto bg-white/20">
            <table class="w-full text-left text-xs min-w-[800px]">
                <thead class="text-manifest-dark/40 bg-manifest-dark/[0.02] uppercase text-[9px] tracking-widest sticky top-0 backdrop-blur-md border-b border-manifest-dark/5 z-10">
                    <tr>
                        <th class="py-4 px-8 w-32">Kategori</th>
                        <th class="py-4 px-6">Nama Tim / Institusi</th>
                        <th class="py-4 px-6">Ketua Perwakilan</th>
                        <th class="py-4 px-6">Nominal Transaksi</th>
                        <th class="py-4 px-8 text-right w-40">Aksi Berkas</th>
                    </tr>
                </thead>
                <tbody id="registrationTable" class="divide-y divide-manifest-dark/[0.03] text-manifest-dark font-medium">
                    </tbody>
            </table>
        </div>

        <div class="h-16 border-t border-manifest-dark/10 header-blur px-8 flex items-center justify-between shrink-0 text-xs">
            <div class="text-manifest-dark/50 text-[11px]" id="paginationInfo">
                Showing 0 to 0 of 0 teams
            </div>
            <div class="flex items-center gap-1" id="paginationControls">
                </div>
        </div>
    </div>

    <div id="detailModal" class="fixed inset-0 bg-manifest-dark/30 backdrop-blur-md hidden z-50 flex items-center justify-center p-4">
        <div class="bg-[#F5F0E3] border border-manifest-dark/10 rounded-[2rem] w-full max-w-2xl shadow-2xl overflow-hidden max-h-[90vh] flex flex-col">
            <div class="p-6 border-b border-manifest-dark/5 flex justify-between items-center bg-white/30">
                <div>
                    <h3 class="font-bold text-manifest-dark text-sm uppercase tracking-tight">Review & Edit Data Registrasi</h3>
                    <p class="text-[10px] uppercase tracking-widest text-manifest-rose font-bold mt-0.5" id="md_comp_type">Kategori: -</p>
                </div>
                <button onclick="closeModal()" class="text-manifest-dark/40 hover:text-manifest-dark font-bold text-sm p-2">
                    <i class="fa-solid fa-xmark text-base"></i>
                </button>
            </div>

            <form id="editRegForm" class="p-6 space-y-5 overflow-y-auto flex-1 text-xs">
                <input type="hidden" name="id" id="md_id">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-bold text-manifest-dark/40 uppercase text-[9px] tracking-wider">Nama Tim</label>
                        <input type="text" name="team_name" id="md_team_name" class="w-full mt-1.5 p-3 border border-manifest-dark/10 rounded-xl bg-white focus:outline-none focus:border-manifest-rose text-manifest-dark font-semibold">
                    </div>
                    <div>
                        <label class="block font-bold text-manifest-dark/40 uppercase text-[9px] tracking-wider">Metode / Pemilik Rekening</label>
                        <input type="text" id="md_payment_info" readonly class="w-full mt-1.5 p-3 border border-manifest-dark/5 rounded-xl bg-manifest-dark/[0.02] text-manifest-dark/40 cursor-not-allowed font-medium">
                    </div>
                </div>

                <div class="p-5 bg-white/30 rounded-2xl border border-manifest-dark/5 grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div class="md:col-span-2 font-bold text-manifest-burgundy uppercase text-[9px] tracking-widest border-b border-manifest-dark/5 pb-2">Delegasi Utama (Ketua)</div>
                    <div>
                        <label class="block text-manifest-dark/50 text-[10px] uppercase">Nama Lengkap</label>
                        <input type="text" name="leader_name" id="md_leader_name" class="w-full mt-1.5 p-2.5 border border-manifest-dark/10 bg-white rounded-xl focus:outline-none text-manifest-dark">
                    </div>
                    <div>
                        <label class="block text-manifest-dark/50 text-[10px] uppercase">WhatsApp</label>
                        <input type="text" name="leader_whatsapp" id="md_leader_wa" class="w-full mt-1.5 p-2.5 border border-manifest-dark/10 bg-white rounded-xl focus:outline-none text-manifest-dark">
                    </div>
                </div>

                <div class="p-5 bg-white/30 rounded-2xl border border-manifest-dark/5 grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div class="md:col-span-2 font-bold text-manifest-rose uppercase text-[9px] tracking-widest border-b border-manifest-dark/5 pb-2">Anggota Pendamping (Member 2)</div>
                    <div>
                        <label class="block text-manifest-dark/50 text-[10px] uppercase">Nama Lengkap</label>
                        <input type="text" name="member_name" id="md_member_name" class="w-full mt-1.5 p-2.5 border border-manifest-dark/10 bg-white rounded-xl focus:outline-none text-manifest-dark">
                    </div>
                    <div>
                        <label class="block text-manifest-dark/50 text-[10px] uppercase">WhatsApp</label>
                        <input type="text" name="member_whatsapp" id="md_member_wa" class="w-full mt-1.5 p-2.5 border border-manifest-dark/10 bg-white rounded-xl focus:outline-none text-manifest-dark">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block font-bold text-manifest-dark/40 uppercase text-[9px] tracking-wider">Verifikasi Berkas Pendataan Digital</label>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 text-center text-[9px] font-bold uppercase tracking-widest text-manifest-rose">
                        <a id="lnk_proof" target="_blank" class="p-3 bg-white/50 rounded-xl hover:bg-white border border-manifest-dark/5 transition-all"><i class="fa-solid fa-receipt mr-1.5"></i> Bukti Bayar</a>
                        <a id="lnk_id1" target="_blank" class="p-3 bg-white/50 rounded-xl hover:bg-white border border-manifest-dark/5 transition-all"><i class="fa-solid fa-address-card mr-1.5"></i> ID Ketua</a>
                        <a id="lnk_id2" target="_blank" class="p-3 bg-white/50 rounded-xl hover:bg-white border border-manifest-dark/5 transition-all"><i class="fa-solid fa-address-card mr-1.5"></i> ID Anggota</a>
                        <a id="lnk_ig" target="_blank" class="p-3 bg-white/50 rounded-xl hover:bg-white border border-manifest-dark/5 transition-all"><i class="fa-brands fa-instagram mr-1.5"></i> Bukti Follow</a>
                        <a id="lnk_feed" target="_blank" class="p-3 bg-white/50 rounded-xl hover:bg-white border border-manifest-dark/5 transition-all"><i class="fa-solid fa-share-nodes mr-1.5"></i> Bukti Feed</a>
                        <a id="lnk_twibbon" target="_blank" class="p-3 bg-white/50 rounded-xl hover:bg-white border border-manifest-dark/5 transition-all"><i class="fa-solid fa-image mr-1.5"></i> Twibbon</a>
                    </div>
                </div>

                <div class="pt-4 border-t border-manifest-dark/5 flex justify-end gap-2">
                    <button type="button" onclick="closeModal()" class="px-6 py-3 bg-white/60 border border-manifest-dark/10 text-[9px] font-bold uppercase tracking-widest rounded-full hover:bg-white transition-all">Batal</button>
                    <button type="submit" class="px-7 py-3 bg-manifest-dark text-white text-[9px] font-bold uppercase tracking-widest rounded-full hover:bg-manifest-burgundy transition-all shadow-md">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Fungsi escape HTML demi mencegah serangan XSS melalui manipulasi input teks basis data
        function escapeHTML(string) {
            const map = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            };
            return String(string).replace(/[&<>"']/g, function(m) { return map[m]; });
        }

        document.addEventListener("DOMContentLoaded", () => {
            loadRegistrations();
            document.getElementById('searchInput').addEventListener('input', () => {
                currentPage = 1; // Reset ke halaman pertama jika filter pencarian berubah
                applyFilters();
            });
        });

        let allData = [];
        let filteredData = [];
        let activeCategory = 'ALL';
        
        // Aturan Pagination Dasbor
        let currentPage = 1;
        const rowsPerPage = 10;

        function loadRegistrations() {
            fetch('../api/admin/registration.php?action=list')
            .then(res => res.json())
            .then(data => {
                allData = data;
                updateStatsAndMetrics(data);
                applyFilters();
            })
            .catch(err => console.error("Gagal menarik entitas data manifest log:", err));
        }

        function updateStatsAndMetrics(data) {
            let totalRevenue = 0;
            
            document.getElementById('side_total').textContent = data.length;
            document.getElementById('side_bpc').textContent = data.filter(r => r.competition_type === 'BPC').length;
            document.getElementById('side_bcc').textContent = data.filter(r => r.competition_type === 'BCC').length;
            document.getElementById('side_ebpc').textContent = data.filter(r => r.competition_type === 'EBPC').length;

            data.forEach(item => { totalRevenue += parseInt(item.final_amount || 0); });
            document.getElementById('stat_revenue').textContent = "Rp " + totalRevenue.toLocaleString('id-ID');
        }

        function applyFilters() {
            const searchKeyword = document.getElementById('searchInput').value.toLowerCase();
            
            filteredData = allData.filter(item => {
                const matchesCategory = (activeCategory === 'ALL' || item.competition_type === activeCategory);
                const matchesSearch = item.team_name.toLowerCase().includes(searchKeyword) || 
                                      item.leader_name.toLowerCase().includes(searchKeyword) ||
                                      (item.payment_method && item.payment_method.toLowerCase().includes(searchKeyword));
                return matchesCategory && matchesSearch;
            });
            
            renderGridWithPagination();
        }

        function renderGridWithPagination() {
            const tbody = document.getElementById('registrationTable');
            tbody.innerHTML = '';
            
            const totalItems = filteredData.length;
            const totalPages = Math.ceil(totalItems / rowsPerPage) || 1;
            
            if (currentPage > totalPages) currentPage = totalPages;
            if (currentPage < 1) currentPage = 1;

            const startIndex = (currentPage - 1) * rowsPerPage;
            const endIndex = Math.min(startIndex + rowsPerPage, totalItems);
            
            const pageData = filteredData.slice(startIndex, startIndex + rowsPerPage);

            if(pageData.length === 0) {
                tbody.innerHTML = `<tr><td colspan="5" class="text-center py-24 text-manifest-dark/30 font-accent italic text-lg">No matches found in the symphony registry.</td></tr>`;
                document.getElementById('paginationInfo').textContent = "Showing 0 to 0 of 0 teams";
                document.getElementById('paginationControls').innerHTML = '';
                return;
            }

            pageData.forEach(row => {
                let badgeClass = '';
                if(row.competition_type === 'EBPC') badgeClass = 'bg-manifest-forest text-white';
                else if(row.competition_type === 'BCC') badgeClass = 'bg-manifest-burgundy text-white';
                else badgeClass = 'bg-manifest-rose text-white';
                
                tbody.innerHTML += `
                    <tr class="hover:bg-white/40 transition-all border-b border-manifest-dark/[0.02]">
                        <td class="py-4 px-8"><span class="px-2.5 py-0.5 text-[8px] font-bold tracking-widest rounded-md uppercase ${badgeClass}">${row.competition_type}</span></td>
                        <td class="py-4 px-6 font-bold text-manifest-dark text-xs">${escapeHTML(row.team_name)}</td>
                        <td class="py-4 px-6 text-manifest-dark/60 text-xs">${escapeHTML(row.leader_name)}</td>
                        <td class="py-4 px-6 font-bold text-manifest-dark text-xs">Rp ${parseInt(row.final_amount).toLocaleString('id-ID')}</td>
                        <td class="py-4 px-8 text-right">
                            <button onclick="openDetail(${row.id})" class="text-manifest-dark text-[9px] tracking-widest font-bold uppercase bg-white hover:bg-white/40 border border-manifest-dark/10 px-4 py-2 rounded-full transition-all cursor-pointer">
                                <i class="fa-solid fa-folder-open mr-1"></i> Audit
                            </button>
                        </td>
                    </tr>
                `;
            });

            document.getElementById('paginationInfo').textContent = `Showing ${startIndex + 1} to ${endIndex} of ${totalItems} teams`;
            renderPaginationControls(totalPages);
        }

        function renderPaginationControls(totalPages) {
            const container = document.getElementById('paginationControls');
            container.innerHTML = '';

            const prevBtn = document.createElement('button');
            prevBtn.className = `px-3 py-1.5 rounded-lg border text-[10px] font-bold uppercase tracking-wider transition-all ${currentPage === 1 ? 'border-manifest-dark/5 text-manifest-dark/20 cursor-not-allowed bg-transparent' : 'border-manifest-dark/10 hover:bg-white bg-white/60'}`;
            prevBtn.innerHTML = '<i class="fa-solid fa-chevron-left"></i>';
            prevBtn.disabled = (currentPage === 1);
            prevBtn.onclick = () => { currentPage--; renderGridWithPagination(); };
            container.appendChild(prevBtn);

            for (let i = 1; i <= totalPages; i++) {
                const pageBtn = document.createElement('button');
                pageBtn.className = `px-3 py-1.5 rounded-lg border text-[10px] font-bold transition-all ${currentPage === i ? 'bg-manifest-dark text-white border-manifest-dark' : 'border-manifest-dark/10 bg-white/60 hover:bg-white text-manifest-dark'}`;
                pageBtn.textContent = i;
                pageBtn.onclick = () => { currentPage = i; renderGridWithPagination(); };
                container.appendChild(pageBtn);
            }

            const nextBtn = document.createElement('button');
            nextBtn.className = `px-3 py-1.5 rounded-lg border text-[10px] font-bold uppercase tracking-wider transition-all ${currentPage === totalPages ? 'border-manifest-dark/5 text-manifest-dark/20 cursor-not-allowed bg-transparent' : 'border-manifest-dark/10 hover:bg-white bg-white/60'}`;
            nextBtn.innerHTML = '<i class="fa-solid fa-chevron-right"></i>';
            nextBtn.disabled = (currentPage === totalPages);
            nextBtn.onclick = () => { currentPage++; renderGridWithPagination(); };
            container.appendChild(nextBtn);
        }

        function filterCategory(category) {
            activeCategory = category;
            currentPage = 1;
            document.querySelectorAll('.filter-btn').forEach(btn => {
                if(btn.getAttribute('data-cate') === category) {
                    btn.classList.remove('bg-white/60', 'text-manifest-dark', 'border');
                    btn.classList.add('bg-manifest-dark', 'text-white');
                } else {
                    btn.classList.remove('bg-manifest-dark', 'text-white');
                    btn.classList.add('bg-white/60', 'text-manifest-dark', 'border', 'border-manifest-dark/5');
                }
            });
            applyFilters();
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

                // PENYESUAIAN AMAN: Mengambil URL berkas langsung dari property khusus dinamis berakhiran '_url' dari API
                document.getElementById('lnk_proof').href   = data.payment_proof_url;
                document.getElementById('lnk_id1').href     = data.leader_id_scan_url;
                document.getElementById('lnk_id2').href     = data.member_id_scan_url;
                document.getElementById('lnk_ig').href      = data.proof_follow_ig_url;
                document.getElementById('lnk_feed').href    = data.proof_repost_feed_url;
                document.getElementById('lnk_twibbon').href = data.proof_twibbon_url;

                // TAMBAHAN FORCE DOWNLOAD: Atribut khusus berkas dokumen PDF pendaftar agar diunduh secara tepat oleh browser
                document.getElementById('lnk_id1').setAttribute('download', data.leader_id_scan);
                document.getElementById('lnk_id2').setAttribute('download', data.member_id_scan);
                document.getElementById('lnk_ig').setAttribute('download', data.proof_follow_ig);
                document.getElementById('lnk_feed').setAttribute('download', data.proof_repost_feed);
                document.getElementById('lnk_twibbon').setAttribute('download', data.proof_twibbon);

                document.getElementById('detailModal').classList.remove('hidden');
            });
        }

        function closeModal() {
            document.getElementById('detailModal').classList.add('hidden');
        }

        function exportTableToCSV(filename) {
            let csv = [];
            csv.push("ID,Kategori,Nama Tim,Nama Ketua,Nominal,Tanggal");
            
            allData.forEach(row => {
                csv.push([row.id, row.competition_type, row.team_name, row.leader_name, row.final_amount, row.created_at].join(","));
            });

            let csvFile = new Blob([csv.join("\n")], {type: "text/csv"});
            let link = document.createElement("a");
            link.download = filename;
            link.href = window.URL.createObjectURL(csvFile);
            link.style.display = "none";
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

        document.getElementById('editRegForm').addEventListener('submit', function(e) {
            e.preventDefault();
            fetch('../api/admin/registration.php?action=update', {
                method: 'POST',
                body: new FormData(this)
            })
            .then(res => res.json())
            .then(data => {
                alert(data.message);
                if (data.status === 'success') {
                    closeModal();
                    loadRegistrations(); 
                }
            });
        });
    </script>
</body>
</html>