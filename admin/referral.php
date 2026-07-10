<?php
require_once __DIR__ . '/bootstrap.php';
manifest_start_admin_session();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: ' . manifest_admin_url('login'), true, 302);
    exit;
}

$adminHomeUrl = manifest_admin_url();
$adminReferralUrl = manifest_admin_url('referral');
$adminApiBaseUrl = manifest_admin_api_url();
?>

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
                <a href="<?= htmlspecialchars($adminHomeUrl, ENT_QUOTES, 'UTF-8') ?>" class="flex items-center gap-3 text-manifest-dark/60 hover:text-manifest-dark text-[11px] font-bold uppercase tracking-wider px-4 py-3 rounded-xl transition-all">
                    <i class="fa-solid fa-chart-simple w-4 text-center"></i> Data Pendaftar
                </a>
                <a href="<?= htmlspecialchars($adminReferralUrl, ENT_QUOTES, 'UTF-8') ?>" class="flex items-center gap-3 bg-manifest-dark text-white text-[11px] font-bold uppercase tracking-wider px-4 py-3 rounded-xl transition-all shadow-none">
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
                <p class="text-[10px] text-manifest-dark/40">Konfigurasi kode promo, nominal potongan harga, & limit voucher</p>
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
                        <label class="block text-[10px] font-bold text-manifest-dark/60 uppercase tracking-wider">Nominal Potongan (Rp)</label>
                        <input type="number" name="discount" min="1000" max="10000000" step="1000" inputmode="numeric" placeholder="Contoh: 10000 = Rp10.000" required class="w-full mt-1.5 p-3 border border-manifest-dark/10 rounded-xl text-xs bg-white focus:outline-none focus:border-manifest-rose font-semibold text-manifest-dark placeholder-manifest-dark/30">
                        <p class="mt-1.5 text-[10px] leading-relaxed text-manifest-dark/40">Masukkan angka tanpa titik atau persen. Contoh: <strong>10000</strong> untuk diskon Rp10.000.</p>
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
                                <th class="py-4 px-6">Potongan Harga</th>
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
        const ADMIN_API_BASE = <?= json_encode($adminApiBaseUrl, JSON_UNESCAPED_SLASHES) ?>;
        const rupiahFormatter = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        });

        let masterReferralData = [];

        function escapeHTML(value) {
            const map = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            };

            return String(value ?? '').replace(/[&<>"']/g, character => map[character]);
        }

        function formatRupiah(value) {
            return rupiahFormatter.format(Number(value) || 0);
        }

        async function parseApiResponse(response) {
            const rawResponse = await response.text();
            let data;

            try {
                data = JSON.parse(rawResponse);
            } catch (error) {
                throw new Error('Respons server tidak valid. Pastikan file API referral sudah diperbarui.');
            }

            if (!response.ok || data.status === 'error') {
                throw new Error(data.message || 'Terjadi kesalahan pada sistem referral.');
            }

            return data;
        }

        document.addEventListener('DOMContentLoaded', loadReferrals);
        document.getElementById('refSearchInput').addEventListener('input', renderTableGrid);

        // Ambil daftar kode referral dari API admin.
        async function loadReferrals() {
            try {
                const response = await fetch(ADMIN_API_BASE + 'referral?action=list', {
                    headers: { 'Accept': 'application/json' }
                });

                const data = await parseApiResponse(response);
                masterReferralData = Array.isArray(data) ? data : [];
                renderTableGrid();
            } catch (error) {
                console.error('Sistem gagal memuat data kupon:', error);
                document.getElementById('referralList').innerHTML = `
                    <tr>
                        <td colspan="3" class="text-center py-20 text-manifest-burgundy/70 font-medium">
                            ${escapeHTML(error.message)}
                        </td>
                    </tr>
                `;
            }
        }

        // Render tabel referral serta pencarian kode secara langsung di browser.
        function renderTableGrid() {
            const tbody = document.getElementById('referralList');
            const keyword = document.getElementById('refSearchInput').value.trim().toLowerCase();
            const filteredData = masterReferralData.filter(item =>
                String(item.code || '').toLowerCase().includes(keyword)
            );

            if (filteredData.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="3" class="text-center py-20 text-manifest-dark/30 font-accent italic text-lg">
                            Tidak ada kode kupon yang sesuai.
                        </td>
                    </tr>
                `;
                return;
            }

            tbody.innerHTML = filteredData.map(item => {
                const referralId = Number(item.id) || 0;
                const referralCode = escapeHTML(item.code);
                const discountAmount = formatRupiah(item.discount_amount);

                return `
                    <tr class="hover:bg-white/40 transition-all border-b border-manifest-dark/[0.02]">
                        <td class="py-4 px-8 font-bold text-manifest-dark tracking-wider uppercase text-xs">${referralCode}</td>
                        <td class="py-4 px-6 font-semibold text-manifest-rose text-xs">${discountAmount}</td>
                        <td class="py-4 px-8 text-right">
                            <button type="button" onclick="deleteRef(${referralId})" class="text-manifest-burgundy text-[9px] tracking-widest font-bold uppercase bg-red-100/50 hover:bg-red-100 border border-red-200/40 px-4 py-2 rounded-full transition-all cursor-pointer shadow-none">
                                <i class="fa-solid fa-trash-can mr-1"></i> Hapus
                            </button>
                        </td>
                    </tr>
                `;
            }).join('');
        }

        // Tambahkan kode referral baru dengan nominal rupiah.
        document.getElementById('addRefForm').addEventListener('submit', async function(event) {
            event.preventDefault();

            const submitButton = this.querySelector('button[type="submit"]');
            const originalButtonText = submitButton.innerHTML;
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-1"></i> Menyimpan...';

            try {
                const formData = new FormData(this);
                const response = await fetch(ADMIN_API_BASE + 'referral?action=add', {
                    method: 'POST',
                    body: formData,
                    headers: { 'Accept': 'application/json' }
                });

                const data = await parseApiResponse(response);
                alert(data.message);
                this.reset();
                await loadReferrals();
            } catch (error) {
                console.error('Gagal menambah referral:', error);
                alert(error.message);
            } finally {
                submitButton.disabled = false;
                submitButton.innerHTML = originalButtonText;
            }
        });

        // Hapus kode referral.
        async function deleteRef(id) {
            if (!Number.isInteger(Number(id)) || Number(id) <= 0) {
                alert('ID referral tidak valid.');
                return;
            }

            if (!confirm('Apakah Anda yakin ingin menghapus kode referral ini?')) {
                return;
            }

            try {
                const formData = new FormData();
                formData.append('id', String(id));

                const response = await fetch(ADMIN_API_BASE + 'referral?action=delete', {
                    method: 'POST',
                    body: formData,
                    headers: { 'Accept': 'application/json' }
                });

                const data = await parseApiResponse(response);
                alert(data.message);
                await loadReferrals();
            } catch (error) {
                console.error('Gagal menghapus referral:', error);
                alert(error.message);
            }
        }
    </script>
</body>
</html>