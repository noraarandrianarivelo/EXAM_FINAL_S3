<html>
    <body class="bg-gray-100 min-h-screen flex flex-col">

<?php include __DIR__ . '/partition/header.php'; ?>

<!-- Hero Section -->
<section class="pt-12 pb-16 px-6 relative overflow-hidden">
    <!-- Decorative elements -->
    <div class="absolute top-1 right-0 w-96 h-96 bg-teal-200/30 rounded-full blur-3xl"></div>
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
            <div class="mt-4 md:mt-0">
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
                <h3 class="text-xl font-bold text-gray-900 mb-2">Aucune donnée disponible</h3>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($villesData as $ville): ?>
                    <?php
                    $pourcentage = $ville['pourcentage'];
                    $statusClass = 'bg-red-100 text-red-600 border-red-200';
                    if ($pourcentage >= 80) $statusClass = 'bg-emerald-100 text-emerald-600 border-emerald-200';
                    elseif ($pourcentage >= 50) $statusClass = 'bg-amber-100 text-amber-600 border-amber-200';
                    ?>
                    
                    <div class="glass-card rounded-2xl p-5 border border-gray-100 bg-white shadow-sm hover:shadow-md transition-shadow flex flex-col">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 leading-tight"><?= htmlspecialchars($ville['nom']) ?></h3>
                                    <p class="text-xs text-gray-500"><?= htmlspecialchars($ville['region']) ?></p>
                                </div>
                            </div>
                            <span class="px-2 py-1 rounded-md text-[10px] font-bold uppercase border <?= $statusClass ?>">
                                <?= number_format($pourcentage, 0) ?>%
                            </span>
                        </div>

                        <div class="grid grid-cols-3 gap-2 mb-4">
                            <div class="text-center p-2 bg-gray-50 rounded-lg">
                                <div class="text-[10px] text-gray-400 uppercase">Besoin</div>
                                <div class="text-sm font-bold"><?= number_format($ville['total_besoins']) ?></div>
                            </div>
                            <div class="text-center p-2 bg-emerald-50 rounded-lg">
                                <div class="text-[10px] text-emerald-500 uppercase">Reçu</div>
                                <div class="text-sm font-bold text-emerald-600"><?= number_format($ville['total_recus']) ?></div>
                            </div>
                            <div class="text-center p-2 bg-red-50 rounded-lg">
                                <div class="text-[10px] text-red-400 uppercase">Reste</div>
                                <div class="text-sm font-bold text-red-600"><?= number_format($ville['reste']) ?></div>
                            </div>
                        </div>

                        <div class="flex-1 space-y-2 max-h-48 overflow-y-auto pr-1 custom-scrollbar">
                            <?php foreach ($ville['besoins'] as $besoin): ?>
                                <div class="text-xs p-2 border border-gray-50 rounded-lg bg-gray-50/30">
                                    <div class="flex justify-between font-medium mb-1">
                                        <span class="text-gray-700"><?= htmlspecialchars($besoin['nom_categorie']) ?></span>
                                        <span class="text-gray-400"><?= number_format(($besoin['quantite_recue']/$besoin['quantite_besoin'])*100, 0) ?>%</span>
                                    </div>
                                    <div class="w-full h-1 bg-gray-200 rounded-full">
                                        <div class="h-full bg-teal-500 rounded-full" style="width: <?= ($besoin['quantite_recue']/$besoin['quantite_besoin'])*100 ?>%"></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include __DIR__ . '/partition/footer.php'; ?>

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