<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Manifest 2026 | The Symphony of Business</title>
    
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
                        'marquee': 'marquee 20s linear infinite',
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

        /* === GSM TEXTURE OVERLAY === */
        .gsm-texture {
            position: fixed; inset: 0; z-index: 9999; pointer-events: none; opacity: 0.25; mix-blend-mode: multiply;
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

        /* === GARIS PARANADA ULTRA HALUS === */
        .music-staff {
            position: absolute; inset: 0; z-index: 1; pointer-events: none;
            background-image: repeating-linear-gradient(to bottom, transparent, transparent 15.5%, rgba(255, 255, 255, 0.015) 15.5%, rgba(255, 255, 255, 0.015) 16%);
            background-size: 100% 15vh;
        }

        .floating-elements { position: absolute; inset: 0; z-index: 2; pointer-events: none; overflow: hidden; }
        .note {
            position: absolute; bottom: -60px; will-change: transform, opacity;
            animation: floatStage linear infinite;
        }

        /* === LIGHTWEIGHT SCROLL REVEAL UTILITIES === */
        .reveal { opacity: 0; transform: translateY(25px); transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1); will-change: transform, opacity; }
        .reveal.active { opacity: 1; transform: translateY(0); }
        .delay-100 { transition-delay: 100ms; }
        .delay-200 { transition-delay: 200ms; }
        .delay-300 { transition-delay: 300ms; }
        .delay-400 { transition-delay: 400ms; }

        /* === HERO V12: LUXURY THEATER STRIPES === */
        .hero-reference-v12 {
            isolation: isolate;
            background-image: repeating-linear-gradient(
                90deg,
                #500707 0px,
                #500707 30px,
                #3b0303 30px,
                #3b0303 60px
            );
            position: relative;
        }
        @media (min-width: 768px) {
            .hero-reference-v12 {
                background-image: repeating-linear-gradient(
                    90deg,
                    #500707 0px,
                    #500707 60px,
                    #3b0303 60px,
                    #3b0303 120px
                );
            }
        }
        .hero-reference-v12::before {
            content: ''; position: absolute; inset: 0; z-index: 0; pointer-events: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='120' height='240' viewBox='0 0 120 240'%3E%3Cg fill='%23280101' fill-opacity='0.55'%3E%3Cpath d='M30 15 q0 15 15 15 q-15 0 -15 15 q0 -15 -15 -15 q15 0 15 -15 Z'/%3E%3Ccircle cx='30' cy='70' r='3.5'/%3E%3Cpath d='M30 100 q0 12 12 12 q-12 0 -12 12 q0 -12 -12 -12 q12 0 12 -12 Z M23 106 q7 6 7 14 q0 -8 7 -14 q-7 -1 -7 -8 q0 7 -7 8 Z'/%3E%3Ccircle cx='30' cy='150' r='3.5'/%3E%3Cpath d='M30 175 q0 15 15 15 q-15 0 -15 15 q0 -15 -15 -15 q15 0 15 -15 Z'/%3E%3Ccircle cx='30' cy='230' r='3.5'/%3E%3Cpath d='M90 135 q0 15 15 15 q-15 0 -15 15 q0 -15 -15 -15 q15 0 15 -15 Z'/%3E%3Ccircle cx='90' cy='195' r='3.5'/%3E%3Cpath d='M90 10 q0 12 12 12 q-12 0 -12 12 q0 -12 -12 -12 q12 0 12 -12 Z M83 16 q7 6 7 14 q0 -8 7 -14 q-7 -1 -7 -8 q0 7 -7 8 Z'/%3E%3Ccircle cx='90' cy='60' r='3.5'/%3E%3C/g%3E%3C/svg%3E");
            background-size: 120px 240px; background-position: center top;
            mask-image: radial-gradient(circle at 50% 50%, black 50%, rgba(0,0,0,0.6) 100%);
            -webkit-mask-image: radial-gradient(circle at 50% 50%, black 50%, rgba(0,0,0,0.6) 100%);
        }
        
        .hero-ref-title {
            letter-spacing: -0.05em;
            text-shadow: 0 15px 35px rgba(0, 0, 0, 0.9);
        }
        
        /* PREMIUM GLASSMORPHISM BENTO BOX */
        .hero-ref-chip, .hero-ref-side-card, .hero-ref-countdown, .hero-ref-time {
            background: rgba(255, 255, 255, 0.25); 
            border: 1px solid rgba(255, 255, 255, 0.6);   
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.45), inset 0 1px 0 rgba(255,255,255,0.3);
            backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .hero-ref-side-card:hover {
            background: rgba(255, 255, 255, 0.35);
            border-color: rgba(255, 255, 255, 0.8);
        }
        
        .hero-ref-stage {
            position: relative; z-index: 5; display: flex; justify-content: center; align-items: flex-end; width: 100%;
        }
        @media (min-width: 1024px) { .hero-ref-stage { min-height: 350px; } }
        
        .hero-ref-arc {
            position: absolute; left: 50%; bottom: 0; transform: translateX(-50%);
            width: min(392px, 80vw); height: min(188px, 34vw); border-radius: 220px 220px 0 0;
            background: linear-gradient(180deg, #120200 0%, #080100 100%); border: 1px solid rgba(255,255,255,0.12); border-bottom: none;
            box-shadow: 0 -10px 40px rgba(0, 0, 0, 0.5);
        }
        
        .hero-ref-logo {
            position: relative; margin-top: 2.5rem; width: 100%; display: flex; flex-direction: column; align-items: center; z-index: 10;
        }
        @media (min-width: 1024px) {
            .hero-ref-logo {
                position: absolute; left: 50%; bottom: 16px; transform: translateX(-50%); width: min(272px, 66vw); margin-top: 0;
            }
        }
        
        .hero-ref-logo-shell {
            width: 175px; height: 175px; border-radius: 999px;
            background: linear-gradient(135deg, #2b0400 0%, #0d0100 100%); display: flex; align-items: center; justify-content: center;
            box-shadow: 0 25px 55px rgba(0, 0, 0, 0.55), inset 0 1px 2px rgba(255,255,255,0.15); position: relative; animation: logoFloat 6s ease-in-out infinite;
        }
        .hero-ref-logo-shell::before { content: ''; position: absolute; inset: -12px; border-radius: 999px; border: 1px solid rgba(255, 255, 255, 0.06); }
        .hero-ref-logo-shell img { width: 54%; height: 54%; object-fit: contain; }
        @keyframes logoFloat { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-6px); } }
        
        .hero-ref-side { position: absolute; top: 52%; width: 200px; transform: translateY(-50%); }
        .hero-ref-side.left { left: -10px; }
        .hero-ref-side.right { right: -10px; }
        
        .hero-ref-quote { font-size: 0.86rem; line-height: 1.5; color: #FFFFFF; font-weight: 400; }
        .hero-ref-stat { font-family: 'Instrument Serif', serif; font-style: italic; font-size: 2.3rem; line-height: 1; color: #FFFFFF; }
        
        .hero-ref-btn-primary { background: #FFFFFF; color: #120200; box-shadow: 0 12px 30px rgba(255, 255, 255, 0.25); }
        .hero-ref-btn-primary:hover { background: #F5F0E3; transform: translateY(-2px); }
        .hero-ref-btn-secondary { background: rgba(255,255,255,0.15); color: #FFFFFF; border: 1px solid rgba(255, 255, 255, 0.4); }
        .hero-ref-btn-secondary:hover { background: rgba(255,255,255,0.25); border-color: #FFFFFF; transform: translateY(-2px); }

        @keyframes floatStage {
            0% { transform: translate3d(0, 0, 0) rotate(0deg) scale(0.9); opacity: 0; }
            10% { opacity: var(--max-op, 0.6); }
            90% { opacity: var(--max-op, 0.6); }
            100% { transform: translate3d(var(--drift, 18px), -102vh, 0) rotate(var(--rot, 20deg)) scale(1.1); opacity: 0; }
        }

        @media (max-width: 1024px) {
            .hero-ref-stage { display: flex; flex-direction: column; align-items: center; justify-content: center; }
            .hero-ref-arc { width: min(320px, 76vw); height: min(160px, 38vw); border-radius: 200px 200px 0 0; position: absolute; bottom: 108px; }
            .hero-ref-mobile-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 1.25rem; max-width: 720px; margin: 2rem auto 0; }
        }
        @media (max-width: 640px) { .hero-ref-mobile-grid { grid-template-columns: 1fr; gap: 1rem; } }

        /* === CONTENT SECTIONS V18 === */
        .manifest-soft-card {
            background: linear-gradient(180deg, rgba(255,255,255,0.85), rgba(245, 240, 227, 0.5));
            border: 1px solid rgba(34, 7, 1, 0.06); box-shadow: 0 16px 40px rgba(34, 7, 1, 0.04);
            backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px);
        }
        .manifest-soft-card:hover { transform: translateY(-4px); box-shadow: 0 22px 50px rgba(34, 7, 1, 0.07); }
        .manifest-faq-item[open] { background: rgba(255,255,255,0.78); }
        .manifest-faq-item summary::-webkit-details-marker { display: none; }
        .manifest-faq-item summary { list-style: none; }
        .manifest-faq-item .faq-plus { transition: transform 0.25s ease, color 0.25s ease; }
        .manifest-faq-item[open] .faq-plus { transform: rotate(45deg); color: #520000; }
        .partnership-panel {
            background: radial-gradient(circle at 84% 24%, rgba(156, 79, 81, 0.15), transparent 28%), linear-gradient(135deg, #220701, #3a0d04);
            box-shadow: 0 28px 70px rgba(34, 7, 1, 0.25);
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

    <div class="absolute top-[-15%] right-0 w-[50vw] max-w-[600px] h-[600px] bg-manifest-rose/[0.03] rounded-full blur-[140px] pointer-events-none -z-10"></div>

    <div id="radialScrollContainer" class="fixed bottom-6 right-6 md:bottom-8 md:right-8 z-30 opacity-0 scale-90 translate-y-4 pointer-events-none transition-all duration-300">
        <a href="#" class="w-12 h-12 md:w-14 md:h-14 rounded-full bg-white/90 backdrop-blur-md flex items-center justify-center relative border border-manifest-dark/5 pointer-events-auto group shadow-sm">
            <svg class="absolute inset-0 w-full h-full transform" viewBox="0 0 44 44">
                <circle class="text-manifest-dark/[0.03]" stroke-width="1.5" stroke="currentColor" fill="transparent" r="18" cx="22" cy="22"/>
                <circle id="progressCircle" class="progress-ring__circle text-manifest-rose" stroke-width="2" stroke-linecap="round" stroke="currentColor" fill="transparent" r="18" cx="22" cy="22"/>
            </svg>
            <svg class="w-3.5 h-3.5 text-manifest-dark/70 group-hover:text-manifest-burgundy transform group-hover:-translate-y-0.5 transition-all duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
            </svg>
        </a>
    </div>

    <!-- === MOBILE SIDEBAR (FIXED LAPISAN & INTEGRATED CLOSE BUTTON) === -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-manifest-dark/40 backdrop-blur-sm z-[999] opacity-0 pointer-events-none transition-opacity duration-300"></div>
    <div id="mobileSidebar" class="fixed inset-y-0 right-0 w-[85%] sm:w-[400px] bg-cream z-[1000] transform translate-x-full p-8 pt-12 flex flex-col justify-between shadow-[-10px_0_40px_rgba(34,7,1,0.15)] border-l border-white/50 transition-transform duration-300">
        
        <!-- Kontainer Atas Sidebar: Berisi Judul Menu Navigasi + Tombol Close (X) bawaan warna Ink Gelap -->
        <div class="flex items-center justify-between w-full mb-8 border-b border-manifest-dark/5 pb-4">
            <span class="text-[10px] font-heading font-bold uppercase tracking-widest text-manifest-burgundy flex items-center gap-2">
                 Menu Navigasi
            </span>
            <!-- Tombol Silang (X) yang solid, mandiri, dan dijamin berfungsi responsif -->
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
                    <a href="bpc" class="sidebar-anchor font-heading text-xs uppercase tracking-widest text-ink/60 hover:text-manifest-burgundy flex items-center gap-2.5 py-1">
                        Business Plan
                    </a>
                    <a href="bcc" class="sidebar-anchor font-heading text-xs uppercase tracking-widest text-ink/60 hover:text-manifest-burgundy flex items-center gap-2.5 py-1">
                        Business Case
                    </a>
                    <a href="ebpc" class="sidebar-anchor font-heading text-xs uppercase tracking-widest text-ink/60 hover:text-manifest-burgundy flex items-center gap-2.5 py-1">
                        English Business Plan
                    </a>
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
            <a href="#" class="font-heading text-xl md:text-2xl font-bold flex items-center gap-1 text-white tracking-tighter group">
                MANIFEST<span class="text-white leading-none transition-transform duration-300 group-hover:scale-125">.</span>
            </a>
            
            <div class="hidden md:flex gap-12 text-[11px] font-heading font-bold uppercase tracking-[0.2em] text-white/90 items-center">
                <div class="relative group cursor-pointer py-2">
                    <span class="hover:text-white transition-all duration-300 flex items-center gap-2 group-hover:text-white">
                        Lomba <i class="fas fa-chevron-down text-[8px] transition-transform duration-300 group-hover:rotate-180 text-white/60 group-hover:text-white"></i>
                    </span>
                    <div class="absolute top-full right-1/2 translate-x-1/2 pt-3 opacity-0 scale-95 origin-top invisible group-hover:opacity-100 group-hover:scale-100 group-hover:visible transition-all duration-300 pointer-events-none group-hover:pointer-events-auto">
                        <div class="bg-white/95 backdrop-blur-xl p-3 rounded-2xl shadow-[0_25px_50px_rgba(0,0,0,0.4)] w-64 flex flex-col gap-1 border border-white/20">
                            <span class="px-3 py-1.5 text-[9px] tracking-widest text-manifest-dark/40 uppercase font-heading font-extrabold border-b border-manifest-dark/5 mb-1 flex items-center gap-1.5">
                                Kategori Lomba
                            </span>
                            <a href="bpc" class="text-[10px] tracking-widest uppercase font-bold text-manifest-dark/80 hover:text-white hover:bg-manifest-dark p-3 rounded-xl flex items-center justify-between transition-all duration-200"><span class="flex items-center gap-3">Business Plan</span><i class="fas fa-arrow-right text-[9px]"></i></a>
                            <a href="bcc" class="text-[10px] tracking-widest uppercase font-bold text-manifest-dark/80 hover:text-white hover:bg-manifest-dark p-3 rounded-xl flex items-center justify-between transition-all duration-200"><span class="flex items-center gap-3">Business Case</span><i class="fas fa-arrow-right text-[9px]"></i></a>
                            <a href="ebpc" class="text-[10px] tracking-widest uppercase font-bold text-manifest-dark/80 hover:text-white hover:bg-manifest-dark p-3 rounded-xl flex items-center justify-between transition-all duration-200"><span class="flex items-center gap-3">English Business Plan</span><i class="fas fa-arrow-right text-[9px]"></i></a>
                        </div>
                    </div>
                </div>
                <a href="#contact" class="hover:text-white transition-all duration-300 relative group py-2">Contact Us<span class="absolute bottom-0 left-0 w-0 h-[1.5px] bg-white transition-all duration-300 group-hover:w-full"></span></a>
            </div>

            <div class="hidden md:block">
                <a href="daftar" class="relative inline-flex items-center justify-center bg-white text-manifest-dark px-8 py-3 rounded-full text-[10px] font-heading font-bold uppercase tracking-[0.18em] overflow-hidden transition-all duration-300 hover:bg-manifest-dark hover:text-white hover:shadow-[0_10px_25px_rgba(255,255,255,0.15)] hover:-translate-y-0.5">
                    <span class="relative z-10 flex items-center gap-2"><i class="fas fa-paper-plane text-[9px]"></i> Daftar</span>
                </a>
            </div>

            <!-- Tombol Hamburger Utama -->
            <button id="menuButton" class="block md:hidden relative w-6 h-5 flex flex-col justify-between items-end group focus:outline-none">
                <span class="w-6 h-[1.5px] bg-white rounded-full"></span>
                <span class="w-4 h-[1.5px] bg-white rounded-full"></span>
                <span class="w-5 h-[1.5px] bg-white rounded-full"></span>
            </button>
        </div>
    </header>

    <main>
        <!-- === HERO SECTION === -->
        <section class="hero-reference-v12 relative min-h-screen flex items-center px-4 sm:px-8 lg:px-12 pt-36 pb-16 overflow-hidden">
            <div class="music-staff opacity-30"></div>
            <div class="floating-elements" id="notesContainer"></div>

            <div class="relative z-10 w-full max-w-[1180px] mx-auto flex flex-col items-center">
                <div class="reveal flex justify-center mb-6">
                    <div class="hero-ref-chip inline-flex items-center gap-2.5 rounded-full px-4 py-2 text-[9px] font-heading font-bold uppercase tracking-[0.25em] text-white">
                        <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                        <span>Manifest ITS 2026</span>
                    </div>
                </div>

                <div class="text-center max-w-[840px] mx-auto mb-6">
                    <p class="reveal delay-100 font-script italic text-[1.75rem] md:text-[2.15rem] text-amber-50 mb-1 md:mb-2 pb-0">Ignite Ideas, Rise with Symphony</p>
                    <h1 class="hero-ref-title reveal delay-200 font-heading font-bold text-[clamp(3.5rem,8.6vw,6.6rem)] leading-[0.92] text-white mt-4 md:mt-6">MANIFEST 2026</h1>
                    <p class="reveal delay-300 mt-5 max-w-[630px] mx-auto text-[0.96rem] md:text-[1.02rem] leading-relaxed text-white/80 tracking-wide font-light">
                        MANIFEST adalah acara terbesar di Departemen Manajemen Bisnis ITS. Ajang kompetisi bisnis tingkat nasional bagi siswa/i SMA sederajat untuk mengonstruksi rencana bisnis kreatif, adaptif, dan siap berdampak di panggung nasional melalui 3 cabang kompetisi utama.
                    </p>
                </div>

                <!-- Main Layout Container -->
                <div class="w-full max-w-[940px] relative">
                    
                    <!-- Kiri Bento Box -->
                    <div class="hidden lg:block absolute left-[-60px] top-1/2 -translate-y-1/2 w-[210px] z-20">
                        <div class="hero-ref-side-card rounded-2xl p-5 text-left transition-all duration-300 hover:scale-[1.02]">
                            <div class="font-accent italic text-4xl leading-none text-white/60">“</div>
                            <p class="hero-ref-quote mt-1 font-normal">Menggabungkan teknologi inovatif dengan prinsip ekonomi sirkular demi pertumbuhan masa depan yang berkelanjutan.</p>
                            <div class="mt-5 pt-4 border-t border-white/30">
                                <p class="hero-ref-stat text-2xl font-bold font-accent italic text-white">3</p>
                                <p class="font-heading text-[11px] font-bold text-white uppercase tracking-wider mt-0.5">Movements</p>
                                <p class="text-[10px] text-white/70 font-light mt-0.5">BPC • BCC • EBPC</p>
                            </div>
                        </div>
                    </div>

                    <!-- Center Stage Layout -->
                    <div class="hero-ref-stage">
                        <div class="hero-ref-arc"></div>
                        <div class="hero-ref-logo">
                            <div class="hero-ref-logo-shell">
                                <img src="logomanifest.png" alt="Logo Manifest" class="filter brightness-0 invert opacity-95">
                            </div>
                            <div class="mt-8 flex flex-col sm:flex-row gap-3.5 font-heading text-center w-full justify-center px-4">
                                <a href="daftar" class="hero-ref-btn-primary px-6 py-3 rounded-full text-[10px] font-bold uppercase tracking-widest transition-all whitespace-nowrap"><i class="fas fa-file-alt mr-2 text-[9px]"></i> Daftar Sekarang</a>
                                <a href="#movements" class="hero-ref-btn-secondary px-6 py-3 rounded-full text-[10px] font-bold uppercase tracking-widest transition-all whitespace-nowrap"><i class="fas fa-download mr-2 text-[9px]"></i> Unduh Guidebook</a>
                            </div>
                        </div>
                    </div>

                    <!-- Kanan Bento Box -->
                    <div class="hidden lg:block absolute right-[-60px] top-1/2 -translate-y-1/2 w-[210px] z-20">
                        <div class="hero-ref-side-card rounded-2xl p-5 text-right transition-all duration-300 hover:scale-[1.02]">
                            <div class="flex gap-1 text-white justify-end opacity-90 mb-2">
                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                            </div>
                            <p class="hero-ref-stat text-2xl font-bold text-white font-accent italic">Rp11 Jt</p>
                            <p class="font-heading text-[11px] font-bold text-white uppercase tracking-wider mt-0.5">BPC Prize Pool</p>
                            <div class="w-16 h-px bg-white/30 mt-4 ml-auto"></div>
                            <p class="text-[11px] text-white font-normal mt-3 leading-normal">Free Pass Jalur Kuliah ITS untuk Juara 1 <i class="fas fa-graduation-cap text-[10px] ml-0.5"></i></p>
                        </div>
                    </div>
                </div>

                <!-- Mobile Interface Grid -->
                <div class="hero-ref-mobile-grid lg:hidden w-full reveal delay-400 px-4">
                    <div class="hero-ref-side-card rounded-xl p-5 text-left">
                        <p class="hero-ref-stat text-xl font-bold text-white font-accent italic">3 Main Movements</p>
                        <p class="text-[12px] text-white font-light mt-1.5 leading-relaxed">Business Plan, Business Case, & English Business Plan Competition.</p>
                    </div>
                    <div class="hero-ref-side-card rounded-xl p-5 text-left">
                        <p class="hero-ref-stat text-xl font-bold text-white font-accent italic">Rp11 Jt + Golden Ticket</p>
                        <p class="text-[12px] text-white font-light mt-1.5 leading-relaxed">Alokasi total dana pembinaan dan Free Pass tanpa tes masuk Manajemen Bisnis ITS.</p>
                    </div>
                </div>

                <!-- Countdown Box -->
                <div class="hero-ref-countdown reveal delay-400 mt-10 mx-4 lg:mx-auto px-6 py-4 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5 w-[calc(100%-2rem)] max-w-[940px] rounded-2xl">
                    <div class="text-left">
                        <p class="font-heading text-[9px] font-bold uppercase tracking-[0.2em] text-white mb-1"><i class="fas fa-hourglass-half mr-1"></i> Pendaftaran Ditutup Dalam</p>
                        <p class="text-[13px] text-white font-light">Segera amankan slot tim terbaikmu sebelum simfoni orkestrasi kompetisi ditutup.</p>
                    </div>
                    <div class="grid grid-cols-4 gap-2.5 lg:min-w-[380px] w-full lg:w-auto">
                        <div class="hero-ref-time rounded-xl py-2 px-1 text-center">
                            <span id="cd-days" class="font-accent italic text-[1.8rem] md:text-[1.95rem] text-white leading-none block">00</span>
                            <span class="font-heading text-[8px] uppercase tracking-wider text-white">Hari</span>
                        </div>
                        <div class="hero-ref-time rounded-xl py-2 px-1 text-center">
                            <span id="cd-hours" class="font-accent italic text-[1.8rem] md:text-[1.95rem] text-white leading-none block">00</span>
                            <span class="font-heading text-[8px] uppercase tracking-wider text-white">Jam</span>
                        </div>
                        <div class="hero-ref-time rounded-xl py-2 px-1 text-center">
                            <span id="cd-minutes" class="font-accent italic text-[1.8rem] md:text-[1.95rem] text-white leading-none block">00</span>
                            <span class="font-heading text-[8px] uppercase tracking-wider text-white">Menit</span>
                        </div>
                        <div class="rounded-xl bg-white text-manifest-dark py-2 px-1 text-center font-bold shadow-[0_15px_35px_rgba(0,0,0,0.3)] border border-white">
                            <span id="cd-seconds" class="font-accent italic text-[1.8rem] md:text-[1.95rem] leading-none block">00</span>
                            <span class="font-heading text-[8px] uppercase tracking-wider text-manifest-dark/80">Detik</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- === WHY CHOOSE MANIFEST SECTION === -->
        <section class="reveal py-20 md:py-24 px-5 md:px-12 relative z-20">
            <div class="max-w-[1440px] mx-auto">
                <div class="max-w-2xl mx-auto text-center mb-12 md:mb-14">
                    <span class="inline-flex items-center gap-2 rounded-full border border-manifest-dark/10 bg-white/45 px-4 py-2 text-[10px] font-heading font-bold uppercase tracking-[0.24em] text-ink/50 mb-5">
                        <span class="w-1.5 h-1.5 rounded-full bg-manifest-rose"></span>
                        Why Join Us
                    </span>
                    <h2 class="font-heading text-[clamp(2.2rem,5vw,4rem)] leading-[0.92] tracking-tight text-ink mb-4">Why You Should Join MANIFEST?</h2>
                    <p class="text-[0.98rem] md:text-[1.02rem] leading-relaxed text-ink/56 max-w-[720px] mx-auto">MANIFEST menghadirkan wadah terbaik bagi generasi muda untuk menguji ide bisnis secara mendalam dengan standar kompetisi tingkat nasional yang terstruktur</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 md:gap-5">
                    <div class="reveal delay-100 manifest-soft-card rounded-[1.5rem] p-6 transition-all duration-300">
                        <p class="font-heading text-[8px] font-bold uppercase tracking-[0.26em] text-manifest-burgundy/70 mb-4">01</p>
                        <h3 class="font-heading text-[1.1rem] font-bold text-ink mb-3">Sharpen Your Business Mind</h3>
                        <p class="text-sm leading-relaxed text-ink/54">Melatih ketajaman analisis makro, riset pasar riil, dan penyusunan strategi operasional bisnis secara holistik terstruktur.</p>
                    </div>
                    <div class="reveal delay-200 manifest-soft-card rounded-[1.5rem] p-6 transition-all duration-300">
                        <p class="font-heading text-[8px] font-bold uppercase tracking-[0.26em] text-manifest-burgundy/70 mb-4">02</p>
                        <h3 class="font-heading text-[1.1rem] font-bold text-ink mb-3">Build Ideas with Purpose</h3>
                        <p class="text-sm leading-relaxed text-ink/54">Mengembangkan ide bisnis sirkular ramah lingkungan yang tidak sekadar kreatif, melainkan juga berteknologi tinggi dan bernilai ekonomi.</p>
                    </div>
                    <div class="reveal delay-300 manifest-soft-card rounded-[1.5rem] p-6 transition-all duration-300">
                        <p class="font-heading text-[8px] font-bold uppercase tracking-[0.26em] text-manifest-burgundy/70 mb-4">03</p>
                        <h3 class="font-heading text-[1.1rem] font-bold text-ink mb-3">Compete Nationally</h3>
                        <p class="text-sm leading-relaxed text-ink/54">Berhadapan secara sehat dengan ratusan tim pelajar berprestasi dari berbagai sekolah di seluruh penjuru Indonesia.</p>
                    </div>
                    <div class="reveal delay-400 manifest-soft-card rounded-[1.5rem] p-6 transition-all duration-300">
                        <p class="font-heading text-[8px] font-bold uppercase tracking-[0.26em] text-manifest-burgundy/70 mb-4">04</p>
                        <h3 class="font-heading text-[1.1rem] font-bold text-ink mb-3">Exclusive Golden Ticket</h3>
                        <p class="text-sm leading-relaxed text-ink/54">Dapatkan kesempatan berharga berupa tiket Free Pass bebas tes masuk perkuliahan langsung menuju Departemen Manajemen Bisnis ITS.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- === BENEFITS SECTION === -->
        <section class="reveal py-20 md:py-24 px-5 md:px-12 relative z-20">
            <div class="max-w-[1440px] mx-auto grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-stretch">
                <div class="reveal lg:col-span-5 manifest-soft-card rounded-[1.8rem] p-7 md:p-9">
                    <span class="inline-flex items-center gap-2 rounded-full border border-manifest-dark/10 bg-white/45 px-4 py-2 text-[10px] font-heading font-bold uppercase tracking-[0.24em] text-ink/50 mb-5">
                        <span class="w-1.5 h-1.5 rounded-full bg-manifest-rose"></span>
                        Participant Benefits
                    </span>
                    <h2 class="font-heading text-[clamp(2rem,4.4vw,3.5rem)] leading-[0.95] tracking-tight text-ink mb-4">What You’ll Get</h2>
                    <p class="text-[0.97rem] leading-relaxed text-ink/56 mb-7">MANIFEST menjamin pengembangan kompetensi peserta melalui serangkaian workshop intensif hulu ke hilir serta pemenuhan akomodasi penuh bagi para finalis terpilih.</p>
                    <div class="space-y-4 text-sm text-ink/58">
                        <div class="flex items-start gap-3"><span class="mt-1.5 text-manifest-rose flex-shrink-0"><i class="fas fa-check-circle"></i></span><p>Sertifikat Kompetisi Resmi berskala Nasional untuk seluruh pendaftar yang terdata.</p></div>
                        <div class="flex items-start gap-3"><span class="mt-1.5 text-manifest-rose flex-shrink-0"><i class="fas fa-check-circle"></i></span><p>Fasilitas penuh akomodasi mencakup Hotel, Konsumsi, & Transportasi lokal gratis selama 3 hari Business Camp di Surabaya.</p></div>
                        <div class="flex items-start gap-3"><span class="mt-1.5 text-manifest-rose flex-shrink-0"><i class="fas fa-check-circle"></i></span><p>Akses bimbingan interaktif eksklusif bersama narasumber handal serta kunjungan langsung korporat emiten mitra (Company Visit).</p></div>
                    </div>
                </div>
                <div class="lg:col-span-7 grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-5">
                    <div class="reveal delay-100 manifest-soft-card rounded-[1.5rem] p-6 transition-all duration-300">
                        <p class="font-heading text-[8px] font-bold uppercase tracking-[0.26em] text-manifest-burgundy/70 mb-4">Benefit 01</p>
                        <h3 class="font-heading text-lg font-bold text-ink mb-2">Exclusive Training</h3>
                        <p class="text-sm leading-relaxed text-ink/54">Pembekalan intensif taktis seputar pembuatan kerangka Business Model Canvas (BMC) hingga penyusunan naskah proposal bisnis yang solid.</p>
                    </div>
                    <div class="reveal delay-200 manifest-soft-card rounded-[1.5rem] p-6 transition-all duration-300">
                        <p class="font-heading text-[8px] font-bold uppercase tracking-[0.26em] text-manifest-burgundy/70 mb-4">Benefit 02</p>
                        <h3 class="font-heading text-lg font-bold text-ink mb-2">3-Day Business Camp</h3>
                        <p class="text-sm leading-relaxed text-ink/54">Karantina luring interaktif bagi 5 tim terbaik untuk mengikuti sesi mentoring kelas industri, simulasi taktis FinRace, dan final pitching di Surabaya.</p>
                    </div>
                    <div class="reveal delay-300 manifest-soft-card rounded-[1.5rem] p-6 transition-all duration-300">
                        <p class="font-heading text-[8px] font-bold uppercase tracking-[0.26em] text-manifest-burgundy/70 mb-4">Benefit 03</p>
                        <h3 class="font-heading text-lg font-bold text-ink mb-2">Networking Community</h3>
                        <p class="text-sm leading-relaxed text-ink/54">Membangun koneksi strategis dan memperluas relasi interaktif positif di dalam ekosistem komunitas inovator muda nasional.</p>
                    </div>
                    <div class="reveal delay-400 manifest-soft-card rounded-[1.5rem] p-6 transition-all duration-300">
                        <p class="font-heading text-[8px] font-bold uppercase tracking-[0.26em] text-manifest-burgundy/70 mb-4">Benefit 04</p>
                        <h3 class="font-heading text-lg font-bold text-ink mb-2">Grand Prizes & Free Pass</h3>
                        <p class="text-sm leading-relaxed text-ink/54">Alokasi jutaan rupiah dana segar pembinaan, trofi penghargaan apresiasi, sertifikat juara nasional, beserta tiket emas langsung masuk ITS tanpa tes.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- === FAQ SECTION === -->
        <section class="reveal py-20 md:py-24 px-5 md:px-12 relative z-20">
            <div class="max-w-[1040px] mx-auto">
                <div class="max-w-2xl mx-auto text-center mb-12 md:mb-14">
                    <span class="inline-flex items-center gap-2 rounded-full border border-manifest-dark/10 bg-white/45 px-4 py-2 text-[10px] font-heading font-bold uppercase tracking-[0.24em] text-ink/50 mb-5">
                        <span class="w-1.5 h-1.5 rounded-full bg-manifest-rose"></span>
                        FAQ
                    </span>
                    <h2 class="font-heading text-[clamp(2.2rem,5vw,3.8rem)] leading-[0.94] tracking-tight text-ink mb-4">Frequently Asked Questions</h2>
                    <p class="text-[0.98rem] md:text-[1.02rem] leading-relaxed text-ink/56 max-w-[700px] mx-auto">Simak rangkuman jawaban ringkas seputar ketentuan teknis operasional regulasi yang kerap ditanyakan calon pendaftar MANIFEST 2026.</p>
                </div>

                <div class="space-y-4">
                    <details class="reveal delay-100 manifest-faq-item manifest-soft-card rounded-[1.35rem] p-5 md:p-6 transition-all duration-300" open>
                        <summary class="flex items-center justify-between gap-4 cursor-pointer">
                            <span class="font-heading text-[1rem] md:text-[1.05rem] font-bold text-ink">Siapa saja yang diperkenankan mendaftar kompetisi ini?</span>
                            <span class="faq-plus text-2xl leading-none text-ink/45">+</span>
                        </summary>
                        <p class="mt-4 text-sm md:text-[0.96rem] leading-relaxed text-ink/56 pr-6">Kompetisi terbuka bagi seluruh kelompok aktif siswa/i tingkat SMA/SMK/MA sederajat di Indonesia. Setiap kelompok diwajibkan beranggotakan 2 orang peserta dan <b>boleh berasal dari instansi sekolah yang berbeda (namun di dalam pendaftaran cabang lomba tetap harus mengisi sekolah yang sama)</b>.</p>
                    </details>
                    <details class="reveal delay-200 manifest-faq-item manifest-soft-card rounded-[1.35rem] p-5 md:p-6 transition-all duration-300">
                        <summary class="flex items-center justify-between gap-4 cursor-pointer">
                            <span class="font-heading text-[1rem] md:text-[1.05rem] font-bold text-ink">Bolehkah satu tim mengikuti lebih dari satu cabang kompetisi?</span>
                            <span class="faq-plus text-2xl leading-none text-ink/45">+</span>
                        </summary>
                        <p class="mt-4 text-sm md:text-[0.96rem] leading-relaxed text-ink/56 pr-6">Berdasarkan regulasi terbaru, setiap kelompok atau individu peserta <b>diperbolehkan terdaftar dan mengikuti lebih dari 1 cabang lomba</b> pada ajang MANIFEST 2026.</p>
                    </details>
                    <details class="reveal delay-300 manifest-faq-item manifest-soft-card rounded-[1.35rem] p-5 md:p-6 transition-all duration-300">
                        <summary class="flex items-center justify-between gap-4 cursor-pointer">
                            <span class="font-heading text-[1rem] md:text-[1.05rem] font-bold text-ink">Bagaimanakah penugasan berkas pada babak penyisihan awal (Preliminary)?</span>
                            <span class="faq-plus text-2xl leading-none text-ink/45">+</span>
                        </summary>
                        <p class="mt-4 text-sm md:text-[0.96rem] leading-relaxed text-ink/56 pr-6">Untuk kategori utama Business Plan Competition (BPC), seluruh tim wajib menyusun skema digital Business Model Canvas (BMC) berukuran 1 halaman A4 landscape yang selaras dengan tema sirkular serta melampirkan surat pernyataan orisinalitas bermaterai.</p>
                    </details>
                    <details class="reveal delay-400 manifest-faq-item manifest-soft-card rounded-[1.35rem] p-5 md:p-6 transition-all duration-300">
                        <summary class="flex items-center justify-between gap-4 cursor-pointer">
                            <span class="font-heading text-[1rem] md:text-[1.05rem] font-bold text-ink">Bagaimanakah alokasi pembiayaan akomodasi finalis selama di Surabaya?</span>
                            <span class="faq-plus text-2xl leading-none text-ink/45">+</span>
                        </summary>
                        <p class="mt-4 text-sm md:text-[0.96rem] leading-relaxed text-ink/56 pr-6">Bagi 5 kelompok finalis terbaik yang berhasil lolos kurasi babak Semifinal, seluruh pembiayaan akomodasi hotel penginapan, makan minum rutin harian, serta mobilisasi transportasi lokal selama agenda Business Camp di Surabaya ditanggung penuh oleh pihak panitia MANIFEST 2026.</p>
                    </details>
                </div>
            </div>
        </section>

        <!-- === PARTNERSHIP SECTION === -->
        <section class="reveal pb-20 md:pb-24 px-5 md:px-12 relative z-20">
            <div class="max-w-[1240px] mx-auto partnership-panel rounded-[2rem] md:rounded-[2.4rem] p-7 md:p-10 lg:p-12 text-white overflow-hidden relative">
                <div class="absolute top-0 right-0 w-56 h-56 bg-manifest-rose/10 rounded-full blur-3xl"></div>
                <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-8">
                        <span class="inline-flex items-center gap-2 rounded-full border border-white/12 bg-white/6 px-4 py-2 text-[10px] font-heading font-bold uppercase tracking-[0.24em] text-white/70 mb-5">
                            <span class="w-1.5 h-1.5 rounded-full bg-manifest-rose"></span>
                            Open For Collaboration
                        </span>
                        <h2 class="font-heading text-[clamp(2rem,4.8vw,3.8rem)] leading-[0.95] tracking-tight mb-4">Interested in Becoming a Partner?</h2>
                        <p class="text-[0.98rem] md:text-[1.03rem] leading-relaxed text-white/70 max-w-[760px]">MANIFEST membuka gerbang kolaborasi sinergis seluas-luasnya bersama korporat mitra, media partner, serta perwakilan ekosistem bisnis digital yang ingin tumbuh berdampak bersama dalam mendukung atmosfer kompetitif kreatif anak bangsa.</p>
                    </div>
                    <div class="lg:col-span-4 flex flex-col sm:flex-row lg:flex-col gap-3 lg:items-end">
                        <a href="#" class="w-full sm:w-auto lg:w-full bg-white text-manifest-dark text-center px-7 py-4 rounded-full font-heading font-bold uppercase tracking-widest text-[10px] hover:bg-manifest-rose hover:text-white transition-all duration-300">Let’s Collaborate <i class="fas fa-envelope ml-1"></i></a>
                        <a href="#" class="w-full sm:w-auto lg:w-full border border-white/14 text-white text-center px-7 py-4 rounded-full font-heading font-bold uppercase tracking-widest text-[10px] hover:bg-white/8 transition-all duration-300">Partnership Deck <i class="fas fa-file-pdf ml-1"></i></a>
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
                        <li>manifestx2026@gmail.com</li>
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

        // 2. RADIAL SCROLL PROGRESS LOGIC & DYNAMIC NAVBAR COLOURED SWITCH
        const circle = document.getElementById('progressCircle');
        const radius = circle.r.baseVal.value;
        const circumference = radius * 2 * Math.PI;

        circle.style.strokeDasharray = `${circumference} ${circumference}`;
        circle.style.strokeDashoffset = circumference;

        function updateScrollProgress() {
            const scrollTop = window.scrollY;
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            const scrollPercent = scrollTop / docHeight;
            
            const offset = circumference - (scrollPercent * circumference);
            circle.style.strokeDashoffset = offset;

            const container = document.getElementById('radialScrollContainer');
            if (scrollTop > 150) {
                container.style.opacity = "1";
                container.style.transform = "translateY(0) scale(1)";
                container.style.pointerEvents = "auto";
            } else {
                container.style.opacity = "0";
                container.style.transform = "translateY(16px) scale(0.9)";
                container.style.pointerEvents = "none";
            }

            const navInner = document.getElementById('navInner');
            if (scrollTop > 80) { 
                navInner.classList.remove('nav-at-top');
                navInner.classList.add('nav-scrolled');
            } else {
                navInner.classList.remove('nav-scrolled');
                navInner.classList.add('nav-at-top');
            }
        }

        window.addEventListener('scroll', updateScrollProgress);

        // 3. Countdown Timer Logic
        const countDownDate = new Date("Jul 15, 2026 23:59:59").getTime();

        const x = setInterval(function() {
            const now = new Date().getTime();
            const distance = countDownDate - now;

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("cd-days").innerText = days.toString().padStart(2, '0');
            document.getElementById("cd-hours").innerText = hours.toString().padStart(2, '0');
            document.getElementById("cd-minutes").innerText = minutes.toString().padStart(2, '0');
            document.getElementById("cd-seconds").innerText = seconds.toString().padStart(2, '0');

            if (distance < 0) {
                clearInterval(x);
                document.getElementById("cd-days").innerText = "00";
                document.getElementById("cd-hours").innerText = "00";
                document.getElementById("cd-minutes").innerText = "00";
                document.getElementById("cd-seconds").innerText = "00";
            }
        }, 1000);

        // 4. Mobile Sidebar Logic
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

        // 5. MUSIC NOTES GENERATOR
        const notes = ['♪', '♫', '♬', '♩', '♭', '♯'];
        const container = document.getElementById('notesContainer');
        for (let i = 0; i < 30; i++) {
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

        // 6. LIGHTWEIGHT NATIVE SCROLL REVEAL LOGIC
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