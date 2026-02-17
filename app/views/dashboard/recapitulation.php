<?php include dirname(__DIR__) . '/partition/header.php'; ?>
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 via-teal-50/30 to-slate-100 min-h-screen">
    <section class="pt-4 pb-8 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
                <div>
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-teal-50 border border-teal-200 rounded-full text-teal-700 text-xs font-semibold uppercase tracking-wider mb-4">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Récapitulation
                    </div>
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 tracking-tight mb-3">
                        📊 État des <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-600 to-emerald-500">Besoins</span>
                    </h1>
                    <p class="text-lg text-gray-600">
                        Suivi en temps réel des besoins totaux et satisfaits en montant
                    </p>
                </div>
                <div class="mt-6 md:mt-0">
                    <button onclick="actualiserStats()" id="btn-actualiser" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-teal-600 to-teal-700 text-white font-semibold rounded-xl shadow-lg shadow-teal-500/30 hover:shadow-teal-500/50 hover:-translate-y-0.5 transition-all duration-300">
                        <svg id="icon-refresh" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        <span id="btn-text">Actualiser</span>
                    </button>
                </div>
            </div>

            <!-- Timestamp dernière mise à jour -->
            <div class="glass-card rounded-xl px-4 py-2 inline-flex items-center gap-2 mb-6">
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-sm text-gray-600">Dernière mise à jour : <strong id="timestamp"><?= date('d/m/Y H:i:s', strtotime($stats['timestamp'])) ?></strong></span>
            </div>
        </div>
    </section>

    <!-- Stats Cards Section -->
    <section class="pb-12 px-6">
        <div class="max-w-7xl mx-auto">
            <!-- Main Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Total Besoins -->
                <div id="card-total" class="glass-card rounded-2xl p-8 shadow-xl border-l-4 border-blue-500">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Besoins Totaux</h3>
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-100 to-blue-200 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-4xl font-bold text-blue-600 mb-2" id="montant-total">
                        <?= number_format($stats['montant_total_besoins'], 2, ',', ' ') ?> Ar
                    </p>
                    <p class="text-sm text-gray-600">
                        <span class="font-semibold" id="nombre-besoins"><?= $stats['nombre_besoins'] ?></span> besoin(s) enregistré(s)
                    </p>
                </div>

                <!-- Besoins Satisfaits -->
                <div id="card-satisfait" class="glass-card rounded-2xl p-8 shadow-xl border-l-4 border-green-500">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Besoins Satisfaits</h3>
                        <div class="w-12 h-12 bg-gradient-to-br from-green-100 to-green-200 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-4xl font-bold text-green-600 mb-2" id="montant-satisfait">
                        <?= number_format($stats['montant_satisfait'], 2, ',', ' ') ?> Ar
                    </p>
                    <p class="text-sm text-gray-600">
                        <span class="font-semibold" id="nombre-attributions"><?= $stats['nombre_attributions'] ?></span> attribution(s)
                    </p>
                </div>

                <!-- Besoins Restants -->
                <div id="card-restant" class="glass-card rounded-2xl p-8 shadow-xl border-l-4 border-red-500">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Besoins Restants</h3>
                        <div class="w-12 h-12 bg-gradient-to-br from-red-100 to-red-200 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-4xl font-bold text-red-600 mb-2" id="montant-restant">
                        <?= number_format($stats['montant_restant'], 2, ',', ' ') ?> Ar
                    </p>
                    <p class="text-sm text-gray-600">
                        <span class="font-semibold" id="pourcentage-satisfait"><?= number_format($stats['pourcentage_satisfait'], 1) ?>%</span> satisfait
                    </p>
                </div>
            </div>

            <!-- Progress Bar -->
            <div class="glass-card rounded-2xl p-8 shadow-xl mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-900">Progression Globale</h3>
                    <span class="text-2xl font-bold text-teal-600" id="progress-percentage"><?= number_format($stats['pourcentage_satisfait'], 1) ?>%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-6 overflow-hidden">
                    <div id="progress-bar" class="bg-gradient-to-r from-teal-500 to-emerald-500 h-6 rounded-full transition-all duration-1000 flex items-center justify-end pr-3" style="width: <?= $stats['pourcentage_satisfait'] ?>%">
                        <?php if ($stats['pourcentage_satisfait'] > 10): ?>
                            <span class="text-xs font-bold text-white"><?= number_format($stats['pourcentage_satisfait'], 1) ?>%</span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="flex justify-between mt-2 text-xs text-gray-600">
                    <span>0 Ar</span>
                    <span><?= number_format($stats['montant_total_besoins'], 0, ',', ' ') ?> Ar</span>
                </div>
            </div>

            <!-- Secondary Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Dons -->
                <div class="glass-card rounded-2xl p-6 shadow-xl">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-purple-100 to-purple-200 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-semibold text-gray-600 mb-1">Dons Reçus</h4>
                            <p class="text-2xl font-bold text-purple-600" id="montant-dons"><?= number_format($stats['montant_dons'], 2, ',', ' ') ?> Ar</p>
                            <p class="text-xs text-gray-500 mt-1"><span id="nombre-dons"><?= $stats['nombre_dons'] ?></span> don(s)</p>
                        </div>
                    </div>
                </div>

                <!-- Achats -->
                <div class="glass-card rounded-2xl p-6 shadow-xl">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-orange-100 to-orange-200 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-semibold text-gray-600 mb-1">Achats Effectués</h4>
                            <p class="text-2xl font-bold text-orange-600" id="montant-achats"><?= number_format($stats['montant_achats'], 2, ',', ' ') ?> Ar</p>
                            <p class="text-xs text-gray-500 mt-1"><span id="nombre-achats"><?= $stats['nombre_achats'] ?></span> achat(s)</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Box -->
            <div class="glass-card rounded-xl p-5 mt-8 border-l-4 border-teal-500 bg-teal-50/80">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-teal-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="flex-1">
                        <h3 class="font-semibold text-teal-900 mb-1">À propos de cette page</h3>
                        <p class="text-sm text-teal-800">
                            Cette page affiche les statistiques en temps réel des besoins des populations affectées. Les montants sont calculés en fonction des prix unitaires de chaque catégorie de besoin. Cliquez sur <strong>"Actualiser"</strong> pour obtenir les dernières données.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function formatNumber(number) {
            return new Intl.NumberFormat('fr-FR', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }).format(number);
        }

        function actualiserStats() {
            const btn = document.getElementById('btn-actualiser');
            const btnText = document.getElementById('btn-text');
            const icon = document.getElementById('icon-refresh');
            
            // Désactiver le bouton et afficher le spinner
            btn.disabled = true;
            btn.classList.add('opacity-75', 'cursor-not-allowed');
            btnText.textContent = 'Actualisation...';
            icon.classList.add('animate-spin');

            // Appel AJAX
            fetch('<?= Flight::get('flight.base_url') ?>api/stats-recapitulation')
                .then(response => response.json())
                .then(data => {
                    // Animer les cartes
                    document.getElementById('card-total').classList.add('pulse-update');
                    document.getElementById('card-satisfait').classList.add('pulse-update');
                    document.getElementById('card-restant').classList.add('pulse-update');

                    // Mettre à jour les valeurs
                    document.getElementById('montant-total').textContent = formatNumber(data.montant_total_besoins) + ' Ar';
                    document.getElementById('nombre-besoins').textContent = data.nombre_besoins;
                    
                    document.getElementById('montant-satisfait').textContent = formatNumber(data.montant_satisfait) + ' Ar';
                    document.getElementById('nombre-attributions').textContent = data.nombre_attributions;
                    
                    document.getElementById('montant-restant').textContent = formatNumber(data.montant_restant) + ' Ar';
                    document.getElementById('pourcentage-satisfait').textContent = data.pourcentage_satisfait.toFixed(1) + '%';
                    
                    document.getElementById('progress-percentage').textContent = data.pourcentage_satisfait.toFixed(1) + '%';
                    document.getElementById('progress-bar').style.width = data.pourcentage_satisfait + '%';
                    
                    document.getElementById('montant-dons').textContent = formatNumber(data.montant_dons) + ' Ar';
                    document.getElementById('nombre-dons').textContent = data.nombre_dons;
                    
                    document.getElementById('montant-achats').textContent = formatNumber(data.montant_achats) + ' Ar';
                    document.getElementById('nombre-achats').textContent = data.nombre_achats;
                    
                    // Mettre à jour le timestamp
                    const now = new Date(data.timestamp);
                    const formatted = now.toLocaleString('fr-FR', {
                        day: '2-digit',
                        month: '2-digit',
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit',
                        second: '2-digit'
                    });
                    document.getElementById('timestamp').textContent = formatted;

                    // Retirer l'animation après 500ms
                    setTimeout(() => {
                        document.querySelectorAll('.pulse-update').forEach(el => {
                            el.classList.remove('pulse-update');
                        });
                    }, 500);
                })
                .catch(error => {
                    console.error('Erreur lors de l\'actualisation:', error);
                    alert('Erreur lors de l\'actualisation des données');
                })
                .finally(() => {
                    // Réactiver le bouton
                    btn.disabled = false;
                    btn.classList.remove('opacity-75', 'cursor-not-allowed');
                    btnText.textContent = 'Actualiser';
                    icon.classList.remove('animate-spin');
                });
        }

        // Auto-actualisation toutes les 30 secondes (optionnel)
        // setInterval(actualiserStats, 30000);
    </script>
    <?php include dirname(__DIR__) . '/partition/footer.php'; ?>
</body>
</html>
