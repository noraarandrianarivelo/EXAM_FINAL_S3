<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BNGRC - Résultat Dispatch Général</title>
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
            background: #10b981;
            color: white;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.6);
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        .pulse-animation {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-emerald-50 via-teal-50/30 to-emerald-100 min-h-screen">
    <section class="py-12 px-6">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <a href="<?= Flight::get('flight.base_url') ?>test/dispatch" class="inline-flex items-center gap-2 text-emerald-600 hover:text-emerald-700 font-medium mb-6 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Retour à la liste
                </a>

                <div class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-50 border border-emerald-200 rounded-full text-emerald-700 text-xs font-semibold uppercase tracking-wider mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Dispatch Validé
                </div>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 tracking-tight mb-3">
                    ✅ Dispatch Général <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-500">Réussi</span>
                </h1>
                <p class="text-lg text-gray-600">
                    Les attributions ont été enregistrées avec succès dans la base de données
                </p>
            </div>

            <?php if ($resultat['success']): ?>
                <!-- Success Alert -->
                <div class="glass-card rounded-xl p-5 mb-6 border-l-4 border-emerald-500 bg-emerald-50/80">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-emerald-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div class="flex-1">
                            <h3 class="font-semibold text-emerald-900 mb-1">Dispatch complété avec succès</h3>
                            <p class="text-sm text-emerald-800">
                                <strong><?= $resultat['nb_dons_dispatches'] ?></strong> don(s) ont été dispatchés vers <strong><?= $resultat['nb_besoins_couverts'] ?></strong> besoin(s) avec <strong><?= $resultat['nb_attributions'] ?></strong> attribution(s) créée(s).
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="glass-card rounded-xl p-6 shadow-xl">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-600">Dons dispatchés</span>
                            <div class="w-10 h-10 bg-gradient-to-br from-emerald-100 to-emerald-200 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-900 mb-1"><?= $resultat['nb_dons_dispatches'] ?></h3>
                        <p class="text-xs text-gray-500">Dons traités</p>
                    </div>

                    <div class="glass-card rounded-xl p-6 shadow-xl">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-600">Besoins couverts</span>
                            <div class="w-10 h-10 bg-gradient-to-br from-green-100 to-green-200 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-900 mb-1"><?= $resultat['nb_besoins_couverts'] ?></h3>
                        <p class="text-xs text-gray-500">Besoins satisfaits</p>
                    </div>

                    <div class="glass-card rounded-xl p-6 shadow-xl">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-600">Attributions créées</span>
                            <div class="w-10 h-10 bg-gradient-to-br from-purple-100 to-purple-200 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-900 mb-1"><?= $resultat['nb_attributions'] ?></h3>
                        <p class="text-xs text-gray-500">Enregistrements</p>
                    </div>
                </div>

                <!-- Résultats détaillés par Don -->
                <?php foreach ($resultat['resultats'] as $res): ?>
                    <div class="glass-card rounded-xl shadow-xl overflow-hidden mb-6">
                        <!-- Don Header -->
                        <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-6 py-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-white font-bold text-lg">Don #<?= $res['don']['id'] ?> - <?= htmlspecialchars($res['don']['nom_categorie']) ?></h3>
                                    <p class="text-emerald-100 text-sm"><?= htmlspecialchars($res['don']['nom_type_besoin']) ?></p>
                                </div>
                                <div class="text-right">
                                    <p class="text-white text-2xl font-bold"><?= number_format($res['dispatche'], 0, ',', ' ') ?></p>
                                    <p class="text-emerald-100 text-xs">Dispatché</p>
                                </div>
                            </div>
                        </div>

                        <!-- Before/After Stats -->
                        <div class="grid grid-cols-3 gap-4 p-6 bg-emerald-50/50">
                            <div class="text-center">
                                <p class="text-xs text-gray-600 mb-1">Avant</p>
                                <p class="text-2xl font-bold text-gray-900"><?= number_format($res['avant'], 0, ',', ' ') ?></p>
                            </div>
                            <div class="text-center">
                                <p class="text-xs text-gray-600 mb-1">Dispatché</p>
                                <p class="text-2xl font-bold text-emerald-600">+<?= number_format($res['dispatche'], 0, ',', ' ') ?></p>
                            </div>
                            <div class="text-center">
                                <p class="text-xs text-gray-600 mb-1">Après</p>
                                <p class="text-2xl font-bold text-gray-900"><?= number_format($res['apres'], 0, ',', ' ') ?></p>
                            </div>
                        </div>

                        <!-- Nouvelles Attributions -->
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b-2 border-emerald-200 bg-emerald-50">
                                        <th class="text-left py-3 px-6 text-emerald-900 font-semibold text-sm">ID</th>
                                        <th class="text-left py-3 px-6 text-emerald-900 font-semibold text-sm">Besoin</th>
                                        <th class="text-left py-3 px-6 text-emerald-900 font-semibold text-sm">Ville</th>
                                        <th class="text-left py-3 px-6 text-emerald-900 font-semibold text-sm">Quantité</th>
                                        <th class="text-left py-3 px-6 text-emerald-900 font-semibold text-sm">Date</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 bg-white/50">
                                    <?php foreach ($res['nouvelles_attributions'] as $attr): ?>
                                        <tr class="hover:bg-emerald-50/50 transition-colors pulse-animation">
                                            <td class="py-3 px-6 font-bold text-gray-900">#<?= $attr['id'] ?></td>
                                            <td class="py-3 px-6 text-gray-700">Besoin #<?= $attr['id_besoin'] ?></td>
                                            <td class="py-3 px-6 text-gray-700"><?= htmlspecialchars($attr['nom_ville']) ?></td>
                                            <td class="py-3 px-6">
                                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-emerald-100 text-emerald-700">
                                                    <?= number_format($attr['quantite_dispatch'], 0, ',', ' ') ?>
                                                </span>
                                            </td>
                                            <td class="py-3 px-6 text-gray-700"><?= date('d/m/Y H:i', strtotime($attr['date_dispatch'])) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endforeach; ?>

                <!-- Success Message -->
                <div class="glass-card rounded-xl p-5 mb-8 border-l-4 border-emerald-500 bg-emerald-50/80">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-emerald-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div class="flex-1">
                            <h3 class="font-semibold text-emerald-900 mb-1">Dispatch terminé</h3>
                            <p class="text-sm text-emerald-800">
                                Toutes les attributions ont été enregistrées avec succès. Les dons sont maintenant assignés aux besoins selon l'ordre FIFO.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Action Button -->
                <div class="text-center">
                    <a href="<?= Flight::get('flight.base_url') ?>test/dispatch" class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-teal-600 to-teal-700 text-white font-bold text-lg rounded-xl shadow-lg shadow-teal-500/30 hover:shadow-teal-500/50 hover:-translate-y-0.5 transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        Retour à la liste des dons
                    </a>
                </div>

            <?php else: ?>
                <!-- Error State -->
                <div class="glass-card rounded-xl p-12 text-center">
                    <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-3">Erreur lors du dispatch</h2>
                    <p class="text-gray-600 mb-6">Aucun don n'a pu être dispatché</p>
                    <a href="<?= Flight::get('flight.base_url') ?>test/dispatch" class="inline-flex items-center gap-2 px-6 py-3 bg-teal-600 text-white font-semibold rounded-xl hover:bg-teal-700 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Retour à la liste
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>
</body>
</html>
