<?php
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
header('Expires: 0');
?>
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

        .pricing-option {
            border: 1px solid rgba(34, 7, 1, 0.10);
            background: rgba(255, 255, 255, 0.42);
            transition: all 0.25s ease;
        }
        .pricing-option:hover { background: rgba(255, 255, 255, 0.82); transform: translateY(-1px); }
        .pricing-option.is-selected {
            border-color: #420000;
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 0 0 3px rgba(66, 0, 0, 0.06);
        }
        .pricing-option.is-disabled {
            opacity: 0.48;
            cursor: not-allowed;
        }
        .pricing-option.is-disabled:hover { background: rgba(255, 255, 255, 0.42); transform: none; }
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
            <h1 class="font-heading font-bold text-3xl sm:text-4xl md:text-5xl tracking-tight text-ink uppercase leading-tight" id="main-title">Pendaftaran Lomba</h1>
            <p class="font-script italic text-xl md:text-3xl text-manifest-burgundy/80 mt-2">Choose Your Competition!</p>
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
                    <label class="manifest-soft-card rounded-2xl p-5 sm:p-6 block cursor-pointer transition-all text-center group relative overflow-hidden flex flex-col justify-between">
                        <input type="radio" name="competition_type" value="BPC" class="sr-only" onclick="selectCompetition('BPC')">
                        <div>
                            <div class="font-heading text-xl sm:text-2xl font-bold text-ink tracking-tight">Business Plan Competition</div>
                            <div class="font-accent italic text-sm sm:text-base text-manifest-rose mt-1">National Level</div>
                        </div>
                        <p class="text-[9px] text-ink/40 mt-4 sm:mt-6 border-t border-manifest-dark/5 pt-3 uppercase tracking-widest font-bold">Tingkat Nasional (ID)</p>
                    </label>
                    <label class="manifest-soft-card rounded-2xl p-5 sm:p-6 block cursor-pointer transition-all text-center group relative overflow-hidden flex flex-col justify-between">
                        <input type="radio" name="competition_type" value="BCC" class="sr-only" onclick="selectCompetition('BCC')">
                        <div>
                            <div class="font-heading text-xl sm:text-2xl font-bold text-ink tracking-tight">Business Case Competition</div>
                            <div class="font-accent italic text-sm sm:text-base text-manifest-rose mt-1">National Level</div>
                        </div>
                        <p class="text-[9px] text-ink/40 mt-4 sm:mt-6 border-t border-manifest-dark/5 pt-3 uppercase tracking-widest font-bold">Tingkat Nasional (ID)</p>
                    </label>
                    <label class="manifest-soft-card rounded-2xl p-5 sm:p-6 block cursor-pointer transition-all text-center group relative overflow-hidden flex flex-col justify-between">
                        <input type="radio" name="competition_type" value="EBPC" class="sr-only" onclick="selectCompetition('EBPC')">
                        <div>
                            <div class="font-heading text-xl sm:text-2xl font-bold text-manifest-burgundy tracking-tight">English Business Plan Competition</div>
                            <div class="font-accent italic text-sm sm:text-base text-manifest-rose mt-1">National Level</div>
                        </div>
                        <p class="text-[9px] text-manifest-burgundy/60 mt-4 sm:mt-6 border-t border-manifest-dark/5 pt-3 uppercase tracking-widest font-bold">NATIONAL (EN)</p>
                    </label>
                </div>
            </div>

            <div id="step-1" class="step-content space-y-4 sm:space-y-6">
                <div class="manifest-soft-card p-4 sm:p-6 rounded-2xl space-y-5">
                    <div>
                        <label class="block text-[9px] font-heading font-bold uppercase text-ink/50 tracking-widest">Nama Tim</label>
                        <input type="text" name="team_name" id="field_team_name" class="w-full mt-2 p-3 sm:p-3.5 rounded-xl input-premium text-sm font-medium text-ink" placeholder="Contoh: Tim Manifest Juara">
                    </div>

                    <div>
                        <label for="field_discovery_source" class="block text-[9px] font-heading font-bold uppercase text-ink/50 tracking-widest">Dari mana Anda mengetahui MANIFEST 2026?</label>
                        <select name="discovery_source" id="field_discovery_source" required class="w-full mt-2 p-3 sm:p-3.5 rounded-xl input-premium text-sm font-medium text-ink/70 bg-white/60">
                            <option value="" selected disabled>Pilih sumber informasi</option>
                            <option value="Instagram">Instagram</option>
                            <option value="TikTok">TikTok</option>
                            <option value="Roadshow MANIFEST">Roadshow MANIFEST</option>
                            <option value="Teman/Keluarga">Teman / Keluarga</option>
                        </select>
                    </div>
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
                            <input type="file" name="leader_id_scan" id="field_leader_id" accept=".pdf,application/pdf" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="updateFileName(this)">
                            <span class="text-[11px] text-ink/60 font-bold block truncate pointer-events-none"><i class="fas fa-file-pdf mr-1.5 text-manifest-rose/70"></i>Scan Kartu Pelajar (PDF) *</span>
                        </div>
                        <input type="tel" inputmode="numeric" autocomplete="tel" name="leader_whatsapp" id="field_leader_wa" placeholder="Nomor WhatsApp (e.g. 0812...)" maxlength="15" pattern="[0-9]{9,15}" class="w-full p-3 rounded-xl input-premium text-sm font-medium text-ink" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
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
                            <input type="file" name="member_id_scan" id="field_member_id" accept=".pdf,application/pdf" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="updateFileName(this)">
                            <span class="text-[11px] text-ink/60 font-bold block truncate pointer-events-none"><i class="fas fa-file-pdf mr-1.5 text-manifest-rose/70"></i>Scan Kartu Pelajar (PDF) *</span>
                        </div>
                        <input type="tel" inputmode="numeric" autocomplete="tel" name="member_whatsapp" id="field_member_wa" placeholder="Nomor WhatsApp (e.g. 0812...)" maxlength="15" pattern="[0-9]{9,15}" class="w-full p-3 rounded-xl input-premium text-sm font-medium text-ink" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
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
                        <input type="text" name="account_holder" id="field_holder" class="w-full mt-2 p-3 rounded-xl input-premium text-sm font-medium text-ink" placeholder="Nama Sesuai Rekening Bank/E-Wallet" required>
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

                <div class="manifest-soft-card p-4 sm:p-6 rounded-2xl">
                    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-2 mb-4">
                        <div>
                            <label class="block text-[9px] font-heading font-bold uppercase text-ink/50 tracking-widest">Pilih Harga Pendaftaran</label>
                            <p id="pricing_status" class="text-[11px] font-medium text-ink/45 mt-1">Memuat ketersediaan Early Bird...</p>
                        </div>
                        <span class="text-[10px] font-heading font-bold uppercase tracking-widest text-manifest-burgundy">Pilih satu kategori</span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <input type="radio" name="pricing_tier" value="early_bird" id="pricing_early" class="sr-only" checked onchange="selectPricingTier('early_bird')">
                        <label for="pricing_early" id="priceCardEarly" class="pricing-option rounded-2xl p-4 cursor-pointer block">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <span class="font-heading text-sm font-bold uppercase tracking-wider text-ink">Early Bird</span>
                                    <span id="early_quota_label" class="block text-[10px] text-ink/45 mt-1 font-medium">90 pendaftar pertama</span>
                                </div>
                                <i class="fa-solid fa-ticket text-manifest-rose/80 text-sm mt-0.5"></i>
                            </div>
                            <span id="early_price_label" class="block mt-4 font-heading text-2xl font-bold text-manifest-burgundy tracking-tight">Rp 65.000</span>
                        </label>

                        <input type="radio" name="pricing_tier" value="normal" id="pricing_normal" class="sr-only" onchange="selectPricingTier('normal')">
                        <label for="pricing_normal" id="priceCardNormal" class="pricing-option rounded-2xl p-4 cursor-pointer block">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <span class="font-heading text-sm font-bold uppercase tracking-wider text-ink">Normal Price</span>
                                    <span class="block text-[10px] text-ink/45 mt-1 font-medium">Harga reguler pendaftaran</span>
                                </div>
                                <i class="fa-solid fa-receipt text-ink/35 text-sm mt-0.5"></i>
                            </div>
                            <span id="normal_price_label" class="block mt-4 font-heading text-2xl font-bold text-ink tracking-tight">Rp 75.000</span>
                        </label>
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
                        <span id="display_amount" class="text-2xl sm:text-3xl font-heading font-bold text-manifest-burgundy tracking-tight">Rp 65.000</span>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-[9px] font-heading font-bold uppercase text-ink/50 tracking-widest">Unggah Bukti Transaksi Resmi (JPG/PNG)</label>
                    <div class="relative border-2 border-dashed border-manifest-dark/10 rounded-2xl p-5 sm:p-6 bg-white/30 text-center hover:bg-white/60 transition-all cursor-pointer">
                        <input type="file" name="payment_proof" id="field_proof" accept="image/jpeg,image/png" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="updateFileName(this)">
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
                    <span><strong>Pemberitahuan Berkas:</strong> Kartu pelajar dan Surat Pernyataan Orisinalitas wajib PDF. Untuk bukti follow, repost, komen, dan twibbon, gunakan <strong>JPG/PNG</strong> agar upload lebih cepat (PDF juga tetap bisa). Maksimal 5MB per berkas.</span>
                </div>

                <div class="space-y-3">
                    <!-- WAJIB KHUSUS BPC & EBPC: SURAT PERNYATAAN ORISINALITAS -->
                    <div id="wrapper_originality_file" class="flex flex-col sm:flex-row sm:items-center sm:justify-between p-3.5 rounded-2xl gap-3 transition-all bg-manifest-burgundy/[0.045] border border-manifest-burgundy/20 shadow-[0_10px_30px_rgba(66,0,0,0.04)]">
                        <div class="w-full sm:max-w-[72%]">
                            <span id="originality_category_label" class="text-[9px] font-heading font-bold uppercase tracking-widest text-manifest-burgundy block mb-1">Wajib untuk Business Plan &amp; English Business Plan</span>
                            <span class="text-xs font-bold text-ink block">Surat Pernyataan Orisinalitas Lomba</span>
                            <a id="originality_template_link" href="https://its.id/m/StatementofOriginalityBPC" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-[9px] text-manifest-burgundy font-heading font-bold uppercase tracking-wider mt-1.5 hover:text-manifest-rose transition-colors">
                                <i class="fa-solid fa-arrow-up-right-from-square text-[8px]"></i>
                                <span id="originality_template_label">Unduh template BPC</span>
                            </a>
                            <span class="text-[10px] text-ink/50 block truncate font-medium file-name-display mt-1" aria-live="polite">Belum ada file dipilih</span>
                        </div>
                        <label for="field_originality" class="w-full sm:w-auto text-center bg-manifest-burgundy text-white text-[10px] font-heading font-bold uppercase tracking-wider px-3.5 py-2.5 rounded-xl cursor-pointer hover:bg-manifest-rose transition-colors shrink-0 shadow-sm">
                            Upload PDF
                        </label>
                        <input type="file" name="proof_originality" id="field_originality" accept=".pdf,application/pdf" class="sr-only" onchange="updateInlineFileName(this)">
                    </div>

                    <div class="flex items-center justify-between p-4 manifest-soft-card rounded-2xl gap-3">
                        <div class="max-w-[60%] sm:max-w-[75%]">
                            <span class="text-xs font-bold text-ink block">Bukti Follow Instagram @its_manifest</span>
                            <span class="text-[10px] text-ink/40 block truncate font-medium file-name-display mt-0.5">Belum ada file dipilih</span>
                        </div>
                        <label class="bg-manifest-dark text-white text-[10px] font-heading font-bold uppercase tracking-wider px-3.5 py-2.5 rounded-xl cursor-pointer hover:bg-manifest-rose transition-colors shrink-0 shadow-sm">
                            Pilih Bukti <input type="file" name="proof_follow_ig" id="field_ig" accept=".pdf,application/pdf,image/jpeg,image/png" required class="sr-only" onchange="updateInlineFileName(this)">
                        </label>
                    </div>

                    <div class="flex items-center justify-between p-4 manifest-soft-card rounded-2xl gap-3">
                        <div class="max-w-[60%] sm:max-w-[75%]">
                            <span class="text-xs font-bold text-ink block">Bukti Repost Feeds Kompetisi</span>
                            <span class="text-[10px] text-ink/40 block truncate font-medium file-name-display mt-0.5">Belum ada file dipilih</span>
                        </div>
                        <label class="bg-manifest-dark text-white text-[10px] font-heading font-bold uppercase tracking-wider px-3.5 py-2.5 rounded-xl cursor-pointer hover:bg-manifest-rose transition-colors shrink-0 shadow-sm">
                            Pilih Bukti <input type="file" name="proof_repost_feed" id="field_feed" accept=".pdf,application/pdf,image/jpeg,image/png" required class="sr-only" onchange="updateInlineFileName(this)">
                        </label>
                    </div>

                    <div class="flex items-center justify-between p-3 manifest-soft-card rounded-xl gap-3">
                        <div class="max-w-[60%] sm:max-w-[75%]">
                            <span class="text-xs font-bold text-ink block">Bukti Komen &amp; Mention @its_manifest</span>
                            <span class="text-[9px] text-ink/40 block mt-0.5">Pastikan komentar dan mention terlihat jelas.</span>
                            <span class="text-[10px] text-ink/40 block truncate font-medium file-name-display mt-1">Belum ada file dipilih</span>
                        </div>
                        <label class="bg-manifest-dark text-white text-[10px] font-heading font-bold uppercase tracking-wider px-3.5 py-2.5 rounded-xl cursor-pointer hover:bg-manifest-rose transition-colors shrink-0 shadow-sm">
                            Pilih Bukti <input type="file" name="proof_comment_mention" id="field_comment_mention" accept=".pdf,application/pdf,image/jpeg,image/png" required class="sr-only" onchange="updateInlineFileName(this)">
                        </label>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between p-4 manifest-soft-card rounded-2xl gap-4">
                        <div class="w-full sm:max-w-[58%]">
                            <span class="text-xs font-bold text-ink block">Bukti Upload Twibbon Kegiatan</span>
                            <div class="flex flex-wrap items-center gap-x-4 gap-y-2 mt-2">
                                <a href="https://www.canva.com/design/DAHNZiSBqK8/Fjx0WNZRntnIbzX5ISeguw/edit" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-[10px] text-manifest-burgundy font-heading font-bold uppercase tracking-wider hover:text-manifest-rose transition-colors">
                                    <i class="fa-solid fa-arrow-up-right-from-square text-[9px]"></i> Buat Twibbon di Canva
                                </a>
                                <a href="https://docs.google.com/document/d/1OsjWFwU-j2GkJe_TMwvRZ8vq0LyU0XocKqndxiVUgE0/edit?usp=sharing" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-[10px] text-manifest-burgundy font-heading font-bold uppercase tracking-wider hover:text-manifest-rose transition-colors">
                                    <i class="fa-solid fa-pen-to-square text-[9px]"></i> Caption Post Twibbon
                                </a>
                            </div>
                            <span class="text-[10px] text-ink/40 block truncate font-medium file-name-display mt-1.5">Belum ada file dipilih</span>
                        </div>
                        <label class="w-full sm:w-auto text-center bg-manifest-dark text-white text-[10px] font-heading font-bold uppercase tracking-wider px-3.5 py-2.5 rounded-xl cursor-pointer hover:bg-manifest-rose transition-colors shrink-0 shadow-sm">
                            Pilih Bukti <input type="file" name="proof_twibbon" id="field_twibbon" accept=".pdf,application/pdf,image/jpeg,image/png" required class="sr-only" onchange="updateInlineFileName(this)">
                        </label>
                    </div>
                </div>

                <div class="flex justify-between items-center pt-4 sm:pt-6 border-t border-manifest-dark/5">
                    <button type="button" onclick="goToStep(2)" class="bg-white/40 text-ink/60 border border-manifest-dark/5 font-heading font-bold text-[10px] uppercase tracking-wider px-5 py-2.5 rounded-full hover:bg-white transition-all">Kembali</button>
                    <button type="submit" id="btnSubmitForm" class="bg-manifest-burgundy text-white font-heading font-bold text-[10px] uppercase tracking-widest px-6 sm:px-8 py-3 rounded-full hover:bg-manifest-rose transition-all shadow-md">KIRIM PENDAFTARAN</button>
                </div>
                <p id="uploadStatus" class="hidden mt-3 text-center text-[10px] font-heading font-bold tracking-wide text-ink/55" role="status" aria-live="polite"></p>
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

        const pricingRules = {
            BPC:  { early: 65000, normal: 75000, limit: 90 },
            BCC:  { early: 65000, normal: 75000, limit: 60 },
            EBPC: { early: 75000, normal: 85000, limit: 30 }
        };

        // Object mapping untuk merubah kode singkatan ke nama panjang pada element #main-title
        const competitionFullName = {
            BPC: "Business Plan Competition",
            BCC: "Business Case Competition",
            EBPC: "English Business Plan Competition"
        };

        const originalityTemplates = {
            BPC: {
                href: "https://its.id/m/StatementofOriginalityBPC",
                label: "Unduh template BPC"
            },
            EBPC: {
                href: "https://its.id/m/StatementofOriginalityEBPC",
                label: "Unduh template EBPC"
            }
        };

        let currentStep = 0;
        let selectedCompType = "BPC";
        let selectedPricingTier = "early_bird";
        let earlyBirdAvailable = true;

        function formatRupiah(amount) {
            return "Rp " + Math.round(Number(amount || 0)).toLocaleString('id-ID');
        }

        // Pendaftaran memuat 7–8 berkas. Beri waktu cukup pada koneksi seluler yang lambat.
        const API_TIMEOUT_MS = 600000;

        function apiPath(file) {
            const isLocal = ['localhost', '127.0.0.1'].includes(window.location.hostname);
            const base = isLocal ? '/manifest/api/user' : '/api/user';
            const endpoint = String(file).replace(/\.php$/i, '').replace(/^\/+|\/+$/g, '');

            // Endpoint dipanggil tanpa .php dan tanpa trailing slash. Aturan .htaccess
            // akan meneruskannya langsung ke file PHP tanpa redirect POST menjadi GET.
            return base + '/' + endpoint;
        }

        async function fetchApi(file, options = {}) {
            const controller = new AbortController();
            const timeout = window.setTimeout(() => controller.abort(), API_TIMEOUT_MS);
            const url = apiPath(file);
            const headers = Object.assign({ 'Accept': 'application/json' }, options.headers || {});

            try {
                return await fetch(url, Object.assign({}, options, {
                    credentials: 'same-origin',
                    headers,
                    signal: controller.signal
                }));
            } catch (error) {
                if (error && error.name === 'AbortError') {
                    throw new Error('Pengunggahan melewati batas waktu 10 menit. Gunakan koneksi yang lebih stabil atau perkecil berkas lalu coba lagi.');
                }
                if (navigator.onLine === false) {
                    throw new Error('Koneksi internet terputus saat pendaftaran dikirim. Sambungkan kembali internet lalu coba lagi.');
                }

                // Browser hanya mengirimkan "Failed to fetch" ketika request terputus/ditolak
                // sebelum PHP dapat memberi respons. Pesan ini paling sering muncul pada upload besar atau koneksi putus.
                throw new Error('Koneksi ke server terputus saat mengunggah berkas. Pastikan semua berkas maksimal 5MB dan gunakan Wi-Fi/data yang stabil, lalu coba lagi.');
            } finally {
                window.clearTimeout(timeout);
            }
        }

        function parseApiPayload(raw, status) {
            let data;
            try {
                data = JSON.parse(raw);
            } catch (error) {
                const detail = raw ? raw.replace(/<[^>]*>/g, ' ').replace(/\s+/g, ' ').trim().slice(0, 160) : 'respons kosong';
                const statusMessage = status === 404
                    ? 'Endpoint API tidak ditemukan. Pastikan folder api/user dan file .htaccess sudah terunggah lengkap.'
                    : status === 413
                        ? 'Total ukuran berkas terlalu besar untuk server. Coba perkecil berkas atau periksa pengaturan upload PHP.'
                        : status >= 500
                            ? 'Server gagal memproses pendaftaran. Periksa error log hosting dan izin folder uploads.'
                            : 'Endpoint API memberi respons yang tidak valid.';
                throw new Error(statusMessage + ' (' + status + '). ' + detail);
            }

            if (status < 200 || status >= 300) {
                if (data && data.message) throw new Error(data.message);
                if (status === 404) throw new Error('Endpoint API tidak ditemukan. Pastikan folder api/user dan file .htaccess sudah terunggah lengkap.');
                if (status === 413) throw new Error('Total ukuran berkas terlalu besar untuk server. Coba perkecil berkas atau periksa pengaturan upload PHP.');
                if (status >= 500) throw new Error('Server gagal memproses pendaftaran. Periksa error log hosting dan izin folder uploads.');
                throw new Error('Server merespons status ' + status + '.');
            }

            return data;
        }

        async function parseApiResponse(res) {
            return parseApiPayload(await res.text(), res.status);
        }

        // Setiap berkas diunggah satu per satu ke staging. Request final hanya mengirim data teks,
        // sehingga proxy shared-hosting tidak menerima satu request multipart besar 30–45MB.
        const FILE_UPLOAD_TIMEOUT_MS = 300000;
        const FINAL_SUBMIT_TIMEOUT_MS = 60000;
        const MAX_UPLOAD_RETRIES = 1;
        let stagedUploadState = { batchId: null, fingerprint: null, ready: false };

        function createUploadBatchId() {
            if (window.crypto && typeof window.crypto.randomUUID === 'function') {
                return window.crypto.randomUUID().replace(/-/g, '');
            }
            if (window.crypto && typeof window.crypto.getRandomValues === 'function') {
                const bytes = new Uint8Array(16);
                window.crypto.getRandomValues(bytes);
                return Array.from(bytes, (byte) => byte.toString(16).padStart(2, '0')).join('');
            }
            return 'manifest' + Date.now().toString(36) + Math.random().toString(36).slice(2, 18);
        }

        function uploadFileToStaging(config, batchId, index, total, onStatus) {
            return new Promise((resolve, reject) => {
                const input = document.getElementById(config.id);
                const file = input && input.files ? input.files[0] : null;
                if (!file) {
                    reject(new Error(config.label + ' belum dipilih.'));
                    return;
                }

                const formData = new FormData();
                formData.append('field', config.field);
                formData.append('upload_batch_id', batchId);
                formData.append('file', file, file.name);

                const xhr = new XMLHttpRequest();
                xhr.open('POST', apiPath('upload_temp.php'), true);
                xhr.withCredentials = true;
                xhr.timeout = FILE_UPLOAD_TIMEOUT_MS;
                xhr.setRequestHeader('Accept', 'application/json');

                xhr.upload.addEventListener('loadstart', () => {
                    onStatus('Mengunggah berkas ' + index + '/' + total + ' — ' + config.label + '...');
                });

                xhr.upload.addEventListener('progress', (event) => {
                    if (event.lengthComputable && event.total > 0) {
                        const percent = Math.min(99, Math.round((event.loaded / event.total) * 100));
                        onStatus('Mengunggah berkas ' + index + '/' + total + ' — ' + config.label + ' (' + percent + '%)');
                    }
                });

                xhr.addEventListener('load', () => {
                    try {
                        const data = parseApiPayload(xhr.responseText || '', xhr.status);
                        if (!data || data.status !== 'success') {
                            throw new Error((data && data.message) || config.label + ' gagal diunggah.');
                        }
                        onStatus('Berkas ' + index + '/' + total + ' tersimpan — ' + config.label + '.');
                        resolve(data);
                    } catch (error) {
                        reject(error);
                    }
                });

                xhr.addEventListener('error', () => {
                    reject(new Error(config.label + ': koneksi ke server terputus.'));
                });
                xhr.addEventListener('timeout', () => {
                    reject(new Error(config.label + ': upload melewati 5 menit. Perkecil/kompres berkas lalu coba lagi.'));
                });
                xhr.addEventListener('abort', () => {
                    reject(new Error(config.label + ': upload dibatalkan.'));
                });

                try {
                    xhr.send(formData);
                } catch (error) {
                    reject(error);
                }
            });
        }

        async function uploadFileWithRetry(config, batchId, index, total, onStatus) {
            let lastError = null;
            for (let attempt = 0; attempt <= MAX_UPLOAD_RETRIES; attempt++) {
                try {
                    return await uploadFileToStaging(config, batchId, index, total, onStatus);
                } catch (error) {
                    lastError = error;
                    if (attempt < MAX_UPLOAD_RETRIES) {
                        onStatus('Koneksi terputus pada ' + config.label + '. Mencoba ulang...');
                        await new Promise((resolve) => window.setTimeout(resolve, 900));
                    }
                }
            }
            throw lastError || new Error(config.label + ' gagal diunggah.');
        }

        async function uploadAllFilesSequentially(configs, batchId, onStatus) {
            for (let index = 0; index < configs.length; index++) {
                await uploadFileWithRetry(configs[index], batchId, index + 1, configs.length, onStatus);
            }
        }

        function submitRegistrationData(formData, onStatus) {
            return new Promise((resolve, reject) => {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', apiPath('apply.php'), true);
                xhr.withCredentials = true;
                xhr.timeout = FINAL_SUBMIT_TIMEOUT_MS;
                xhr.setRequestHeader('Accept', 'application/json');
                onStatus('Seluruh berkas tersimpan. Menyimpan data pendaftaran...');

                xhr.addEventListener('load', () => {
                    try {
                        resolve(parseApiPayload(xhr.responseText || '', xhr.status));
                    } catch (error) {
                        reject(error);
                    }
                });
                xhr.addEventListener('error', () => {
                    reject(new Error('Berkas sudah tersimpan, tetapi data pendaftaran belum mendapat respons server. Tekan Kirim Pendaftaran sekali lagi; berkas tidak perlu diunggah ulang.'));
                });
                xhr.addEventListener('timeout', () => {
                    reject(new Error('Server terlalu lama menyimpan data. Tekan Kirim Pendaftaran sekali lagi; berkas tidak perlu diunggah ulang.'));
                });
                xhr.addEventListener('abort', () => reject(new Error('Pendaftaran dibatalkan.')));

                try {
                    xhr.send(formData);
                } catch (error) {
                    reject(error);
                }
            });
        }

        const MAX_FILE_UPLOAD = 5 * 1024 * 1024;
        const MAX_TOTAL_UPLOAD = 45 * 1024 * 1024;

        function fileExtension(file) {
            const name = String(file && file.name ? file.name : '');
            const match = name.match(/\.([a-z0-9]+)$/i);
            return match ? match[1].toLowerCase() : '';
        }

        function validateSelectedFile(input, label, allowedExtensions, isRequired = true) {
            const file = input && input.files && input.files[0];
            if (!file) {
                if (isRequired) showToast(label + ' belum dipilih.');
                return !isRequired;
            }
            if (file.size <= 0 || file.size > MAX_FILE_UPLOAD) {
                showToast(label + ' maksimal 5MB. Perkecil/kompres berkas lalu pilih ulang.');
                return false;
            }
            if (!allowedExtensions.includes(fileExtension(file))) {
                showToast(label + ' harus berformat ' + allowedExtensions.map(ext => '.' + ext.toUpperCase()).join(', ') + '.');
                return false;
            }
            return true;
        }

        function isPdfFile(input) {
            const file = input && input.files && input.files[0];
            return Boolean(file) && file.size > 0 && file.size <= MAX_FILE_UPLOAD && fileExtension(file) === 'pdf';
        }

        function getRequiredUploadConfigs() {
            const files = [
                { id: 'field_leader_id', field: 'leader_id_scan', label: 'Kartu pelajar ketua', extensions: ['pdf'] },
                { id: 'field_member_id', field: 'member_id_scan', label: 'Kartu pelajar anggota', extensions: ['pdf'] },
                { id: 'field_proof', field: 'payment_proof', label: 'Bukti pembayaran', extensions: ['jpg', 'jpeg', 'png'] },
                { id: 'field_ig', field: 'proof_follow_ig', label: 'Bukti follow Instagram', extensions: ['pdf', 'jpg', 'jpeg', 'png'] },
                { id: 'field_feed', field: 'proof_repost_feed', label: 'Bukti repost feeds', extensions: ['pdf', 'jpg', 'jpeg', 'png'] },
                { id: 'field_comment_mention', field: 'proof_comment_mention', label: 'Bukti komen dan mention', extensions: ['pdf', 'jpg', 'jpeg', 'png'] },
                { id: 'field_twibbon', field: 'proof_twibbon', label: 'Bukti upload twibbon', extensions: ['pdf', 'jpg', 'jpeg', 'png'] }
            ];

            if (selectedCompType !== 'BCC') {
                files.unshift({ id: 'field_originality', field: 'proof_originality', label: 'Surat Pernyataan Orisinalitas', extensions: ['pdf'] });
            }
            return files;
        }

        function validateRequiredUploads() {
            for (const config of getRequiredUploadConfigs()) {
                if (!validateSelectedFile(document.getElementById(config.id), config.label, config.extensions, true)) return false;
            }
            return true;
        }

        function validateTotalUploadSize(form) {
            let total = 0;
            form.querySelectorAll('input[type="file"]').forEach((input) => {
                Array.from(input.files || []).forEach((file) => {
                    total += Number(file.size || 0);
                });
            });

            if (total > MAX_TOTAL_UPLOAD) {
                showToast('Total seluruh berkas melebihi 45MB. Perkecil ukuran PDF/gambar lalu coba kembali.');
                return false;
            }
            return true;
        }

        function getCurrentRule() {
            return pricingRules[selectedCompType] || pricingRules.BPC;
        }

        function getCurrentTier() {
            const checked = document.querySelector('input[name="pricing_tier"]:checked');
            return checked ? checked.value : selectedPricingTier;
        }

        function updateOriginalityRequirement() {
            const wrapper = document.getElementById('wrapper_originality_file');
            const input = document.getElementById('field_originality');
            const templateLink = document.getElementById('originality_template_link');
            const templateLabel = document.getElementById('originality_template_label');
            const categoryLabel = document.getElementById('originality_category_label');
            const template = originalityTemplates[selectedCompType];
            const needsOriginality = Boolean(template);

            wrapper.classList.toggle('hidden', !needsOriginality);
            input.required = needsOriginality;

            if (needsOriginality) {
                templateLink.href = template.href;
                templateLabel.textContent = template.label;
                categoryLabel.textContent = selectedCompType === 'BPC'
                    ? 'Wajib untuk Business Plan Competition'
                    : 'Wajib untuk English Business Plan Competition';
            } else {
                input.value = '';
            }
        }

        function updatePricingCards() {
            const rule = getCurrentRule();
            const earlyInput = document.getElementById('pricing_early');
            const normalInput = document.getElementById('pricing_normal');
            const earlyCard = document.getElementById('priceCardEarly');
            const normalCard = document.getElementById('priceCardNormal');
            const status = document.getElementById('pricing_status');

            document.getElementById('early_price_label').textContent = formatRupiah(rule.early);
            document.getElementById('normal_price_label').textContent = formatRupiah(rule.normal);
            document.getElementById('early_quota_label').textContent = rule.limit + ' pendaftar pertama';

            earlyInput.disabled = !earlyBirdAvailable;
            earlyCard.classList.toggle('is-disabled', !earlyBirdAvailable);

            if (!earlyBirdAvailable && selectedPricingTier === 'early_bird') {
                selectedPricingTier = 'normal';
                normalInput.checked = true;
            }
            if (selectedPricingTier === 'early_bird') earlyInput.checked = true;
            else normalInput.checked = true;

            earlyCard.classList.toggle('is-selected', selectedPricingTier === 'early_bird');
            normalCard.classList.toggle('is-selected', selectedPricingTier === 'normal');

            if (earlyBirdAvailable) {
                status.textContent = 'Kuota Early Bird tersedia. Harga final diverifikasi kembali saat formulir dikirim.';
                status.className = 'text-[11px] font-medium text-ink/45 mt-1';
            } else {
                status.textContent = 'Kuota Early Bird sudah penuh. Normal Price tersedia.';
                status.className = 'text-[11px] font-bold text-manifest-burgundy mt-1';
            }
        }

        function setDisplayedPrice(amount) {
            document.getElementById('display_amount').textContent = formatRupiah(amount);
        }

        async function requestPricing(showPromoMessage = false) {
            const promoCode = document.getElementById('ref_field').value.trim();
            const promoData = new FormData();
            promoData.append('referral_code', promoCode);
            promoData.append('competition_type', selectedCompType);
            promoData.append('pricing_tier', getCurrentTier());

            const res = await fetchApi('check_promo.php', { method: 'POST', body: promoData });
            const data = await parseApiResponse(res);

            if (typeof data.early_available !== 'undefined') {
                earlyBirdAvailable = Boolean(data.early_available);
            }

            if (data.status !== 'success') {
                if (data.early_available === false && getCurrentTier() === 'early_bird') {
                    selectedPricingTier = 'normal';
                    updatePricingCards();
                    return requestPricing(showPromoMessage);
                }
                throw new Error(data.message || 'Harga pendaftaran tidak dapat diproses.');
            }

            selectedPricingTier = data.pricing_tier || getCurrentTier();
            updatePricingCards();
            setDisplayedPrice(data.final_amount);

            const messageEl = document.getElementById('ref_message');
            if (showPromoMessage) {
                if (promoCode) {
                    const discountAmount = Number(data.discount_amount ?? data.discount ?? 0);
                    messageEl.textContent = `✓ Kode diterapkan (Potongan ${formatRupiah(discountAmount)})`;
                    messageEl.className = 'text-[11px] font-bold mt-1 text-manifest-rose';
                    showToast(data.message || 'Kode referral berhasil diterapkan!', 'success');
                } else {
                    messageEl.textContent = '';
                }
            }
            return data;
        }

        function refreshPricing(showPromoMessage = false) {
            requestPricing(showPromoMessage).catch((err) => {
                const messageEl = document.getElementById('ref_message');
                if (showPromoMessage) {
                    messageEl.textContent = '✕ ' + err.message;
                    messageEl.className = 'text-[11px] font-bold mt-1 text-manifest-burgundy';
                    showToast(err.message);
                }
                console.error(err);
            });
        }

        function selectPricingTier(tier) {
            if (tier === 'early_bird' && !earlyBirdAvailable) {
                showToast('Kuota Early Bird sudah penuh. Silakan pilih Normal Price.');
                document.getElementById('pricing_normal').checked = true;
                selectedPricingTier = 'normal';
                updatePricingCards();
                refreshPricing(false);
                return;
            }
            selectedPricingTier = tier;
            document.getElementById(tier === 'early_bird' ? 'pricing_early' : 'pricing_normal').checked = true;
            document.getElementById('ref_message').textContent = '';
            updatePricingCards();
            refreshPricing(false);
        }

        function verifyReferral() {
            const promoCode = document.getElementById('ref_field').value.trim();
            if (!promoCode) {
                showToast('Masukkan kode promo/referral terlebih dahulu!');
                return;
            }
            const messageEl = document.getElementById('ref_message');
            messageEl.textContent = 'Memverifikasi...';
            messageEl.className = 'text-[11px] font-bold mt-1 text-ink/60';
            requestPricing(true).catch((err) => {
                messageEl.textContent = '✕ ' + err.message;
                messageEl.className = 'text-[11px] font-bold mt-1 text-manifest-burgundy';
                showToast(err.message);
                console.error(err);
            });
        }

        function selectCompetition(type) {
            selectedCompType = type;
            selectedPricingTier = 'early_bird';
            earlyBirdAvailable = true;
            
            // Perubahan di sini: Mengubah title memakai nama lengkap dari object mapping
            const longName = competitionFullName[type] || type;
            document.getElementById('main-title').textContent = 'Pendaftaran Lomba — ' + longName;
            
            const radioInput = document.querySelector(`input[name="competition_type"][value="${type}"]`);
            if (radioInput) radioInput.checked = true;

            document.getElementById('ref_field').value = '';
            document.getElementById('ref_message').textContent = '';
            updateOriginalityRequirement();
            updatePricingCards();
            setDisplayedPrice(getCurrentRule().early);
            refreshPricing(false);
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

        function isValidPhone(value) {
            return /^[0-9]{9,15}$/.test(value);
        }

        function validateAndNext(nextStepTarget) {
            if (currentStep === 1) {
                const team = document.getElementById('field_team_name').value.trim();
                const discoverySource = document.getElementById('field_discovery_source').value;
                const lName = document.getElementById('field_leader_name').value.trim();
                const lSchool = document.getElementById('field_leader_school').value.trim();
                const lWa = document.getElementById('field_leader_wa').value.trim();
                const mName = document.getElementById('field_member_name').value.trim();
                const mSchool = document.getElementById('field_member_school').value.trim();
                const mWa = document.getElementById('field_member_wa').value.trim();
                const leaderId = document.getElementById('field_leader_id');
                const memberId = document.getElementById('field_member_id');

                if (!team || !lName || !lSchool || !mName || !mSchool) {
                    showToast('Mohon lengkapi seluruh data tim dan anggota terlebih dahulu.');
                    return;
                }
                if (!discoverySource) {
                    showToast('Pilih sumber informasi MANIFEST 2026 terlebih dahulu.');
                    return;
                }
                if (!isValidPhone(lWa) || !isValidPhone(mWa)) {
                    showToast('Nomor WhatsApp wajib berupa angka 9–15 digit.');
                    return;
                }
                if (!isPdfFile(leaderId) || !isPdfFile(memberId)) {
                    showToast('Kartu pelajar ketua dan anggota wajib diunggah dalam PDF, maksimal 5MB per file.');
                    return;
                }
            }

            if (currentStep === 2) {
                const holder = document.getElementById('field_holder').value.trim();
                const proofInput = document.getElementById('field_proof');
                const tier = getCurrentTier();
                if (!holder || !proofInput.files.length) {
                    showToast('Harap isi nama pemilik rekening dan lampirkan bukti pembayaran.');
                    return;
                }
                if (!validateSelectedFile(proofInput, 'Bukti pembayaran', ['jpg', 'jpeg', 'png'], true)) {
                    return;
                }
                if (!tier) {
                    showToast('Pilih kategori harga pendaftaran terlebih dahulu.');
                    return;
                }
                if (tier === 'early_bird' && !earlyBirdAvailable) {
                    showToast('Kuota Early Bird sudah penuh. Silakan pilih Normal Price.');
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

        document.getElementById('upgradeRegForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            if (!validateRequiredUploads()) {
                return;
            }
            if (!validateTotalUploadSize(this)) {
                return;
            }

            const form = this;
            const configs = getRequiredUploadConfigs();
            const btn = document.getElementById('btnSubmitForm');
            const status = document.getElementById('uploadStatus');
            const setUploadStatus = (message, visible = true) => {
                if (!status) return;
                status.textContent = message;
                status.classList.toggle('hidden', !visible);
            };

            const fingerprint = configs.map((config) => {
                const file = document.getElementById(config.id).files[0];
                return config.field + ':' + file.name + ':' + file.size + ':' + file.lastModified;
            }).join('|');

            btn.disabled = true;
            try {
                if (!stagedUploadState.ready || stagedUploadState.fingerprint !== fingerprint) {
                    stagedUploadState = {
                        batchId: createUploadBatchId(),
                        fingerprint: fingerprint,
                        ready: false
                    };
                    btn.textContent = 'MENGUNGGAH BERKAS...';
                    setUploadStatus('Menyiapkan upload bertahap...');
                    await uploadAllFilesSequentially(configs, stagedUploadState.batchId, setUploadStatus);
                    stagedUploadState.ready = true;
                }

                btn.textContent = 'MENYIMPAN PENDAFTARAN...';
                const formData = new FormData(form);
                // Berkas sudah berada di staging; jangan kirim ulang seluruh file pada request akhir.
                configs.forEach((config) => formData.delete(config.field));
                formData.set('competition_type', selectedCompType);
                formData.set('pricing_tier', getCurrentTier());
                formData.set('upload_batch_id', stagedUploadState.batchId);

                const data = await submitRegistrationData(formData, setUploadStatus);
                if (!data || data.status !== 'success') {
                    throw new Error((data && data.message) || 'Gagal memproses pendaftaran.');
                }

                stagedUploadState = { batchId: null, fingerprint: null, ready: false };
                btn.textContent = 'PENDAFTARAN BERHASIL';
                setUploadStatus('Pendaftaran berhasil disimpan. Halaman akan dimuat ulang...');
                showToast(data.message || 'Pendaftaran berhasil terkirim!', 'success');
                setTimeout(() => { window.location.reload(); }, 1500);
            } catch (err) {
                console.error(err);
                showToast(err.message || 'Terjadi kendala pada server. Silakan coba kembali.');
                btn.disabled = false;
                btn.textContent = stagedUploadState.ready ? 'KIRIM PENDAFTARAN' : 'COBA UPLOAD LAGI';
                // Status terakhir dibiarkan agar peserta tahu file mana yang bermasalah.
                if (!status || status.textContent.trim() === '') {
                    setUploadStatus(err.message || 'Upload belum selesai.');
                }
            }
        });

        updateOriginalityRequirement();
        updatePricingCards();
        setDisplayedPrice(getCurrentRule().early);
    </script>
</body>
</html>