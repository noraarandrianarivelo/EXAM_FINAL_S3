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
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 via-teal-50/30 to-slate-100 min-h-screen">
    <!-- Navigation -->
    <nav class="glass-nav fixed top-0 left-0 right-0 z-50 h-20">
        <div class="max-w-7xl mx-auto px-6 h-full flex items-center justify-between">
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
            <a href="<?= Flight::get('flight.base_url') ?>dons/create" class="inline-flex items-center gap-2 px-5 py-2.5 bg-teal-600 text-white text-sm font-semibold rounded-xl mt-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Faire un don
            </a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-16 px-6 relative overflow-hidden">
        <!-- Decorative elements -->
        <div class="absolute top-20 right-0 w-96 h-96 bg-teal-200/30 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-amber-200/20 rounded-full blur-3xl"></div>
        
        <div class="max-w-7xl mx-auto relative">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <!-- Badge -->
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-teal-50 border border-teal-200 rounded-full text-teal-700 text-xs font-semibold uppercase tracking-wider mb-6">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Tableau de bord
                </div>
                
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 tracking-tight leading-tight mb-6">
                    Distribution des 
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-600 to-emerald-500">Dons Humanitaires</span>
                </h1>
                
                <p class="text-lg text-gray-600 leading-relaxed mb-8">
                    Suivi en temps réel de la distribution des dons aux villes sinistrées. 
                    Vue d'ensemble des besoins et des attributions par ville.
                </p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                <!-- Total Villes -->
                <div class="glass-card rounded-2xl p-6 group hover:shadow-xl transition-all duration-300">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-2 py-1 rounded-full">Villes</span>
                    </div>
                    <div class="text-3xl md:text-4xl font-bold text-gray-900 mb-1"><?= $stats['total_villes'] ?></div>
                    <div class="text-sm text-gray-500">Villes touchées</div>
                </div>

                <!-- Total Besoins -->
                <div class="glass-card rounded-2xl p-6 group hover:shadow-xl transition-all duration-300">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-orange-500 rounded-xl flex items-center justify-center shadow-lg shadow-amber-500/30 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-amber-600 bg-amber-50 px-2 py-1 rounded-full">Urgent</span>
                    </div>
                    <div class="text-3xl md:text-4xl font-bold text-gray-900 mb-1"><?= number_format($stats['total_besoins']) ?></div>
                    <div class="text-sm text-gray-500">Besoins totaux</div>
                </div>

                <!-- Total Dons -->
                <div class="glass-card rounded-2xl p-6 group hover:shadow-xl transition-all duration-300">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-green-500 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-500/30 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-full flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            Actif
                        </span>
                    </div>
                    <div class="text-3xl md:text-4xl font-bold text-gray-900 mb-1"><?= number_format($stats['total_dons']) ?></div>
                    <div class="text-sm text-gray-500">Dons reçus</div>
                </div>

                <!-- Total Attributions -->
                <div class="glass-card rounded-2xl p-6 group hover:shadow-xl transition-all duration-300">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-teal-500 to-cyan-500 rounded-xl flex items-center justify-center shadow-lg shadow-teal-500/30 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-teal-600 bg-teal-50 px-2 py-1 rounded-full">Distribué</span>
                    </div>
                    <div class="text-3xl md:text-4xl font-bold text-gray-900 mb-1"><?= number_format($stats['total_attributions']) ?></div>
                    <div class="text-sm text-gray-500">Distributions effectuées</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Villes avec leurs besoins -->
    <section class="py-16 px-6 relative">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between mb-10">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-teal-600 mb-2 block">Distribution par ville</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 tracking-tight">Villes et besoins</h2>
                </div>
                <div class="mt-4 md:mt-0 flex items-center gap-3">
                    <a href="<?= Flight::get('flight.base_url') ?>test/dispatch" class="inline-flex items-center gap-2 text-sm font-semibold text-teal-600 hover:text-teal-700 transition-colors group">
                        Gérer les dons
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <?php if (empty($villesData)): ?>
                <div class="glass-card rounded-2xl p-12 text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Aucune donnée disponible</h3>
                    <p class="text-gray-600">Aucune ville avec des besoins n'a été trouvée dans la base de données.</p>
                </div>
            <?php else: ?>
                <div class="space-y-6">
                    <?php foreach ($villesData as $ville): ?>
                        <?php
                        $pourcentage = $ville['pourcentage'];
                        $progressClass = 'progress-bar';
                        $statusClass = 'bg-red-500/20 text-red-400 border-red-500/30';
                        $statusText = 'Urgent';
                        $statusIcon = '<span class="w-1.5 h-1.5 rounded-full bg-red-400 animate-pulse"></span>';
                        
                        if ($pourcentage >= 80) {
                            $statusClass = 'bg-emerald-500/20 text-emerald-400 border-emerald-500/30';
                            $statusText = 'Bon';
                            $statusIcon = '<span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>';
                        } elseif ($pourcentage >= 50) {
                            $statusClass = 'bg-amber-500/20 text-amber-400 border-amber-500/30';
                            $statusText = 'Moyen';
                            $statusIcon = '<span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>';
                        }
                        ?>
                        
                        <!-- Carte Ville -->
                        <div class="glass-card rounded-2xl p-6 hover:shadow-xl transition-all duration-300">
                            <!-- En-tête de la ville -->
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 pb-6 border-b border-gray-200">
                                <div class="flex items-center gap-4 mb-4 md:mb-0">
                                    <div class="w-14 h-14 bg-gradient-to-br from-slate-100 to-slate-200 rounded-xl flex items-center justify-center">
                                        <svg class="w-7 h-7 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-2xl font-bold text-gray-900"><?= htmlspecialchars($ville['nom']) ?></h3>
                                        <p class="text-sm text-gray-500"><?= htmlspecialchars($ville['region']) ?> • <?= $ville['nb_besoins'] ?> besoin<?= $ville['nb_besoins'] > 1 ? 's' : '' ?></p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <div class="text-right">
                                        <div class="text-xs text-gray-500 mb-1">Couverture globale</div>
                                        <div class="text-2xl font-bold text-teal-600"><?= number_format($pourcentage, 1) ?>%</div>
                                    </div>
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold <?= $statusClass ?> border">
                                        <?= $statusIcon ?>
                                        <?= $statusText ?>
                                    </span>
                                </div>
                            </div>

                            <!-- Statistiques résumées -->
                            <div class="grid grid-cols-3 gap-4 mb-6">
                                <div class="bg-white/50 rounded-xl p-4">
                                    <div class="text-xs text-gray-500 mb-1">Total requis</div>
                                    <div class="text-2xl font-bold text-gray-900"><?= number_format($ville['total_besoins']) ?></div>
                                </div>
                                <div class="bg-white/50 rounded-xl p-4">
                                    <div class="text-xs text-gray-500 mb-1">Reçu</div>
                                    <div class="text-2xl font-bold text-emerald-600"><?= number_format($ville['total_recus']) ?></div>
                                </div>
                                <div class="bg-white/50 rounded-xl p-4">
                                    <div class="text-xs text-gray-500 mb-1">Reste</div>
                                    <div class="text-2xl font-bold text-red-600"><?= number_format($ville['reste']) ?></div>
                                </div>
                            </div>

                            <!-- Barre de progression -->
                            <div class="mb-6">
                                <div class="flex justify-between text-sm mb-2">
                                    <span class="text-gray-600 font-medium">Progression de la distribution</span>
                                    <span class="text-gray-500"><?= number_format($ville['total_recus']) ?> / <?= number_format($ville['total_besoins']) ?></span>
                                </div>
                                <div class="h-3 bg-gray-100 rounded-full overflow-hidden">
                                    <div class="h-full <?= $progressClass ?> rounded-full transition-all duration-500" style="width: <?= $pourcentage ?>%"></div>
                                </div>
                            </div>

                            <!-- Liste des besoins -->
                            <?php if (!empty($ville['besoins'])): ?>
                                <div class="space-y-3">
                                    <h4 class="text-sm font-bold text-gray-700 uppercase tracking-wider mb-3">Détail des besoins</h4>
                                    <?php foreach ($ville['besoins'] as $besoin): ?>
                                        <?php
                                        $besoinPourcentage = $besoin['quantite_besoin'] > 0 ? 
                                            ($besoin['quantite_recue'] / $besoin['quantite_besoin'] * 100) : 0;
                                        $besoinStatusClass = 'text-red-600';
                                        $besoinBgClass = 'bg-red-50';
                                        
                                        if ($besoinPourcentage >= 100) {
                                            $besoinStatusClass = 'text-emerald-600';
                                            $besoinBgClass = 'bg-emerald-50';
                                        } elseif ($besoinPourcentage >= 50) {
                                            $besoinStatusClass = 'text-amber-600';
                                            $besoinBgClass = 'bg-amber-50';
                                        }
                                        ?>
                                        <div class="bg-white rounded-xl p-4 border border-gray-200">
                                            <div class="flex items-start justify-between mb-3">
                                                <div class="flex-1">
                                                    <div class="flex items-center gap-2 mb-1">
                                                        <h5 class="font-semibold text-gray-900"><?= htmlspecialchars($besoin['nom_categorie']) ?></h5>
                                                        <span class="px-2 py-0.5 bg-gray-100 text-gray-600 text-xs rounded-full font-medium">
                                                            <?= htmlspecialchars($besoin['nom_type']) ?>
                                                        </span>
                                                    </div>
                                                    <p class="text-xs text-gray-500">Demandé le <?= date('d/m/Y', strtotime($besoin['date_besoin'])) ?></p>
                                                </div>
                                                <div class="text-right">
                                                    <div class="<?= $besoinBgClass ?> <?= $besoinStatusClass ?> px-3 py-1.5 rounded-lg text-sm font-bold">
                                                        <?= number_format($besoinPourcentage, 0) ?>%
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-3 gap-3 mb-2">
                                                <div>
                                                    <div class="text-xs text-gray-500">Requis</div>
                                                    <div class="text-sm font-bold text-gray-900"><?= number_format($besoin['quantite_besoin']) ?></div>
                                                </div>
                                                <div>
                                                    <div class="text-xs text-gray-500">Reçu</div>
                                                    <div class="text-sm font-bold text-emerald-600"><?= number_format($besoin['quantite_recue']) ?></div>
                                                </div>
                                                <div>
                                                    <div class="text-xs text-gray-500">Reste</div>
                                                    <div class="text-sm font-bold text-red-600"><?= number_format($besoin['reste']) ?></div>
                                                </div>
                                            </div>
                                            <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                                                <div class="h-full progress-bar rounded-full transition-all duration-500" style="width: <?= min($besoinPourcentage, 100) ?>%"></div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-12 px-6 border-t border-gray-200 bg-white/50 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-teal-500 to-teal-700 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="font-bold text-gray-900">BNGRC</div>
                        <div class="text-xs text-gray-500">Bureau National de Gestion des Risques et Catastrophes</div>
                    </div>
                </div>
                <div class="text-sm text-gray-500">
                    © <?= date('Y') ?> BNGRC. Tous droits réservés.
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        
        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }
    </script>
</body>
</html>
