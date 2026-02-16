<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BNGRC - Gestion des Dons Humanitaires</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/styles.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-slate-50 via-teal-50/30 to-slate-100 min-h-screen">
    <!-- Navigation -->
    <nav class="glass-nav fixed top-0 left-0 right-0 z-50 h-20">
        <div class="max-w-7xl mx-auto px-6 h-full flex items-center justify-between">
            <!-- Logo -->
            <a href="#" class="flex items-center gap-3 group">
                <div class="w-12 h-12 bg-gradient-to-br from-teal-500 to-teal-700 rounded-xl flex items-center justify-center shadow-lg shadow-teal-500/30 group-hover:shadow-teal-500/50 transition-all duration-300">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <div>
                    <span class="text-xl font-bold text-gray-900 tracking-tight">BNGRC</span>
                    <span class="block text-xs text-gray-500 font-medium -mt-0.5">Gestion des Dons</span>
                </div>
            </a>

            <!-- Menu Principal -->
            <div class="hidden md:flex items-center gap-8">
                <a href="#" class="text-sm font-semibold text-teal-700 border-b-2 border-teal-500 pb-1">Accueil</a>
                <a href="#" class="text-sm font-medium text-gray-600 hover:text-teal-700 transition-colors">Villes</a>
                <a href="#" class="text-sm font-medium text-gray-600 hover:text-teal-700 transition-colors">Besoins</a>
                <a href="#" class="text-sm font-medium text-gray-600 hover:text-teal-700 transition-colors">Dons</a>
                <a href="#" class="text-sm font-medium text-gray-600 hover:text-teal-700 transition-colors">Dispatch</a>
                <a href="#" class="text-sm font-medium text-gray-600 hover:text-teal-700 transition-colors">Tableau de bord</a>
            </div>

            <!-- CTA -->
            <div class="flex items-center gap-4">
                <a href="#" class="hidden sm:inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-teal-600 to-teal-700 text-white text-sm font-semibold rounded-xl shadow-lg shadow-teal-500/30 hover:shadow-teal-500/50 hover:-translate-y-0.5 transition-all duration-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Faire un don
                </a>
                <!-- Mobile menu button -->
                <button class="md:hidden p-2 text-gray-600 hover:text-teal-700" id="mobile-menu-btn">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="md:hidden hidden bg-white border-t border-gray-100 py-4 px-6 space-y-3" id="mobile-menu">
            <a href="#" class="block text-sm font-semibold text-teal-700">Accueil</a>
            <a href="#" class="block text-sm font-medium text-gray-600">Villes</a>
            <a href="#" class="block text-sm font-medium text-gray-600">Besoins</a>
            <a href="#" class="block text-sm font-medium text-gray-600">Dons</a>
            <a href="#" class="block text-sm font-medium text-gray-600">Dispatch</a>
            <a href="#" class="block text-sm font-medium text-gray-600">Tableau de bord</a>
            <a href="#" class="inline-flex items-center gap-2 px-5 py-2.5 bg-teal-600 text-white text-sm font-semibold rounded-xl mt-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Faire un don
            </a>
        </div>
    </nav>
