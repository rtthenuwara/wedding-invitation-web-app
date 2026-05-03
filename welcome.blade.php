<!DOCTYPE html>
<html lang="si">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dasuni & Shanka - Wedding Invitation</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="icon" href="assets/favicon.png" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        vintage: {
                            bg: '#fdfbf7',
                            /* Ivory */
                            peach: '#fceee9',
                            /* Soft Peach */
                            green: '#eef2ed',
                            /* Sage Green */
                            text: '#4a3f35',
                            gold: '#c2a373'
                        }
                    },
                    fontFamily: {
                        serif: ['"Playfair Display"', 'serif'],
                        script: ['"Great Vibes"', 'cursive'],
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Playfair Display', serif;
            background:
                url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.8' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.04'/%3E%3C/svg%3E"),
                radial-gradient(circle at center, #ffffff 0%, #fdfbf7 30%, #eef2ed 75%, #fceee9 100%);
            color: #4a3f35;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* Splash Screen (Tap to Open) */
        .loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #fdfbf7;
            z-index: 99999;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            transition: opacity 0.8s ease-out;
        }

        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body>

    <div id="tapToOpenScreen" class="fixed inset-0 z-[99999] bg-[#fdfbf7] flex flex-col items-center justify-center cursor-pointer overflow-hidden">

        <div class="absolute inset-4 md:inset-6 border border-vintage-gold/30 rounded-2xl md:rounded-3xl pointer-events-none"></div>

        <div class="floral-tl absolute top-0 left-0 w-32 md:w-56 lg:w-72 z-20 pointer-events-none opacity-90 drop-shadow-md">
            <img src="{{ asset('assets/floral_borders_4.png') }}" alt="Floral accent" class="w-full" style="transform: rotate(-90deg) scaleX(-1);">
        </div>
        <img src="{{ asset('assets/floral_borders_3.png') }}" alt="Floral accent" class="floral-br absolute bottom-0 right-0 w-40 md:w-64 lg:w-80 z-20 pointer-events-none opacity-90 drop-shadow-md">

        <div class="z-30 relative flex flex-col items-center justify-center w-full mt-4 md:mt-0 px-4 text-center">

            <div class="mb-6 md:mb-8 flex flex-col items-center">
                <h2 class="text-5xl md:text-6xl lg:text-7xl font-script text-vintage-gold drop-shadow-sm mb-3">Timeless Love</h2>
                <div class="flex items-center gap-3 md:gap-4 opacity-80">
                    <div class="w-8 md:w-16 h-[1px] bg-vintage-gold/70"></div>
                    <span class="text-[10px] md:text-sm font-serif text-vintage-text tracking-[0.3em] uppercase font-semibold">Vintage Elegance</span>
                    <div class="w-8 md:w-16 h-[1px] bg-vintage-gold/70"></div>
                </div>
            </div>

            <div class="relative w-40 h-40 md:w-56 md:h-56 flex items-center justify-center mb-10">
                <div class="absolute inset-0 border-[1px] border-vintage-gold/40 rounded-full animate-[spin_15s_linear_infinite]"></div>
                <div class="absolute inset-2 md:inset-3 border-[1px] border-dashed border-vintage-gold/60 rounded-full animate-[spin_20s_linear_infinite_reverse]"></div>
                <div class="absolute inset-4 md:inset-5 bg-vintage-gold/5 rounded-full"></div>

                <h1 class="text-5xl md:text-7xl font-script text-vintage-gold drop-shadow-sm flex items-center gap-2 md:gap-3 mt-2 md:mt-0">
                    D <span class="text-3xl md:text-4xl text-vintage-text/40 font-serif">&amp;</span> S
                </h1>
            </div>

            <div class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-vintage-gold/60 to-vintage-peach rounded-full blur opacity-40 group-hover:opacity-100 transition duration-1000 group-hover:duration-200 animate-pulse"></div>
                <button id="tap-btn-text" class="relative px-10 py-3 md:px-12 md:py-4 bg-[#fdfbf7] border border-vintage-gold/50 text-vintage-text rounded-full font-serif tracking-[0.2em] text-xs md:text-sm uppercase transition-all duration-300 shadow-xl group-hover:bg-vintage-gold group-hover:text-white">
                    Tap to Open
                </button>
            </div>

        </div>
    </div>

    <section class="min-h-[100svh] flex flex-col justify-center items-center relative p-4 text-center overflow-hidden w-full">

        <div class="absolute inset-0 z-0 overflow-hidden bg-[#2a241e]">
            <img src="assets/bg_image.jpg" alt="Couple Background" class="w-full h-full object-cover filter blur-[2px] scale-105 opacity-60">
            <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/30 to-[#fdfbf7]"></div>
        </div>

        <div class="absolute top-10 left-10 w-48 h-48 md:w-64 md:h-64 bg-vintage-peach rounded-full mix-blend-overlay filter blur-3xl opacity-30 z-10"></div>
        <div class="absolute bottom-10 right-10 w-48 h-48 md:w-64 md:h-64 bg-vintage-green rounded-full mix-blend-overlay filter blur-3xl opacity-30 z-10"></div>

        <div class="hero-content z-30 opacity-0 transform translate-y-12 px-4 w-full -mt-12 md:-mt-24">

            <div class="mb-3 md:mb-5 flex flex-col items-center gap-1 md:gap-2">
                <p class="text-[10px] md:text-xs lg:text-sm tracking-[0.3em] uppercase text-gray-200 font-semibold drop-shadow-md">
                    Together with our families
                </p>
                <p class="text-sm md:text-lg lg:text-xl font-serif italic text-white drop-shadow-md">
                    We request the honor of your presence
                </p>
                <p class="text-xs md:text-sm lg:text-lg tracking-[0.2em] uppercase text-[#e5c07b] font-bold drop-shadow-md mt-1">
                    To celebrate the wedding of
                </p>
            </div>

            <h1 class="font-script mb-1 md:mb-2 text-white drop-shadow-[0_4px_10px_rgba(0,0,0,0.5)] flex flex-col sm:block items-center leading-[0.9] sm:leading-[1.1]">
                <span class="text-[5.5rem] sm:text-7xl md:text-8xl lg:text-9xl">Dasuni</span>
                <span class="text-[3.5rem] sm:text-7xl md:text-8xl lg:text-9xl text-[#e5c07b] sm:text-white my-1 sm:my-0">&amp;</span>
                <span class="text-[5.5rem] sm:text-7xl md:text-8xl lg:text-9xl">Shanka</span>
            </h1>

            <p class="text-lg sm:text-xl md:text-3xl italic mb-1 text-white font-medium drop-shadow-md">
                Thursday, May 28, 2026
            </p>

            <p class="text-sm md:text-md lg:text-lg tracking-widest text-gray-200 font-semibold max-w-lg mx-auto leading-relaxed drop-shadow-md">
                Riverbank Chateau<br>Vinrich Lake Resort, Madapatha, Piliyandala
            </p>

            <div id="countdown-container" class="flex justify-center items-center gap-4 sm:gap-6 md:gap-10 mt-5 md:mt-6 z-30 opacity-0 transform translate-y-8 bg-black/30 backdrop-blur-md p-4 rounded-3xl border border-white/20 shadow-xl inline-flex">
                <div class="flex flex-col items-center w-16 md:w-24">
                    <span id="days" class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-serif text-[#e5c07b] drop-shadow-sm">00</span>
                    <span class="text-[10px] sm:text-xs tracking-widest uppercase text-gray-300 mt-1 md:mt-2 font-medium">Days</span>
                </div>
                <div class="text-xl sm:text-2xl text-white/50 mb-4 md:mb-6 font-bold">:</div>
                <div class="flex flex-col items-center w-16 md:w-24">
                    <span id="hours" class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-serif text-[#e5c07b] drop-shadow-sm">00</span>
                    <span class="text-[10px] sm:text-xs tracking-widest uppercase text-gray-300 mt-1 md:mt-2 font-medium">Hours</span>
                </div>
                <div class="text-xl sm:text-2xl text-white/50 mb-4 md:mb-6 font-bold">:</div>
                <div class="flex flex-col items-center w-16 md:w-24">
                    <span id="minutes" class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-serif text-[#e5c07b] drop-shadow-sm">00</span>
                    <span class="text-[10px] sm:text-xs tracking-widest uppercase text-gray-300 mt-1 md:mt-2 font-medium">Mins</span>
                </div>
                <div class="text-xl sm:text-2xl text-white/50 mb-4 md:mb-6 hidden sm:block font-bold">:</div>
                <div class="flex-col items-center w-16 md:w-24 hidden sm:flex">
                    <span id="seconds" class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-serif text-[#e5c07b] drop-shadow-sm">00</span>
                    <span class="text-[10px] sm:text-xs tracking-widest uppercase text-gray-300 mt-1 md:mt-2 font-medium">Secs</span>
                </div>
            </div>

        </div>

        <div class="absolute bottom-1 sm:bottom-1 left-0 w-full scroll-indicator opacity-0 flex flex-col items-center z-30 pointer-events-none">
            <div class="flex flex-col items-center animate-bounce">
                <p class="text-[9px] sm:text-[10px] tracking-[0.4em] mb-2 uppercase text-[#202940] font-medium drop-shadow-md opacity-90">
                    Scroll
                </p>
                <div class="w-[1.5px] h-6 sm:h-6 bg-gradient-to-b from-[#202940] to-transparent"></div>
            </div>
        </div>

    </section>

    <section class="py-16 md:py-24 relative z-30 min-h-screen flex flex-col justify-center bg-transparent w-full overflow-hidden">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 w-full relative z-10">

            <div class="text-center mb-12 md:mb-20 agenda-title opacity-0 transform translate-y-8 relative z-20 flex flex-col items-center">
                <p class="text-xs md:text-sm tracking-[0.3em] uppercase mb-4 text-vintage-gold font-semibold">The Schedule</p>
                <div class="flex items-center justify-center gap-3 sm:gap-6 md:gap-10 w-full px-2">
                    <img src="{{ asset('assets/dancer-left.png') }}" class="w-12 sm:w-16 md:w-24 lg:w-32 opacity-90 drop-shadow-md" alt="Kandyan Dancer">
                    <h2 class="text-[2.5rem] sm:text-6xl md:text-8xl font-script text-vintage-text drop-shadow-sm whitespace-nowrap">Wedding Agenda</h2>
                    <img src="{{ asset('assets/dancer-left.png') }}" class="w-12 sm:w-16 md:w-24 lg:w-32 opacity-90 drop-shadow-md" style="transform: scaleX(-1);" alt="Kandyan Dancer">
                </div>
                <div class="w-16 md:w-24 h-[1px] bg-vintage-gold mx-auto mt-6 md:mt-8"></div>
            </div>

            <div class="relative border-l-[2px] md:border-l-[3px] border-vintage-gold/40 ml-2 sm:ml-8 md:ml-12 z-10">

                <div class="mb-10 md:mb-14 relative pl-6 sm:pl-10 md:pl-16 timeline-item opacity-0 transform translate-y-12">
                    <div class="absolute -left-[10px] md:-left-[11px] top-4 md:top-5 w-4 h-4 md:w-5 md:h-5 rounded-full bg-vintage-bg border-[3px] md:border-[4px] border-vintage-gold z-10 shadow-sm"></div>
                    <div class="bg-white/60 md:bg-white/40 backdrop-blur-md p-5 sm:p-6 md:p-8 rounded-2xl rounded-tl-none border border-vintage-gold/20 shadow-lg hover:bg-white/80 transition duration-300">
                        <div class="flex flex-col sm:flex-row sm:items-baseline sm:justify-between mb-2 md:mb-3">
                            <h3 class="text-2xl sm:text-3xl md:text-4xl font-serif text-vintage-text font-medium mb-1 sm:mb-0">09:45 <span class="text-base md:text-xl">A.M.</span></h3>
                            <h4 class="text-2xl sm:text-3xl font-script text-vintage-gold">Arrival of Groom</h4>
                        </div>
                        <p class="text-sm md:text-base text-gray-600 tracking-wide font-light leading-relaxed">The beginning of our forever. We warmly welcome the groom as he arrives to start this joyous day.</p>
                    </div>
                </div>

                <div class="mb-10 md:mb-14 relative pl-6 sm:pl-10 md:pl-16 timeline-item opacity-0 transform translate-y-12">
                    <div class="absolute -left-[10px] md:-left-[11px] top-4 md:top-5 w-4 h-4 md:w-5 md:h-5 rounded-full bg-vintage-bg border-[3px] md:border-[4px] border-vintage-gold z-10 shadow-sm"></div>
                    <div class="bg-white/60 md:bg-white/40 backdrop-blur-md p-5 sm:p-6 md:p-8 rounded-2xl rounded-tl-none border border-vintage-gold/20 shadow-lg hover:bg-white/80 transition duration-300">
                        <div class="flex flex-col sm:flex-row sm:items-baseline sm:justify-between mb-2 md:mb-3">
                            <h3 class="text-2xl sm:text-3xl md:text-4xl font-serif text-vintage-text font-medium mb-1 sm:mb-0">09:55 <span class="text-base md:text-xl">A.M.</span></h3>
                            <h4 class="text-2xl sm:text-3xl font-script text-vintage-gold">Arrival of Bride</h4>
                        </div>
                        <p class="text-sm md:text-base text-gray-600 tracking-wide font-light leading-relaxed">A moment of pure magic. All eyes turn as the radiant bride makes her grand entrance.</p>
                    </div>
                </div>

                <div class="mb-10 md:mb-14 relative pl-6 sm:pl-10 md:pl-16 timeline-item opacity-0 transform translate-y-12">
                    <div class="absolute -left-[12px] md:-left-[14px] top-4 md:top-5 w-5 h-5 md:w-7 md:h-7 rounded-full bg-vintage-gold border-[3px] md:border-[4px] border-white z-10 shadow-[0_0_15px_#c2a373]"></div>
                    <div class="bg-vintage-pink/40 md:bg-vintage-pink/30 backdrop-blur-md p-5 sm:p-6 md:p-8 rounded-2xl rounded-tl-none border border-vintage-gold/40 shadow-xl hover:bg-vintage-pink/60 transition duration-300">
                        <div class="flex flex-col sm:flex-row sm:items-baseline sm:justify-between mb-2 md:mb-3">
                            <h3 class="text-3xl sm:text-4xl md:text-5xl font-serif text-vintage-text font-semibold mb-1 sm:mb-0 drop-shadow-sm">10:10 <span class="text-lg md:text-2xl">A.M.</span></h3>
                            <h4 class="text-3xl sm:text-4xl font-script text-vintage-gold font-bold">Outdoor Poruwa Ceremony</h4>
                        </div>
                        <p class="text-sm md:text-base text-gray-800 tracking-wide font-medium leading-relaxed">The most auspicious moment. Please join us to witness the sacred traditional customs and bless our union.</p>
                    </div>
                </div>

                <div class="mb-10 md:mb-14 relative pl-6 sm:pl-10 md:pl-16 timeline-item opacity-0 transform translate-y-12">
                    <div class="absolute -left-[10px] md:-left-[11px] top-4 md:top-5 w-4 h-4 md:w-5 md:h-5 rounded-full bg-vintage-bg border-[3px] md:border-[4px] border-vintage-gold z-10 shadow-sm"></div>
                    <div class="bg-white/60 md:bg-white/40 backdrop-blur-md p-5 sm:p-6 md:p-8 rounded-2xl rounded-tl-none border border-vintage-gold/20 shadow-lg hover:bg-white/80 transition duration-300">
                        <div class="flex flex-col sm:flex-row sm:items-baseline sm:justify-between mb-2 md:mb-3">
                            <h3 class="text-2xl sm:text-3xl md:text-4xl font-serif text-vintage-text font-medium mb-1 sm:mb-0">10:55 <span class="text-base md:text-xl">A.M.</span></h3>
                            <h4 class="text-2xl sm:text-3xl font-script text-vintage-gold">Lighting of Oil Lamps</h4>
                        </div>
                        <p class="text-sm md:text-base text-gray-600 tracking-wide font-light leading-relaxed">Illuminating our future. Lighting the traditional oil lamp to invite blessings, prosperity, and light into our new life.</p>
                    </div>
                </div>

                <div class="mb-10 md:mb-14 relative pl-6 sm:pl-10 md:pl-16 timeline-item opacity-0 transform translate-y-12">
                    <div class="absolute -left-[10px] md:-left-[11px] top-4 md:top-5 w-4 h-4 md:w-5 md:h-5 rounded-full bg-vintage-bg border-[3px] md:border-[4px] border-vintage-gold z-10 shadow-sm"></div>
                    <div class="bg-white/60 md:bg-white/40 backdrop-blur-md p-5 sm:p-6 md:p-8 rounded-2xl rounded-tl-none border border-vintage-gold/20 shadow-lg hover:bg-white/80 transition duration-300">
                        <div class="flex flex-col sm:flex-row sm:items-baseline sm:justify-between mb-2 md:mb-3">
                            <h3 class="text-2xl sm:text-3xl md:text-4xl font-serif text-vintage-text font-medium mb-1 sm:mb-0">11:00 <span class="text-base md:text-xl">A.M.</span></h3>
                            <h4 class="text-2xl sm:text-3xl font-script text-vintage-gold">Kirikala & Sashrika Table</h4>
                        </div>
                        <p class="text-sm md:text-base text-gray-600 tracking-wide font-light leading-relaxed">A taste of tradition. Sharing the joy with milk rice and sweetmeats to mark a prosperous and sweet beginning.</p>
                    </div>
                </div>

                <div class="mb-10 md:mb-14 relative pl-6 sm:pl-10 md:pl-16 timeline-item opacity-0 transform translate-y-12">
                    <div class="absolute -left-[10px] md:-left-[11px] top-4 md:top-5 w-4 h-4 md:w-5 md:h-5 rounded-full bg-vintage-bg border-[3px] md:border-[4px] border-vintage-gold z-10 shadow-sm"></div>
                    <div class="bg-white/60 md:bg-white/40 backdrop-blur-md p-5 sm:p-6 md:p-8 rounded-2xl rounded-tl-none border border-vintage-gold/20 shadow-lg hover:bg-white/80 transition duration-300">
                        <div class="flex flex-col sm:flex-row sm:items-baseline sm:justify-between mb-2 md:mb-3">
                            <h3 class="text-2xl sm:text-3xl md:text-4xl font-serif text-vintage-text font-medium mb-1 sm:mb-0">11:22 <span class="text-base md:text-xl">A.M.</span></h3>
                            <h4 class="text-2xl sm:text-3xl font-script text-vintage-gold">Registration</h4>
                        </div>
                        <p class="text-sm md:text-base text-gray-600 tracking-wide font-light leading-relaxed">Making it official! The couple signs the marriage register, legally binding their love and commitment to each other.</p>
                    </div>
                </div>

                <div class="mb-10 md:mb-14 relative pl-6 sm:pl-10 md:pl-16 timeline-item opacity-0 transform translate-y-12">
                    <div class="absolute -left-[10px] md:-left-[11px] top-4 md:top-5 w-4 h-4 md:w-5 md:h-5 rounded-full bg-vintage-bg border-[3px] md:border-[4px] border-vintage-gold z-10 shadow-sm"></div>
                    <div class="bg-white/60 md:bg-white/40 backdrop-blur-md p-5 sm:p-6 md:p-8 rounded-2xl rounded-tl-none border border-vintage-gold/20 shadow-lg hover:bg-white/80 transition duration-300">
                        <div class="flex flex-col sm:flex-row sm:items-baseline sm:justify-between mb-2 md:mb-3">
                            <h3 class="text-2xl sm:text-3xl md:text-4xl font-serif text-vintage-text font-medium mb-1 sm:mb-0">11:35 <span class="text-base md:text-xl">A.M.</span></h3>
                            <h4 class="text-2xl sm:text-3xl font-script text-vintage-gold">Opening of Bar</h4>
                        </div>
                        <p class="text-sm md:text-base text-gray-600 tracking-wide font-light leading-relaxed">Let the toasts begin! Grab your favorite drink, raise a glass, and let's celebrate the newlyweds in style.</p>
                    </div>
                </div>

                <div class="mb-10 md:mb-14 relative pl-6 sm:pl-10 md:pl-16 timeline-item opacity-0 transform translate-y-12">
                    <div class="absolute -left-[10px] md:-left-[11px] top-4 md:top-5 w-4 h-4 md:w-5 md:h-5 rounded-full bg-vintage-bg border-[3px] md:border-[4px] border-vintage-gold z-10 shadow-sm"></div>
                    <div class="bg-white/60 md:bg-white/40 backdrop-blur-md p-5 sm:p-6 md:p-8 rounded-2xl rounded-tl-none border border-vintage-gold/20 shadow-lg hover:bg-white/80 transition duration-300">
                        <div class="flex flex-col sm:flex-row sm:items-baseline sm:justify-between mb-2 md:mb-3">
                            <h3 class="text-2xl sm:text-3xl md:text-4xl font-serif text-vintage-text font-medium mb-1 sm:mb-0">12:30 <span class="text-base md:text-xl">P.M.</span></h3>
                            <h4 class="text-2xl sm:text-3xl font-script text-vintage-gold">Wedding Lunch</h4>
                        </div>
                        <p class="text-sm md:text-base text-gray-600 tracking-wide font-light leading-relaxed">A feast of love. Please join us for a delightful lunch filled with amazing flavors, laughter, and great company.</p>
                    </div>
                </div>

                <div class="relative pl-6 sm:pl-10 md:pl-16 timeline-item opacity-0 transform translate-y-12">
                    <div class="absolute -left-[10px] md:-left-[11px] top-4 md:top-5 w-4 h-4 md:w-5 md:h-5 rounded-full bg-vintage-bg border-[3px] md:border-[4px] border-vintage-gold z-10 shadow-sm"></div>
                    <div class="bg-white/60 md:bg-white/40 backdrop-blur-md p-5 sm:p-6 md:p-8 rounded-2xl rounded-tl-none border border-vintage-gold/20 shadow-lg hover:bg-white/80 transition duration-300">
                        <div class="flex flex-col sm:flex-row sm:items-baseline sm:justify-between mb-2 md:mb-3">
                            <h3 class="text-2xl sm:text-3xl md:text-4xl font-serif text-vintage-text font-medium mb-1 sm:mb-0">03:35 <span class="text-base md:text-xl">P.M.</span></h3>
                            <h4 class="text-2xl sm:text-3xl font-script text-vintage-gold">Leaving</h4>
                        </div>
                        <p class="text-sm md:text-base text-gray-600 tracking-wide font-light leading-relaxed">And so the adventure begins... We bid a fond farewell to the happy couple as they embark on their new journey together.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="py-16 md:py-24 relative z-30 flex flex-col justify-center bg-transparent w-full">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 w-full">

            <div class="text-center mb-12 md:mb-16 gallery-title opacity-0 transform translate-y-8">
                <p class="text-xs md:text-sm tracking-[0.3em] uppercase mb-2 md:mb-3 text-vintage-gold font-semibold">Our Memories</p>
                <h2 class="text-5xl sm:text-6xl md:text-8xl font-script text-vintage-text drop-shadow-sm">Captured Moments</h2>
                <div class="w-16 md:w-24 h-[1px] bg-vintage-gold mx-auto mt-4 md:mt-6"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-6 md:gap-8">

                <div class="gallery-item opacity-0 transform translate-y-12 overflow-hidden rounded-2xl shadow-xl border-[3px] md:border-[4px] border-white/80 relative group aspect-[4/5] will-change-transform">
                    <img src="assets/capture_1.jpg" alt="Pre-shoot 1" class="w-full h-full object-cover transform-gpu transition-transform duration-700 group-hover:scale-110 will-change-transform" loading="lazy">
                    <div class="absolute inset-0 bg-vintage-text/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                </div>

                <div class="gallery-item opacity-0 transform translate-y-12 overflow-hidden rounded-2xl shadow-xl border-[3px] md:border-[4px] border-white/80 relative group aspect-[4/5] lg:mt-12 will-change-transform">
                    <img src="assets/capture_2.jpg" alt="Pre-shoot 2" class="w-full h-full object-cover object-top transform-gpu transition-transform duration-700 group-hover:scale-110 will-change-transform" loading="lazy">
                    <div class="absolute inset-0 bg-vintage-text/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                </div>

                <div class="gallery-item opacity-0 transform translate-y-12 overflow-hidden rounded-2xl shadow-xl border-[3px] md:border-[4px] border-white/80 relative group aspect-[4/5] sm:col-span-2 lg:col-span-1 sm:w-1/2 sm:mx-auto lg:w-full will-change-transform">
                    <img src="assets/capture_3.jpg" alt="Pre-shoot 3" class="w-full h-full object-cover transform-gpu transition-transform duration-700 group-hover:scale-110 will-change-transform" loading="lazy">
                    <div class="absolute inset-0 bg-vintage-text/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                </div>

            </div>

        </div>
    </section>

    <section class="py-16 md:py-24 relative z-30 flex flex-col justify-center bg-transparent min-h-[80svh] w-full">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 w-full text-center">

            <div class="mb-10 md:mb-12 rsvp-title opacity-0 transform translate-y-8">
                <p class="text-xs md:text-sm tracking-[0.3em] uppercase mb-2 md:mb-3 text-vintage-gold font-semibold">Join The Celebration</p>
                <h2 class="text-5xl sm:text-6xl md:text-8xl font-script text-vintage-text drop-shadow-sm">RSVP</h2>
                <div class="w-16 md:w-24 h-[1px] bg-vintage-gold mx-auto mt-4 md:mt-6"></div>
            </div>

            <div class="bg-white/60 md:bg-white/50 backdrop-blur-md p-6 sm:p-8 md:p-12 rounded-3xl border border-vintage-gold/30 shadow-2xl rsvp-card opacity-0 transform scale-[0.98] md:scale-95 relative overflow-hidden min-h-[300px] flex items-center justify-center">

                <div id="rsvp-step-1" class="transition-all duration-500 w-full absolute p-6 md:p-12">
                    <h3 class="text-xl sm:text-2xl font-serif text-vintage-text mb-6">Enter Your Whatsapp Number</h3>
                    <input type="tel" id="mobile-number" oninput="clearError()" placeholder="07X XXX XXXX" class="w-full sm:w-4/5 md:w-2/3 px-4 md:px-6 py-3 md:py-4 rounded-full bg-white/90 border border-vintage-gold/50 focus:outline-none focus:ring-2 focus:ring-vintage-gold text-center text-lg md:text-xl tracking-widest font-serif transition-colors duration-300">
                    <p id="phone-error" class="text-red-500 text-xs md:text-sm tracking-wide mt-2 mb-4 h-5 opacity-0 transition-opacity duration-300"></p>
                    <button onclick="checkInvitation()" class="w-full sm:w-auto bg-vintage-gold text-white px-8 md:px-10 py-3 rounded-full hover:bg-[#a6885b] transition duration-300 font-semibold tracking-wider uppercase text-xs md:text-sm shadow-lg">Find My Invitation</button>
                </div>

                <div id="rsvp-step-status" class="hidden absolute top-0 left-0 w-full h-full flex flex-col justify-center items-center p-6 sm:p-8 bg-white/80 backdrop-blur-md transition-all duration-500 opacity-0 transform translate-y-8">
                    <h3 class="text-2xl sm:text-3xl font-serif text-vintage-text mb-3">Hello, <br class="sm:hidden"><span id="guest-name-status" class="font-script text-3xl sm:text-4xl text-vintage-gold"></span></h3>
                    <p class="text-sm md:text-base text-gray-700 mb-6">Your current RSVP status is: <br>
                        <strong id="current-status-text" class="text-lg md:text-xl uppercase tracking-widest mt-1 block"></strong>
                    </p>
                    <p class="text-xs md:text-sm text-gray-500 mb-6">Would you like to change your response?</p>
                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 w-full sm:w-auto">
                        <button onclick="goToChangeRsvp()" class="w-full sm:w-auto bg-vintage-gold text-white px-6 md:px-8 py-3 rounded-full hover:bg-[#a6885b] transition duration-300 font-semibold tracking-wider uppercase text-xs md:text-sm shadow-lg">Change RSVP</button>
                        <button onclick="resetRSVP()" class="w-full sm:w-auto bg-white border-2 border-gray-300 text-gray-600 px-6 md:px-8 py-3 rounded-full hover:bg-gray-50 transition duration-300 font-semibold tracking-wider uppercase text-xs md:text-sm shadow-sm">Keep As Is</button>
                    </div>
                </div>

                <div id="rsvp-step-2" class="hidden absolute top-0 left-0 w-full h-full flex flex-col justify-center items-center p-6 sm:p-8 bg-white/80 backdrop-blur-md transition-all duration-500 opacity-0 transform translate-y-8">
                    <h3 class="text-2xl sm:text-3xl font-serif text-vintage-text mb-2">Hello, <br class="sm:hidden"><span id="guest-name" class="font-script text-3xl sm:text-4xl text-vintage-gold">Dear Guest</span></h3>
                    <p class="text-sm md:text-base text-gray-700 mb-6 md:mb-8">Will you be attending the wedding?</p>
                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 w-full sm:w-auto">
                        <button onclick="updateStatus('accepted')" class="w-full sm:w-auto bg-green-700 text-white px-6 md:px-8 py-3 rounded-full hover:bg-green-800 transition duration-300 font-semibold tracking-wider uppercase text-xs md:text-sm shadow-lg">Joyfully Accept</button>
                        <button onclick="updateStatus('declined')" class="w-full sm:w-auto bg-gray-500 text-white px-6 md:px-8 py-3 rounded-full hover:bg-gray-600 transition duration-300 font-semibold tracking-wider uppercase text-xs md:text-sm shadow-lg">Regretfully Decline</button>
                    </div>
                </div>

                <div id="rsvp-step-3" class="hidden absolute top-0 left-0 w-full h-full flex flex-col justify-center items-center p-8 bg-[#fdfbf7]/90 backdrop-blur-md transition-all duration-500 opacity-0 transform translate-y-8">
                    <h3 class="text-4xl font-script text-vintage-gold mb-4">We can't wait to see you!</h3>
                    <p class="text-xl font-serif text-vintage-text mb-6">Your response has been saved.</p>
                    <p class="text-gray-500 text-sm italic">Please save the date: May 28, 2026</p>
                </div>

                <div id="rsvp-step-4" class="hidden absolute top-0 left-0 w-full h-full flex flex-col justify-center items-center p-6 sm:p-8 bg-[#fdfbf7]/95 backdrop-blur-md transition-all duration-500 opacity-0 transform translate-y-8">
                    <h3 class="text-3xl sm:text-4xl font-script text-vintage-text mb-3 md:mb-4">You will be missed!</h3>
                    <p class="text-sm md:text-base text-gray-600 px-4">Thank you for letting us know. We will celebrate with you in spirit.</p>
                </div>

                <button onclick="resetRSVP()" class="absolute top-4 right-4 md:top-6 md:right-6 p-2 text-vintage-gold/60 hover:text-vintage-gold hover:bg-vintage-gold/10 rounded-full transition duration-300 z-50" title="Reset Form">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                </button>

            </div>
        </div>
    </section>

    <section class="py-16 md:py-20 relative z-30 bg-white/40 border-t border-vintage-gold/20 w-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 w-full">
            <div class="text-center mb-10 md:mb-16 map-title opacity-0 transform translate-y-8">
                <h2 class="text-5xl sm:text-6xl md:text-7xl font-script text-vintage-text drop-shadow-sm">The Venue</h2>
                <p class="text-sm sm:text-base md:text-lg mt-3 md:mt-4 text-gray-600 font-serif px-4">Riverbank Chateau, Vinrich Lake Resort,<br class="sm:hidden"> Madapatha, Piliyandala</p>
            </div>
            <div class="flex flex-col lg:flex-row gap-6 md:gap-8 items-stretch lg:h-[500px]">
                <div class="w-full lg:w-1/2 h-[350px] lg:h-auto rounded-2xl overflow-hidden shadow-xl border-[3px] md:border-4 border-white opacity-0 transform lg:-translate-x-12 map-item">
                    <iframe src="https://maps.google.com/maps?q=Vinrich%20Lake%20Resort,%20Madapatha,%20Piliyandala&t=&z=15&ie=UTF8&iwloc=&output=embed" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="w-full lg:w-1/2 h-[400px] lg:h-auto grid grid-cols-2 gap-3 md:gap-4 map-item opacity-0 transform lg:translate-x-12">
                    <div class="rounded-2xl overflow-hidden shadow-md border-[2px] md:border-[3px] border-white">
                        <img src="{{ asset('assets/vinrich-lake-resort_1.jpeg') }}" onerror="this.src='https://images.unsplash.com/photo-1519167758481-83f550bb49b3?q=80&w=400&auto=format&fit=crop'" loading="lazy" class="w-full h-full object-cover hover:scale-110 transition duration-500">
                    </div>
                    <div class="rounded-2xl overflow-hidden shadow-md border-[2px] md:border-[3px] border-white row-span-2">
                        <img src="{{ asset('assets/vinrich-lake-resort_2.jpeg') }}" onerror="this.src='https://images.unsplash.com/photo-1522798514-97ceb8c4f1c8?q=80&w=400&auto=format&fit=crop'" loading="lazy" class="w-full h-full object-cover hover:scale-110 transition duration-500">
                    </div>
                    <div class="rounded-2xl overflow-hidden shadow-md border-[2px] md:border-[3px] border-white">
                        <img src="{{ asset('assets/vinrich-lake-resort_3.jpeg') }}" onerror="this.src='https://images.unsplash.com/photo-1469334031218-e382a71b716b?q=80&w=400&auto=format&fit=crop'" loading="lazy" class="w-full h-full object-cover hover:scale-110 transition duration-500">
                    </div>
                </div>
            </div>
            <div class="text-center mt-16 md:mt-20 pb-8 md:pb-10">
                <p class="font-script text-3xl md:text-4xl text-vintage-gold">With Love,</p>
                <p class="font-serif text-base md:text-lg text-vintage-text mt-1 md:mt-2">Dasuni & Shanka</p>
            </div>
        </div>
    </section>

    <footer class="w-full py-8 text-center z-30 relative bg-white/40 border-t border-vintage-gold/20 backdrop-blur-md">
        <p class="text-xs md:text-sm text-gray-500 font-serif mb-3">
            Designed & Developed with <span class="text-vintage-gold">♥</span> by
            <span class="font-bold text-vintage-text tracking-wide drop-shadow-sm">R.T. Thenuwara</span>
        </p>

        <a href="https://wa.me/94712811977" target="_blank" class="inline-flex items-center gap-2 px-5 py-2 md:py-2.5 rounded-full bg-[#25D366]/10 border border-[#25D366]/30 text-[#25D366] hover:bg-[#25D366] hover:text-white transition-all duration-300 text-[10px] md:text-xs font-semibold tracking-widest uppercase shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 md:w-5 md:h-5 fill-current" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
            </svg>
            Contact Developer
        </a>
    </footer>

    <audio id="weddingAudio" loop>
        <source src="{{ asset('assets/wedding-song.mp3') }}" type="audio/mpeg">
    </audio>

    <button id="musicToggle" class="fixed bottom-4 left-4 sm:bottom-6 sm:left-6 md:bottom-8 md:left-8 z-50 bg-white/70 backdrop-blur-md border border-vintage-gold/40 p-3 md:p-4 rounded-full shadow-[0_4px_15px_rgba(0,0,0,0.1)] hover:scale-110 hover:bg-white transition-all duration-500 group focus:outline-none">
        <div id="musicIcon" class="text-vintage-gold animate-spin-slow" style="animation-play-state: paused;">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
            </svg>
        </div>
    </button>

    <style>
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
    </style>

    <script>
        const audio = document.getElementById('weddingAudio');
        const musicIcon = document.getElementById('musicIcon');
        let isPlaying = false;

        function toggleMusic(forcePlay = false) {
            if (isPlaying && !forcePlay) {
                audio.pause();
                musicIcon.style.animationPlayState = 'paused';
                isPlaying = false;
            } else {
                audio.play().then(() => {
                    musicIcon.style.animationPlayState = 'running';
                    isPlaying = true;
                }).catch(err => console.log("Audio block"));
            }
        }

        document.getElementById('musicToggle').addEventListener('click', (e) => {
            e.stopPropagation();
            toggleMusic();
        });

        // --- Tap to Open Logic ---
        const tapScreen = document.getElementById("tapToOpenScreen");
        const tapBtnText = document.getElementById("tap-btn-text");

        // Browser එක Load උනාම
        window.addEventListener("load", () => {
            tapBtnText.innerText = "Tap to Open";
            tapBtnText.classList.remove('bg-vintage-gold/5', 'border-vintage-gold/40', 'text-vintage-gold/60');
            tapBtnText.classList.add('bg-vintage-gold/10', 'border-vintage-gold', 'text-vintage-gold', 'animate-pulse', 'hover:bg-vintage-gold', 'hover:text-white');
            document.body.style.overflow = 'hidden';

            // Splash Screen එකට ආපු ගමන් මල් දෙක ලස්සනට මතු වෙනවා
            gsap.from(".floral-tl", {
                opacity: 0,
                x: -50,
                y: -50,
                duration: 1.5,
                ease: "power3.out"
            });
            gsap.from(".floral-br", {
                opacity: 0,
                x: 50,
                y: 50,
                duration: 1.5,
                ease: "power3.out"
            });

            // Tap කරාම වෙන දේ (Curtain Animation)
            tapScreen.addEventListener('click', () => {
                toggleMusic(true);

                const tl = gsap.timeline();

                // 1. Center Content එක මුලින්ම බොඳ වෙලා යනවා
                tl.to(tapScreen.querySelector('.z-30'), {
                        opacity: 0,
                        y: -20,
                        duration: 0.4
                    })

                    // 2. මුළු තිරයම තිරයක් (Curtain) අරිනවා වගේ උඩට යනවා
                    .to(tapScreen, {
                        y: "-100%", // උඩට යන විධානය
                        duration: 1.2,
                        ease: "power4.inOut",
                        onComplete: () => {
                            tapScreen.style.display = "none";
                            document.body.style.overflow = 'auto';
                            document.body.style.overflowX = 'hidden';
                        }
                    }, "-=0.1")

                    // 3. යට තියෙන Hero Section එකේ දේවල් මතු වෙනවා
                    .to(".hero-content", {
                        y: 0,
                        opacity: 1,
                        duration: 1.2,
                        ease: "power4.out"
                    }, "-=0.6")
                    .to("#countdown-container", {
                        y: 0,
                        opacity: 1,
                        duration: 1,
                        ease: "power3.out"
                    }, "-=0.8")
                    .to(".scroll-indicator", {
                        opacity: 1,
                        duration: 1,
                        ease: "power2.inOut"
                    }, "-=0.5");
            });
        });

        // --- GSAP Scroll Animations ---
        gsap.registerPlugin(ScrollTrigger);
        gsap.to(".agenda-title", {
            scrollTrigger: {
                trigger: ".agenda-title",
                start: "top 85%"
            },
            y: 0,
            opacity: 1,
            duration: 1.2,
            ease: "power3.out"
        });
        gsap.utils.toArray('.timeline-item').forEach((item, i) => {
            gsap.to(item, {
                scrollTrigger: {
                    trigger: item,
                    start: "top 90%"
                },
                y: 0,
                opacity: 1,
                duration: 1,
                delay: i * 0.15,
                ease: "back.out(1.2)"
            });
        });
        gsap.to(".gallery-title", {
            scrollTrigger: {
                trigger: ".gallery-title",
                start: "top 85%"
            },
            y: 0,
            opacity: 1,
            duration: 1.2,
            ease: "power3.out"
        });
        gsap.to(".gallery-item", {
            scrollTrigger: {
                trigger: ".gallery-title",
                start: "top 75%"
            },
            y: 0,
            opacity: 1,
            duration: 1,
            stagger: 0.2,
            ease: "power3.out"
        });
        gsap.to(".rsvp-title", {
            scrollTrigger: {
                trigger: ".rsvp-title",
                start: "top 85%"
            },
            y: 0,
            opacity: 1,
            duration: 1.2,
            ease: "power3.out"
        });
        gsap.to(".rsvp-card", {
            scrollTrigger: {
                trigger: ".rsvp-card",
                start: "top 80%"
            },
            scale: 1,
            opacity: 1,
            duration: 1.2,
            ease: "elastic.out(1, 0.8)"
        });
        gsap.to(".map-title", {
            scrollTrigger: {
                trigger: ".map-title",
                start: "top 85%"
            },
            y: 0,
            opacity: 1,
            duration: 1
        });
        gsap.to(".map-item", {
            scrollTrigger: {
                trigger: ".map-title",
                start: "top 75%"
            },
            x: 0,
            y: 0,
            opacity: 1,
            duration: 1,
            stagger: 0.2,
            ease: "power3.out"
        });

        // --- RSVP LOGIC ---
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let currentGuestPhone = '';

        function showError(msg) {
            const errorEl = document.getElementById('phone-error');
            const inputEl = document.getElementById('mobile-number');
            errorEl.innerText = msg;
            errorEl.style.opacity = 1;
            inputEl.classList.remove('border-vintage-gold/50', 'focus:ring-vintage-gold');
            inputEl.classList.add('border-red-400', 'focus:ring-red-400');
        }

        function clearError() {
            const errorEl = document.getElementById('phone-error');
            const inputEl = document.getElementById('mobile-number');
            errorEl.style.opacity = 0;
            inputEl.classList.remove('border-red-400', 'focus:ring-red-400');
            inputEl.classList.add('border-vintage-gold/50', 'focus:ring-vintage-gold');
        }

        // Steps අතර මාරු කරන පොදු Function එක
        function transitionStep(hideId, showId) {
            const hideEl = document.getElementById(hideId);
            const showEl = document.getElementById(showId);

            if (hideEl && !hideEl.classList.contains('hidden')) {
                hideEl.style.opacity = 0;
                hideEl.style.transform = 'translateY(8px)';
                setTimeout(() => {
                    hideEl.classList.add('hidden');
                    showEl.classList.remove('hidden');
                    setTimeout(() => {
                        showEl.style.opacity = 1;
                        showEl.style.transform = 'translateY(0)';
                    }, 50);
                }, 400);
            } else {
                showEl.classList.remove('hidden');
                setTimeout(() => {
                    showEl.style.opacity = 1;
                    showEl.style.transform = 'translateY(0)';
                }, 50);
            }
        }

        // 1. Invitation එක හොයන Function එක
        function checkInvitation() {
            clearError();

            let number = document.getElementById('mobile-number').value;

            if (number.length > 5) {
                const btn = document.querySelector('button[onclick="checkInvitation()"]');
                const originalText = btn.innerText;
                btn.innerText = "Searching...";
                btn.disabled = true;

                fetch('/rsvp/check', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            phone: number
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        btn.innerText = originalText;
                        btn.disabled = false;

                        if (data.success) {
                            currentGuestPhone = number;
                            const status = data.guest.status || 'pending';

                            if (status === 'pending') {
                                // තාම මුකුත් කරලා නැත්නම් කෙලින්ම Accept/Reject එකට යනවා
                                document.getElementById('guest-name').innerText = data.guest.name;
                                transitionStep('rsvp-step-1', 'rsvp-step-2');
                            } else {
                                // දැනටමත් Accept/Reject කරලා නම් Status එක පෙන්වනවා
                                document.getElementById('guest-name-status').innerText = data.guest.name;
                                const statusTextEl = document.getElementById('current-status-text');
                                statusTextEl.innerText = status;

                                // Status එකට අනුව පාට වෙනස් කරනවා
                                if (status === 'accepted') {
                                    statusTextEl.className = "text-lg md:text-xl uppercase tracking-widest mt-1 block text-green-600";
                                } else {
                                    statusTextEl.className = "text-lg md:text-xl uppercase tracking-widest mt-1 block text-red-500";
                                }

                                transitionStep('rsvp-step-1', 'rsvp-step-status');
                            }
                        } else {
                            showError(data.message || "Invitation not found. Please check your number.");
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        btn.innerText = originalText;
                        btn.disabled = false;
                        showError("An error occurred. Please try again later.");
                    });
            } else {
                showError("Please enter a valid mobile number.");
            }
        }

        // Change RSVP ඔබපුවාම Accept/Reject අහන තැනට යනවා
        function goToChangeRsvp() {
            document.getElementById('guest-name').innerText = document.getElementById('guest-name-status').innerText;
            transitionStep('rsvp-step-status', 'rsvp-step-2');
        }

        function updateStatus(statusType) {
            fetch('/rsvp/update', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        phone: currentGuestPhone,
                        status: statusType
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        if (statusType === 'accepted') {
                            transitionStep('rsvp-step-2', 'rsvp-step-3');
                        } else {
                            transitionStep('rsvp-step-2', 'rsvp-step-4');
                        }
                    } else {
                        alert("Could not update status. Please try again.");
                    }
                });
        }

        // --- Countdown Timer ---
        const weddingDate = new Date("May 28, 2026 09:45:00").getTime();
        setInterval(() => {
            const now = new Date().getTime();
            const distance = weddingDate - now;
            if (distance < 0) return;
            document.getElementById("days").innerText = Math.floor(distance / (1000 * 60 * 60 * 24)).toString().padStart(2, '0');
            document.getElementById("hours").innerText = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)).toString().padStart(2, '0');
            document.getElementById("minutes").innerText = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)).toString().padStart(2, '0');
            const secElement = document.getElementById("seconds");
            if (secElement) secElement.innerText = Math.floor((distance % (1000 * 60)) / 1000).toString().padStart(2, '0');
        }, 1000);

        // --- Reset RSVP ---
        function resetRSVP() {
            document.getElementById('mobile-number').value = '';
            clearError();

            ['rsvp-step-2', 'rsvp-step-3', 'rsvp-step-4', 'rsvp-step-status'].forEach(id => {
                let step = document.getElementById(id);
                if (!step.classList.contains('hidden')) {
                    step.style.opacity = 0;
                    step.style.transform = 'translateY(8px)';
                    setTimeout(() => step.classList.add('hidden'), 400);
                }
            });

            setTimeout(() => {
                let step1 = document.getElementById('rsvp-step-1');
                step1.classList.remove('hidden');
                setTimeout(() => {
                    step1.style.opacity = 1;
                    step1.style.transform = 'translateY(0)';
                }, 50);
            }, 400);
        }
    </script>
</body>

</html>