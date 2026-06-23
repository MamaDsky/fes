<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Business Case Competition | Manifest 2026</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
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
                    },
                    animation: {
                        'marquee': 'marquee 15s linear infinite',
                    },
                    keyframes: {
                        marquee: {
                            '0%': { transform: 'translateX(0%)' },
                            '100%': { transform: 'translateX(-50%)' },
                        }
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
            position: fixed; inset: 0; z-index: 9999; pointer-events: none; opacity: 0.35; mix-blend-mode: multiply;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.15'/%3E%3C/svg%3E");
        }

        /* === ANIMASI TIRAI === */
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

        /* PREMIUM THEATER STRIPES BACKGROUND */
        .bpc-hero-multipage {
            isolation: isolate;
            background-image: repeating-linear-gradient(
                90deg,
                #500707 0px,
                #500707 30px,
                #3b0303 30px,
                #3b0303 60px
            );
            position: relative;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }
        
        .bpc-hero-multipage::before {
            content: ''; position: absolute; inset: 0; z-index: 0; pointer-events: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='120' height='240' viewBox='0 0 120 240'%3E%3Cg fill='%23280101' fill-opacity='0.55'%3E%3Cpath d='M30 15 q0 15 15 15 q-15 0 -15 15 q0 -15 -15 -15 q15 0 15 -15 Z'/%3E%3Ccircle cx='30' cy='70' r='3.5'/%3E%3Cpath d='M30 100 q0 12 12 12 q-12 0 -12 12 q0 -12 -12 -12 q12 0 12 -12 Z M23 106 q7 6 7 14 q0 -8 7 -14 q-7 -1 -7 -8 q0 7 -7 8 Z'/%3E%3Ccircle cx='30' cy='150' r='3.5'/%3E%3Cpath d='M30 175 q0 15 15 15 q-15 0 -15 15 q0 -15 -15 -15 q15 0 15 -15 Z'/%3E%3Ccircle cx='30' cy='230' r='3.5'/%3E%3Cpath d='M90 135 q0 15 15 15 q-15 0 -15 15 q0 -15 -15 -15 q15 0 15 -15 Z'/%3E%3Ccircle cx='90' cy='195' r='3.5'/%3E%3Cpath d='M90 10 q0 12 12 12 q-12 0 -12 12 q0 -12 -12 -12 q12 0 12 -12 Z M83 16 q7 6 7 14 q0 -8 7 -14 q-7 -1 -7 -8 q0 7 -7 8 Z'/%3E%3Ccircle cx='90' cy='60' r='3.5'/%3E%3C/g%3E%3C/svg%3E");
            background-size: 120px 240px; background-position: center top;
            mask-image: radial-gradient(circle at 50% 50%, black 50%, rgba(0,0,0,0.6) 100%);
            -webkit-mask-image: radial-gradient(circle at 50% 50%, black 50%, rgba(0,0,0,0.6) 100%);
        }

        /* ANIMASI NOT BALOK BACKGROUND TIMPAAN */
        .floating-elements { position: absolute; inset: 0; z-index: 2; pointer-events: none; overflow: hidden; }
        .note {
            position: absolute; bottom: -60px; will-change: transform, opacity;
            animation: floatStage linear infinite;
        }

        @keyframes floatStage {
            0% { transform: translate3d(0, 0, 0) rotate(0deg) scale(0.9); opacity: 0; }
            10% { opacity: var(--max-op, 0.6); }
            90% { opacity: var(--max-op, 0.6); }
            100% { transform: translate3d(var(--drift, 18px), -102vh, 0) rotate(var(--rot, 20deg)) scale(1.1); opacity: 0; }
        }

        /* TRANSISI ELEMEN REVEAL HALUS */
        .reveal { opacity: 0; transform: translateY(30px); transition: all 1s cubic-bezier(0.16, 1, 0.3, 1); will-change: transform, opacity; }
        .reveal.active { opacity: 1; transform: translateY(0); }
        .delay-100 { transition-delay: 150ms; }
        .delay-200 { transition-delay: 300ms; }
        .delay-300 { transition-delay: 450ms; }

        .manifest-soft-card {
            background: linear-gradient(180deg, rgba(255,255,255,0.85), rgba(245, 240, 227, 0.5));
            border: 1px solid rgba(34, 7, 1, 0.06);
            box-shadow: 0 16px 40px rgba(34, 7, 1, 0.04);
            backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px);
        }
        .manifest-soft-card:hover { transform: translateY(-4px); box-shadow: 0 22px 50px rgba(34, 7, 1, 0.07); }

        @media (min-width: 1024px) {
            .timeline-grid-item::before {
                content: ''; position: absolute; top: 2rem; right: -1.25rem; width: 1.25rem; height: 1px;
                background: rgba(82, 0, 0, 0.12);
            }
            .timeline-grid-item:last-child::before { display: none; }
        }

        /* DINAMIS NAVBAR CLASSES */
        .nav-at-top {
            background: rgba(255, 255, 255, 0.22) !important;
            border-color: rgba(255, 255, 255, 0.5) !important;
            box-shadow: 0 15px 45px rgba(0,0,0,0.35);
        }
        .nav-scrolled {
            background: rgba(26, 4, 2, 0.92) !important; 
            border-color: rgba(255, 255, 255, 0.2) !important;
            box-shadow: 0 10px 30px rgba(26, 4, 2, 0.3);
        }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #FFFBEB; }
        ::-webkit-scrollbar-thumb { background: #220701; border-radius: 10px; }
    </style>
</head>
<body class="bg-cream text-ink font-body antialiased overflow-x-hidden selection:bg-manifest-burgundy selection:text-white">

    <div class="gsm-texture"></div>

    <!-- === LOADING CURTAIN === -->
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

    <!-- === FIXED LAYERING MOBILE SIDEBAR === -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-manifest-dark/40 backdrop-blur-sm z-[999] opacity-0 pointer-events-none transition-opacity duration-300"></div>
    <div id="mobileSidebar" class="fixed inset-y-0 right-0 w-[85%] sm:w-[400px] bg-cream z-[1000] transform translate-x-full p-8 pt-12 flex flex-col justify-between shadow-[-10px_0_40px_rgba(34,7,1,0.15)] border-l border-white/50 transition-transform duration-300">
        
        <div class="flex items-center justify-between w-full mb-8 border-b border-manifest-dark/5 pb-4">
            <span class="text-[10px] font-heading font-bold uppercase tracking-widest text-manifest-burgundy flex items-center gap-2">
                 Menu Navigasi
            </span>
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
                <a href="#contact" class="sidebar-anchor font-script text-5xl italic text-ink hover:text-manifest-burgundy transition-colors block">Contact Us</a>
            </div>
        </nav>

        <div class="sidebar-link link-3 flex flex-col gap-6 border-t border-manifest-dark/5 pt-8">
            <a href="daftar" class="sidebar-anchor w-full bg-manifest-dark text-white text-center py-4 font-heading rounded-full text-xs font-bold uppercase tracking-widest hover:bg-manifest-rose transition-colors flex items-center justify-center gap-2 shadow-sm">
                <i class="fas fa-paper-plane text-[10px]"></i> Daftar Sekarang
            </a>
        </div>
    </div>

    <!-- === PREMIUM DESKTOP / MOBILE NAVBAR === -->
    <header class="fixed w-full top-5 z-[50] px-4 md:px-12 transition-all duration-500" id="navbar">
        <div id="navInner" class="max-w-[1340px] mx-auto nav-at-top backdrop-blur-2xl rounded-full px-6 md:px-8 py-3 flex justify-between items-center transition-all duration-500">
            
            <a href="index" class="font-heading text-xl md:text-2xl font-bold flex items-center gap-1 text-white tracking-tighter group" id="navLogo">
                MANIFEST<span class="text-white leading-none transition-transform duration-300 group-hover:scale-125">.</span>
            </a>
            
            <div class="hidden md:flex gap-12 text-[11px] font-heading font-bold uppercase tracking-[0.2em] text-white/90 items-center" id="navLinks">
                <div class="relative group cursor-pointer py-2">
                    <span class="hover:text-white transition-all duration-300 flex items-center gap-2 group-hover:text-white" id="navLinkLomba">
                        Lomba <i class="fas fa-chevron-down text-[8px] transition-transform duration-300 group-hover:rotate-180 text-white/40 group-hover:text-white"></i>
                    </span>
                    
                    <div class="absolute top-full right-1/2 translate-x-1/2 pt-3 opacity-0 scale-95 origin-top invisible group-hover:opacity-100 group-hover:scale-100 group-hover:visible transition-all duration-300 pointer-events-none group-hover:pointer-events-auto">
                        <div class="bg-white/95 backdrop-blur-xl p-3 rounded-2xl shadow-[0_25px_50px_rgba(0,0,0,0.4)] w-64 flex flex-col gap-1 border border-white/20">
                            <span class="px-3 py-1.5 text-[9px] tracking-widest text-manifest-dark/40 uppercase font-heading font-extrabold border-b border-manifest-dark/5 mb-1 flex items-center gap-1.5">Kategori Lomba</span>
                            <a href="bpc" class="text-[10px] tracking-widest uppercase font-bold text-manifest-dark/80 hover:text-white hover:bg-manifest-dark p-3 rounded-xl flex items-center justify-between transition-all duration-200 group/item"><span>Business Plan</span><i class="fas fa-arrow-right text-[9px]"></i></a>
                            <a href="bcc" class="text-[10px] tracking-widest uppercase font-bold text-manifest-dark/80 hover:text-white hover:bg-manifest-dark p-3 rounded-xl flex items-center justify-between transition-all duration-200 group/item"><span>Business Case</span><i class="fas fa-arrow-right text-[9px]"></i></a>
                            <a href="ebpc" class="text-[10px] tracking-widest uppercase font-bold text-manifest-dark/80 hover:text-white hover:bg-manifest-dark p-3 rounded-xl flex items-center justify-between transition-all duration-200 group/item"><span>English Business Plan</span><i class="fas fa-arrow-right text-[9px]"></i></a>
                        </div>
                    </div>
                </div>

                <a href="#contact" class="hover:text-white transition-all duration-300 relative group py-2" id="navLinkContact">Contact Us<span class="absolute bottom-0 left-0 w-0 h-[1.5px] bg-white transition-all duration-300 group-hover:w-full"></span></a>
            </div>

            <div class="hidden md:block">
                <a href="daftar" class="relative inline-flex items-center justify-center bg-white text-manifest-dark px-8 py-3 rounded-full text-[10px] font-heading font-bold uppercase tracking-[0.18em] overflow-hidden transition-all duration-300 hover:bg-manifest-dark hover:text-white hover:shadow-[0_10px_25px_rgba(255,255,255,0.15)] hover:-translate-y-0.5">
                    <span class="relative z-10 flex items-center gap-2"><i class="fas fa-paper-plane text-[9px]"></i> Daftar</span>
                </a>
            </div>

            <button id="menuButton" class="block md:hidden relative w-6 h-5 flex flex-col justify-between items-end group focus:outline-none">
                <span class="w-6 h-[1.5px] bg-white rounded-full"></span>
                <span class="w-4 h-[1.5px] bg-white rounded-full"></span>
                <span class="w-5 h-[1.5px] bg-white rounded-full"></span>
            </button>
        </div>
    </header>

    <main>
        <!-- MULTIPAGE LIGHT HERO HEADER -->
        <section class="bpc-hero-multipage relative pt-40 pb-16 px-5 sm:px-8 md:px-12 lg:px-16 overflow-hidden">
            <div class="floating-elements" id="notesContainer"></div>
            
            <div class="relative z-10 max-w-[1220px] mx-auto flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-white/10 pb-10">
                <div class="text-left max-w-[640px]">
                    <span class="reveal text-[9px] font-heading font-bold uppercase tracking-[0.20em] text-manifest-cream block mb-2">Movement II &bull; Competition Package</span>
                    <h1 class="reveal delay-100 font-heading font-bold text-4xl md:text-5xl lg:text-6xl text-white uppercase tracking-tight leading-[0.95]">
                        Business Case <br><span class="font-accent italic text-manifest-cream normal-case font-normal font-serif">Competition</span>
                    </h1>
                    <p class="reveal delay-200 mt-4 text-xs md:text-sm leading-relaxed text-white/70 tracking-wide font-light">
                        Tantangan analisis studi kasus riil dari perusahaan kolaborator. Peserta diminta memecahkan problematika secara taktis serta menyusun strategi solusi bisnis yang komprehensif, relevan, dan aplikatif.
                    </p>
                </div>
                
                <div class="reveal delay-200 flex flex-col sm:flex-row gap-3 font-heading w-full md:w-auto min-w-[300px]">
                    <a href="daftar" class="relative inline-flex items-center justify-center bg-white text-manifest-dark px-8 py-4 rounded-full text-[11px] font-bold uppercase tracking-widest overflow-hidden transition-all duration-300 group hover:shadow-[0_12px_24px_rgba(255,255,255,0.15)] hover:-translate-y-0.5 text-center flex-1 sm:flex-none">
                        <span class="relative z-10 flex items-center justify-center gap-2"><i class="fas fa-file-alt text-[10px]"></i> Daftar Lomba</span>
                    </a>
                    <a href="https://drive.google.com/drive/folders/1Gd1wBiqbjl8SF48PYI78PHGMHHTvL0Xr?usp=sharing" target="_blank" class="inline-flex items-center justify-center bg-transparent border border-white/20 text-white px-8 py-4 rounded-full text-[11px] font-bold uppercase tracking-widest transition-all duration-300 hover:border-white hover:bg-white/5 hover:-translate-y-0.5 text-center flex-1 sm:flex-none">
                        <span class="flex items-center justify-center gap-2"><i class="fas fa-download text-[10px]"></i> Guidebook</span>
                    </a>
                </div>
            </div>
        </section>

        <!-- BENTO DETAILS GRID SECTION -->
        <section class="py-12 md:py-16 px-4 sm:px-6 md:px-12 relative z-20">
            <div class="max-w-[1220px] mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-5">
                    
                    <!-- Bento 1 -->
                    <div class="manifest-soft-card rounded-[1.5rem] p-5 md:p-6 md:col-span-2 flex flex-col justify-between transition-all duration-500 hover:scale-[1.01] hover:shadow-xl reveal">
                        <div>
                            <span class="text-[8px] font-heading font-bold uppercase tracking-widest text-manifest-rose">01 / Challenge Focus</span>
                            <h3 class="font-heading text-lg md:text-xl font-bold text-ink mt-2 mb-3">Transforming Challenges into Opportunities Through Innovation, Collaboration, and Growth</h3>
                            <p class="text-xs leading-relaxed text-ink/60">
                                Peserta diwajibkan untuk menyelesaikan problem dari perusahaan mitra/kolaborator dengan menganalisis akar masalah secara riil, mengeksplorasi potensi, serta menawarkan formula penyelesaian taktis yang adaptif dan siap berdampak langsung pada akselerasi pertumbuhan bisnis.
                            </p>
                        </div>
                        <div class="mt-6 pt-4 border-t border-manifest-dark/5 flex gap-6">
                            <div>
                                <span class="text-[9px] uppercase tracking-wider text-ink/40 block">Format Kelompok</span>
                                <span class="font-heading text-xs font-bold text-manifest-burgundy">2 Siswa / Instansi Sekolah yang berbeda / sama</span>
                            </div>
                            <div>
                                <span class="text-[9px] uppercase tracking-wider text-ink/40 block">Skala Kompetisi</span>
                                <span class="font-heading text-xs font-bold text-manifest-burgundy">Nasional (SMA Sederajat)</span>
                            </div>
                        </div>
                    </div>

                    <!-- Bento 2: Burgundy Card -->
                    <div class="bg-manifest-burgundy text-white rounded-[1.5rem] p-5 md:p-6 flex flex-col justify-between shadow-md transition-all duration-500 hover:scale-[1.01] hover:shadow-2xl reveal delay-100">
                        <div>
                            <span class="text-[8px] font-heading font-bold uppercase tracking-widest text-white/40">02 / Rewards</span>
                            <h3 class="font-heading text-base md:text-lg font-bold mt-2 opacity-90">BCC Grand Prize Pool</h3>
                            <p class="font-accent italic text-3xl md:text-4xl text-manifest-cream my-3">Rp11.000.000</p>
                        </div>
                        <p class="text-[11px] text-white/60 leading-relaxed border-t border-white/10 pt-3">
                            Distribusi: Juara 1 (5 Jt + **Golden Ticket Free Pass Bebas Tes Masuk Program Studi S1 Bisnis Digital ITS**), Juara 2 (3.5 Jt), Juara 3 (2.5 Jt), & Best Speaker (500 Ribu).
                        </p>
                    </div>

                    <!-- Bento 3 -->
                    <div class="manifest-soft-card rounded-[1.5rem] p-5 md:p-6 flex flex-col justify-between transition-all duration-500 hover:scale-[1.01] hover:shadow-xl reveal">
                        <div>
                            <span class="text-[8px] font-heading font-bold uppercase tracking-widest text-manifest-rose">03 / Admission</span>
                            <h3 class="font-heading text-sm md:text-base font-bold text-ink mt-2 mb-1">Registration Fee Tier</h3>
                            <div class="flex justify-between items-center mt-2">
                                <span class="text-xs text-ink/60">Early Bird:</span>
                                <span class="font-heading text-sm font-bold text-manifest-burgundy">Rp65.000</span>
                            </div>
                            <div class="flex justify-between items-center mt-1">
                                <span class="text-xs text-ink/60">Normal Fee:</span>
                                <span class="font-heading text-sm font-bold text-manifest-burgundy">Rp75.000</span>
                            </div>
                        </div>
                        <p class="text-[11px] text-ink/50 leading-relaxed pt-3 border-t border-manifest-dark/5 mt-3">
                            Transfer resmi: **BANK JAGO 100930748805 (a.n FARADITA TANZANIA)**. Wajib mengunggah scan Kartu Pelajar aktif.
                        </p>
                    </div>

                    <!-- Bento 4 -->
                    <div class="manifest-soft-card rounded-[1.5rem] p-5 md:p-6 md:col-span-2 flex flex-col justify-between transition-all duration-500 hover:scale-[1.01] hover:shadow-xl reveal delay-100">
                        <div>
                            <span class="text-[8px] font-heading font-bold uppercase tracking-widest text-manifest-rose">04 / Deliverables & Legitimacy</span>
                            <h3 class="font-heading text-base md:text-lg font-bold text-ink mt-2 mb-2">Sistem Pengumpulan Berkas Digital</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-2">
                                <div class="p-3.5 bg-white/50 rounded-xl border border-manifest-dark/5">
                                    <h4 class="font-heading font-bold text-xs text-manifest-burgundy mb-1">Babak Preliminary: Executive Summary</h4>
                                    <p class="text-[11px] text-ink/60 leading-relaxed">Format 1 halaman PDF ukuran A4 potrait. Font Times New Roman (Judul 14 Bold, Isi 12 Justify, Margin 1-1-1-1). Nama file: EXSUM_Nama Tim_Nama Ketua Tim.</p>
                                </div>
                                <div class="p-4 bg-white/50 rounded-xl border border-manifest-dark/5">
                                    <h4 class="font-heading font-bold text-xs text-manifest-burgundy mb-1">Babak Semifinal: Proposal</h4>
                                    <p class="text-[11px] text-ink/60 leading-relaxed">Proposal penyelesaian komprehensif maksimal 15 halaman PDF (di luar cover, abstrak, lampiran). Spasi 1.15, Margin 4-3-3-3. Nama file: BCC Proposal_Nama Tim_Nama Ketua Tim.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- 👑 THE ULTIMATE REDESIGN: APPLE-STYLE INFOGRAPHIC BENTO MATRIX 👑 -->
        <section class="py-20 md:py-24 px-4 sm:px-6 md:px-12 relative z-20 border-t border-manifest-dark/5 bg-gradient-to-b from-white/30 to-transparent">
            <div class="max-w-[1220px] mx-auto">
                <div class="max-w-2xl mb-16 text-left reveal">
                    <span class="inline-flex items-center gap-2 rounded-full border border-manifest-dark/10 bg-white/45 px-4 py-2 text-[10px] font-heading font-bold uppercase tracking-[0.24em] text-ink/50 mb-4">
                        <span class="w-1.5 h-1.5 rounded-full bg-manifest-rose"></span>
                        Evaluation Parameters
                    </span>
                    <h2 class="font-heading text-[clamp(2.2rem,5vw,3.8rem)] leading-[0.92] tracking-tight text-ink uppercase mb-4">Judging Matrix Infographics</h2>
                    <p class="text-sm md:text-base text-ink/54 max-w-xl leading-relaxed">Transparansi parameter penentuan skor juri. Skema pembobotan dirancang asimetris menyesuaikan tingkat kedalaman esensi riset studi kasus di setiap babak.</p>
                </div>
                
                <!-- CONTAINER UTAMA DUA BABAK -->
                <div class="space-y-16">
                    
                    <!-- PHASE 01: PRELIMINARY GRID -->
                    <div class="space-y-6">
                        <div class="flex items-center gap-4 reveal border-b border-manifest-dark/5 pb-3">
                            <span class="font-accent italic text-3xl md:text-4xl text-manifest-burgundy/40">01 /</span>
                            <h3 class="font-heading font-bold text-lg md:text-xl text-ink uppercase tracking-wide">Babak Preliminary <span class="font-body text-xs text-ink/40 lowercase tracking-normal font-normal pl-2">(Bobot Evaluasi Executive Summary)</span></h3>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <!-- Card Big 60% -->
                            <div class="sm:col-span-2 manifest-soft-card rounded-2xl p-6 flex flex-col justify-between transition-all duration-300 hover:scale-[1.02] reveal delay-100">
                                <div class="flex justify-between items-start">
                                    <span class="text-[9px] uppercase tracking-wider text-ink/40 font-heading font-bold">Core Matrix</span>
                                    <div class="w-7 h-7 rounded-full bg-manifest-burgundy/5 flex items-center justify-center text-manifest-burgundy"><i class="fas fa-lightbulb text-xs"></i></div>
                                </div>
                                <div class="mt-8">
                                    <span class="font-accent italic text-5xl md:text-6xl text-manifest-burgundy leading-none block">60%</span>
                                    <h4 class="font-heading font-bold text-sm text-ink mt-3">Analisis dan Solusi</h4>
                                    <p class="text-[11px] text-ink/50 leading-relaxed mt-1.5">Penilaian ditekankan pada rasionalitas argumentasi dari hasil analisis kasus, kualitas & kedalaman taktis dari solusi yang ditawarkan, serta tingkat kelayakan pengimplementasian solusi tersebut.</p>
                                </div>
                            </div>

                            <!-- Card Medium 25% -->
                            <div class="manifest-soft-card rounded-2xl p-6 flex flex-col justify-between transition-all duration-300 hover:scale-[1.02] reveal delay-200">
                                <div class="flex justify-between items-start">
                                    <span class="text-[9px] uppercase tracking-wider text-ink/40 font-heading font-bold">Aspek Metodologi</span>
                                    <div class="w-7 h-7 rounded-full bg-manifest-burgundy/5 flex items-center justify-center text-manifest-burgundy"><i class="fas fa-search text-xs"></i></div>
                                </div>
                                <div class="mt-8">
                                    <span class="font-accent italic text-5xl md:text-6xl text-manifest-burgundy leading-none block">25%</span>
                                    <h4 class="font-heading font-bold text-sm text-ink mt-3">Riset dan Metodologi</h4>
                                    <p class="text-[11px] text-ink/50 leading-relaxed mt-1.5">Kualitas pengolahan sumber referensi pendukung yang relevan dan kredibel, serta ketepatan penggunaan tools atau metode analisis bisnis.</p>
                                </div>
                            </div>

                            <!-- Row Bawah: 10% & 5% -->
                            <div class="sm:col-span-2 bg-white/60 backdrop-blur-md border border-manifest-dark/5 rounded-2xl p-5 flex items-center gap-4 transition-all duration-300 hover:scale-[1.01] reveal">
                                <span class="font-accent italic text-4xl text-manifest-rose font-bold shrink-0">10%</span>
                                <div>
                                    <h4 class="font-heading font-bold text-xs text-ink">Struktur Bahasa</h4>
                                    <p class="text-[11px] text-ink/50 leading-tight mt-0.5">Penggunaan tata bahasa formal, diksi yang tepat, serta kerapian struktur kalimat rancangan berkas.</p>
                                </div>
                            </div>

                            <div class="bg-white/40 backdrop-blur-md border border-manifest-dark/5 border-dashed rounded-2xl p-5 flex items-center gap-4 transition-all duration-300 hover:scale-[1.01] reveal delay-100">
                                <span class="font-accent italic text-4xl text-ink/30 font-bold shrink-0">05%</span>
                                <div>
                                    <h4 class="font-heading font-bold text-xs text-ink/70">Format Penulisan</h4>
                                    <p class="text-[11px] text-ink/40 leading-tight mt-0.5">Kepatuhan teknis penulisan secara sistematis sesuai regulasi instruksi (EYD & Layout).</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PHASE 02: SEMIFINAL GRID -->
                    <div class="space-y-6 pt-6">
                        <div class="flex items-center gap-4 reveal border-b border-manifest-dark/5 pb-3">
                            <span class="font-accent italic text-3xl md:text-4xl text-manifest-burgundy/40">02 /</span>
                            <h3 class="font-heading font-bold text-lg md:text-xl text-ink uppercase tracking-wide">Babak Semifinal <span class="font-body text-xs text-ink/40 lowercase tracking-normal font-normal pl-2">(Bobot Evaluasi Proposal Kasus)</span></h3>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                            <!-- Mega Dominant Card: 65% -->
                            <div class="md:col-span-7 bg-manifest-burgundy text-cream rounded-3xl p-6 md:p-8 flex flex-col justify-between shadow-lg transition-all duration-300 hover:scale-[1.01] hover:shadow-2xl reveal">
                                <div>
                                    <div class="flex justify-between items-start border-b border-white/10 pb-4">
                                        <span class="text-[8px] font-heading font-bold uppercase tracking-widest text-manifest-cream/50">High-Level Strategic Evaluation</span>
                                        <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-manifest-cream"><i class="fas fa-shield-alt text-xs"></i></div>
                                    </div>
                                    <div class="mt-8 md:mt-12">
                                        <span class="font-accent italic text-6xl md:text-7xl lg:text-8xl text-manifest-cream leading-none block">65%</span>
                                        <h4 class="font-heading font-bold text-base text-white mt-4 uppercase tracking-wide">Analisis dan Solusi Komprehensif</h4>
                                        <p class="text-xs text-manifest-cream/70 leading-relaxed mt-2.5">
                                            Penilaian fokus utama juri pada objektivitas rasionalitas argumentasi dari hasil analisis masalah perusahaan, kualitas operasional & kecerdasan strategi solusi yang ditawarkan, estimasi dampak nyata, serta perhitungan matang kelayakan penerapan solusi secara operasional-finansial.
                                        </p>
                                    </div>
                                </div>
                                <div class="mt-8 pt-4 border-t border-white/10 text-[10px] text-manifest-cream/40 font-light uppercase tracking-wider">
                                    Strategic Impact Passing Gate
                                </div>
                            </div>

                            <!-- Right Side Dashboard Grid inside Semifinal (Mengisi sisa kolom) -->
                            <div class="md:col-span-5 grid grid-cols-1 gap-4">
                                
                                <div class="manifest-soft-card rounded-2xl p-6 flex flex-col justify-between transition-all duration-300 hover:scale-[1.02] reveal delay-100">
                                    <div>
                                        <div class="w-6 h-6 rounded-full bg-manifest-burgundy/5 flex items-center justify-center text-manifest-burgundy text-[10px]"><i class="fas fa-fingerprint"></i></div>
                                        <h4 class="font-heading font-bold text-xs text-ink mt-3">Riset dan Metodologi</h4>
                                    </div>
                                    <div class="mt-6">
                                        <span class="font-accent italic text-4xl text-manifest-burgundy block leading-none">25%</span>
                                        <p class="text-[11px] text-ink/50 leading-normal mt-1">Kredibilitas penyeleksian sumber daya referensi acuan data analitik bisnis serta ketepatan kerangka pisau analisis konseptual framework.</p>
                                    </div>
                                </div>

                                <div class="bg-white/70 border border-manifest-dark/5 rounded-2xl p-5 flex flex-col justify-between transition-all duration-300 hover:scale-[1.02] reveal delay-200">
                                    <div class="flex justify-between items-center">
                                        <h4 class="font-heading font-bold text-xs text-ink">Struktur Kalimat</h4>
                                        <span class="font-accent italic text-2xl text-manifest-rose font-bold">04%</span>
                                    </div>
                                    <p class="text-[11px] text-ink/50 leading-none mt-1">Efektivitas penyusunan kalimat akademis formal yang komunikatif.</p>
                                </div>

                                <div class="bg-white/45 border border-manifest-dark/5 border-dashed rounded-2xl p-4 flex items-center justify-between transition-all duration-300 hover:scale-[1.01] reveal delay-300">
                                    <div class="flex items-center gap-3">
                                        <span class="font-accent italic text-2xl text-ink/40 font-bold">05%</span>
                                        <div class="w-px h-6 bg-manifest-dark/10"></div>
                                        <div>
                                            <h4 class="font-heading font-bold text-xs text-ink/80">Format & Sistematika Penulisan</h4>
                                            <p class="text-[10px] text-ink/40">Kepatuhan batas layout margin 4-3-3-3, limitasi 15 lembar, aturan EYD baku.</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>

        <!-- BUSINESS FINRACE SIMULATION -->
        <section class="py-12 md:py-16 px-4 sm:px-6 md:px-12 relative z-20 border-t border-manifest-dark/5 bg-gradient-to-b from-white/20 to-transparent">
            <div class="max-w-[1220px] mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-7 max-w-xl text-left reveal">
                    <span class="text-[9px] font-heading font-bold uppercase tracking-[0.2em] text-manifest-rose block mb-2">Interactive Business Simulation</span>
                    <h2 class="font-heading text-2xl md:text-3xl font-bold text-ink uppercase tracking-tight">FinRace Simulation Mechanism</h2>
                    <p class="text-xs leading-relaxed text-ink/60 mt-3">
                        Sebagai bagian dari agenda eksklusif <b>3-Day Business Camp</b> luring di Surabaya, 5 tim finalis terbaik akan ditantang bertanding dalam permainan interaktif <b>FinRace (Business Race)</b>.
                    </p>
                    <p class="text-xs leading-relaxed text-ink/60 mt-2">
                        Setiap kelompok dibekali modal awal berupa uang mainan taktis untuk melakukan portofolio investasi pada aset yang disediakan, menyelesaikan beberapa misi, serta beradu taktik kecepatan akumulasi profit.
                    </p>
                </div>
                <div class="lg:col-span-5 grid grid-cols-2 gap-3.5 font-heading text-center reveal delay-100">
                    <div class="p-4 bg-white/70 rounded-xl border border-manifest-dark/5 shadow-sm transition-all duration-300 hover:scale-[1.02] hover:shadow-md">
                        <span class="block text-xl font-bold text-manifest-burgundy font-serif italic">01</span>
                        <span class="block text-[10px] uppercase tracking-wider text-ink/40 mt-1">Sifat Agenda</span>
                        <span class="block text-xs font-bold text-ink mt-0.5">Offline di MB ITS</span>
                    </div>
                    <div class="p-4 bg-white/70 rounded-xl border border-manifest-dark/5 shadow-sm transition-all duration-300 hover:scale-[1.02] hover:shadow-md">
                        <span class="block text-xl font-bold text-manifest-burgundy font-serif italic">02</span>
                        <span class="block text-[10px] uppercase tracking-wider text-ink/40 mt-1">Kalkulasi Juara</span>
                        <span class="block text-xs font-bold text-ink mt-0.5">Kecepatan & Nilai Aset</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- TIMELINE SECTION -->
        <section class="py-16 md:py-20 px-4 sm:px-6 md:px-12 relative z-20 bg-[#FAF8F3]/60 border-t border-manifest-dark/5">
            <div class="max-w-[1220px] mx-auto">
                
                <div class="max-w-xl mb-10 md:mb-14 text-left reveal">
                    <span class="inline-flex items-center gap-2 rounded-full border border-manifest-dark/10 bg-white/45 px-3 py-1.5 text-[9px] font-heading font-bold uppercase tracking-[0.2em] text-ink/50 mb-3">
                        <span class="w-1.1 h-1.1 rounded-full bg-manifest-burgundy"></span>
                        Competition Schedule
                    </span>
                    <h2 class="font-heading text-2xl md:text-3xl font-bold text-ink uppercase tracking-tight">Timeline</h2>
                    <p class="text-xs text-ink/50 mt-2">Perhatikan ritme garis waktu di bawah demi ketepatan pengumpulan berkas administrasi analisis kasus tim delegasi Anda.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-5">
                    
                    <div class="timeline-grid-item relative bg-white border border-manifest-dark/5 rounded-[1.4rem] p-5 md:p-6 shadow-sm transition-all duration-500 hover:-translate-y-1 hover:shadow-xl flex flex-col justify-between min-h-[180px] md:min-h-[190px] reveal">
                        <div>
                            <div class="flex items-baseline justify-between">
                                <span class="font-accent italic text-2xl md:text-3xl text-manifest-burgundy/40">Mov. I</span>
                                <span class="text-[9px] font-heading font-bold uppercase tracking-wider text-manifest-rose bg-manifest-rose/5 border border-manifest-rose/10 px-2.5 py-0.5 rounded-full">Active</span>
                            </div>
                            <h3 class="font-heading font-bold text-sm md:text-base text-manifest-dark mt-4">Pendaftaran Gelombang</h3>
                            <p class="text-xs text-manifest-dark/50 mt-2 leading-relaxed">Pembukaan gerbang registrasi administratif serta pengisian database tim pendaftar.</p>
                        </div>
                        <div class="mt-6 pt-3 border-t border-manifest-dark/5 font-heading text-[10px] font-bold text-manifest-burgundy tracking-wide uppercase">
                            22 Juni - 8 Agustus 2026
                        </div>
                    </div>

                    <div class="timeline-grid-item relative bg-white border border-manifest-dark/5 rounded-[1.4rem] p-5 md:p-6 shadow-sm transition-all duration-500 hover:-translate-y-1 hover:shadow-xl flex flex-col justify-between min-h-[180px] md:min-h-[190px] reveal delay-100">
                        <div>
                            <div class="flex items-baseline justify-between">
                                <span class="font-accent italic text-2xl md:text-3xl text-manifest-burgundy/40">Mov. II</span>
                                <span class="text-[9px] font-heading font-bold uppercase tracking-wider text-manifest-dark/30 bg-manifest-dark/5 px-2.5 py-0.5 rounded-full">Case Released</span>
                            </div>
                            <h3 class="font-heading font-bold text-sm md:text-base text-manifest-dark mt-4">Preliminary (Exsum)</h3>
                            <p class="text-xs text-manifest-dark/50 mt-2 leading-relaxed">Rilis kasus pada 9 Agustus. Batas akhir submisi dokumen analisis Executive Summary kelompok.</p>
                        </div>
                        <div class="mt-6 pt-3 border-t border-manifest-dark/5 font-heading text-[10px] font-bold text-manifest-burgundy tracking-wide uppercase">
                            9 Agustus - 16 Agustus 2026
                        </div>
                    </div>

                    <div class="timeline-grid-item relative bg-white border border-manifest-dark/5 rounded-[1.4rem] p-5 md:p-6 shadow-sm transition-all duration-500 hover:-translate-y-1 hover:shadow-xl flex flex-col justify-between min-h-[180px] md:min-h-[190px] reveal delay-200">
                        <div>
                            <div class="flex items-baseline justify-between">
                                <span class="font-accent italic text-2xl md:text-3xl text-manifest-burgundy/40">Mov. III</span>
                                <span class="text-[9px] font-heading font-bold uppercase tracking-wider text-manifest-dark/30 bg-manifest-dark/5 px-2.5 py-0.5 rounded-full">Review</span>
                            </div>
                            <h3 class="font-heading font-bold text-sm md:text-base text-manifest-dark mt-4">Semifinal Proposal</h3>
                            <p class="text-xs text-manifest-dark/50 mt-2 leading-relaxed">Kurasi ketat dokumen proposal naskah studi kasus komprehensif kelompok terpilih.</p>
                        </div>
                        <div class="mt-6 pt-3 border-t border-manifest-dark/5 font-heading text-[10px] font-bold text-manifest-burgundy tracking-wide uppercase">
                            31 Ags - 11 Sep 2026
                        </div>
                    </div>

                    <div class="timeline-grid-item relative bg-manifest-dark text-white rounded-[1.4rem] p-5 md:p-6 shadow-md transition-all duration-500 hover:-translate-y-1 hover:shadow-2xl flex flex-col justify-between min-h-[180px] md:min-h-[190px] reveal delay-300">
                        <div>
                            <div class="flex items-baseline justify-between">
                                <span class="font-accent italic text-2xl md:text-3xl text-manifest-cream">Coda</span>
                                <span class="text-[9px] font-heading font-bold uppercase tracking-wider text-manifest-dark bg-manifest-cream px-2.5 py-0.5 rounded-full">Surabaya</span>
                            </div>
                            <h3 class="font-heading font-bold text-sm md:text-base text-white mt-4">Business Camp & Pitch</h3>
                            <p class="text-xs text-white/50 mt-2 leading-relaxed">Karantina luring 3 hari, simulasi FinRace, dan penentuan final pitching di hadapan panel dewan juri emiten ahli.</p>
                        </div>
                        <div class="mt-6 pt-3 border-t border-white/10 font-heading text-[10px] font-bold text-manifest-cream tracking-wide uppercase">
                            2 - 4 Oktober 2026
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>

    <footer class="bg-manifest-dark text-cream pt-20 pb-10 px-5 md:px-12 mt-12 rounded-t-[2.5rem] relative z-20">
        <div class="max-w-[1440px] mx-auto grid grid-cols-1 md:grid-cols-12 gap-12 lg:gap-8">
            <div class="md:col-span-5 flex flex-col items-start text-center md:text-left mx-auto md:mx-0">
                <a href="index" class="font-heading text-3xl font-bold flex items-center justify-center md:justify-start gap-1 text-white tracking-tighter mb-6 w-full">
                    MANIFEST<span class="text-manifest-rose leading-none">.</span>
                </a>
                <p class="text-white/40 text-[0.875rem] max-w-sm font-body leading-relaxed mb-6 mx-auto md:mx-0">
                    The Symphony of Business. Mengorkestrasikan inovasi, strategi, dan eksekusi untuk masa depan lanskap bisnis di Indonesia.
                </p>
                <div class="flex justify-center md:justify-start gap-3 w-full">
                    <a href="https://instagram.com/manifest_its" target="_blank" class="w-10 h-10 rounded-full border border-white/10 flex items-center justify-center text-white/50 hover:bg-manifest-burgundy hover:text-white hover:border-transparent transition-all">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full border border-white/10 flex items-center justify-center text-white/50 hover:bg-crimson-700 hover:text-white hover:border-transparent transition-all">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.593-11.018-3.714v-2.155z"/></svg>
                    </a>
                </div>
            </div>
            <div class="md:col-span-7 grid grid-cols-2 sm:grid-cols-3 gap-10 text-center sm:text-left mt-8 md:mt-0">
                <div>
                    <h4 class="font-heading font-bold uppercase tracking-widest text-[0.65rem] text-white/80 mb-5">Symphony</h4>
                    <ul class="space-y-3 text-[0.85rem] font-body text-white/40">
                        <li><a href="#" class="hover:text-manifest-rose transition-colors">The Overture</a></li>
                        <li><a href="#" class="hover:text-manifest-rose transition-colors">Movements</a></li>
                        <li><a href="#" class="hover:text-manifest-rose transition-colors">Timeline</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-heading font-bold uppercase tracking-widest text-[0.65rem] text-white/80 mb-5">Resources</h4>
                    <ul class="space-y-3 text-[0.85rem] font-body text-white/40">
                        <li><a href="#" class="hover:text-manifest-rose transition-colors">Guidebook BPC</a></li>
                        <li><a href="#" class="hover:text-manifest-rose transition-colors">Guidebook EBPC</a></li>
                        <li><a href="#" class="hover:text-manifest-rose transition-colors">Guidebook BCC</a></li>
                        <li><a href="#" class="hover:text-manifest-rose transition-colors">FAQ</a></li>
                    </ul>
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <h4 class="font-heading font-bold uppercase tracking-widest text-[0.65rem] text-white/80 mb-5">Reach Us</h4>
                    <ul class="space-y-3 text-[0.85rem] font-body text-white/40">
                        <li>hello@manifest-its.com</li>
                        <li>+62 813 1530 2007 (Osvaldo)</li>
                        <li>+62 856 5585 6165 (Arin)</li>
                        <li class="pt-2">Departemen Manajemen Bisnis<br>Institut Teknologi Sepuluh Nopember</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="max-w-[1440px] mx-auto mt-16 pt-8 border-t border-white/5 flex flex-col sm:flex-row justify-between items-center gap-4 text-[0.7rem] font-body text-white/30 uppercase tracking-widest text-center sm:text-left">
            <p>&copy; 2026 Manifest ITS. All rights reserved.</p>
            <p><a href="https://algatra.id">Designed with Precision. Made by Algatra.</a></p>
        </div>
    </footer>

    <!-- INTERACTION & ANIMATION LOGIC -->
    <script>
        // 1. Loading Curtain
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

        function updateScrollNavbar() {
            const scrollTop = window.scrollY;
            const navInner = document.getElementById('navInner');

            if (scrollTop > 80) { 
                navInner.classList.remove('nav-at-top');
                navInner.classList.add('nav-scrolled');
            } else {
                navInner.classList.remove('nav-scrolled');
                navInner.classList.add('nav-at-top');
            }
        }
        window.addEventListener('scroll', updateScrollNavbar);
        window.addEventListener('load', updateScrollNavbar);

        // GENERATOR SIMULASI PARTIKEL NOT BALOK MELAYANG
        const notes = ['♪', '♫', '♬', '♩', '♭', '♯'];
        const container = document.getElementById('notesContainer');
        for (let i = 0; i < 25; i++) {
            const span = document.createElement('span');
            span.classList.add('note');
            span.innerText = notes[Math.floor(Math.random() * notes.length)];
            const left = Math.random() * 96 + 2;
            const size = (Math.random() * 1) + 0.8;
            const duration = (Math.random() * 4) + 7;
            const delay = Math.random() * 5;
            const drift = (Math.random() * 60) - 30;
            const rot = (Math.random() * 40) - 20;
            const depth = Math.random();

            let op = 0.2;
            if (depth > 0.75) { 
                op = 0.42; 
                span.style.filter = 'blur(0px)'; 
            } else if (depth < 0.28) { 
                op = 0.12; 
                span.style.filter = 'blur(2px)'; 
            } else { 
                span.style.filter = 'blur(1px)'; 
            }

            span.style.color = '#FFFFFF';
            span.style.textShadow = `0 0 10px rgba(255, 255, 255, ${op * 0.4})`;
            span.style.left = `${left}%`;
            span.style.fontSize = `${size}rem`;
            span.style.animationDuration = `${duration}s`;
            span.style.animationDelay = `${delay}s`;
            span.style.setProperty('--drift', `${drift}px`);
            span.style.setProperty('--rot', `${rot}deg`);
            span.style.setProperty('--max-op', op);
            container.appendChild(span);
        }

        document.addEventListener("DOMContentLoaded", () => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                    }
                });
            }, { 
                threshold: 0.01,
                rootMargin: "0px 0px 0px 0px" 
            });
            document.querySelectorAll('.reveal').forEach((el) => observer.observe(el));
        });
    </script>
</body>
</html>