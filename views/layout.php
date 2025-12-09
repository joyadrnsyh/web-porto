<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio | Creative Developer</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                    extend: {
                        colors: {
                            primary: '#00ff41', // Hacker Green
                            secondary: '#7000df',
                            dark: '#050505',
                            darker: '#0a0a0a',
                            surface: '#111111',
                        },
                        fontFamily: {
                            sans: ['Inter', 'sans-serif'],
                        },
                        mono: ['JetBrains Mono', 'monospace'],
                    },
                    backgroundImage: {
                        'grid-pattern': "linear-gradient(to right, #1f2937 1px, transparent 1px), linear-gradient(to bottom, #1f2937 1px, transparent 1px)",
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background-color: #050505;
            color: #e5e5e5;
        }
        .bg-grid {
            background-size: 40px 40px;
            mask-image: linear-gradient(to bottom, transparent, 10%, black, 90%, transparent);
            -webkit-mask-image: linear-gradient(to bottom, transparent, 10%, black, 90%, transparent);
        }
        .neon-border {
            box-shadow: 0 0 5px theme('colors.primary'), 0 0 10px theme('colors.primary');
        }
        .glitch-effect:hover {
            animation: glitch 0.3s cubic-bezier(.25, .46, .45, .94) both infinite;
        }
        @keyframes glitch {
            0% { transform: translate(0) }
            20% { transform: translate(-2px, 2px) }
            40% { transform: translate(-2px, -2px) }
            60% { transform: translate(2px, 2px) }
            80% { transform: translate(2px, -2px) }
            100% { transform: translate(0) }
        }
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #000;
        }
        ::-webkit-scrollbar-thumb {
            background: #333;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #00ff41;
        }

        /* Force Override for Buttons */
        .btn-primary-hover {
            background-color: #ffffff !important;
            color: #000000 !important;
            transition: all 0.3s ease;
        }
        .btn-primary-hover:hover {
            background-color: #00ff41 !important;
            color: #000000 !important; 
            box-shadow: none !important;
            transform: translate(2px, 2px);
        }
    </style>
</head>
<body class="font-sans antialiased selection:bg-primary selection:text-black overflow-x-hidden">
    
    <!-- Background Grid -->
    <div class="fixed inset-0 z-[-1] bg-grid-pattern bg-grid opacity-[0.15] pointer-events-none"></div>

    <!-- Navbar -->
    <nav class="fixed w-full z-50 top-0 transition-all duration-300 bg-dark/80 backdrop-blur-md border-b border-gray-800">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="<?php echo BASE_URL; ?>" class="flex items-center group">
                <span class="self-center text-2xl font-bold whitespace-nowrap font-mono text-white group-hover:text-primary transition-colors">
                    &lt;jo/&gt;
                </span>
            </a>
            <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-400 rounded-lg md:hidden hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-700">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
            </button>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul class="flex flex-col p-4 md:p-0 mt-4 font-mono font-medium border border-gray-800 rounded-lg bg-gray-900 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-transparent">
                    <li>
                        <a href="<?php echo BASE_URL; ?>/#home" class="block py-2 pl-3 pr-4 text-white hover:text-primary md:p-0 transition-colors">~/home</a>
                    </li>
                    <li>
                        <a href="<?php echo BASE_URL; ?>/#about" class="block py-2 pl-3 pr-4 text-gray-400 hover:text-primary md:p-0 transition-colors">./about</a>
                    </li>
                    <li>
                        <a href="<?php echo BASE_URL; ?>/?page=projects" class="block py-2 pl-3 pr-4 text-gray-400 hover:text-primary md:p-0 transition-colors">./projects</a>
                    </li>
                    <!-- Auth Links -->
                <?php if (isLoggedIn()): ?>
                    <li class="md:ml-4">
                        <a href="<?php echo BASE_URL; ?>/?page=admin" class="text-secondary hover:text-white transition-colors">Admin_Panel</a>
                    </li>
                    <li>
                        <a href="<?php echo BASE_URL; ?>/?page=logout" class="text-red-500 hover:text-red-400 transition-colors">Logout</a>
                    </li>
                <?php else: ?>
                    <?php $settings = getSettings(); ?>
                    <li class="md:ml-8">
                        <a href="https://wa.me/<?php echo htmlspecialchars($settings['contact_whatsapp'] ?? ''); ?>" target="_blank" class="btn-primary-hover px-5 py-2 text-sm font-bold rounded-none shadow-[4px_4px_0px_rgba(255,255,255,0.2)]">
                            HIRE_ME_NOW()
                        </a>
                    </li>
                <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <main class="min-h-screen pt-16">
        <?php include $content; ?>
    </main>

    <footer class="bg-black border-t border-gray-800 py-12">
        <div class="max-w-screen-xl mx-auto px-4 text-center">
            <h2 class="text-2xl font-mono font-bold text-white mb-2">&lt;/End_Stream&gt;</h2>
            <p class="text-gray-500 font-mono text-sm mb-6">Designed & Built by AI + Human Collaboration.</p>
            <div class="flex justify-center gap-6 mb-8">
                <a href="#" class="text-gray-400 hover:text-primary transition-colors">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                </a>
            </div>
            <p class="text-gray-600 text-xs font-mono">&copy; <?php echo date('Y'); ?> All systems functional.</p>
        </div>
    </footer>

    <!-- Simple Mobile Menu Script -->
    <script>
        const btn = document.querySelector('[data-collapse-toggle]');
        const menu = document.getElementById('navbar-sticky');
        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>
    
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 100,
            easing: 'ease-out-cubic'
        });
    </script>
</body>
</html>
