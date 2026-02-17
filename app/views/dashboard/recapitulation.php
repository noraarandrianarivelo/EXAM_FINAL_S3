<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BNGRC - Récapitulation des Besoins</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        .animate-spin {
            animation: spin 1s linear infinite;
        }
        @keyframes pulse-scale {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        .pulse-update {
            animation: pulse-scale 0.5s ease-in-out;
        }
        @keyframes scale-in {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        .animate-scale-in {
            animation: scale-in 0.3s ease-out;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 via-teal-50/30 to-slate-100 min-h-screen">
    <!-- Navigation -->
    <nav class="glass-card sticky top-0 z-50 shadow-lg">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="<?= Flight::get('flight.base_url') ?>" class="flex items-center gap-3 group">
                <div class="w-10 h-10 bg-gradient-to-br from-teal-500 to-teal-700 rounded-xl flex items-center justify-center shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <span class="text-xl font-bold text-gray-900">BNGRC</span>
            </a>
            <div class="flex items-center gap-4">
                <a href="<?= Flight::get('flight.base_url') ?>" class="text-sm font-medium text-gray-600 hover:text-teal-700 transition-colors">
                    Tableau de bord
                </a>
                <a href="<?= Flight::get('flight.base_url') ?>test/dispatch" class="text-sm font-medium text-gray-600 hover:text-teal-700 transition-colors">
                    Dispatch
                </a>
            </div>
        </div>
    </nav>

    <!-- Header Section -->
    <section class="pt-12 pb-8 px-6">
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
                <div class="mt-6 md:mt-0 flex gap-3">
                    <button onclick="actualiserStats()" id="btn-actualiser" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-teal-600 to-teal-700 text-white font-semibold rounded-xl shadow-lg shadow-teal-500/30 hover:shadow-teal-500/50 hover:-translate-y-0.5 transition-all duration-300">
                        <svg id="icon-refresh" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        <span id="btn-text">Actualiser</span>
                    </button>
                    <button onclick="showResetModal()" id="btn-reset" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-red-600 to-red-700 text-white font-semibold rounded-xl shadow-lg shadow-red-500/30 hover:shadow-red-500/50 hover:-translate-y-0.5 transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        <span>Réinitialiser</span>
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
    <!-- Modal de confirmation de réinitialisation -->
    <div id="resetModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="glass-card rounded-2xl max-w-md w-full p-8 shadow-2xl animate-scale-in">
            <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-red-100 to-red-200 rounded-full">
                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 text-center mb-2">Réinitialiser les données</h3>
            <p class="text-gray-600 text-center mb-6">Êtes-vous sûr de vouloir réinitialiser <strong>tous les besoins, dons et attributions</strong> aux données initiales ? Cette action est <strong>irréversible</strong>.</p>
            
            <div class="flex gap-3">
                <button onclick="hideResetModal()" class="flex-1 px-6 py-3 bg-gray-200 text-gray-700 font-semibold rounded-xl hover:bg-gray-300 transition-colors">
                    Annuler
                </button>
                <button onclick="confirmReset()" id="btn-confirm-reset" class="flex-1 px-6 py-3 bg-gradient-to-r from-red-600 to-red-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-red-500/50 transition-all">
                    Confirmer
                </button>
            </div>
        </div>
    </div>

    <script>
        function showResetModal() {
            document.getElementById('resetModal').classList.remove('hidden');
        }
        
        function hideResetModal() {
            document.getElementById('resetModal').classList.add('hidden');
        }
        
        async function confirmReset() {
            const btnConfirm = document.getElementById('btn-confirm-reset');
            btnConfirm.disabled = true;
            btnConfirm.innerHTML = '<svg class="animate-spin h-5 w-5 mx-auto" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';
            
            try {
                const response = await fetch('<?= Flight::get('flight.base_url') ?>admin/reset', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                });
                
                const result = await response.json();
                
                if (result.success) {
                    hideResetModal();
                    // Afficher notification de succès
                    alert('✅ Données réinitialisées avec succès!');
                    // Recharger la page pour afficher les nouvelles données
                    window.location.reload();
                } else {
                    alert('❌ Erreur : ' + (result.message || 'Une erreur est survenue'));
                    btnConfirm.disabled = false;
                    btnConfirm.innerHTML = 'Confirmer';
                }
            } catch (error) {
                alert('❌ Erreur de connexion : ' + error.message);
                btnConfirm.disabled = false;
                btnConfirm.innerHTML = 'Confirmer';
            }
        }
        
        // Fermer le modal en cliquant en dehors
        document.getElementById('resetModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                hideResetModal();
            }
        });
    </script>

</body>
</html>
