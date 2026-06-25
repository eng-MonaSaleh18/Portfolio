<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $about->name ?? 'Mona Saleh' }} | Developer</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        html {
            scroll-behavior: smooth;
        }

        /* الإعدادات العامة والخطوط */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #121417;
            overflow-x: hidden;
        }

        /* 1. الأنيميشن المفقودة (التصحيح) */
        @keyframes spin-slow {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .animate-spin-slow {
            animation: spin-slow 8s linear infinite;
        }

        @keyframes spin-reverse {
            from {
                transform: rotate(360deg);
            }

            to {
                transform: rotate(0deg);
            }
        }

        .animate-spin-reverse {
            animation: spin-reverse 4s linear infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(3deg);
            }

            50% {
                transform: translateY(-20px) rotate(5deg);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .reveal-item {
            opacity: 0;
            animation: fadeInUp 0.8s ease-out forwards;
        }

        /* 2. تخصيصات الناف بار */
        .nav-link {
            @apply text-[11px] font-bold uppercase tracking-[0.2em] text-gray-400 transition-all duration-300;
            position: relative;
        }

        .nav-link span::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 0;
            background-color: #9D1747;
            transition: all 0.3s ease;
        }

        .nav-link:hover span::after {
            width: 100%;
        }

        .nav-link:hover {
            @apply text-white;
        }

        /* 3. الهيرو وقسم المشاريع */
        .bg-primary {
            background-color: #9D1747;
        }

        .text-primary {
            color: #9D1747;
        }

        .border-primary {
            border-color: #9D1747;
        }

        .hero-glass {
            background: rgba(22, 24, 26, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .project-card {
            @apply bg-[#16181a] border border-gray-800/50 rounded-2xl overflow-hidden transition-all duration-500 flex flex-col h-full;
            border-radius: 2rem;
            /* حواف منحنية كبيرة للكارد */
            overflow: hidden;
        }

        .project-card:hover {
            @apply -translate-y-3 border-[#9D1747]/50;
            box-shadow: 0 20px 40px -15px rgba(157, 23, 71, 0.4);
        }

        .project-card p {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            max-height: 4.5rem;
            /* 3 أسطر تقريباً */
        }

        .project-card:hover p {
            -webkit-line-clamp: unset;
            max-height: 500px;
            color: #9ca3af;
            /* رمادي أفتح شوي عند الهوفر */
        }

        /* شريط fade سفلي يلمح إن فيه أكثر */
        .project-card .project-desc-wrapper {
            position: relative;
        }

        .project-card .project-desc-wrapper::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2rem;
            background: linear-gradient(to bottom, transparent, #16181a);
            pointer-events: none;
            transition: opacity 0.4s ease;
        }

        .project-card:hover .project-desc-wrapper::after {
            opacity: 0;
        }

        /* تحسين انحناء حاوية الصورة */
        .project-image-container {
            position: relative;
            width: 100%;
            height: 220px;
            /* يمكنك تعديل الارتفاع */
            overflow: hidden;
            border-radius: 1rem 1rem 0 0;
            /* انحناء من الأعلى فقط */
        }

        .project-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        /* تكبير الصورة عند الهوفر مع الحفاظ على الانحناء */
        .project-card:hover .project-image-container img {
            transform: scale(1.1);
        }

        /* حاوية الأزرار لضمان التوازن والتباعد البصري */

        .btn-container {
            display: flex;
            gap: 10px;
            margin-top: auto;
            padding-top: 1.5rem;
        }

        /* ─── مشترك ─── */
        .btn-main,
        .btn-secondary {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 0;
            height: 46px;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            border-radius: 12px;
            position: relative;
            overflow: hidden;
            cursor: pointer;
            text-decoration: none;
            isolation: isolate;
        }

        /* ─── زر Demo ─── */
        .btn-main {
            background: #16181a;
            color: white;
            border: 1px solid #9D1747;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* طبقة الـ gradient الخلفية */
        .btn-main::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, #9D1747, #d42060);
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: -1;
            border-radius: 12px;
        }

        /* خط متوهج على الحافة */
        .btn-main::after {
            content: '';
            position: absolute;
            inset: -1px;
            border-radius: 12px;
            padding: 1px;
            background: linear-gradient(135deg, #9D1747, #d42060, #9D1747);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            opacity: 1;
            transition: opacity 0.4s ease;
        }

        .btn-main:hover {
            border-color: transparent;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(157, 23, 71, 0.35);
        }

        .btn-main:hover::before {
            opacity: 1;
        }

        .btn-main:hover::after {
            opacity: 0;
        }

        .btn-main:active {
            transform: translateY(0);
            box-shadow: 0 2px 10px rgba(157, 23, 71, 0.25);
        }

        .btn-main i {
            transition: transform 0.3s ease;
            font-size: 11px;
        }

        .btn-main:hover i {
            transform: translate(3px, -3px);
        }

        /* ─── زر Code ─── */
        .btn-secondary {
            background: transparent;
            color: #9ca3af;
            border: 1px solid #374151;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* خلفية مائية */
        .btn-secondary::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 12px;
            background: radial-gradient(circle at center, rgba(157, 23, 71, 0.08), transparent 70%);
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: -1;
        }

        /* خط سفلي متوهج */
        .btn-secondary::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, #9D1747, transparent);
            transition: width 0.4s ease;
            border-radius: 2px;
        }

        .btn-secondary:hover {
            border-color: #9D1747;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(157, 23, 71, 0.12);
        }

        .btn-secondary:hover::before {
            opacity: 1;
        }

        .btn-secondary:hover::after {
            width: 60%;
        }

        .btn-secondary:active {
            transform: translateY(0);
        }

        .btn-secondary i {
            transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
            font-size: 14px;
        }

        .btn-secondary:hover i {
            transform: rotate(-12deg) scale(1.2);
        }

        input::placeholder,
        textarea::placeholder {
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        input:focus::placeholder,
        textarea:focus::placeholder {
            opacity: 0.4;
            transform: translateX(4px);
        }

        input:-webkit-autofill,
        textarea:-webkit-autofill {
            -webkit-box-shadow: 0 0 0 50px #16181a inset;
            -webkit-text-fill-color: white;
        }

        textarea {
            resize: vertical;
            min-height: 120px;
        }

        @keyframes shimmer {
            0% {
                background-position: -200% center;
            }

            100% {
                background-position: 200% center;
            }
        }

        #contact button[type="submit"]:hover {
            background-size: 200% auto;
            animation: shimmer 2s linear infinite;
        }

        @keyframes shimmer {
            0% {
                background-position: -200% center;
            }

            100% {
                background-position: 200% center;
            }
        }

        #contact button[type="submit"]:hover {
            background-size: 200% auto;
            animation: shimmer 2s linear infinite;
        }

        /*  */
        /* Glow Pulse Animation */
        @keyframes glow-pulse {

            0%,
            100% {
                opacity: 1;
                text-shadow: 0 0 20px rgba(157, 23, 71, 0.8);
                transform: scale(1);
            }

            50% {
                opacity: 0.7;
                transform: scale(0.9);
            }
        }

        .animate-glow-pulse {
            animation: glow-pulse 2s ease-in-out infinite;
        }
    </style>
</head>

<body class="bg-[#0c0d0e] text-gray-400 antialiased selection:bg-[#9D1747]/30">
    <div id="preloader" class="fixed inset-0 z-[100] flex items-center justify-center bg-[#0c0d0e]">
        <div class="relative w-32 h-32">
            <div
                class="absolute inset-0 rounded-full border-t-4 border-b-4 border-primary opacity-20 animate-spin-slow">
            </div>

            <div class="absolute inset-2 rounded-full border-r-4 border-l-4 border-primary animate-spin-reverse"></div>

            <div class="absolute inset-4 rounded-full border-2 border-primary/50 shadow-[0_0_15px_rgba(157,23,71,0.5)]">
            </div>

            <div class="absolute inset-0 flex items-center justify-center">
                <span class="text-white font-bold text-3xl tracking-tighter animate-glow-pulse">
                    {{ substr($about->name ?? 'M', 0, 1) }}
                </span>
            </div>
        </div>
    </div>






    <nav class="bg-[#121417]/90 backdrop-blur-md sticky top-0 z-50 py-3 px-6 border-b border-gray-800/50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">

            <div class="flex items-center gap-3">
                <div
                    class="w-10 h-10 rounded-full bg-gradient-to-br from-[#9D1747] to-[#5a0e29] flex items-center justify-center text-white font-bold shadow-lg">
                    M
                </div>
                <span class="text-xl font-bold tracking-tighter text-white uppercase">
                    Mona <span class="text-[#9D1747]"> Sa</span>
                </span>
            </div>

            <div class="hidden md:flex items-center gap-10">
                <a href="#home" class="nav-link"><span>Home</span></a>
                <a href="#about" class="nav-link"><span>About</span></a>
                <a href="#portfolio" class="nav-link"><span>Projects</span></a>
                <a href="#contact" class="nav-link"><span>Contact</span></a>
            </div>

        </div>
    </nav>

    {{-- قسم الهيرو  --}}

    {{-- قسم الهيرو المعدل --}}
    <main class="relative overflow-hidden bg-[#0c0d0e] pt-10 md:pt-16">
        <section id="home"
            class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-12 gap-12 items-center min-h-[70vh] mb-0 relative">

            {{-- الجزء النصي --}}
            <div class="space-y-6 z-10 text-center md:text-left md:col-span-7">
                <div class="inline-block">
                    <span
                        class="text-primary tracking-[0.4em] text-[10px] font-black uppercase bg-[#9D1747]/10 px-4 py-2 rounded-full border border-[#9D1747]/20">
                        Welcome to my world
                    </span>
                </div>

                <h1 class="text-4xl md:text-6xl font-bold text-white leading-[1.1]">
                    Hi, I'm <span class="text-primary">{{ $about->name ?? 'Mona' }}</span><br>
                    <span class="text-xl md:text-3xl text-gray-400 mt-2 block font-medium">Backend Developer.</span>
                </h1>

                <div class="text-gray-400 leading-relaxed max-w-lg text-base md:text-lg font-light">
                    {!! strip_tags(
                        $about->description ?? 'Expert in building high-performance server-side logic and database structures.',
                    ) !!}
                </div>

                <div class="flex flex-wrap justify-center md:justify-start gap-4 pt-2">
                    <a href="#portfolio"
                        class="px-6 py-3 bg-[#9D1747] text-white text-[10px] font-bold uppercase tracking-widest rounded-xl transition-all duration-300 hover:bg-[#83143c] hover:scale-105 hover:shadow-[0_10px_20px_rgba(157,23,71,0.3)] flex items-center gap-2">
                        <span>VIEW PROJECTS</span>
                        <i class="fa-solid fa-arrow-right-long"></i>
                    </a>
                    <a href="#contact"
                        class="px-6 py-3 bg-transparent border-2 border-gray-800 text-white text-[10px] font-bold uppercase tracking-widest rounded-xl transition-all duration-300 hover:border-[#9D1747] hover:text-[#9D1747] flex items-center gap-2">
                        CONTACT ME
                    </a>
                </div>
            </div>

            {{-- الجزء الخاص بالصورة مع إصلاح الزوايا --}}
            <div class="relative flex justify-center items-center md:col-span-5">
                <div class="absolute w-56 h-56 bg-[#9D1747] rounded-full opacity-[0.04] blur-[70px]"></div>

                <div
                    class="relative w-52 h-64 md:w-56 md:h-72 p-2 bg-white/5 backdrop-blur-sm border border-white/10 rounded-[1.5rem] shadow-2xl overflow-hidden">
                    <div
                        class="w-full h-full transition-transform duration-400 ease-out hover:scale-105 origin-center will-change-transform">
                        <div
                            class="w-full h-full bg-[#1a1c1e] rounded-[1rem] overflow-hidden border border-white/5 relative">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($about->name ?? 'M') }}&size=512&background=16181a&color=9D1747"
                                class="w-full h-full object-cover opacity-85" alt="Mona">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-[#0c0d0e] via-transparent to-transparent opacity-65">
                            </div>
                        </div>
                    </div>

                    <div
                        class="absolute top-0 right-0 w-12 h-12 border-t-2 border-r-2 border-[#9D1747]/40 rounded-tr-[1.5rem] pointer-events-none z-20">
                    </div>
                    <div
                        class="absolute bottom-0 left-0 w-12 h-12 border-b-2 border-l-2 border-[#9D1747]/40 rounded-bl-[1.5rem] pointer-events-none z-20">
                    </div>
                </div>
            </div>
        </section>
    </main>
    {{-- قسم نبذة عني  --}}
    <section id="about" class="py-24 max-w-6xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">

            <div class="lg:col-span-7 space-y-8">
                <div class="relative group">
                    <div
                        class="absolute -inset-1 bg-gradient-to-r from-[#9D1747] to-transparent rounded-3xl blur opacity-10 group-hover:opacity-20 transition duration-1000">
                    </div>
                    <div class="relative bg-[#121417] p-8 rounded-3xl border border-gray-800/50 shadow-2xl">
                        <h3 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                            <span class="w-8 h-[2px] bg-[#9D1747]"></span>
                            About Me
                        </h3>
                        <div class="text-gray-400 leading-relaxed text-lg">
                            {!! $about->description !!}
                        </div>
                    </div>
                </div>

                <div class="relative group">
                    <div
                        class="absolute -inset-1 bg-gradient-to-r from-[#9D1747] to-transparent rounded-3xl blur opacity-10 group-hover:opacity-20 transition duration-1000">
                    </div>
                    <div class="relative bg-[#121417] p-8 rounded-3xl border border-gray-800/50 shadow-2xl">
                        <h3 class="text-2xl font-bold text-white mb-8 flex items-center gap-3">
                            <span class="p-2 bg-[#9D1747]/10 rounded-lg text-[#9D1747]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z">
                                    </path>
                                </svg>
                            </span>
                            Academic Path
                        </h3>
                        <div class="relative border-l-2 border-[#9D1747]/30 ml-3 pl-8">
                            <div
                                class="absolute -left-[9px] top-1 w-4 h-4 rounded-full bg-[#0c0d0e] border-2 border-[#9D1747] shadow-[0_0_10px_#9D1747]">
                            </div>
                            <time class="text-xs font-bold text-[#9D1747] uppercase tracking-[0.2em]">2018 — 2023</time>
                            <h4 class="text-xl font-bold text-white mt-2 leading-tight">Electronics & Communications
                                Engineering</h4>
                            <p class="text-gray-400 font-medium mt-1">Damascus University</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5 space-y-8">
                <div class="relative group">
                    <div
                        class="absolute -inset-1 bg-gradient-to-r from-[#9D1747] to-transparent rounded-3xl blur opacity-10 group-hover:opacity-20 transition duration-1000">
                    </div>
                    <div class="relative bg-[#121417] p-8 rounded-3xl border border-gray-800/50 shadow-2xl">
                        <h3 class="text-2xl font-bold text-white mb-8 flex items-center gap-3">
                            <span class="w-8 h-[2px] bg-[#9D1747]"></span>
                            Technical Skills
                        </h3>
                        <div class="grid grid-cols-2 gap-3">
                            @foreach ($skills as $skill)
                                <div
                                    class="group/item p-3 bg-[#16181a] border border-gray-800 rounded-xl hover:border-[#9D1747]/50 transition-all duration-300 min-h-[50px] flex items-center">
                                    <div class="flex items-start gap-2 w-full">
                                        <div
                                            class="w-1.5 h-1.5 rounded-full bg-[#9D1747] shadow-[0_0_5px_#9D1747] opacity-60 group-hover/item:opacity-100 mt-1.5 shrink-0">
                                        </div>
                                        <span
                                            class="text-gray-400 group-hover/item:text-white font-medium text-[12px] md:text-[13px] transition-colors uppercase tracking-tight leading-snug">
                                            {{ $skill->name }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="relative group">
                    <div
                        class="absolute -inset-1 bg-gradient-to-r from-[#9D1747] to-transparent rounded-3xl blur opacity-10 group-hover:opacity-20 transition duration-1000">
                    </div>
                    <div class="relative bg-[#121417] p-8 rounded-3xl border border-gray-800/50 shadow-2xl">
                        <h3 class="text-xl font-bold text-white mb-8 flex items-center gap-3">
                            <span class="w-8 h-[2px] bg-[#9D1747]"></span>
                            Languages
                        </h3>
                        <div class="space-y-6">
                            <div class="relative">
                                <div class="flex justify-between items-end mb-2">
                                    <span
                                        class="text-sm text-gray-300 font-semibold tracking-wide uppercase">Arabic</span>
                                    <span
                                        class="text-[10px] text-[#9D1747] font-black uppercase tracking-[0.2em]">Native</span>
                                </div>
                                <div class="h-[2px] w-full bg-gray-900 rounded-full overflow-hidden">
                                    <div class="h-full bg-[#9D1747] w-full shadow-[0_0_8px_#9D1747]"></div>
                                </div>
                            </div>
                            <div class="relative">
                                <div class="flex justify-between items-end mb-2">
                                    <span
                                        class="text-sm text-gray-300 font-semibold tracking-wide uppercase">English</span>
                                    <span
                                        class="text-[10px] text-[#9D1747] font-black uppercase tracking-[0.2em]">Good</span>
                                </div>
                                <div class="h-[2px] w-full bg-gray-900 rounded-full overflow-hidden">
                                    <div class="h-full bg-[#9D1747] w-[50%] shadow-[0_0_8px_#9D1747]"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- قسم المشاريع --}}

    <section id="portfolio" class="py-24 bg-[#0c0d0e]">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                    Featured <span class="text-[#9D1747]">Projects</span>
                </h2>
                <div class="w-20 h-1.5 bg-[#9D1747] rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($projects as $project)
                    <div class="project-card group">
                        <div class="project-image-container">
                            <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#16181a] to-transparent opacity-60">
                            </div>
                        </div>

                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="text-xl font-bold text-white mb-3 group-hover:text-[#9D1747] transition-colors">
                                {{ $project->title }}
                            </h3>
                            <div class="project-desc-wrapper mb-6">
                                <p class="text-gray-500 text-sm leading-relaxed">
                                    {!! strip_tags($project->description) !!}
                                </p>
                            </div>

                            <div class="btn-container">
                                @if ($project->project_link)
                                    <a href="{{ $project->project_link }}" target="_blank" class="btn-main">
                                        <span>Demo</span>
                                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                                    </a>
                                @endif

                                @if ($project->code_link)
                                    <a href="{{ $project->code_link }}" target="_blank" class="btn-secondary">
                                        <i class="fa-brands fa-github text-base"></i>
                                        <span>Code</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="contact" class="py-24 bg-[#0c0d0e] relative overflow-hidden">
        <div
            class="absolute top-0 left-1/2 -translate-x-1/2 w-[600px] h-[600px] bg-[#9D1747] rounded-full opacity-[0.03] blur-[120px] pointer-events-none">
        </div>

        <div class="max-w-6xl mx-auto px-6 relative z-10">
            {{-- العنوان --}}
            <div class="flex flex-col mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                    Get In <span class="text-[#9D1747]">Touch</span>
                </h2>
                <div class="w-20 h-1.5 bg-[#9D1747] rounded-full"></div>
                <p class="text-gray-500 mt-4 max-w-md text-sm leading-relaxed">
                    Have a project in mind or want to collaborate? Feel free to reach out — I'm always open to
                    discussing new opportunities.
                </p>
            </div>

            {{-- رسالة نجاح --}}
            @if (session('success'))
                <div class="mb-8 p-4 bg-[#9D1747]/10 border border-[#9D1747]/30 rounded-2xl flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-[#9D1747]/20 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-check text-[#9D1747]"></i>
                    </div>
                    <p class="text-sm text-white font-medium">{{ session('success') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

                {{-- الجانب الأيسر — معلومات التواصل --}}
                <div class="lg:col-span-5 space-y-6">
                    {{-- Email --}}
                    <div class="group relative">
                        <div
                            class="absolute -inset-0.5 bg-gradient-to-r from-[#9D1747]/30 to-transparent rounded-2xl blur opacity-0 group-hover:opacity-100 transition duration-500">
                        </div>
                        <div
                            class="relative bg-[#121417] p-6 rounded-2xl border border-gray-800/50 flex items-center gap-5 transition-all duration-300 group-hover:border-[#9D1747]/40 group-hover:-translate-y-1">
                            <div
                                class="w-12 h-12 rounded-xl bg-[#9D1747]/10 flex items-center justify-center shrink-0 group-hover:bg-[#9D1747]/20 transition-colors">
                                <i class="fa-solid fa-envelope text-[#9D1747] text-lg"></i>
                            </div>
                            <div>
                                <span
                                    class="text-[10px] text-gray-500 font-bold uppercase tracking-[0.15em] block mb-1">Email</span>
                                <a href="mailto:{{ $user->email }}"
                                    class="text-white font-medium text-sm hover:text-[#9D1747] transition-colors">
                                    {{ $user->email }}
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Phone --}}
                    <div class="group relative">
                        <div
                            class="absolute -inset-0.5 bg-gradient-to-r from-[#9D1747]/30 to-transparent rounded-2xl blur opacity-0 group-hover:opacity-100 transition duration-500">
                        </div>
                        <div
                            class="relative bg-[#121417] p-6 rounded-2xl border border-gray-800/50 flex items-center gap-5 transition-all duration-300 group-hover:border-[#9D1747]/40 group-hover:-translate-y-1">
                            <div
                                class="w-12 h-12 rounded-xl bg-[#9D1747]/10 flex items-center justify-center shrink-0 group-hover:bg-[#9D1747]/20 transition-colors">
                                <i class="fa-solid fa-phone text-[#9D1747] text-lg"></i>
                            </div>
                            <div>
                                <span
                                    class="text-[10px] text-gray-500 font-bold uppercase tracking-[0.15em] block mb-1">Phone</span>
                                <a href="tel:{{ $user->phone }}"
                                    class="text-white font-medium text-sm hover:text-[#9D1747] transition-colors">
                                    {{ $user->phone }}
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Location --}}
                    <div class="group relative">
                        <div
                            class="absolute -inset-0.5 bg-gradient-to-r from-[#9D1747]/30 to-transparent rounded-2xl blur opacity-0 group-hover:opacity-100 transition duration-500">
                        </div>
                        <div
                            class="relative bg-[#121417] p-6 rounded-2xl border border-gray-800/50 flex items-center gap-5 transition-all duration-300 group-hover:border-[#9D1747]/40 group-hover:-translate-y-1">
                            <div
                                class="w-12 h-12 rounded-xl bg-[#9D1747]/10 flex items-center justify-center shrink-0 group-hover:bg-[#9D1747]/20 transition-colors">
                                <i class="fa-solid fa-location-dot text-[#9D1747] text-lg"></i>
                            </div>
                            <div>
                                <span
                                    class="text-[10px] text-gray-500 font-bold uppercase tracking-[0.15em] block mb-1">Location</span>
                                <span class="text-white font-medium text-sm">{{ $user->location }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- السوشيال ميديا --}}
                    <div class="pt-4">
                        <span class="text-[10px] text-gray-500 font-bold uppercase tracking-[0.15em] block mb-4">Follow
                            Me</span>
                        <div class="flex gap-3">
                            <a href="{{ $user->github_link }}" target="_blank"
                                class="w-11 h-11 rounded-xl bg-[#16181a] border border-gray-800/50 flex items-center justify-center text-gray-400 hover:text-white hover:border-[#9D1747]/50 hover:bg-[#9D1747]/10 transition-all duration-300 hover:-translate-y-1">
                                <i class="fa-brands fa-github text-lg"></i>
                            </a>
                            <a href="{{ $user->linkedin_link }}" target="_blank"
                                class="w-11 h-11 rounded-xl bg-[#16181a] border border-gray-800/50 flex items-center justify-center text-gray-400 hover:text-white hover:border-[#9D1747]/50 hover:bg-[#9D1747]/10 transition-all duration-300 hover:-translate-y-1">
                                <i class="fa-brands fa-linkedin-in text-lg"></i>
                            </a>
                            <a href="{{ $user->telegram_link }}" target="_blank"
                                class="w-11 h-11 rounded-xl bg-[#16181a] border border-gray-800/50 flex items-center justify-center text-gray-400 hover:text-white hover:border-[#9D1747]/50 hover:bg-[#9D1747]/10 transition-all duration-300 hover:-translate-y-1">
                                <i class="fa-brands fa-telegram text-lg"></i>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- الجانب الأيمن — النموذج --}}
                <div class="lg:col-span-7">
                    <div class="relative group">
                        <div
                            class="absolute -inset-1 bg-gradient-to-r from-[#9D1747]/20 to-transparent rounded-3xl blur opacity-20 group-hover:opacity-30 transition duration-1000">
                        </div>
                        <div
                            class="relative bg-[#121417] p-8 md:p-10 rounded-3xl border border-gray-800/50 shadow-2xl">
                            <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    {{-- الاسم --}}
                                    <div class="space-y-2">
                                        <label
                                            class="text-[10px] text-gray-400 font-bold uppercase tracking-[0.15em]">Full
                                            Name</label>
                                        <input type="text" name="name" required value="{{ old('name') }}"
                                            placeholder="John Doe"
                                            class="w-full bg-[#16181a] border border-gray-800/50 rounded-xl px-5 py-3.5 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-[#9D1747]/60 focus:ring-1 focus:ring-[#9D1747]/30 transition-all duration-300 @error('name') !border-red-500/60 @enderror">
                                        @error('name')
                                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- البريد --}}
                                    <div class="space-y-2">
                                        <label
                                            class="text-[10px] text-gray-400 font-bold uppercase tracking-[0.15em]">Email</label>
                                        <input type="email" name="email" required value="{{ old('email') }}"
                                            placeholder="john@example.com"
                                            class="w-full bg-[#16181a] border border-gray-800/50 rounded-xl px-5 py-3.5 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-[#9D1747]/60 focus:ring-1 focus:ring-[#9D1747]/30 transition-all duration-300 @error('email') !border-red-500/60 @enderror">
                                        @error('email')
                                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                {{-- العنوان --}}
                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] text-gray-400 font-bold uppercase tracking-[0.15em]">Subject</label>
                                    <input type="text" name="message_subject" required
                                        value="{{ old('message_subject') }}" placeholder="Project Collaboration"
                                        class="w-full bg-[#16181a] border border-gray-800/50 rounded-xl px-5 py-3.5 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-[#9D1747]/60 focus:ring-1 focus:ring-[#9D1747]/30 transition-all duration-300 @error('message_subject') !border-red-500/60 @enderror">
                                    @error('message_subject')
                                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- الرسالة --}}
                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] text-gray-400 font-bold uppercase tracking-[0.15em]">Message</label>
                                    <textarea name="message_content" rows="5" required placeholder="Tell me about your project..."
                                        class="w-full bg-[#16181a] border border-gray-800/50 rounded-xl px-5 py-3.5 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-[#9D1747]/60 focus:ring-1 focus:ring-[#9D1747]/30 transition-all duration-300 resize-none @error('message_content') !border-red-500/60 @enderror">{{ old('message_content') }}</textarea>
                                    @error('message_content')
                                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- زر الإرسال --}}
                                <button type="submit"
                                    class="w-full relative overflow-hidden bg-gradient-to-r from-[#9D1747] to-[#b91c52] text-white font-bold text-[11px] uppercase tracking-[0.15em] py-4 rounded-xl transition-all duration-300 hover:shadow-[0_8px_30px_rgba(157,23,71,0.4)] hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center gap-3 group/btn">
                                    <span>Send Message</span>
                                    <i
                                        class="fa-solid fa-paper-plane text-xs transition-transform duration-300 group-hover/btn:translate-x-1 group-hover/btn:-translate-y-0.5"></i>
                                    <div
                                        class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover/btn:translate-x-full transition-transform duration-700">
                                    </div>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>










    <script>
        window.addEventListener('load', function() {
            const preloader = document.getElementById('preloader');

            setTimeout(() => {
                preloader.classList.add('transition-all', 'duration-1000', 'opacity-0', 'scale-110');

                setTimeout(() => {
                    preloader.style.display = 'none';
                    document.body.classList.remove('loading');
                }, 1000);
            }, 2000);
        });
    </script>



    <script>
        // Smooth scroll مع offset للنافبار
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const offset = 80; // ارتفاع النافبار
                    const top = target.getBoundingClientRect().top + window.pageYOffset - offset;
                    window.scrollTo({
                        top,
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>

</html>
