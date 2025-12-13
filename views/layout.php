<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio | Creative Developer</title>
    <!-- Google Fonts: Outfit (Display) + Inter (Body) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Outfit:wght@400;500;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#6366f1', // Indigo 500
                        secondary: '#ec4899', // Pink 500
                        accent: '#06b6d4', // Cyan 500
                        dark: '#0f172a', // Slate 900
                        surface: '#1e293b', // Slate 800
                        'surface-light': '#334155', // Slate 700
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Outfit', 'sans-serif'],
                    },
                    backgroundImage: {
                        'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background-color: #0f172a;
            color: #f8fafc;
        }
        
        /* Modern Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #0f172a;
        }
        ::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #475569;
        }

        /* Glassmorphism Utilities */
        .glass {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .glass-hover:hover {
            background: rgba(30, 41, 59, 0.9);
            border-color: rgba(99, 102, 241, 0.3);
        }

        /* Gradient Text */
        .text-gradient {
            background: linear-gradient(to right, #6366f1, #ec4899);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body class="font-sans antialiased selection:bg-primary selection:text-black overflow-x-hidden">
    
    <!-- Background Gradients -->
    <div class="fixed inset-0 z-[-1] pointer-events-none">
        <div class="absolute top-[-10%] right-[-5%] w-[500px] h-[500px] bg-primary/20 rounded-full blur-[120px] mix-blend-screen opacity-30 animate-pulse"></div>
        <div class="absolute bottom-[-10%] left-[-5%] w-[500px] h-[500px] bg-secondary/20 rounded-full blur-[120px] mix-blend-screen opacity-30"></div>
    </div>
    
    <!-- Navbar -->
    <nav class="fixed w-full z-50 top-0 transition-all duration-300 glass border-b border-surface-light/30">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="<?php echo BASE_URL; ?>" class="flex items-center group gap-2">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-primary to-secondary flex items-center justify-center text-white font-bold font-display text-xl shadow-lg shadow-primary/20">
                    J
                </div>
                <span class="self-center text-xl font-bold whitespace-nowrap font-display text-white tracking-tight group-hover:text-primary transition-colors">
                    Joy.dev
                </span>
            </a>
            <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-400 rounded-lg md:hidden hover:bg-white/5 focus:outline-none focus:ring-2 focus:ring-gray-700">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
            </button>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-800 rounded-lg bg-surface/50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-transparent">
                    <li>
                        <a href="<?php echo BASE_URL; ?>/#home" class="block py-2 pl-3 pr-4 text-white hover:text-primary md:p-0 transition-colors text-sm">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo BASE_URL; ?>/#about" class="block py-2 pl-3 pr-4 text-gray-400 hover:text-primary md:p-0 transition-colors text-sm">About</a>
                    </li>
                    <li>
                        <a href="<?php echo BASE_URL; ?>/?page=projects" class="block py-2 pl-3 pr-4 text-gray-400 hover:text-primary md:p-0 transition-colors text-sm">Projects</a>
                    </li>
                    <!-- Auth Links -->
                <?php if (isLoggedIn()): ?>
                    <li class="md:ml-4">
                        <a href="<?php echo BASE_URL; ?>/?page=admin" class="text-secondary hover:text-white transition-colors text-sm">Admin</a>
                    </li>
                    <li>
                        <a href="<?php echo BASE_URL; ?>/?page=logout" class="text-red-500 hover:text-red-400 transition-colors text-sm">Logout</a>
                    </li>
                <?php else: ?>
                    <?php $settings = getSettings(); ?>
                    <li class="md:ml-8">
                        <a href="https://wa.me/<?php echo htmlspecialchars($settings['contact_whatsapp'] ?? ''); ?>" target="_blank" class="px-6 py-2 text-sm font-medium text-white bg-primary hover:bg-indigo-600 rounded-full transition-all shadow-lg shadow-indigo-500/30">
                            Hire Me
                        </a>
                    </li>
                <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <main class="min-h-screen pt-20">
        <?php include $content; ?>
    </main>

    <footer class="bg-darker border-t border-surface-light/30 py-12 relative overflow-hidden">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-[1px] bg-gradient-to-r from-transparent via-primary/50 to-transparent"></div>
        <div class="max-w-screen-xl mx-auto px-4 text-center">
            <h2 class="text-2xl font-display font-bold text-white mb-2">Let's build something amazing</h2>
            <p class="text-gray-500 text-sm mb-8">Crafting digital experiences with passion and precision.</p>
            
            <div class="flex justify-center gap-6 mb-8">
                <a href="#" class="w-10 h-10 rounded-full bg-surface border border-surface-light flex items-center justify-center text-gray-400 hover:text-white hover:border-primary hover:bg-primary/10 transition-all duration-300">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                </a>
            </div>
            <p class="text-gray-600 text-xs text-center">&copy; <?php echo date('Y'); ?> Joy.dev. All rights reserved.</p>
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
    <!-- Back to Top Button -->
    <button id="backToTop" class="fixed bottom-8 right-8 z-50 bg-primary/90 hover:bg-primary text-white p-3 rounded-full shadow-lg shadow-primary/30 opacity-0 translate-y-10 transition-all duration-300 pointer-events-none backdrop-blur-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
    </button>

    <script>
        // Back to Top Logic
        const backToTopBtn = document.getElementById('backToTop');
        
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                backToTopBtn.classList.remove('opacity-0', 'translate-y-10', 'pointer-events-none');
            } else {
                backToTopBtn.classList.add('opacity-0', 'translate-y-10', 'pointer-events-none');
            }
        });

        backToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 100,
            easing: 'ease-out-cubic'
        });
    </script>
</body>
</html>
