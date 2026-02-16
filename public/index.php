<?php
$ds = DIRECTORY_SEPARATOR;
require(__DIR__. $ds . '..' . $ds . 'app' . $ds . 'config' . $ds . 'bootstrap.php');

// Include header
include(__DIR__. $ds . '..' . $ds . 'app' . $ds . 'views' . $ds . 'partials' . $ds . 'header.php');
?>

    <!-- Hero Section -->
    <section class="pt-32 pb-16 px-6 relative overflow-hidden">
        <!-- Decorative elements -->
        <div class="absolute top-20 right-0 w-96 h-96 bg-teal-200/30 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-amber-200/20 rounded-full blur-3xl"></div>
        
        <div class="max-w-7xl mx-auto relative">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <!-- Badge -->
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-red-50 border border-red-200 rounded-full text-red-700 text-xs font-semibold uppercase tracking-wider mb-6">
                    <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
                    Situation d'urgence en cours
                </div>
                
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 tracking-tight leading-tight mb-6">
                    Ensemble, aidons les 
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-600 to-emerald-500">sinistrés</span>
                </h1>
                
                <p class="text-lg text-gray-600 leading-relaxed mb-8">
                    Le BNGRC coordonne la collecte et la distribution de dons pour venir en aide 
                    aux populations touchées par les catastrophes naturelles. Chaque don compte.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="#" class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-teal-600 to-teal-700 text-white font-semibold rounded-2xl shadow-xl shadow-teal-500/30 hover:shadow-teal-500/50 hover:-translate-y-1 transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        Faire un don maintenant
                    </a>
                    <a href="#" class="inline-flex items-center gap-2 px-8 py-4 bg-white text-gray-700 font-semibold rounded-2xl shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-gray-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Voir le tableau de bord
                    </a>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mt-12">
                <!-- Villes touchées -->
                <div class="glass-card rounded-2xl p-6 group hover:shadow-xl transition-all duration-300">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-2 py-1 rounded-full">Actif</span>
                    </div>
                    <div class="text-3xl md:text-4xl font-bold text-gray-900 mb-1">12</div>
                    <div class="text-sm text-gray-500">Villes touchées</div>
                </div>

                <!-- Sinistrés -->
                <div class="glass-card rounded-2xl p-6 group hover:shadow-xl transition-all duration-300">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-orange-500 rounded-xl flex items-center justify-center shadow-lg shadow-amber-500/30 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-amber-600 bg-amber-50 px-2 py-1 rounded-full">Cumul</span>
                    </div>
                    <div class="text-3xl md:text-4xl font-bold text-gray-900 mb-1">4 520</div>
                    <div class="text-sm text-gray-500">Sinistrés recensés</div>
                </div>

                <!-- Dons reçus -->
                <div class="glass-card rounded-2xl p-6 group hover:shadow-xl transition-all duration-300">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-green-500 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-500/30 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-full flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            En cours
                        </span>
                    </div>
                    <div class="text-3xl md:text-4xl font-bold text-gray-900 mb-1">2 850</div>
                    <div class="text-sm text-gray-500">Dons reçus</div>
                </div>

                <!-- Dons distribués -->
                <div class="glass-card rounded-2xl p-6 group hover:shadow-xl transition-all duration-300">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-teal-500 to-cyan-500 rounded-xl flex items-center justify-center shadow-lg shadow-teal-500/30 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-teal-600 bg-teal-50 px-2 py-1 rounded-full">Distribué</span>
                    </div>
                    <div class="text-3xl md:text-4xl font-bold text-gray-900 mb-1">1 890</div>
                    <div class="text-sm text-gray-500">Distributions effectuées</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Villes Touchées -->
    <section class="py-16 px-6 relative">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between mb-10">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-teal-600 mb-2 block">Situation régionale</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 tracking-tight">Villes touchées</h2>
                </div>
                <a href="#" class="mt-4 md:mt-0 inline-flex items-center gap-2 text-sm font-semibold text-teal-600 hover:text-teal-700 transition-colors group">
                    Voir toutes les villes
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-5">
                <!-- Ville 1 -->
                <div class="glass-card rounded-2xl p-5 group hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-slate-100 to-slate-200 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Antsirabe</h3>
                                <p class="text-xs text-gray-500">850 sinistrés</p>
                            </div>
                        </div>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-red-500/20 text-red-400 border border-red-500/30"><span class="w-1.5 h-1.5 rounded-full bg-red-400 animate-pulse"></span>Urgente</span>
                    </div>
                    <div class="mb-2">
                        <div class="flex justify-between text-xs mb-1.5">
                            <span class="text-gray-500">Couverture</span>
                            <span class="font-semibold text-teal-600">45%</span>
                        </div>
                        <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full progress-bar rounded-full transition-all duration-500" style="width: 45%"></div>
                        </div>
                    </div>
                    <a href="#" class="inline-flex items-center gap-1 text-xs font-semibold text-teal-600 hover:text-teal-700 mt-3 group/link">
                        Voir les détails
                        <svg class="w-3 h-3 group-hover/link:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>

                <!-- Ville 2 -->
                <div class="glass-card rounded-2xl p-5 group hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-slate-100 to-slate-200 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Ambatondrazaka</h3>
                                <p class="text-xs text-gray-500">620 sinistrés</p>
                            </div>
                        </div>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-amber-500/20 text-amber-400 border border-amber-500/30"><span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>Haute</span>
                    </div>
                    <div class="mb-2">
                        <div class="flex justify-between text-xs mb-1.5">
                            <span class="text-gray-500">Couverture</span>
                            <span class="font-semibold text-teal-600">62%</span>
                        </div>
                        <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full progress-bar rounded-full transition-all duration-500" style="width: 62%"></div>
                        </div>
                    </div>
                    <a href="#" class="inline-flex items-center gap-1 text-xs font-semibold text-teal-600 hover:text-teal-700 mt-3 group/link">
                        Voir les détails
                        <svg class="w-3 h-3 group-hover/link:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>

                <!-- Ville 3 -->
                <div class="glass-card rounded-2xl p-5 group hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-slate-100 to-slate-200 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Toamasina</h3>
                                <p class="text-xs text-gray-500">580 sinistrés</p>
                            </div>
                        </div>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-amber-500/20 text-amber-400 border border-amber-500/30"><span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>Haute</span>
                    </div>
                    <div class="mb-2">
                        <div class="flex justify-between text-xs mb-1.5">
                            <span class="text-gray-500">Couverture</span>
                            <span class="font-semibold text-teal-600">78%</span>
                        </div>
                        <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full progress-bar rounded-full transition-all duration-500" style="width: 78%"></div>
                        </div>
                    </div>
                    <a href="#" class="inline-flex items-center gap-1 text-xs font-semibold text-teal-600 hover:text-teal-700 mt-3 group/link">
                        Voir les détails
                        <svg class="w-3 h-3 group-hover/link:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>

                <!-- Ville 4 -->
                <div class="glass-card rounded-2xl p-5 group hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-slate-100 to-slate-200 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Fianarantsoa</h3>
                                <p class="text-xs text-gray-500">720 sinistrés</p>
                            </div>
                        </div>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-red-500/20 text-red-400 border border-red-500/30"><span class="w-1.5 h-1.5 rounded-full bg-red-400 animate-pulse"></span>Urgente</span>
                    </div>
                    <div class="mb-2">
                        <div class="flex justify-between text-xs mb-1.5">
                            <span class="text-gray-500">Couverture</span>
                            <span class="font-semibold text-teal-600">38%</span>
                        </div>
                        <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full progress-bar rounded-full transition-all duration-500" style="width: 38%"></div>
                        </div>
                    </div>
                    <a href="#" class="inline-flex items-center gap-1 text-xs font-semibold text-teal-600 hover:text-teal-700 mt-3 group/link">
                        Voir les détails
                        <svg class="w-3 h-3 group-hover/link:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Besoins Urgents -->
    <section class="py-16 px-6 bg-gradient-to-b from-transparent via-teal-50/50 to-transparent relative">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between mb-10">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-red-600 mb-2 block">Priorité absolue</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 tracking-tight">Besoins urgents</h2>
                </div>
                <a href="#" class="mt-4 md:mt-0 inline-flex items-center gap-2 text-sm font-semibold text-teal-600 hover:text-teal-700 transition-colors group">
                    Gérer les besoins
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>

            <div class="overflow-x-auto">
                <div class="glass-card rounded-2xl overflow-hidden min-w-[600px]">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-100">
                                <th class="text-left text-xs font-bold uppercase tracking-wider text-gray-500 px-6 py-4">Type</th>
                                <th class="text-left text-xs font-bold uppercase tracking-wider text-gray-500 px-6 py-4">Article</th>
                                <th class="text-right text-xs font-bold uppercase tracking-wider text-gray-500 px-6 py-4">Besoin total</th>
                                <th class="text-right text-xs font-bold uppercase tracking-wider text-gray-500 px-6 py-4">Couvert</th>
                                <th class="text-left text-xs font-bold uppercase tracking-wider text-gray-500 px-6 py-4 w-48">Progression</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Riz -->
                            <tr class="border-b border-gray-50 last:border-0 hover:bg-teal-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-lg flex items-center justify-center bg-emerald-100 text-emerald-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                        </div>
                                        <span class="text-xs font-semibold capitalize text-emerald-700">nature</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900">Riz</td>
                                <td class="px-6 py-4 text-right">
                                    <span class="font-semibold text-gray-900">15 000</span>
                                    <span class="text-xs text-gray-500 ml-1">kg</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="font-semibold text-teal-600">6 500</span>
                                    <span class="text-xs text-gray-400 ml-1">kg</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div>
                                        <div class="flex justify-between text-xs mb-1">
                                            <span class="font-semibold text-gray-700">43%</span>
                                            <span class="text-red-500 font-medium">Reste: 8,500</span>
                                        </div>
                                        <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                                            <div class="h-full progress-bar rounded-full" style="width: 43%"></div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Huile -->
                            <tr class="border-b border-gray-50 last:border-0 hover:bg-teal-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-lg flex items-center justify-center bg-emerald-100 text-emerald-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                        </div>
                                        <span class="text-xs font-semibold capitalize text-emerald-700">nature</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900">Huile</td>
                                <td class="px-6 py-4 text-right">
                                    <span class="font-semibold text-gray-900">2 500</span>
                                    <span class="text-xs text-gray-500 ml-1">L</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="font-semibold text-teal-600">1 800</span>
                                    <span class="text-xs text-gray-400 ml-1">L</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div>
                                        <div class="flex justify-between text-xs mb-1">
                                            <span class="font-semibold text-gray-700">72%</span>
                                            <span class="text-red-500 font-medium">Reste: 700</span>
                                        </div>
                                        <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                                            <div class="h-full progress-bar rounded-full" style="width: 72%"></div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Tôles -->
                            <tr class="border-b border-gray-50 last:border-0 hover:bg-teal-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-lg flex items-center justify-center bg-blue-100 text-blue-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                        </div>
                                        <span class="text-xs font-semibold capitalize text-blue-700">materiau</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900">Tôles</td>
                                <td class="px-6 py-4 text-right">
                                    <span class="font-semibold text-gray-900">3 200</span>
                                    <span class="text-xs text-gray-500 ml-1">unités</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="font-semibold text-teal-600">1 400</span>
                                    <span class="text-xs text-gray-400 ml-1">unités</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div>
                                        <div class="flex justify-between text-xs mb-1">
                                            <span class="font-semibold text-gray-700">44%</span>
                                            <span class="text-red-500 font-medium">Reste: 1,800</span>
                                        </div>
                                        <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                                            <div class="h-full progress-bar rounded-full" style="width: 44%"></div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Aide financière -->
                            <tr class="border-b border-gray-50 last:border-0 hover:bg-teal-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-lg flex items-center justify-center bg-amber-100 text-amber-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </div>
                                        <span class="text-xs font-semibold capitalize text-amber-700">argent</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900">Aide financière</td>
                                <td class="px-6 py-4 text-right">
                                    <span class="font-semibold text-gray-900">25 000 000</span>
                                    <span class="text-xs text-gray-500 ml-1">MGA</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="font-semibold text-teal-600">12 500 000</span>
                                    <span class="text-xs text-gray-400 ml-1">MGA</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div>
                                        <div class="flex justify-between text-xs mb-1">
                                            <span class="font-semibold text-gray-700">50%</span>
                                            <span class="text-red-500 font-medium">Reste: 12,500,000</span>
                                        </div>
                                        <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                                            <div class="h-full progress-bar rounded-full" style="width: 50%"></div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Dons Récents -->
    <section class="py-16 px-6 relative">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between mb-10">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-emerald-600 mb-2 block">Solidarité en action</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 tracking-tight">Dons récents</h2>
                </div>
                <a href="#" class="mt-4 md:mt-0 inline-flex items-center gap-2 text-sm font-semibold text-teal-600 hover:text-teal-700 transition-colors group">
                    Voir tous les dons
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
                <!-- Don 1 -->
                <div class="glass-card rounded-2xl p-5 group hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0 bg-gradient-to-br from-emerald-400 to-emerald-600 shadow-lg shadow-emerald-500/30">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between mb-1">
                                <h3 class="font-semibold text-gray-900 truncate">Entreprise ABC</h3>
                                <span class="text-xs text-gray-400 shrink-0 ml-2">15/01</span>
                            </div>
                            <p class="text-sm text-gray-600 mb-2">2 000 kg de riz</p>
                            <div class="flex items-center gap-2">
                                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                </svg>
                                <span class="text-xs text-gray-500">Destiné à Antsirabe</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Don 2 -->
                <div class="glass-card rounded-2xl p-5 group hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0 bg-gradient-to-br from-amber-400 to-amber-600 shadow-lg shadow-amber-500/30">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between mb-1">
                                <h3 class="font-semibold text-gray-900 truncate">Anonyme</h3>
                                <span class="text-xs text-gray-400 shrink-0 ml-2">15/01</span>
                            </div>
                            <p class="text-sm text-gray-600 mb-2">2 500 000 MGA</p>
                            <div class="flex items-center gap-2">
                                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                </svg>
                                <span class="text-xs text-gray-500">Destiné à Fianarantsoa</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Don 3 -->
                <div class="glass-card rounded-2xl p-5 group hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0 bg-gradient-to-br from-blue-400 to-blue-600 shadow-lg shadow-blue-500/30">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between mb-1">
                                <h3 class="font-semibold text-gray-900 truncate">ONG Solidarité</h3>
                                <span class="text-xs text-gray-400 shrink-0 ml-2">14/01</span>
                            </div>
                            <p class="text-sm text-gray-600 mb-2">500 tôles</p>
                            <div class="flex items-center gap-2">
                                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                </svg>
                                <span class="text-xs text-gray-500">Destiné à Morondava</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 px-6 relative">
        <div class="max-w-4xl mx-auto">
            <div class="relative rounded-3xl overflow-hidden">
                <!-- Background gradient -->
                <div class="absolute inset-0 bg-gradient-to-br from-teal-600 via-teal-700 to-emerald-700"></div>
                <!-- Decorative elements -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-emerald-400/20 rounded-full blur-3xl"></div>
                
                <div class="relative p-8 md:p-12 text-center">
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-6 float-animation">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl md:text-3xl font-bold text-white mb-4">Chaque geste compte</h2>
                    <p class="text-teal-100 text-lg mb-8 max-w-xl mx-auto">
                        Que ce soit un don en nature, en matériaux ou une contribution financière, 
                        votre solidarité fait la différence pour les familles sinistrées.
                    </p>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="#" class="inline-flex items-center gap-2 px-8 py-4 bg-white text-teal-700 font-semibold rounded-2xl shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Faire un don
                        </a>
                        <a href="#" class="inline-flex items-center gap-2 px-8 py-4 bg-white/10 text-white font-semibold rounded-2xl border border-white/20 hover:bg-white/20 transition-all duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            Voir le dispatch
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
// Include footer
include(__DIR__. $ds . '..' . $ds . 'app' . $ds . 'views' . $ds . 'partials' . $ds . 'footer.php');
?>