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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        heading: ['"Alte Haas Grotesk"', 'Arial', 'sans-serif'],
                        body: ['"Alte Haas Grotesk"', 'Arial', 'sans-serif'],
                        accent: ['"Instrument Serif"', 'serif'],
                        script: ['"Griffith"', '"Times New Roman"', 'serif'],
                    },
                    colors: {
                        manifest: {
                            dark: '#120200',       
                            cream: '#FFFBEB',      
                            burgundy: '#420000',   
                            rose: '#E57373',       
                            sage: '#C3E2C2',       
                            forest: '#1F312F',     
                            navy: '#1B3162',       
                            sky: '#B9E0FF',        
                            grey: '#E2E8F0',       
                            milk: '#FFFFFF',       
                        },
                        cream: '#FFFBEB',          
                        ink: '#220701',            
                    }
                }
            }
        }
    </script>
    
    <style>
        html, body {
            overflow-x: hidden; width: 100%; max-width: 100vw; position: relative;
        }

        @font-face {
            font-family: 'Alte Haas Grotesk';
            src: local('Alte Haas Grotesk');
            font-weight: 400 700;
            font-style: normal;
        }
        @font-face {
            font-family: 'Griffith';
            src: local('Griffith');
            font-weight: 400;
            font-style: normal;
        }

        body {
            letter-spacing: -0.01em;
        }

        .gsm-texture {
            position: fixed; inset: 0; z-index: 9999; pointer-events: none; opacity: 0.25; mix-blend-mode: multiply;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.15'/%3E%3C/svg%3E");
        }

        .curtain-container {
            position: fixed; inset: 0; z-index: 99999; display: flex; pointer-events: none;
        }
        .curtain-panel {
            width: 50%; height: 100%;
            background: linear-gradient(90deg, #0a0a0a 0%, #151515 25%, #220701 50%, #151515 75%, #0a0a0a 100%);
            background-size: 200% 100%;
            transition: transform 2.8s cubic-bezier(0.77, 0, 0.175, 1), border-radius 2.8s cubic-bezier(0.77, 0, 0.175, 1);
            display: flex; align-items: center; box-shadow: 0 0 50px rgba(0,0,0,0.9);
        }
        .curtain-left { transform-origin: bottom left; justify-content: flex-end; border-right: 1px solid rgba(82, 0, 0, 0.2); }
        .curtain-right { transform-origin: bottom right; justify-content: flex-start; background-position: right center; }
        .curtain-content-wrapper {
            position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);
            display: flex; flex-direction: column; align-items: center; transition: opacity 0.8s ease; z-index: 100000;
        }
        .curtain-loader {
            width: 80px; height: 1px; background: rgba(255,255,255,0.1); position: relative; overflow: hidden;
        }
        .curtain-loader::after {
            content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 40%; background: #9C4F51;
            animation: loadingBar 1.5s ease-in-out infinite alternate;
        }
        @keyframes loadingBar { 0% { transform: translateX(-100%); } 100% { transform: translateX(300%); } }
        
        body.loaded .curtain-left { 
            transform: translateX(-150%) skewX(-8deg); 
            border-bottom-right-radius: 50vw 80vh; 
        }
        body.loaded .curtain-right { 
            transform: translateX(150%) skewX(8deg); 
            border-bottom-left-radius: 50vw 80vh; 
        }
        body.loaded .curtain-content-wrapper { opacity: 0; pointer-events: none; }

        .music-staff {
            position: absolute; inset: 0; z-index: 1; pointer-events: none;
            background-image: repeating-linear-gradient(to bottom, transparent, transparent 15.5%, rgba(255, 255, 255, 0.015) 15.5%, rgba(255, 255, 255, 0.015) 16%);
            background-size: 100% 15vh;
        }

        .step-content { display: none; }
        .step-content.active { display: block; animation: fadeIn 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .manifest-soft-card {
            background: linear-gradient(180deg, rgba(255,255,255,0.85), rgba(245, 240, 227, 0.5));
            border: 1px solid rgba(34, 7, 1, 0.06); box-shadow: 0 16px 40px rgba(34, 7, 1, 0.04);
            backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px);
        }
        .manifest-soft-card:hover { transform: translateY(-2px); box-shadow: 0 22px 50px rgba(34, 7, 1, 0.07); }

        .nav-daftar-style {
            background: rgba(255, 255, 255, 0.4) !important;
            border: 1px solid rgba(34, 7, 1, 0.08) !important;
            box-shadow: 0 12px 35px rgba(34, 7, 1, 0.04);
        }

        .input-premium {
            background: rgba(255, 255, 255, 0.6);
            border: 1px solid rgba(34, 7, 1, 0.08);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .input-premium:focus {
            background: rgba(255, 255, 255, 0.95);
            border-color: #420000;
            box-shadow: 0 0 0 4px rgba(66, 0, 0, 0.05);
            outline: none;
        }
        #customToast {
            transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.4s ease;
        }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #FFFBEB; }
        ::-webkit-scrollbar-thumb { background: #220701; border-radius: 10px; }
    </style>
</head>
<body class="bg-cream text-ink font-body antialiased min-h-screen flex flex-col relative selection:bg-manifest-burgundy selection:text-white pb-12">

    <div class="gsm-texture"></div>

    <div class="curtain-container" id="curtain">
        <div class="curtain-panel curtain-left"></div>
        <div class="curtain-panel curtain-right"></div>
        <div class="curtain-content-wrapper" id="curtainText">
            <div class="flex items-center gap-6 md:gap-8 mb-6">
                <img src="logomanifest.png" alt="Logo Manifest" class="h-10 md:h-12 object-contain filter brightness-0 invert opacity-90">
                <div class="w-px h-8 md:h-10 bg-white/20"></div>
                <img src="logomb.png" alt="Logo MB" class="h-10 md:h-12 object-contain filter brightness-0 invert opacity-90">
            </div>
            <div class="curtain-loader"></div>
        </div>
    </div>

    <div class="absolute top-0 left-0 w-full h-[60vh] bg-gradient-to-b from-[#500707]/5 to-transparent pointer-events-none -z-10"></div>
    <div class="music-staff opacity-20"></div>

    <div class="absolute top-[-10%] right-0 w-[50vw] max-w-[600px] h-[600px] bg-manifest-rose/[0.03] rounded-full blur-[140px] pointer-events-none -z-10"></div>
    <div class="absolute bottom-0 left-0 w-[40vw] h-[40vw] bg-manifest-cream/[0.1] rounded-full blur-[120px] pointer-events-none -z-10"></div>

    <div id="customToast" class="fixed top-24 right-4 md:right-12 z-[10000] pointer-events-none opacity-0 -translate-y-8 w-[calc(100%-2rem)] sm:w-auto sm:max-w-md">
        <div class="bg-white/95 backdrop-blur-xl rounded-2xl px-5 py-4 shadow-xl border border-manifest-dark/10 flex items-center gap-3.5">
            <div id="toastIcon" class="w-5 h-5 shrink-0 flex items-center justify-center rounded-full"></div>
            <p id="toastMessage" class="text-xs font-heading font-bold uppercase tracking-wider text-ink leading-relaxed"></p>
        </div>
    </div>

    <div id="sidebarOverlay" class="fixed inset-0 bg-manifest-dark/40 backdrop-blur-sm z-[999] opacity-0 pointer-events-none transition-opacity duration-300"></div>
    <div id="mobileSidebar" class="fixed inset-y-0 right-0 w-[85%] sm:w-[400px] bg-cream z-[1000] transform translate-x-full p-8 pt-12 flex flex-col justify-between shadow-[-10px_0_40px_rgba(34,7,1,0.15)] border-l border-white/50 transition-transform duration-300">
        <div class="flex items-center justify-between w-full mb-8 border-b border-manifest-dark/5 pb-4">
            <span class="text-[10px] font-heading font-bold uppercase tracking-widest text-manifest-burgundy flex items-center gap-2">Menu Navigasi</span>
            <button id="closeMenuButton" class="w-8 h-8 flex items-center justify-center rounded-full bg-manifest-dark/5 text-ink hover:bg-manifest-dark/10 focus:outline-none transition-colors">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>
        <nav class="flex flex-col gap-6 relative z-10 flex-grow">
            <div class="sidebar-link link-1">
                <button onclick="toggleSubMenu(event)" class="font-script text-5xl italic text-ink hover:text-manifest-burgundy transition-colors w-full text-left flex justify-between items-center focus:outline-none group">
                    Lomba 
                    <span id="chevron" class="text-xl transition-transform duration-300 text-ink/30 group-hover:text-manifest-burgundy">
                        <i class="fas fa-chevron-down text-lg"></i>
                    </span>
                </button>
                <div id="subMenu" class="max-h-0 overflow-hidden transition-all duration-500 flex flex-col gap-3 mt-3 pl-4 border-l border-manifest-dark/10">
                    <span class="text-[9px] tracking-widest text-ink/40 uppercase font-heading font-extrabold block mb-1">Kategori Lomba</span>
                    <a href="bpc" class="sidebar-anchor font-heading text-xs uppercase tracking-widest text-ink/60 hover:text-manifest-burgundy flex items-center gap-2.5 py-1">Business Plan</a>
                    <a href="bcc" class="sidebar-anchor font-heading text-xs uppercase tracking-widest text-ink/60 hover:text-manifest-burgundy flex items-center gap-2.5 py-1">Business Case</a>
                    <a href="ebpc" class="sidebar-anchor font-heading text-xs uppercase tracking-widest text-ink/60 hover:text-manifest-burgundy flex items-center gap-2.5 py-1">English Business Plan</a>
                </div>
            </div>
            <div class="sidebar-link link-2 py-2">
                <a href="index.html#contact" class="sidebar-anchor font-script text-5xl italic text-ink hover:text-manifest-burgundy transition-colors block">Contact Us</a>
            </div>
        </nav>
        <div class="sidebar-link link-3 flex flex-col gap-6 border-t border-manifest-dark/5 pt-8">
            <a href="daftar" class="sidebar-anchor w-full bg-manifest-dark text-white text-center py-4 font-heading rounded-full text-xs font-bold uppercase tracking-widest hover:bg-manifest-rose transition-colors flex items-center justify-center gap-2 shadow-sm">
                <i class="fas fa-paper-plane text-[10px]"></i> Daftar Sekarang
            </a>
        </div>
    </div>

    <header class="fixed w-full top-5 z-[50] px-4 md:px-12 transition-all duration-500" id="navbar">
        <div id="navInner" class="max-w-[1340px] mx-auto nav-daftar-style backdrop-blur-2xl rounded-full px-6 md:px-8 py-3 flex justify-between items-center transition-all duration-500">
            <a href="index.html" class="font-heading text-xl md:text-2xl font-bold flex items-center gap-1 text-ink tracking-tighter group">
                MANIFEST<span class="text-manifest-burgundy leading-none transition-transform duration-300 group-hover:scale-125">.</span>
            </a>
            
            <div class="hidden md:flex gap-12 text-[11px] font-heading font-bold uppercase tracking-[0.2em] text-ink/80 items-center">
                <div class="relative group cursor-pointer py-2">
                    <span class="hover:text-manifest-burgundy transition-all duration-300 flex items-center gap-2 group-hover:text-manifest-burgundy">
                        Lomba <i class="fas fa-chevron-down text-[8px] transition-transform duration-300 group-hover:rotate-180 text-ink/40 group-hover:text-manifest-burgundy"></i>
                    </span>
                    <div class="absolute top-full right-1/2 translate-x-1/2 pt-3 opacity-0 scale-95 origin-top invisible group-hover:opacity-100 group-hover:scale-100 group-hover:visible transition-all duration-300 pointer-events-none group-hover:pointer-events-auto">
                        <div class="bg-white/95 backdrop-blur-xl p-3 rounded-2xl shadow-[0_25px_50px_rgba(34,7,1,0.08)] w-64 flex flex-col gap-1 border border-manifest-dark/5">
                            <span class="px-3 py-1.5 text-[9px] tracking-widest text-manifest-dark/40 uppercase font-heading font-extrabold border-b border-manifest-dark/5 mb-1 flex items-center gap-1.5">Kategori Lomba</span>
                            <a href="bpc" class="text-[10px] tracking-widest uppercase font-bold text-manifest-dark/80 hover:text-white hover:bg-manifest-dark p-3 rounded-xl flex items-center justify-between transition-all duration-200"><span class="flex items-center gap-3">Business Plan</span><i class="fas fa-arrow-right text-[9px]"></i></a>
                            <a href="bcc" class="text-[10px] tracking-widest uppercase font-bold text-manifest-dark/80 hover:text-white hover:bg-manifest-dark p-3 rounded-xl flex items-center justify-between transition-all duration-200"><span class="flex items-center gap-3">Business Case</span><i class="fas fa-arrow-right text-[9px]"></i></a>
                            <a href="ebpc" class="text-[10px] tracking-widest uppercase font-bold text-manifest-dark/80 hover:text-white hover:bg-manifest-dark p-3 rounded-xl flex items-center justify-between transition-all duration-200"><span class="flex items-center gap-3">English Business Plan</span><i class="fas fa-arrow-right text-[9px]"></i></a>
                        </div>
                    </div>
                </div>
                <a href="index.html#contact" class="hover:text-manifest-burgundy transition-all duration-300 relative group py-2">Contact Us<span class="absolute bottom-0 left-0 w-0 h-[1.5px] bg-manifest-burgundy transition-all duration-300 group-hover:w-full"></span></a>
            </div>

            <div class="hidden md:block">
                <a href="daftar" class="relative inline-flex items-center justify-center bg-manifest-dark text-white px-8 py-3 rounded-full text-[10px] font-heading font-bold uppercase tracking-[0.18em] overflow-hidden transition-all duration-300 hover:bg-manifest-burgundy hover:shadow-[0_10px_25px_rgba(66,0,0,0.15)] hover:-translate-y-0.5">
                    <span class="relative z-10 flex items-center gap-2"><i class="fas fa-paper-plane text-[9px]"></i> Daftar</span>
                </a>
            </div>

            <button id="menuButton" class="block md:hidden relative w-6 h-5 flex flex-col justify-between items-end group focus:outline-none">
                <span class="w-6 h-[1.5px] bg-ink rounded-full"></span>
                <span class="w-4 h-[1.5px] bg-ink rounded-full"></span>
                <span class="w-5 h-[1.5px] bg-ink rounded-full"></span>
            </button>
        </div>
    </header>

    <main class="w-full max-w-4xl mx-auto px-4 sm:px-6 md:px-8 pt-32 md:pt-40 flex-1 flex flex-col justify-center relative z-10">
        
        <div class="text-center mb-8 md:mb-12">
            <h1 class="font-heading font-bold text-3xl sm:text-4xl md:text-6xl tracking-tight text-ink uppercase" id="main-title">Pendaftaran Lomba</h1>
            <p class="font-script italic text-xl md:text-3xl text-manifest-burgundy/80 mt-2">The Symphony of Business</p>
        </div>

        <div class="flex items-center justify-between mb-8 md:mb-14 px-2 max-w-md mx-auto w-full">
            <div class="flex items-center gap-2 sm:gap-3">
                <div id="dot-1" class="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-manifest-dark text-white text-xs font-heading font-bold flex items-center justify-center transition-all border border-manifest-dark/10 shadow-sm">1</div>
                <span class="hidden sm:inline text-[10px] font-heading font-bold uppercase tracking-wider text-ink">Kategori</span>
            </div>
            <div class="flex-1 h-[1px] bg-manifest-dark/10 mx-2 sm:mx-4"></div>
            <div class="flex items-center gap-2 sm:gap-3">
                <div id="dot-2" class="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-white/60 text-ink/40 text-xs font-heading font-bold flex items-center justify-center transition-all border border-manifest-dark/5">2</div>
                <span class="hidden sm:inline text-[10px] font-heading font-bold uppercase tracking-wider text-ink/40">Data Tim</span>
            </div>
            <div class="flex-1 h-[1px] bg-manifest-dark/10 mx-2 sm:mx-4"></div>
            <div class="flex items-center gap-2 sm:gap-3">
                <div id="dot-3" class="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-white/60 text-ink/40 text-xs font-heading font-bold flex items-center justify-center transition-all border border-manifest-dark/5">3</div>
                <span class="hidden sm:inline text-[10px] font-heading font-bold uppercase tracking-wider text-ink/40">Berkas</span>
            </div>
        </div>

        <form id="upgradeRegForm" enctype="multipart/form-data" class="space-y-6 sm:space-y-8">
            
            <div id="step-0" class="step-content active space-y-4 sm:space-y-6">
                <h3 class="font-heading text-[10px] font-bold uppercase tracking-widest text-ink/40 text-center mb-4">Silakan Pilih Cabang Kompetisi:</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <label class="manifest-soft-card rounded-2xl p-5 sm:p-6 block cursor-pointer transition-all text-center group relative overflow-hidden">
                        <input type="radio" name="competition_type" value="BPC" class="sr-only" onclick="selectCompetition('BPC')">
                        <div class="font-heading text-2xl sm:text-3xl font-bold text-ink tracking-tight">BPC</div>
                        <div class="font-accent italic text-sm sm:text-base text-manifest-rose mt-0.5">Business Plan Competition</div>
                        <p class="text-[9px] text-ink/40 mt-4 sm:mt-6 border-t border-manifest-dark/5 pt-3 uppercase tracking-widest font-bold">Tingkat Nasional (ID)</p>
                    </label>
                    <label class="manifest-soft-card rounded-2xl p-5 sm:p-6 block cursor-pointer transition-all text-center group relative overflow-hidden">
                        <input type="radio" name="competition_type" value="BCC" class="sr-only" onclick="selectCompetition('BCC')">
                        <div class="font-heading text-2xl sm:text-3xl font-bold text-ink tracking-tight">BCC</div>
                        <div class="font-accent italic text-sm sm:text-base text-manifest-rose mt-0.5">Business Case Competition</div>
                        <p class="text-[9px] text-ink/40 mt-4 sm:mt-6 border-t border-manifest-dark/5 pt-3 uppercase tracking-widest font-bold">Tingkat Nasional (ID)</p>
                    </label>
                    <label class="manifest-soft-card rounded-2xl p-5 sm:p-6 block cursor-pointer transition-all text-center group relative overflow-hidden">
                        <input type="radio" name="competition_type" value="EBPC" class="sr-only" onclick="selectCompetition('EBPC')">
                        <div class="font-heading text-2xl sm:text-3xl font-bold text-manifest-burgundy tracking-tight">EBPC</div>
                        <div class="font-accent italic text-sm sm:text-base text-manifest-rose mt-0.5">Eng. Business Plan</div>
                        <p class="text-[9px] text-manifest-burgundy/60 mt-4 sm:mt-6 border-t border-manifest-dark/5 pt-3 uppercase tracking-widest font-bold">NATIONAL (EN)</p>
                    </label>
                </div>
            </div>

            <div id="step-1" class="step-content space-y-4 sm:space-y-6">
                <div class="manifest-soft-card p-4 sm:p-6 rounded-2xl">
                    <label class="block text-[9px] font-heading font-bold uppercase text-ink/50 tracking-widest">Nama Tim</label>
                    <input type="text" name="team_name" id="field_team_name" class="w-full mt-2 p-3 sm:p-3.5 rounded-xl input-premium text-sm font-medium text-ink" placeholder="Contoh: Tim Manifest Juara">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                    <div class="manifest-soft-card p-4 sm:p-6 rounded-2xl space-y-4">
                        <h4 class="font-heading font-bold text-ink text-xs uppercase tracking-widest border-b border-manifest-dark/5 pb-2.5 flex items-center justify-between">
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
                        
                        <div class="relative border border-dashed border-manifest-dark/15 rounded-xl p-3.5 bg-white/20 text-center hover:bg-white/60 transition-all cursor-pointer">
                            <input type="file" name="leader_id_scan" id="field_leader_id" accept=".pdf" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="updateFileName(this)">
                            <span class="text-[11px] text-ink/60 font-bold block truncate pointer-events-none"><i class="fas fa-file-pdf mr-1.5 text-manifest-rose/70"></i>Scan Kartu Pelajar (PDF) *</span>
                        </div>
                        <input type="text" inputmode="numeric" name="leader_whatsapp" id="field_leader_wa" placeholder="Nomor WhatsApp (e.g. 0812...)" class="w-full p-3 rounded-xl input-premium text-sm font-medium text-ink" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                    </div>

                    <div class="manifest-soft-card p-4 sm:p-6 rounded-2xl space-y-4">
                        <h4 class="font-heading font-bold text-ink text-xs uppercase tracking-widest border-b border-manifest-dark/5 pb-2.5 flex items-center justify-between">
                            <span>Anggota Tim 2</span>
                            <span class="w-1.5 h-1.5 rounded-full bg-manifest-dark/30"></span>
                        </h4>
                        <input type="text" name="member_name" id="field_member_name" placeholder="Nama Lengkap" class="w-full p-3 rounded-xl input-premium text-sm font-medium text-ink">
                        <input type="text" name="member_school" id="field_member_school" placeholder="Asal Sekolah / Instansi" class="w-full p-3 rounded-xl input-premium text-sm font-medium text-ink">
                        <select name="member_grade" class="w-full p-3 rounded-xl input-premium text-sm font-medium text-ink/70 bg-white/60">
                            <option value="10">Kelas 10 / Grade 10</option>
                            <option value="11">Kelas 11 / Grade 11</option>
                            <option value="12">Kelas 12 / Grade 12</option>
                        </select>
                        
                        <div class="relative border border-dashed border-manifest-dark/15 rounded-xl p-3.5 bg-white/20 text-center hover:bg-white/60 transition-all cursor-pointer">
                            <input type="file" name="member_id_scan" id="field_member_id" accept=".pdf" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="updateFileName(this)">
                            <span class="text-[11px] text-ink/60 font-bold block truncate pointer-events-none"><i class="fas fa-file-pdf mr-1.5 text-manifest-rose/70"></i>Scan Kartu Pelajar (PDF) *</span>
                        </div>
                        <input type="text" inputmode="numeric" name="member_whatsapp" id="field_member_wa" placeholder="Nomor WhatsApp (e.g. 0812...)" class="w-full p-3 rounded-xl input-premium text-sm font-medium text-ink" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                    </div>
                </div>

                <div class="flex justify-between items-center pt-4 sm:pt-6 border-t border-manifest-dark/5">
                    <button type="button" onclick="goToStep(0)" class="text-[10px] font-heading font-bold uppercase tracking-widest text-ink/40 hover:text-manifest-burgundy transition-colors">← Kembali</button>
                    <button type="button" onclick="validateAndNext(2)" class="bg-manifest-dark text-white font-heading font-bold text-[10px] uppercase tracking-widest px-6 sm:px-8 py-3 rounded-full hover:bg-manifest-rose transition-all shadow-sm">Lanjutkan</button>
                </div>
            </div>

            <div id="step-2" class="step-content space-y-4 sm:space-y-6">
                <div class="manifest-soft-card p-4 sm:p-6 rounded-2xl space-y-4 sm:space-y-5">
                    <div>
                        <label class="block text-[9px] font-heading font-bold uppercase text-ink/50 tracking-widest">Nama Pemilik Rekening Pengirim</label>
                        <input type="text" name="account_holder" id="field_holder" class="w-full mt-2 p-3 rounded-xl input-premium text-sm font-medium text-ink" placeholder="Nama Sesuai Rekening Bank/E-Wallet">
                    </div>

                    <div>
                        <label class="block text-[9px] font-heading font-bold uppercase text-ink/50 tracking-widest mb-2">Pilih Metode Pembayaran</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <label class="border border-manifest-dark/10 rounded-xl p-3.5 text-center block cursor-pointer bg-white/40 hover:bg-white/80 transition-all select-none font-bold text-xs text-ink/80">
                                <input type="radio" name="payment_method" value="Bank Jago" class="accent-manifest-burgundy" checked onchange="togglePaymentInstructions('Bank Jago')"> <span class="ml-1.5">Bank Jago</span>
                            </label>
                            <label class="border border-manifest-dark/10 rounded-xl p-3.5 text-center block cursor-pointer bg-white/40 hover:bg-white/80 transition-all select-none font-bold text-xs text-ink/80">
                                <input type="radio" name="payment_method" value="QRIS" class="accent-manifest-burgundy" onchange="togglePaymentInstructions('QRIS')"> <span class="ml-1.5">QRIS Digital</span>
                            </label>
                        </div>
                    </div>

                    <div id="paymentInstructionsContainer" class="p-4 rounded-xl bg-white/60 border border-manifest-dark/5 transition-all duration-300 hidden">
                        <div id="instructionText" class="text-xs text-manifest-dark/80 font-medium leading-relaxed"></div>
                    </div>
                </div>

                <div class="p-4 sm:p-6 manifest-soft-card rounded-2xl flex flex-col sm:flex-row sm:items-center justify-between gap-4 sm:gap-6">
                    <div class="space-y-1">
                        <label class="block text-[9px] font-heading font-bold uppercase text-ink/50 tracking-widest">Gunakan Voucher / Kode Referral</label>
                        <div class="flex gap-2 mt-2">
                            <input type="text" id="ref_field" name="referral_code" placeholder="Kode Promo" class="p-2.5 rounded-xl input-premium text-xs uppercase font-bold w-36 tracking-wider">
                            <button type="button" onclick="verifyReferral()" class="bg-manifest-dark text-white text-[10px] font-heading font-bold uppercase tracking-wider px-4 py-2.5 rounded-xl hover:bg-manifest-rose transition-colors shadow-sm">Terapkan</button>
                        </div>
                        <p id="ref_message" class="text-[11px] font-bold mt-1 text-ink/40"></p>
                    </div>
                    <div class="text-left sm:text-right border-t border-dashed border-manifest-dark/10 sm:border-0 pt-3 sm:pt-0">
                        <span class="text-[9px] font-heading font-bold uppercase tracking-widest text-ink/40 block">Total Tagihan Transaksi:</span>
                        <span id="display_amount" class="text-2xl sm:text-3xl font-heading font-bold text-manifest-burgundy tracking-tight">Rp 75.000</span>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-[9px] font-heading font-bold uppercase text-ink/50 tracking-widest">Unggah Bukti Transaksi Resmi (JPG/PNG)</label>
                    <div class="relative border-2 border-dashed border-manifest-dark/10 rounded-2xl p-5 sm:p-6 bg-white/30 text-center hover:bg-white/60 transition-all cursor-pointer">
                        <input type="file" name="payment_proof" id="field_proof" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="updateFileName(this)">
                        <span class="text-xs text-manifest-dark/80 font-bold block pointer-events-none"><i class="fas fa-cloud-upload-alt mr-2 text-manifest-rose/80"></i>Pilih Gambar Bukti Bayar</span>
                        <span class="text-[10px] text-ink/40 mt-1 block font-medium">Format berkas didukung: PNG, JPG, JPEG maks 5MB</span>
                    </div>
                </div>

                <div class="flex justify-between items-center pt-4 sm:pt-6 border-t border-manifest-dark/5">
                    <button type="button" onclick="goToStep(1)" class="bg-white/40 text-ink/60 border border-manifest-dark/5 font-heading font-bold text-[10px] uppercase tracking-wider px-5 py-2.5 rounded-full hover:bg-white transition-all">Kembali</button>
                    <button type="button" onclick="validateAndNext(3)" class="bg-manifest-dark text-white font-heading font-bold text-[10px] uppercase tracking-widest px-6 sm:px-8 py-3 rounded-full hover:bg-manifest-rose transition-all shadow-sm">Lanjutkan</button>
                </div>
            </div>

            <div id="step-3" class="step-content space-y-4 sm:space-y-6">
                <div class="p-4 bg-manifest-burgundy/5 border border-manifest-burgundy/10 rounded-2xl text-manifest-burgundy text-[11px] font-medium leading-relaxed flex items-start gap-2.5">
                    <i class="fas fa-exclamation-triangle mt-0.5 shrink-0"></i>
                    <span><strong>Pemberitahuan Berkas Singkat:</strong> Untuk syarat di bawah ini, kumpulkan bukti screenshot milik seluruh anggota tim Anda lalu gabungkan (merge) menjadi satu file berformat PDF.</span>
                </div>

                <div class="space-y-3">
                    <div id="wrapper_originality_file" class="flex items-center justify-between p-4 manifest-soft-card rounded-2xl gap-3 transition-all">
                        <div class="max-w-[60%] sm:max-w-[75%]">
                            <span class="text-xs font-bold text-ink block">Surat Pernyataan Orisinalitas Lomba</span>
                            <span class="text-[10px] text-ink/40 block truncate font-medium file-name-display mt-0.5">Belum ada file dipilih</span>
                        </div>
                        <label class="bg-manifest-dark text-white text-[10px] font-heading font-bold uppercase tracking-wider px-3.5 py-2.5 rounded-xl cursor-pointer hover:bg-manifest-rose transition-colors shrink-0 shadow-sm">
                            Pilih PDF <input type="file" name="proof_originality" id="field_originality" accept=".pdf" class="sr-only" onchange="updateInlineFileName(this)">
                        </label>
                    </div>

                    <div class="flex items-center justify-between p-4 manifest-soft-card rounded-2xl gap-3">
                        <div class="max-w-[60%] sm:max-w-[75%]">
                            <span class="text-xs font-bold text-ink block">Bukti Follow Instagram @its_manifest</span>
                            <span class="text-[10px] text-ink/40 block truncate font-medium file-name-display mt-0.5">Belum ada file dipilih</span>
                        </div>
                        <label class="bg-manifest-dark text-white text-[10px] font-heading font-bold uppercase tracking-wider px-3.5 py-2.5 rounded-xl cursor-pointer hover:bg-manifest-rose transition-colors shrink-0 shadow-sm">
                            Pilih PDF <input type="file" name="proof_follow_ig" id="field_ig" accept=".pdf" class="sr-only" onchange="updateInlineFileName(this)">
                        </label>
                    </div>

                    <div class="flex items-center justify-between p-4 manifest-soft-card rounded-2xl gap-3">
                        <div class="max-w-[60%] sm:max-w-[75%]">
                            <span class="text-xs font-bold text-ink block">Bukti Repost Feeds Kompetisi</span>
                            <span class="text-[10px] text-ink/40 block truncate font-medium file-name-display mt-0.5">Belum ada file dipilih</span>
                        </div>
                        <label class="bg-manifest-dark text-white text-[10px] font-heading font-bold uppercase tracking-wider px-3.5 py-2.5 rounded-xl cursor-pointer hover:bg-manifest-rose transition-colors shrink-0 shadow-sm">
                            Pilih PDF <input type="file" name="proof_repost_feed" id="field_feed" accept=".pdf" class="sr-only" onchange="updateInlineFileName(this)">
                        </label>
                    </div>

                    <div class="flex items-center justify-between p-4 manifest-soft-card rounded-2xl gap-3">
                        <div class="max-w-[60%] sm:max-w-[75%]">
                            <span class="text-xs font-bold text-ink block">Bukti Upload Twibbon Kegiatan</span>
                            <span class="text-[10px] text-ink/40 block truncate font-medium file-name-display mt-0.5">Belum ada file dipilih</span>
                        </div>
                        <label class="bg-manifest-dark text-white text-[10px] font-heading font-bold uppercase tracking-wider px-3.5 py-2.5 rounded-xl cursor-pointer hover:bg-manifest-rose transition-colors shrink-0 shadow-sm">
                            Pilih PDF <input type="file" name="proof_twibbon" id="field_twibbon" accept=".pdf" class="sr-only" onchange="updateInlineFileName(this)">
                        </label>
                    </div>
                </div>

                <div class="flex justify-between items-center pt-4 sm:pt-6 border-t border-manifest-dark/5">
                    <button type="button" onclick="goToStep(2)" class="bg-white/40 text-ink/60 border border-manifest-dark/5 font-heading font-bold text-[10px] uppercase tracking-wider px-5 py-2.5 rounded-full hover:bg-white transition-all">Kembali</button>
                    <button type="submit" id="btnSubmitForm" class="bg-manifest-burgundy text-white font-heading font-bold text-[10px] uppercase tracking-widest px-6 sm:px-8 py-3 rounded-full hover:bg-manifest-rose transition-all shadow-md">KIRIM PENDAFTARAN</button>
                </div>
            </div>
        </form>
    </main>

    <script>
        window.addEventListener('load', () => {
            setTimeout(() => {
                document.body.classList.add('loaded');
                setTimeout(() => {
                    document.getElementById('curtain')?.remove();
                }, 2800); 
            }, 800); 
        });

        const menuButton = document.getElementById('menuButton');
        const closeMenuButton = document.getElementById('closeMenuButton');
        const mobileSidebar = document.getElementById('mobileSidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const mainNavbar = document.getElementById('navbar');

        function openMenu() {
            mobileSidebar.classList.add('open', 'translate-x-0');
            mobileSidebar.classList.remove('translate-x-full');
            sidebarOverlay.classList.remove('opacity-0', 'pointer-events-none');
            sidebarOverlay.classList.add('opacity-100');
            mainNavbar.classList.add('hidden');
        }

        function closeMenu() {
            mobileSidebar.classList.remove('open', 'translate-x-0');
            mobileSidebar.classList.add('translate-x-full');
            sidebarOverlay.classList.remove('opacity-100');
            sidebarOverlay.classList.add('opacity-0', 'pointer-events-none');
            mainNavbar.classList.remove('hidden');
        }

        menuButton.addEventListener('click', openMenu);
        closeMenuButton.addEventListener('click', closeMenu);
        sidebarOverlay.addEventListener('click', closeMenu);

        document.querySelectorAll('.sidebar-anchor').forEach(link => {
            link.addEventListener('click', closeMenu);
        });

        function toggleSubMenu(event) {
            event.stopPropagation();
            const subMenu = document.getElementById('subMenu');
            const chevron = document.getElementById('chevron');
            if (subMenu.style.maxHeight === "0px" || subMenu.style.maxHeight === "") {
                subMenu.style.maxHeight = subMenu.scrollHeight + "px";
                chevron.style.transform = "rotate(180deg)";
            } else {
                subMenu.style.maxHeight = "0px";
                chevron.style.transform = "rotate(0deg)";
            }
        }

        let currentStep = 0;
        let selectedCompType = "BPC";

        function togglePaymentInstructions(method) {
            const container = document.getElementById('paymentInstructionsContainer');
            const targetDiv = document.getElementById('instructionText');
            
            if (!method) {
                container.classList.add('hidden');
                return;
            }
            container.classList.remove('hidden');
            
            if (method === 'QRIS') {
                targetDiv.innerHTML = `
                    <div class="flex flex-col items-center gap-3 p-2 text-center animate-[fadeIn_0.3s_ease]">
                        <p class="font-heading text-[10px] tracking-wider text-manifest-dark/40 uppercase font-bold">Pindai Kode QRIS Resmi MANIFEST 2026</p>
                        <div class="p-3 bg-white rounded-2xl border border-manifest-dark/5 shadow-md max-w-[150px] w-full mx-auto">
                            <img src="manifest.jpeg" alt="QRIS Kupon Resmi" class="w-full h-auto object-contain">
                        </div>
                        <p class="text-[11px] text-manifest-burgundy font-bold mt-1"><i class="fa-solid fa-circle-info mr-1"></i> Pastikan nominal transfer presisi hingga angka terakhir.</p>
                    </div>
                `;
            } else if (method === 'Bank Jago') {
                targetDiv.innerHTML = `
                    <div class="flex flex-col gap-2 p-1 animate-[fadeIn_0.3s_ease]">
                        <p class="font-heading text-[9px] tracking-wider text-manifest-dark/40 uppercase font-bold">Informasi Akun Transfer Bank Resmi</p>
                        <div class="flex items-center gap-3 bg-white/70 px-4 py-3 rounded-xl border border-manifest-dark/5">
                            <div class="w-8 h-8 rounded-full bg-manifest-dark/5 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-building-columns text-manifest-rose text-sm"></i>
                            </div>
                            <div>
                                <span class="text-[10px] text-manifest-dark/40 block uppercase tracking-wider font-bold">Bank Jago</span>
                                <span class="text-sm font-bold tracking-tight text-manifest-dark select-all font-mono">100930748805</span>
                                <span class="text-[11px] text-manifest-dark/60 block mt-0.5 font-medium">a.n. Faradita Tanzania</span>
                            </div>
                        </div>
                    </div>
                `;
            }
        }

        function showToast(message, type = 'error') {
            const toast = document.getElementById('customToast');
            const toastMsg = document.getElementById('toastMessage');
            const toastIcon = document.getElementById('toastIcon');
            toastMsg.textContent = message;

            if (type === 'error') {
                toastIcon.innerHTML = `<svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>`;
                toastIcon.className = "w-5 h-5 shrink-0 flex items-center justify-center rounded-full bg-manifest-burgundy";
            } else if (type === 'success') {
                toastIcon.innerHTML = `<svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>`;
                toastIcon.className = "w-5 h-5 shrink-0 flex items-center justify-center rounded-full bg-manifest-rose";
            }

            toast.classList.remove('opacity-0', 'pointer-events-none', '-translate-y-8');
            toast.classList.add('opacity-100', 'translate-y-0');

            setTimeout(() => {
                toast.classList.add('opacity-0', '-translate-y-8');
                toast.classList.remove('opacity-100', 'translate-y-0');
                setTimeout(() => { toast.classList.add('pointer-events-none'); }, 500);
            }, 4000);
        }

        // === FUNGSI VERIFIKASI REFERRAL / PROMO ===
        // === FUNGSI VERIFIKASI REFERRAL / PROMO ===
        function verifyReferral() {
            const promoCode = document.getElementById('ref_field').value.trim();
            const messageEl = document.getElementById('ref_message');
            const displayAmountEl = document.getElementById('display_amount');

            if (!promoCode) {
                showToast("Masukkan kode promo/referral terlebih dahulu!");
                return;
            }

            messageEl.textContent = "Memverifikasi...";
            messageEl.className = "text-[11px] font-bold mt-1 text-ink/60";

            const promoData = new FormData();
            promoData.append('referral_code', promoCode);

            // Gunakan './' di depan agar browser strict mencari folder 'api' di tempat daftar.php berada
            fetch('./api/user/check_promo.php', {
                method: 'POST',
                body: promoData
            })
            .then(res => {
                // Proteksi jika server mengembalikan status eror (seperti 404 atau 500)
                if (!res.ok) {
                    throw new Error("Server merespon dengan status " + res.status);
                }
                return res.json();
            })
            .then(data => {
                if (data.status === 'success') {
                    let basePrice = (selectedCompType === 'BCC') ? 150000 : 75000;
                    let discountAmount = (data.discount / 100) * basePrice;
                    let finalAmount = basePrice - discountAmount;

                    displayAmountEl.textContent = "Rp " + finalAmount.toLocaleString('id-ID');
                    
                    showToast(data.message || "Kode referral berhasil diterapkan!", "success");
                    messageEl.textContent = `✓ Kode diterapkan (Diskon ${data.discount}%)`;
                    messageEl.className = "text-[11px] font-bold mt-1 text-manifest-rose";
                } else {
                    showToast(data.message || "Kode referral tidak valid.");
                    messageEl.textContent = "✕ " + (data.message || "Kode tidak valid.");
                    messageEl.className = "text-[11px] font-bold mt-1 text-manifest-burgundy";
                    
                    let basePrice = (selectedCompType === 'BCC') ? 150000 : 75000;
                    displayAmountEl.textContent = "Rp " + basePrice.toLocaleString('id-ID');
                }
            })
            .catch(err => {
                console.error(err);
                showToast("Gagal memuat file API. Pastikan file check_promo.php ada di folder api/user/.");
                messageEl.textContent = "✕ Gagal verifikasi (Eror 404/Rute Salah).";
                messageEl.className = "text-[11px] font-bold mt-1 text-manifest-burgundy";
            });
        }

        function selectCompetition(type) {
            selectedCompType = type;
            document.getElementById('main-title').textContent = "Pendaftaran Lomba — " + type;
            const radioInput = document.querySelector(`input[name="competition_type"][value="${type}"]`);
            if (radioInput) radioInput.checked = true;

            // Reset status input promo agar kalkulasi harga tidak bug saat berganti kategori
            document.getElementById('ref_field').value = "";
            document.getElementById('ref_message').textContent = "";

            const originalityWrapper = document.getElementById('wrapper_originality_file');
            if (type === 'BCC') {
                originalityWrapper.classList.add('hidden');
                document.getElementById('display_amount').textContent = "Rp 150.000"; 
            } else {
                originalityWrapper.classList.remove('hidden');
                document.getElementById('display_amount').textContent = "Rp 75.000"; 
            }
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
                        dot.className = "w-8 h-8 rounded-full bg-manifest-dark text-white text-xs font-heading font-bold flex items-center justify-center transition-all border border-manifest-dark/10 shadow-sm";
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

                const leaderIdUploaded = document.getElementById('field_leader_id').files.length;
                const memberIdUploaded = document.getElementById('field_member_id').files.length;

                if (!team || !lName || !lSchool || !lWa || !mName || !mSchool || !mWa) {
                    showToast("Mohon lengkapi seluruh data teks tim dan anggota kelompok Anda!");
                    return;
                }

                if (leaderIdUploaded === 0 || memberIdUploaded === 0) {
                    showToast("Kartu Pelajar Ketua dan Anggota tim wajib diunggah!");
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
            const container = input.closest('div');
            const labelSpan = container.querySelector('.file-name-display');
            if (input.files.length > 0 && labelSpan) {
                labelSpan.textContent = "✔ " + input.files[0].name;
            }
        }

        document.getElementById('upgradeRegForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (selectedCompType !== 'BCC' && !document.getElementById('field_originality').files.length) {
                showToast("Harap unggah berkas Surat Pernyataan Orisinalitas di halaman 3!");
                return;
            }

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
            formData.append('competition_type', selectedCompType);

            fetch('api/user/apply.php', { method: 'POST', body: formData })
            .then(res => res.json())
            .then(data => {
                if(data.status === 'success') {
                    showToast("Pendaftaran berhasil terkirim!", "success");
                    setTimeout(() => { window.location.reload(); }, 1500);
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