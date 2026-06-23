<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MANIFEST Admin Hub — Kelola Referral</title>
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

    <aside class="w-64 border-r border-manifest-dark/10 sidebar-blur flex flex-col justify-between z-20 shrink-0 shadow-none">
        <div class="p-6">
            <div class="mb-8">
                <h1 class="text-xl font-bold tracking-tighter uppercase text-manifest-dark">MANIFEST 2026<span class="text-manifest-rose">.</span></h1>
                <p class="font-accent italic text-lg text-manifest-rose leading-none mt-0.5">Admin Central</p>
            </div>

            <nav class="space-y-1">
                <span class="text-[9px] font-bold uppercase tracking-widest text-manifest-dark/30 block mb-2 px-3">Data Management</span>
                <a href="index.php" class="flex items-center gap-3 text-manifest-dark/60 hover:text-manifest-dark text-[11px] font-bold uppercase tracking-wider px-4 py-3 rounded-xl transition-all">
                    <i class="fa-solid fa-chart-simple w-4 text-center"></i> Data Pendaftar
                </a>
                <a href="referral.php" class="flex items-center gap-3 bg-manifest-dark text-white text-[11px] font-bold uppercase tracking-wider px-4 py-3 rounded-xl transition-all shadow-none">
                    <i class="fa-solid fa-ticket w-4 text-center"></i>Referral Code
                </a>
            </nav>
        </div>

        <div class="p-6 border-t border-manifest-dark/5 text-[10px] tracking-widest uppercase text-manifest-dark/30 text-center">
            Precision System Hub
        </div>
    </aside>

    <div class="flex-1 flex flex-col h-full overflow-hidden relative z-10">
        
        <header class="h-20 border-b border-manifest-dark/10 header-blur px-8 flex justify-between items-center shrink-0 shadow-none">
            <div>
                <h2 class="text-sm font-bold tracking-tight uppercase text-manifest-dark">Referral Engine Control</h2>
                <p class="text-[10px] text-manifest-dark/40">Konfigurasi Kode Promo, Pembagian Diskon, & Limitasi Voucher</p>
            </div>

            <div class="bg-manifest-dark/5 px-4 py-2 rounded-xl text-right">
                <span class="text-[8px] uppercase tracking-widest text-manifest-dark/40 block">Voucher Status</span>
                <span class="text-xs font-bold tracking-tight text-manifest-dark uppercase"><i class="fa-solid fa-circle-check text-manifest-rose mr-1"></i> System Active</span>
            </div>
        </header>

        <div class="flex-1 flex flex-col lg:flex-row overflow-hidden bg-white/10">
            
            <div class="w-full lg:w-80 border-r border-manifest-dark/5 p-6 space-y-6 overflow-y-auto bg-white/20">
                <div>
                    <h3 class="text-xs font-bold text-manifest-dark uppercase tracking-wider mb-1">Tambah Kode Referral</h3>
                    <p class="text-[11px] text-manifest-dark/50">Buat parameter kode promo potongan harga baru.</p>
                </div>

                <form id="addRefForm" class="space-y-4">
                    <div>
                        <label class="block text-[10px] font-bold text-manifest-dark/60 uppercase tracking-wider">Kode Kupon</label>
                        <input type="text" name="code" placeholder="CONTOH: MANIFESTMABA" required class="w-full mt-1.5 p-3 border border-manifest-dark/10 rounded-xl text-xs bg-white focus:outline-none focus:border-manifest-rose font-bold tracking-wider uppercase text-manifest-dark placeholder-manifest-dark/30">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-manifest-dark/60 uppercase tracking-wider">Besaran Diskon (%)</label>
                        <input type="number" name="discount" min="1" max="100" placeholder="Masukkan angka kuantitas (1-100)" required class="w-full mt-1.5 p-3 border border-manifest-dark/10 rounded-xl text-xs bg-white focus:outline-none focus:border-manifest-rose font-semibold text-manifest-dark placeholder-manifest-dark/30">
                    </div>
                    <button type="submit" class="w-full bg-manifest-dark text-white text-[10px] font-bold uppercase tracking-widest py-3.5 rounded-full hover:bg-manifest-burgundy transition-all shadow-none">
                        <i class="fa-solid fa-plus mr-1"></i> Simpan Kode Kupon
                    </button>
                </form>
            </div>

            <div class="flex-1 flex flex-col overflow-hidden">
                
                <div class="p-4 border-b border-manifest-dark/5 bg-white/30 flex items-center shrink-0">
                    <div class="relative w-full sm:w-80">
                        <span class="absolute inset-y-0 left-4 flex items-center text-manifest-dark/30 text-xs">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </span>
                        <input type="text" id="refSearchInput" placeholder="Cari Kode Promo Aktif..." class="w-full bg-white text-xs pl-10 pr-4 py-2.5 rounded-xl border border-manifest-dark/10 focus:outline-none focus:border-manifest-rose text-manifest-dark transition-all placeholder-manifest-dark/30 font-medium">
                    </div>
                </div>

                <div class="flex-1 overflow-auto">
                    <table class="w-full text-left text-xs min-w-[500px]">
                        <thead class="text-manifest-dark/40 bg-manifest-dark/[0.02] uppercase text-[9px] tracking-widest sticky top-0 backdrop-blur-md border-b border-manifest-dark/5 z-10">
                            <tr>
                                <th class="py-4 px-8">Kode Kupon</th>
                                <th class="py-4 px-6">Potongan Harga (%)</th>
                                <th class="py-4 px-8 text-right">Opsi Tindakan</th>
                            </tr>
                        </thead>
                        <tbody id="referralList" class="divide-y divide-manifest-dark/[0.03] text-manifest-dark font-medium">
                            </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", loadReferrals);
        document.getElementById('refSearchInput').addEventListener('input', renderTableGrid);

        let masterReferralData = [];

        // Ambil Data dari API Admin
        function loadReferrals() {
            fetch('../api/admin/referral.php?action=list')
            .then(res => res.json())
            .then(data => {
                masterReferralData = data;
                renderTableGrid();
            })
            .catch(err => console.error("Sistem gagal memuat log data kupon:", err));
        }

        // Render Table Data Grid + Live Client Side Filtering
        function renderTableGrid() {
            const tbody = document.getElementById('referralList');
            tbody.innerHTML = '';
            
            const keyword = document.getElementById('refSearchInput').value.toLowerCase();
            const filteredData = masterReferralData.filter(item => item.code.toLowerCase().includes(keyword));

            if(filteredData.length === 0) {
                tbody.innerHTML = `<tr><td colspan="3" class="text-center py-20 text-manifest-dark/30 font-accent italic text-lg">No coupon match found in the symphony registry.</td></tr>`;
                return;
            }

            filteredData.forEach(item => {
                tbody.innerHTML += `
                    <tr class="hover:bg-white/40 transition-all border-b border-manifest-dark/[0.02]">
                        <td class="py-4 px-8 font-bold text-manifest-dark tracking-wider uppercase text-xs">${item.code}</td>
                        <td class="py-4 px-6 font-semibold text-manifest-rose text-xs">${item.discount_percentage}% Off</td>
                        <td class="py-4 px-8 text-right">
                            <button onclick="deleteRef(${item.id})" class="text-manifest-burgundy text-[9px] tracking-widest font-bold uppercase bg-red-100/50 hover:bg-red-100 border border-red-200/40 px-4 py-2 rounded-full transition-all cursor-pointer shadow-none">
                                <i class="fa-solid fa-trash-can mr-1"></i> Hapus
                            </button>
                        </td>
                    </tr>
                `;
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