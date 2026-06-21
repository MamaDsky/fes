<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Registration Hub — MANIFEST 2026</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
    
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
                            dark: '#220701',       
                            cream: '#D8CEA8',      
                            burgundy: '#520000',   
                            rose: '#9C4F51',       
                            milk: '#F5F0E3',       
                        },
                        cream: '#F5F0E3',
                        ink: '#220701',
                    }
                }
            }
        }
    </script>
    
    <style>
        @font-face {
            font-family: 'Alte Haas Grotesk';
            src: local('Alte Haas Grotesk');
            font-weight: 400 700;
            font-style: normal;
        }
        body {
            letter-spacing: -0.01em;
        }
        .gsm-texture {
            position: fixed; inset: 0; z-index: 9999; pointer-events: none; opacity: 0.35; mix-blend-mode: multiply;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.15'/%3E%3C/svg%3E");
        }
        .music-staff {
            position: absolute; inset: 0; z-index: 0; pointer-events: none;
            background-image: repeating-linear-gradient(to bottom, transparent, transparent 19%, rgba(82, 0, 0, 0.02) 19%, rgba(82, 0, 0, 0.02) 20%);
            background-size: 100% 20vh;
        }
        .step-content { display: none; }
        .step-content.active { display: block; animation: fadeIn 0.5s ease forwards; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .glass-panel {
            background: rgba(245, 240, 227, 0.4);
            backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(34, 7, 1, 0.05);
        }
        .input-premium {
            background: rgba(255, 255, 255, 0.5);
            border: 1px solid rgba(34, 7, 1, 0.08);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .input-premium:focus {
            background: rgba(255, 255, 255, 0.85);
            border-color: #9C4F51;
            box-shadow: 0 0 0 3px rgba(156, 79, 81, 0.1);
            outline: none;
        }
        /* Custom Toast Animation */
        #customToast {
            transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.4s ease;
        }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #F5F0E3; }
        ::-webkit-scrollbar-thumb { background: #220701; border-radius: 10px; }
    </style>
</head>
<body class="bg-cream text-ink font-body antialiased min-h-screen flex flex-col relative selection:bg-manifest-burgundy selection:text-white pb-12">

    <div class="gsm-texture"></div>
    <div class="music-staff opacity-20"></div>

    <!-- Background Decorative Glow -->
    <div class="absolute top-0 right-0 w-[50vw] h-[50vw] bg-manifest-rose/[0.03] rounded-full blur-[140px] pointer-events-none -z-10"></div>
    <div class="absolute bottom-0 left-0 w-[40vw] h-[40vw] bg-manifest-cream/[0.1] rounded-full blur-[120px] pointer-events-none -z-10"></div>

    <!-- === TOAST ALERT KUSTOM (POJOK KANAN ATAS) === -->
    <div id="customToast" class="fixed top-24 right-4 md:right-12 z-[10000] pointer-events-none opacity-0 -translate-y-8 w-[calc(100%-2rem)] sm:w-auto sm:max-w-md">
        <div class="glass-panel rounded-2xl px-5 py-4 shadow-xl border border-manifest-dark/10 flex items-center gap-3.5">
            <div id="toastIcon" class="w-5 h-5 shrink-0 flex items-center justify-center font-bold text-xs rounded-full"></div>
            <p id="toastMessage" class="text-xs font-heading font-bold uppercase tracking-wider text-ink leading-relaxed"></p>
        </div>
    </div>

    <!-- === NAVBAR === -->
    <header class="fixed w-full top-4 z-50 px-4 md:px-12 transition-all duration-300" id="navbar">
        <div class="max-w-[1440px] mx-auto glass-panel rounded-full px-6 py-3 flex justify-between items-center shadow-xs">
            <a href="index.html" class="font-heading text-xl md:text-2xl font-bold flex items-center gap-1 text-ink tracking-tighter">
                MANIFEST<span class="text-manifest-rose leading-none">.</span>
            </a>
            <div class="flex gap-4 md:gap-6 text-[10px] md:text-xs font-heading font-bold uppercase tracking-widest text-ink/60">
                <a href="index.html" class="hover:text-manifest-burgundy transition-colors">Beranda</a>
                <a href="index.html#faq" class="hover:text-manifest-burgundy transition-colors">FAQ</a>
            </div>
        </div>
    </header>

    <!-- === MAIN REGISTRATION CONTAINER === -->
    <main class="w-full max-w-4xl mx-auto px-4 md:px-8 pt-28 md:pt-36 flex-1 flex flex-col justify-center relative z-10">
        
        <!-- Header Terintegrasi Halaman -->
        <div class="text-center mb-8 md:mb-12">
            <div class="inline-flex items-center gap-2 rounded-full border border-manifest-dark/10 bg-white/45 px-4 py-1.5 text-[9px] md:text-[10px] font-heading font-bold uppercase tracking-[0.24em] text-ink/50 mb-4">
                <span class="w-1.5 h-1.5 rounded-full bg-manifest-rose"></span>
                Registration Dashboard
            </div>
            <h1 class="font-heading font-bold text-3xl md:text-5xl tracking-tight text-ink" id="main-title">Pendaftaran Kompetisi</h1>
            <p class="font-accent italic text-lg md:text-2xl text-manifest-burgundy/80 mt-1">The Symphony of Business</p>
        </div>

        <!-- Progress Step Tracker Minimalis -->
        <div class="flex items-center justify-between mb-10 md:mb-14 px-4 max-w-sm mx-auto w-full">
            <div class="flex items-center gap-3">
                <div id="dot-1" class="w-8 h-8 rounded-full bg-manifest-dark text-white text-xs font-heading font-bold flex items-center justify-center transition-all border border-manifest-dark/10 shadow-xs">1</div>
                <span class="hidden sm:inline text-[10px] font-heading font-bold uppercase tracking-wider text-ink">Kategori</span>
            </div>
            <div class="flex-1 h-[1px] bg-manifest-dark/10 mx-4"></div>
            <div class="flex items-center gap-3">
                <div id="dot-2" class="w-8 h-8 rounded-full bg-white/60 text-ink/40 text-xs font-heading font-bold flex items-center justify-center transition-all border border-manifest-dark/5">2</div>
                <span class="hidden sm:inline text-[10px] font-heading font-bold uppercase tracking-wider text-ink/40">Data Tim</span>
            </div>
            <div class="flex-1 h-[1px] bg-manifest-dark/10 mx-4"></div>
            <div class="flex items-center gap-3">
                <div id="dot-3" class="w-8 h-8 rounded-full bg-white/60 text-ink/40 text-xs font-heading font-bold flex items-center justify-center transition-all border border-manifest-dark/5">3</div>
                <span class="hidden sm:inline text-[10px] font-heading font-bold uppercase tracking-wider text-ink/40">Berkas</span>
            </div>
        </div>

        <!-- Form Registration -->
        <form id="upgradeRegForm" enctype="multipart/form-data" class="space-y-8">
            
            <!-- STEP 0: SELEKSI KATEGORI -->
            <div id="step-0" class="step-content active space-y-6">
                <h3 class="font-heading text-[11px] font-bold uppercase tracking-widest text-ink/50 text-center mb-6">Silakan Pilih Cabang Kompetisi:</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <label class="bg-white/30 border border-manifest-dark/5 rounded-2xl p-6 block cursor-pointer hover:border-manifest-rose/50 hover:bg-white/70 transition-all text-center group relative overflow-hidden shadow-xs">
                        <input type="radio" name="competition_type" value="BPC" class="sr-only" onclick="selectCompetition('BPC')">
                        <div class="font-heading text-2xl font-bold text-ink tracking-tight">BPC</div>
                        <div class="font-accent italic text-sm text-manifest-rose mt-0.5">Business Plan Competition</div>
                        <p class="text-[10px] text-ink/40 mt-4 border-t border-manifest-dark/5 pt-3 uppercase tracking-wider font-bold">Tingkat Nasional (ID)</p>
                    </label>
                    <label class="bg-white/30 border border-manifest-dark/5 rounded-2xl p-6 block cursor-pointer hover:border-manifest-rose/50 hover:bg-white/70 transition-all text-center group relative overflow-hidden shadow-xs">
                        <input type="radio" name="competition_type" value="BCC" class="sr-only" onclick="selectCompetition('BCC')">
                        <div class="font-heading text-2xl font-bold text-ink tracking-tight">BCC</div>
                        <div class="font-accent italic text-sm text-manifest-rose mt-0.5">Business Case Competition</div>
                        <p class="text-[10px] text-ink/40 mt-4 border-t border-manifest-dark/5 pt-3 uppercase tracking-wider font-bold">Tingkat Nasional (ID)</p>
                    </label>
                    <label class="bg-white/30 border border-manifest-dark/5 rounded-2xl p-6 block cursor-pointer hover:border-manifest-rose/50 hover:bg-white/70 transition-all text-center group relative overflow-hidden shadow-xs">
                        <input type="radio" name="competition_type" value="EBPC" class="sr-only" onclick="selectCompetition('EBPC')">
                        <div class="font-heading text-2xl font-bold text-manifest-burgundy tracking-tight">EBPC</div>
                        <div class="font-accent italic text-sm text-manifest-rose mt-0.5">Int. Business Plan</div>
                        <p class="text-[10px] text-manifest-burgundy/60 mt-4 border-t border-manifest-dark/5 pt-3 uppercase tracking-wider font-bold">International (EN)</p>
                    </label>
                </div>
            </div>

            <!-- STEP 1: DATA TIM & ANGGOTA -->
            <div id="step-1" class="step-content space-y-6">
                <div class="bg-white/30 p-5 rounded-2xl border border-manifest-dark/5 shadow-xs">
                    <label class="block text-[9px] font-heading font-bold uppercase text-ink/50 tracking-widest">Nama Tim</label>
                    <input type="text" name="team_name" id="field_team_name" class="w-full mt-2 p-3.5 rounded-xl input-premium text-sm font-medium text-ink" placeholder="Contoh: Tim Manifest Juara">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- KETUA TIM -->
                    <div class="bg-white/30 p-5 rounded-2xl border border-manifest-dark/5 space-y-4 shadow-xs">
                        <h4 class="font-heading font-bold text-ink text-xs uppercase tracking-wider border-b border-manifest-dark/5 pb-2.5 flex items-center justify-between">
                            <span>Ketua Tim (Member 1)</span>
                            <span class="w-1.5 h-1.5 rounded-full bg-manifest-rose"></span>
                        </h4>
                        <input type="text" name="leader_name" id="field_leader_name" placeholder="Nama Lengkap" class="w-full p-3 rounded-xl input-premium text-sm font-medium text-ink">
                        <input type="text" name="leader_school" id="field_leader_school" placeholder="Asal Sekolah / Instansi" class="w-full p-3 rounded-xl input-premium text-sm font-medium text-ink">
                        <select name="leader_grade" class="w-full p-3 rounded-xl input-premium text-sm font-medium text-ink/70 bg-white/60">
                            <option value="10">Kelas 10 / Grade 10</option>
                            <option value="11">Kelas 11 / Grade 11</option>
                            <option value="12">Kelas 12 / Grade 12</option>
                        </select>
                        
                        <div class="relative border border-dashed border-manifest-dark/20 rounded-xl p-3.5 bg-white/20 text-center hover:bg-white/60 transition-all cursor-pointer">
                            <input type="file" name="leader_id_scan" accept=".pdf" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="updateFileName(this)">
                            <span class="text-[11px] text-ink/60 font-bold block truncate pointer-events-none">Scan Kartu Pelajar (PDF)</span>
                        </div>
                        <input type="text" name="leader_whatsapp" id="field_leader_wa" placeholder="Nomor WhatsApp (e.g. 0895...)" class="w-full p-3 rounded-xl input-premium text-sm font-medium text-ink">
                    </div>

                    <!-- ANGGOTA 2 -->
                    <div class="bg-white/30 p-5 rounded-2xl border border-manifest-dark/5 space-y-4 shadow-xs">
                        <h4 class="font-heading font-bold text-ink text-xs uppercase tracking-wider border-b border-manifest-dark/5 pb-2.5 flex items-center justify-between">
                            <span>Anggota Tim 2</span>
                            <span class="w-1.5 h-1.5 rounded-full bg-manifest-cream"></span>
                        </h4>
                        <input type="text" name="member_name" id="field_member_name" placeholder="Nama Lengkap" class="w-full p-3 rounded-xl input-premium text-sm font-medium text-ink">
                        <input type="text" name="member_school" id="field_member_school" placeholder="Asal Sekolah / Instansi" class="w-full p-3 rounded-xl input-premium text-sm font-medium text-ink">
                        <select name="member_grade" class="w-full p-3 rounded-xl input-premium text-sm font-medium text-ink/70 bg-white/60">
                            <option value="10">Kelas 10 / Grade 10</option>
                            <option value="11">Kelas 11 / Grade 11</option>
                            <option value="12">Kelas 12 / Grade 12</option>
                        </select>
                        
                        <div class="relative border border-dashed border-manifest-dark/20 rounded-xl p-3.5 bg-white/20 text-center hover:bg-white/60 transition-all cursor-pointer">
                            <input type="file" name="member_id_scan" accept=".pdf" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="updateFileName(this)">
                            <span class="text-[11px] text-ink/60 font-bold block truncate pointer-events-none">Scan Kartu Pelajar (PDF)</span>
                        </div>
                        <input type="text" name="member_whatsapp" id="field_member_wa" placeholder="Nomor WhatsApp (e.g. 0895...)" class="w-full p-3 rounded-xl input-premium text-sm font-medium text-ink">
                    </div>
                </div>

                <div class="flex justify-between items-center pt-6 border-t border-manifest-dark/5">
                    <button type="button" onclick="goToStep(0)" class="text-[10px] font-heading font-bold uppercase tracking-wider text-ink/40 hover:text-manifest-burgundy transition-colors">← Kembali Pilih Kategori</button>
                    <button type="button" onclick="validateAndNext(2)" class="bg-manifest-dark text-white font-heading font-bold text-xs uppercase tracking-widest px-7 py-3 rounded-full hover:bg-manifest-rose transition-all shadow-md">Lanjutkan</button>
                </div>
            </div>

            <!-- STEP 2: ADMINISTRASI & TRANSAKSI -->
            <div id="step-2" class="step-content space-y-6">
                <div class="bg-white/30 p-5 rounded-2xl border border-manifest-dark/5 space-y-4 shadow-xs">
                    <div>
                        <label class="block text-[9px] font-heading font-bold uppercase text-ink/50 tracking-widest">Nama Pemilik Rekening Pengirim</label>
                        <input type="text" name="account_holder" id="field_holder" class="w-full mt-2 p-3.5 rounded-xl input-premium text-sm font-medium text-ink" placeholder="Nama Sesuai Rekening Bank/E-Wallet">
                    </div>

                    <div>
                        <label class="block text-[9px] font-heading font-bold uppercase text-ink/50 tracking-widest mb-2.5">Pilih Metode Pembayaran</label>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                            <label class="border border-manifest-dark/10 rounded-xl p-3 text-center block cursor-pointer bg-white/20 hover:bg-white/60 transition-all select-none">
                                <input type="radio" name="payment_method" value="Bank Mandiri" class="accent-manifest-rose" checked> <span class="text-xs font-bold text-ink/80 ml-1">Mandiri</span>
                            </label>
                            <label class="border border-manifest-dark/10 rounded-xl p-3 text-center block cursor-pointer bg-white/20 hover:bg-white/60 transition-all select-none">
                                <input type="radio" name="payment_method" value="Bank BRI" class="accent-manifest-rose"> <span class="text-xs font-bold text-ink/80 ml-1">BRI</span>
                            </label>
                            <label class="border border-manifest-dark/10 rounded-xl p-3 text-center block cursor-pointer bg-white/20 hover:bg-white/60 transition-all select-none">
                                <input type="radio" name="payment_method" value="ShopeePay" class="accent-manifest-rose"> <span class="text-xs font-bold text-ink/80 ml-1">ShopeePay</span>
                            </label>
                            <label class="border border-manifest-dark/10 rounded-xl p-3 text-center block cursor-pointer bg-white/20 hover:bg-white/60 transition-all select-none">
                                <input type="radio" name="payment_method" value="QRIS" class="accent-manifest-rose"> <span class="text-xs font-bold text-ink/80 ml-1">QRIS</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Kode Promo & Summary Tagihan -->
                <div class="p-6 bg-white/40 border border-manifest-dark/5 rounded-2xl flex flex-col sm:flex-row sm:items-center justify-between gap-6 shadow-xs">
                    <div class="space-y-1">
                        <label class="block text-[9px] font-heading font-bold uppercase text-ink/50 tracking-widest">Gunakan Voucher / Kode Referral</label>
                        <div class="flex gap-2 mt-2">
                            <input type="text" id="ref_field" name="referral_code" placeholder="Kode Promo" class="p-2.5 rounded-xl input-premium text-xs uppercase font-bold w-36 tracking-wider">
                            <button type="button" onclick="verifyReferral()" class="bg-manifest-rose text-white text-[10px] font-heading font-bold uppercase tracking-wider px-4 py-2 rounded-xl hover:bg-manifest-burgundy transition-colors">Terapkan</button>
                        </div>
                        <p id="ref_message" class="text-[11px] font-bold mt-1 text-ink/40"></p>
                    </div>
                    <div class="text-left sm:text-right border-t border-dashed border-manifest-dark/10 sm:border-0 pt-4 sm:pt-0">
                        <span class="text-[9px] font-heading font-bold uppercase tracking-widest text-ink/40 block">Total Tagihan Transaksi:</span>
                        <span id="display_amount" class="text-3xl font-heading font-bold text-manifest-burgundy tracking-tight">Rp 150.000</span>
                    </div>
                </div>

                <!-- Unggah Bukti Transaksi -->
                <div class="space-y-2">
                    <label class="block text-[9px] font-heading font-bold uppercase text-ink/50 tracking-widest">Unggah Bukti Transaksi Resmi (JPG/PNG)</label>
                    <div class="relative border-2 border-dashed border-manifest-rose/20 rounded-2xl p-6 bg-white/20 text-center hover:bg-white/50 transition-all cursor-pointer">
                        <input type="file" name="payment_proof" id="field_proof" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="updateFileName(this)">
                        <span class="text-xs text-manifest-rose font-bold block pointer-events-none">Pilih Gambar Bukti Bayar</span>
                        <span class="text-[10px] text-ink/40 mt-1 block font-medium">Format berkas didukung: PNG, JPG, JPEG maks 5MB</span>
                    </div>
                </div>

                <div class="flex justify-between items-center pt-6 border-t border-manifest-dark/5">
                    <button type="button" onclick="goToStep(1)" class="bg-white/40 text-ink/60 border border-manifest-dark/5 font-heading font-bold text-xs uppercase tracking-wider px-5 py-3 rounded-full hover:bg-white transition-all">Kembali</button>
                    <button type="button" onclick="validateAndNext(3)" class="bg-manifest-dark text-white font-heading font-bold text-xs uppercase tracking-widest px-7 py-3 rounded-full hover:bg-manifest-rose transition-all shadow-md">Lanjutkan</button>
                </div>
            </div>

            <!-- STEP 3: SUBMISI PERSYARATAN BERKAS TAMBAHAN -->
            <div id="step-3" class="step-content space-y-6">
                <div class="p-4 bg-manifest-burgundy/5 border border-manifest-burgundy/10 rounded-2xl text-manifest-burgundy text-[11px] font-medium leading-relaxed">
                    ⚠️ <strong>Pemberitahuan Berkas Singkat:</strong> Untuk syarat di bawah ini, kumpulkan bukti screenshot milik seluruh anggota tim Anda lalu gabungkan (merge) menjadi satu file berformat PDF.
                </div>

                <div class="space-y-3">
                    <!-- Instagram Follow -->
                    <div class="flex items-center justify-between p-4 bg-white/30 border border-manifest-dark/5 rounded-2xl shadow-xs">
                        <div class="max-w-[65%] sm:max-w-[75%]">
                            <span class="text-xs font-bold text-ink block">Bukti Follow Instagram @manifest_its</span>
                            <span class="text-[10px] text-ink/40 block truncate font-medium file-name-display mt-0.5">Belum ada file dipilih</span>
                        </div>
                        <label class="bg-manifest-dark text-white text-[10px] font-heading font-bold uppercase tracking-wider px-3.5 py-2.5 rounded-xl cursor-pointer hover:bg-manifest-rose transition-colors shrink-0">
                            Pilih PDF <input type="file" name="proof_follow_ig" id="field_ig" accept=".pdf" class="sr-only" onchange="updateInlineFileName(this)">
                        </label>
                    </div>

                    <!-- Repost Feeds -->
                    <div class="flex items-center justify-between p-4 bg-white/30 border border-manifest-dark/5 rounded-2xl shadow-xs">
                        <div class="max-w-[65%] sm:max-w-[75%]">
                            <span class="text-xs font-bold text-ink block">Bukti Repost Feeds Kompetisi</span>
                            <span class="text-[10px] text-ink/40 block truncate font-medium file-name-display mt-0.5">Belum ada file dipilih</span>
                        </div>
                        <label class="bg-manifest-dark text-white text-[10px] font-heading font-bold uppercase tracking-wider px-3.5 py-2.5 rounded-xl cursor-pointer hover:bg-manifest-rose transition-colors shrink-0">
                            Pilih PDF <input type="file" name="proof_repost_feed" id="field_feed" accept=".pdf" class="sr-only" onchange="updateInlineFileName(this)">
                        </label>
                    </div>

                    <!-- Twibbon -->
                    <div class="flex items-center justify-between p-4 bg-white/30 border border-manifest-dark/5 rounded-2xl shadow-xs">
                        <div class="max-w-[65%] sm:max-w-[75%]">
                            <span class="text-xs font-bold text-ink block">Bukti Upload Twibbon Kegiatan</span>
                            <span class="text-[10px] text-ink/40 block truncate font-medium file-name-display mt-0.5">Belum ada file dipilih</span>
                        </div>
                        <label class="bg-manifest-dark text-white text-[10px] font-heading font-bold uppercase tracking-wider px-3.5 py-2.5 rounded-xl cursor-pointer hover:bg-manifest-rose transition-colors shrink-0">
                            Pilih PDF <input type="file" name="proof_twibbon" id="field_twibbon" accept=".pdf" class="sr-only" onchange="updateInlineFileName(this)">
                        </label>
                    </div>
                </div>

                <div class="flex justify-between items-center pt-6 border-t border-manifest-dark/5">
                    <button type="button" onclick="goToStep(2)" class="bg-white/40 text-ink/60 border border-manifest-dark/5 font-heading font-bold text-xs uppercase tracking-wider px-5 py-3 rounded-full hover:bg-white transition-all">Kembali</button>
                    <button type="submit" id="btnSubmitForm" class="bg-manifest-burgundy text-white font-heading font-bold text-xs uppercase tracking-widest px-8 py-3 rounded-full hover:bg-manifest-rose transition-all shadow-md">KIRIM PENDAFTARAN</button>
                </div>
            </div>
        </form>
    </main>

    <script>
        let currentStep = 0;

        // --- SISTEM TOAST ALERT ATAS ---
        function showToast(message, type = 'error') {
            const toast = document.getElementById('customToast');
            const toastMsg = document.getElementById('toastMessage');
            const toastIcon = document.getElementById('toastIcon');

            toastMsg.textContent = message;

            if (type === 'error') {
                toastIcon.textContent = '✕';
                toastIcon.className = "w-5 h-5 shrink-0 flex items-center justify-center font-bold text-xs rounded-full bg-manifest-burgundy text-white";
            } else if (type === 'success') {
                toastIcon.textContent = '✓';
                toastIcon.className = "w-5 h-5 shrink-0 flex items-center justify-center font-bold text-xs rounded-full bg-manifest-rose text-white";
            }

            // Animate In (Dari atas ke bawah)
            toast.classList.remove('opacity-0', 'pointer-events-none', '-translate-y-8');
            toast.classList.add('opacity-100', 'translate-y-0');

            // Animate Out setelah 4 detik
            setTimeout(() => {
                toast.classList.add('opacity-0', '-translate-y-8');
                toast.classList.remove('opacity-100', 'translate-y-0');
                setTimeout(() => {
                    toast.classList.add('pointer-events-none');
                }, 500);
            }, 4000);
        }

        function selectCompetition(type) {
            document.getElementById('main-title').textContent = "Pendaftaran Lomba — " + type;
            goToStep(1);
        }

        function goToStep(step) {
            document.querySelectorAll('.step-content').forEach(el => el.classList.remove('active'));
            document.getElementById('step-' + step).classList.add('active');
            currentStep = step;

            for (let i = 1; i <= 3; i++) {
                const dot = document.getElementById('dot-' + i);
                if (dot) {
                    if (i <= step) {
                        dot.className = "w-8 h-8 rounded-full bg-manifest-dark text-white text-xs font-heading font-bold flex items-center justify-center transition-all border border-manifest-dark/10 shadow-xs";
                    } else {
                        dot.className = "w-8 h-8 rounded-full bg-white/60 text-ink/40 text-xs font-heading font-bold flex items-center justify-center transition-all border border-manifest-dark/5";
                    }
                }
            }
        }

        function validateAndNext(nextStepTarget) {
            if (currentStep === 1) {
                const team = document.getElementById('field_team_name').value.trim();
                const lName = document.getElementById('field_leader_name').value.trim();
                const lSchool = document.getElementById('field_leader_school').value.trim();
                const lWa = document.getElementById('field_leader_wa').value.trim();
                const mName = document.getElementById('field_member_name').value.trim();
                const mSchool = document.getElementById('field_member_school').value.trim();
                const mWa = document.getElementById('field_member_wa').value.trim();

                if (!team || !lName || !lSchool || !lWa || !mName || !mSchool || !mWa) {
                    showToast("Mohon lengkapi seluruh data tim dan anggota kelompok Anda!");
                    return;
                }
            } 
            
            if (currentStep === 2) {
                const holder = document.getElementById('field_holder').value.trim();
                const proofFile = document.getElementById('field_proof').files.length;
                if (!holder || proofFile === 0) {
                    showToast("Harap isi nama pemilik rekening dan lampirkan bukti pembayaran!");
                    return;
                }
            }

            goToStep(nextStepTarget);
        }

        function updateFileName(input) {
            const container = input.closest('div');
            const labelSpan = container.querySelector('span');
            if (input.files.length > 0) {
                labelSpan.textContent = "✔ " + input.files[0].name;
                labelSpan.className = "text-[11px] text-manifest-rose font-bold block truncate pointer-events-none";
            }
        }

        function updateInlineFileName(input) {
            const row = input.closest('div');
            const displaySpan = row.querySelector('.file-name-display');
            if (input.files.length > 0) {
                displaySpan.textContent = "✔ " + input.files[0].name;
                displaySpan.className = "text-[10px] text-manifest-rose font-bold block truncate file-name-display mt-0.5";
            }
        }

        function verifyReferral() {
            const code = document.getElementById('ref_field').value;
            const formData = new FormData();
            formData.append('referral_code', code);

            fetch('api/user/check_promo.php', { method: 'POST', body: formData })
            .then(res => res.json())
            .then(data => {
                const msgBox = document.getElementById('ref_message');
                msgBox.textContent = data.message;
                if(data.status === 'success') {
                    msgBox.className = "text-[11px] font-bold mt-1 text-manifest-rose";
                    document.getElementById('display_amount').textContent = "Rp " + data.final_amount.toLocaleString('id-ID');
                    showToast("Kode promo berhasil diterapkan!", "success");
                } else {
                    msgBox.className = "text-[11px] font-bold mt-1 text-manifest-burgundy/80";
                    document.getElementById('display_amount').textContent = "Rp 150.000";
                    showToast(data.message || "Kode promo tidak valid.");
                }
            });
        }

        document.getElementById('upgradeRegForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!document.getElementById('field_ig').files.length || 
                !document.getElementById('field_feed').files.length || 
                !document.getElementById('field_twibbon').files.length) {
                showToast("Tolong lengkapi seluruh upload berkas persyaratan tambahan di halaman 3!");
                return;
            }

            const btn = document.getElementById('btnSubmitForm');
            btn.disabled = true;
            btn.textContent = "Memproses...";

            const formData = new FormData(this);
            const compSelected = document.querySelector('input[name="competition_type"]:checked').value;
            formData.append('competition_type', compSelected);

            fetch('api/user/apply.php', { method: 'POST', body: formData })
            .then(res => res.json())
            .then(data => {
                if(data.status === 'success') {
                    showToast("Pendaftaran berhasil terkirim!", "success");
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                } else {
                    showToast(data.message || "Gagal memproses pendaftaran.");
                    btn.disabled = false;
                    btn.textContent = "KIRIM PENDAFTARAN";
                }
            })
            .catch(err => {
                console.error(err);
                showToast("Terjadi masalah koneksi ke server.");
                btn.disabled = false;
                btn.textContent = "KIRIM PENDAFTARAN";
            });
        });
    </script>
</body>
</html>