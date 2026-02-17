<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BNGRC - Tableau de Bord</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        ::selection {
            background: #0d9488;
            color: white;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.6);
        }
        .glass-nav {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(16px);
            border-bottom: 1 px solid rgba(255, 255, 255, 0.6);
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .float-animation {
            animation: float 3s ease-in-out infinite;
        }
        @keyframes pulse-ring {
            0% { transform: scale(1); opacity: 1; }
            100% { transform: scale(1.5); opacity: 0; }
        }
        .progress-bar {
            background: linear-gradient(90deg, #14b8a6, #0d9488, #0f766e);
            background-size: 200% 100%;
            animation: shimmer 2s linear infinite;
        }
        @keyframes shimmer {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
        /* Suppression de pulse-scale et .pulse-update */
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 via-teal-50/30 to-slate-100 min-h-screen">
    <!-- Navigation -->
    <nav class="glass-nav fixed top-0 left-0 right-0 z-50 h-16">
        <div class="max-w-7xl mx-auto px-4 h-full flex items-center justify-between">
            <!-- Logo -->
            <a href="<?= Flight::get('flight.base_url') ?>" class="flex items-center gap-3 group">
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
                <a href="<?= Flight::get('flight.base_url') ?>" class="text-sm font-semibold text-teal-700 border-b-2 border-teal-500 pb-1">Tableau de bord</a>
                <a href="<?= Flight::get('flight.base_url') ?>recapitulation" class="text-sm font-medium text-gray-600 hover:text-teal-700 transition-colors">Récapitulation</a>
                <a href="<?= Flight::get('flight.base_url') ?>dons/create" class="text-sm font-medium text-gray-600 hover:text-teal-700 transition-colors">Nouveau Don</a>
                <a href="<?= Flight::get('flight.base_url') ?>test/dispatch" class="text-sm font-medium text-gray-600 hover:text-teal-700 transition-colors">Dispatch</a>
                <a href="<?= Flight::get('flight.base_url') ?>achats/besoins-achetables" class="text-sm font-medium text-gray-600 hover:text-teal-700 transition-colors">Achats</a>
                <a href="<?= Flight::get('flight.base_url') ?>achats" class="text-sm font-medium text-gray-600 hover:text-teal-700 transition-colors">Liste Achats</a>
                <a href="<?= Flight::get('flight.base_url') ?>besoins" class="text-sm font-medium text-gray-600 hover:text-teal-700 transition-colors">Besoins</a>
                <a href="<?= Flight::get('flight.base_url') ?>villes" class="text-sm font-medium text-gray-600 hover:text-teal-700 transition-colors">Villes</a>
            </div>

            <!-- CTA -->
            <div class="flex items-center gap-4">
                <a href="<?= Flight::get('flight.base_url') ?>dons/create" class="hidden sm:inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-teal-600 to-teal-700 text-white text-sm font-semibold rounded-xl shadow-lg shadow-teal-500/30 hover:shadow-teal-500/50 hover:-translate-y-0.5 transition-all duration-300">
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
            <a href="<?= Flight::get('flight.base_url') ?>" class="block text-sm font-semibold text-teal-700">Tableau de bord</a>
            <a href="<?= Flight::get('flight.base_url') ?>dons/create" class="block text-sm font-medium text-gray-600">Nouveau Don</a>
            <a href="<?= Flight::get('flight.base_url') ?>test/dispatch" class="block text-sm font-medium text-gray-600">Dispatch</a>
            <a href="<?= Flight::get('flight.base_url') ?>achats/besoins-achetables" class="block text-sm font-medium text-gray-600">Achats</a>
            <a href="<?= Flight::get('flight.base_url') ?>achats" class="block text-sm font-medium text-gray-600">Liste Achats</a>
            <a href="<?= Flight::get('flight.base_url') ?>besoins" class="block text-sm font-medium text-gray-600">Besoins</a>
            <a href="<?= Flight::get('flight.base_url') ?>villes" class="block text-sm font-medium text-gray-600">Villes</a>
            <a href="<?= Flight::get('flight.base_url') ?>dons/create" class="inline-flex items-center gap-2 px-5 py-2.5 bg-teal-600 text-white text-sm font-semibold rounded-xl mt-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Faire un don
            </a>
        </div>
    </nav>
<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BNGRC - Tableau de Bord</title>
    <!-- Bootstrap CSS -->
    <link href="/public/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS pour glass-card, progress-bar, etc. -->
    <link href="/public/assets/bootstrap/css/custom.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        ::selection {
            background: #0d9488;
            color: white;
        }
    </style>
</head>
<body class="bg-light min-vh-100">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <a href="<?= Flight::get('flight.base_url') ?>" class="navbar-brand d-flex align-items-center gap-2">
                <div class="bg-gradient rounded p-2 d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #14b8a6, #0d9488);">
                    <svg class="text-white" width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <span class="fw-bold text-dark">BNGRC</span>
                <span class="small text-muted">Gestion des Dons</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active fw-semibold text-teal" href="<?= Flight::get('flight.base_url') ?>">Tableau de bord</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= Flight::get('flight.base_url') ?>recapitulation">Récapitulation</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= Flight::get('flight.base_url') ?>dons/create">Nouveau Don</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= Flight::get('flight.base_url') ?>test/dispatch">Dispatch</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= Flight::get('flight.base_url') ?>achats/besoins-achetables">Achats</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= Flight::get('flight.base_url') ?>achats">Liste Achats</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= Flight::get('flight.base_url') ?>besoins">Besoins</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= Flight::get('flight.base_url') ?>villes">Villes</a></li>
                </ul>
                <a href="<?= Flight::get('flight.base_url') ?>dons/create" class="btn btn-success ms-3 d-none d-lg-inline-flex align-items-center gap-2">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Faire un don
                </a>
            </div>
        </div>
    </nav>
    <!-- Spacer supprimé pour enlever l'espace sous le header -->
