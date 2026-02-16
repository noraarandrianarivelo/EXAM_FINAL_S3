<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BNGRC - Simulation Dispatch Général</title>
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
            background: #2563eb;
            color: white;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.6);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 via-indigo-50/30 to-blue-100 min-h-screen">
    <section class="py-12 px-6">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <a href="<?= Flight::get('flight.base_url') ?>test/dispatch" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-medium mb-6 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Retour à la liste
                </a>

                <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 border border-blue-200 rounded-full text-blue-700 text-xs font-semibold uppercase tracking-wider mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    Mode Simulation
                </div>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 tracking-tight mb-3">
                    📊 Simulation Dispatch <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-500">Général</span>
                </h1>
                <p class="text-lg text-gray-600">
                    Prévisualisation du dispatch de tous les dons - <strong class="text-blue-600">Aucune donnée n'a été enregistrée</strong>
                </p>
            </div>

            <?php if ($resultat['success']): ?>
                <!-- Success Alert -->
                <div class="glass-card rounded-xl p-5 mb-6 border-l-4 border-blue-500 bg-blue-50/80">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div class="flex-1">
                            <h3 class="font-semibold text-blue-900 mb-1">Simulation réussie</h3>
                            <p class="text-sm text-blue-800">
                                <strong><?= $resultat['nb_dons_a_dispatcher'] ?></strong> don(s) seraient dispatchés vers <strong><?= $resultat['nb_besoins_couverts'] ?></strong> besoin(s) pour un total de <strong><?= number_format($resultat['quantite_totale_dispatchee'], 0, ',', ' ') ?></strong> unités. Les données ne sont pas encore enregistrées dans la base.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="glass-card rounded-xl p-6 shadow-xl">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-600">Dons à dispatcher</span>
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-100 to-blue-200 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-900 mb-1"><?= $resultat['nb_dons_a_dispatcher'] ?></h3>
                        <p class="text-xs text-gray-500">Avec quantité disponible</p>
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
                        <p class="text-xs text-gray-500">Attributions potentielles</p>
                    </div>

                    <div class="glass-card rounded-xl p-6 shadow-xl">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-600">Total dispatché</span>
                            <div class="w-10 h-10 bg-gradient-to-br from-purple-100 to-purple-200 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-900 mb-1"><?= number_format($resultat['quantite_totale_dispatchee'], 0, ',', ' ') ?></h3>
                        <p class="text-xs text-gray-500">Unités totales</p>
                    </div>
                </div>

                <!-- Résultats par Don -->
                <?php foreach ($resultat['resultats'] as $res): ?>
                    <div class="glass-card rounded-xl shadow-xl overflow-hidden mb-6">
                        <!-- Don Header -->
                        <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-white font-bold text-lg">Don #<?= $res['don']['id'] ?> - <?= htmlspecialchars($res['don']['nom_categorie']) ?></h3>
                                    <p class="text-blue-100 text-sm"><?= htmlspecialchars($res['don']['nom_type_besoin']) ?></p>
                                </div>
                                <div class="text-right">
                                    <p class="text-white text-2xl font-bold"><?= number_format($res['simulation']['quantite_dispatched'], 0, ',', ' ') ?></p>
                                    <p class="text-blue-100 text-xs">Sera dispatché</p>
                                </div>
                            </div>
                        </div>

                        <!-- Attributions Table -->
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b-2 border-blue-200 bg-blue-50">
                                        <th class="text-left py-3 px-6 text-blue-900 font-semibold text-sm">Besoin</th>
                                        <th class="text-left py-3 px-6 text-blue-900 font-semibold text-sm">Ville</th>
                                        <th class="text-left py-3 px-6 text-blue-900 font-semibold text-sm">Région</th>
                                        <th class="text-left py-3 px-6 text-blue-900 font-semibold text-sm">Qté Besoin</th>
                                        <th class="text-left py-3 px-6 text-blue-900 font-semibold text-sm">Reste Avant</th>
                                        <th class="text-left py-3 px-6 text-blue-900 font-semibold text-sm">Qté Dispatché</th>
                                        <th class="text-left py-3 px-6 text-blue-900 font-semibold text-sm">Reste Après</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 bg-white/50">
                                    <?php foreach ($res['simulation']['attributions'] as $attr): ?>
                                        <tr class="hover:bg-blue-50/50 transition-colors">
                                            <td class="py-3 px-6 font-bold text-gray-900">#<?= $attr['id_besoin'] ?></td>
                                            <td class="py-3 px-6 text-gray-700"><?= htmlspecialchars($attr['ville']) ?></td>
                                            <td class="py-3 px-6 text-gray-700"><?= htmlspecialchars($attr['region']) ?></td>
                                            <td class="py-3 px-6 text-gray-900 font-medium"><?= number_format($attr['quantite_besoin'], 0, ',', ' ') ?></td>
                                            <td class="py-3 px-6 text-gray-700"><?= number_format($attr['reste_besoin_avant'], 0, ',', ' ') ?></td>
                                            <td class="py-3 px-6">
                                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-700">
                                                    +<?= number_format($attr['quantite_dispatch'], 0, ',', ' ') ?>
                                                </span>
                                            </td>
                                            <td class="py-3 px-6">
                                                <?php if ($attr['reste_besoin_après'] == 0): ?>
                                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                                                        ✓ Couvert
                                                    </span>
                                                <?php else: ?>
                                                    <span class="text-gray-700 font-medium"><?= number_format($attr['reste_besoin_après'], 0, ',', ' ') ?></span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endforeach; ?>

                <!-- Warning Box -->
                <div class="glass-card rounded-xl p-5 mb-8 border-l-4 border-yellow-500 bg-yellow-50/80">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-yellow-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <div class="flex-1">
                            <h3 class="font-semibold text-yellow-900 mb-1">Attention - Simulation uniquement</h3>
                            <p class="text-sm text-yellow-800">
                                Cette simulation montre le résultat du dispatch sans enregistrer les données. Pour enregistrer les attributions dans la base de données, cliquez sur <strong>"Valider le dispatch"</strong>.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="<?= Flight::get('flight.base_url') ?>test/dispatch" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-gray-600 text-white font-bold text-lg rounded-xl shadow-lg hover:bg-gray-700 hover:-translate-y-0.5 transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Annuler
                    </a>
                    <form method="POST" action="<?= Flight::get('flight.base_url') ?>test/dispatch/valider-tout">
                        <button type="submit" onclick="return confirm('⚠️ Confirmer le dispatch de <?= $resultat['nb_dons_a_dispatcher'] ?> don(s) vers <?= $resultat['nb_besoins_couverts'] ?> besoin(s) ?');" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white font-bold text-lg rounded-xl shadow-lg shadow-emerald-500/30 hover:shadow-emerald-500/50 hover:-translate-y-0.5 transition-all duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Valider le dispatch
                        </button>
                    </form>
                </div>

            <?php else: ?>
                <!-- Empty State -->
                <div class="glass-card rounded-xl p-12 text-center">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-3">Aucun don disponible</h2>
                    <p class="text-gray-600 mb-6">Tous les dons sont déjà dispatchés ou aucun besoin ouvert n'est disponible</p>
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
