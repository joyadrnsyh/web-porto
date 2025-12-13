<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio | Creative Developer</title>
    <!-- Google Fonts: Space Grotesk (Display) + Inter (Body) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        background: '#09090b', // Zinc 950
                        surface: '#18181b', // Zinc 900
                        'surface-light': '#27272a', // Zinc 800
                        primary: '#10b981', // Emerald 500
                        'primary-dark': '#059669', // Emerald 600
                        secondary: '#8b5cf6', // Violet 500
                        accent: '#06b6d4', // Cyan 500
                        text: '#f4f4f5', // Zinc 100
                        'text-muted': '#a1a1aa', // Zinc 400
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Space Grotesk', 'sans-serif'],
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background-color: #09090b;
            color: #f4f4f5;
        }
        
        /* Modern Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #27272a;
            border-radius: 20px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #3f3f46;
        }

        /* Glassmorphism Utilities */
        .glass {
            background: rgba(24, 24, 27, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .glass-panel {
            background: rgba(24, 24, 27, 0.4);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        /* Subtle Gradient Text */
        .text-gradient {
            background: linear-gradient(135deg, #10b981, #3b82f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Clean Focus */
        *:focus-visible {
            outline: 2px solid #10b981;
            outline-offset: 2px;
        }
    </style>
</head>
<body class="font-sans antialiased selection:bg-primary/30 selection:text-white overflow-x-hidden relative">
    
    <!-- Ambient Background -->
    <div class="fixed inset-0 z-[-1] overflow-hidden pointer-events-none">
        <div class="absolute top-0 left-1/4 w-[300px] md:w-[600px] h-[300px] md:h-[600px] bg-primary/10 rounded-full blur-[80px] md:blur-[120px] mix-blend-screen opacity-20 animate-pulse"></div>
        <div class="absolute bottom-0 right-1/4 w-[300px] md:w-[500px] h-[300px] md:h-[500px] bg-secondary/10 rounded-full blur-[80px] md:blur-[100px] mix-blend-screen opacity-20"></div>
    </div>
    
    <!-- Navbar -->
    <div class="fixed top-4 w-full z-50 flex justify-center px-4">
        <nav id="main-nav" class="w-full max-w-5xl glass rounded-2xl md:rounded-full px-4 md:px-6 py-3 shadow-2xl shadow-black/20 transition-all duration-300">
            <div class="flex items-center justify-between">
                <a href="<?php echo BASE_URL; ?>" class="flex items-center gap-2 group shrink-0">
                    <div class="w-8 h-8 rounded-full bg-surface-light flex items-center justify-center border border-white/5 group-hover:border-primary/50 transition-colors">
                        <span class="font-display font-bold text-primary">J</span>
                    </div>
                    <span class="font-display font-semibold text-lg tracking-tight group-hover:text-white transition-colors">
                        Joy<span class="text-gray-500">.dev</span>
                    </span>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <ul class="flex space-x-6 text-sm font-medium text-gray-400">
                        <li><a href="<?php echo BASE_URL; ?>/#home" class="hover:text-white transition-colors">Home</a></li>
                        <li><a href="<?php echo BASE_URL; ?>/#about" class="hover:text-white transition-colors">About</a></li>
                        <li><a href="<?php echo BASE_URL; ?>/?page=projects" class="hover:text-white transition-colors">Projects</a></li>
                    </ul>
                    
                    <div class="pl-6 border-l border-white/10 flex items-center gap-4">
                        <?php if (isLoggedIn()): ?>
                            <a href="<?php echo BASE_URL; ?>/?page=admin" class="text-sm font-medium text-gray-300 hover:text-white transition-colors">Dashboard</a>
                            <a href="<?php echo BASE_URL; ?>/?page=logout" class="text-sm font-medium text-red-400 hover:text-red-300 transition-colors">Logout</a>
                        <?php else: ?>
                            <?php $settings = getSettings(); ?>
                            <a href="https://wa.me/<?php echo htmlspecialchars($settings['contact_whatsapp'] ?? ''); ?>" target="_blank" class="px-5 py-2 text-xs font-bold uppercase tracking-wider text-black bg-white hover:bg-gray-200 rounded-full transition-all">
                                Let's Talk
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-9 h-9 justify-center text-sm text-gray-400 rounded-full md:hidden hover:bg-white/5 focus:outline-none bg-surface-light/30 border border-white/5">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                    </svg>
                </button>
            </div>
            
            <!-- Mobile Menu -->
            <div class="hidden w-full md:hidden mt-4 pt-4 border-t border-white/5" id="navbar-sticky">
                <ul class="flex flex-col space-y-2 font-medium text-center pb-2">
                    <li><a href="<?php echo BASE_URL; ?>/#home" class="block py-3 px-4 rounded-xl hover:bg-white/5 text-gray-400 hover:text-white transition-all">Home</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/#about" class="block py-3 px-4 rounded-xl hover:bg-white/5 text-gray-400 hover:text-white transition-all">About</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/?page=projects" class="block py-3 px-4 rounded-xl hover:bg-white/5 text-gray-400 hover:text-white transition-all">Projects</a></li>
                    <li class="h-px bg-white/5 my-2 w-full"></li>
                    <?php if (isLoggedIn()): ?>
                        <li><a href="<?php echo BASE_URL; ?>/?page=admin" class="block py-3 px-4 text-primary">Dashboard</a></li>
                        <li><a href="<?php echo BASE_URL; ?>/?page=logout" class="block py-3 px-4 text-red-400">Logout</a></li>
                    <?php else: ?>
                        <li><a href="https://wa.me/<?php echo htmlspecialchars($settings['contact_whatsapp'] ?? ''); ?>" class="block py-3 px-4 bg-white text-black rounded-xl font-bold uppercase tracking-wider text-xs mx-4">Let's Talk</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <main class="min-h-screen pt-28 md:pt-32 pb-20 px-4 md:px-6">
        <?php include $content; ?>
    </main>

    <!-- Footer -->
    <footer class="border-t border-white/5 bg-black/20 backdrop-blur-sm py-12">
        <div class="max-w-screen-xl mx-auto px-4 text-center">
            <div class="mb-8">
                <a href="#" class="inline-flex items-center gap-2 mb-4">
                     <div class="w-6 h-6 rounded-full bg-surface-light flex items-center justify-center border border-white/5">
                        <span class="font-display font-bold text-xs text-primary">J</span>
                    </div>
                    <span class="font-display font-medium text-gray-400">Joy.dev</span>
                </a>
                <p class="text-text-muted text-sm max-w-md mx-auto">Building digital products, brands, and experiences with attention to detail.</p>
            </div>
            <p class="text-zinc-600 text-xs">&copy; <?php echo date('Y'); ?> Joy.dev. All rights reserved.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Start Mobile Menu Logic
        const btn = document.querySelector('[data-collapse-toggle]');
        const menu = document.getElementById('navbar-sticky');
        if(btn && menu) {
            btn.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });
        }
    </script>
    
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 50,
            easing: 'ease-out-cubic'
        });
    </script>
</body>
</html>
