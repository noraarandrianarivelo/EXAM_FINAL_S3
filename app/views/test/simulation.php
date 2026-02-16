<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BNGRC - Simulation Dispatch</title>
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
            font-family: 'Plus Jakarta Sans', sans-serif';
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
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 via-blue-50/30 to-slate-100 min-h-screen">
    <section class="py-12 px-6">
        <div class="max-w-7xl mx-auto">
            <!-- Back Link -->
            <a href="<?= Flight::get('flight.base_url') ?>test/dispatch/don/<?= $don['id'] ?>" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-medium mb-6 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Retour au don
            </a>

            <!-- Header -->
            <div class="mb-8">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 border border-blue-200 rounded-full text-blue-700 text-xs font-semibold uppercase tracking-wider mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    Simulation Dispatch
                </div>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 tracking-tight mb-3">
                    Don #<span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-500"><?= $don['id'] ?></span>
                </h1>
                <p class="text-lg text-gray-600">
                    Prévisualisation du dispatch - <strong>Aucune donnée n'a été enregistrée</strong>
                </p>
            </div>

            <!-- Alert -->
            <?php if ($simulation['success']): ?>
                <div class="glass-card rounded-xl p-5 mb-8 border-l-4 border-blue-500 bg-blue-50/80">
                    <div class="flex items-start gap-3">
                        <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div class="flex-1">
                            <h3 class="font-bold text-blue-900 mb-1 text-lg">Simulation réussie</h3>
                            <p class="text-blue-800">
                                <?= $simulation['nb_besoins_couverts'] ?> besoin(s) seraient couverts par ce dispatch. 
                                <strong>Les données ne sont pas enregistrées.</strong> Validez pour confirmer.
                            </p>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="glass-card rounded-xl p-5 mb-8 border-l-4 border-yellow-500 bg-yellow-50/80">
                    <div class="flex items-start gap-3">
                        <svg class="w-6 h-6 text-yellow-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <div class="flex-1">
                            <h3 class="font-bold text-yellow-900 mb-1 text-lg">Attention</h3>
                            <p class="text-yellow-800">
                                <?= htmlspecialchars($simulation['message']) ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($simulation['success']): ?>
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="glass-card rounded-xl p-6 text-center shadow-lg border-l-4 border-gray-400">
                        <div class="text-sm text-gray-600 mb-2 font-medium">Quantité totale</div>
                        <div class="text-3xl font-bold text-gray-900"><?= number_format($simulation['quantite_totale'], 0, ',', ' ') ?></div>
                    </div>
                    <div class="glass-card rounded-xl p-6 text-center shadow-lg border-l-4 border-red-400">
                        <div class="text-sm text-gray-600 mb-2 font-medium">Déjà utilisé</div>
                        <div class="text-3xl font-bold text-red-600"><?= number_format($simulation['quantite_deja_utilisee'], 0, ',', ' ') ?></div>
                    </div>
                    <div class="glass-card rounded-xl p-6 text-center shadow-lg border-l-4 border-blue-400">
                        <div class="text-sm text-gray-600 mb-2 font-medium">Sera dispatché</div>
                        <div class="text-3xl font-bold text-blue-600"><?= number_format($simulation['quantite_dispatched'], 0, ',', ' ') ?></div>
                    </div>
                    <div class="glass-card rounded-xl p-6 text-center shadow-lg border-l-4 border-emerald-400">
                        <div class="text-sm text-gray-600 mb-2 font-medium">Restera disponible</div>
                        <div class="text-3xl font-bold text-emerald-600"><?= number_format($simulation['quantite_restante'], 0, ',', ' ') ?></div>
                    </div>
                </div>

                <!-- Simulated Attributions -->
                <div class="glass-card rounded-2xl p-8 shadow-xl mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900">Attributions Simulées</h2>
                        </div>
                        <span class="px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold">
                            <?= count($simulation['attributions']) ?> attribution(s)
                        </span>
                    </div>

                    <div class="overflow-x-auto rounded-lg border border-gray-200">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b-2 border-blue-200 bg-gradient-to-r from-blue-600 to-blue-700">
                                    <th class="text-left py-4 px-6 text-white font-semibold text-sm">Besoin ID</th>
                                    <th class="text-left py-4 px-6 text-white font-semibold text-sm">Ville</th>
                                    <th class="text-left py-4 px-6 text-white font-semibold text-sm">Région</th>
                                    <th class="text-right py-4 px-6 text-white font-semibold text-sm">Qté Besoin</th>
                                    <th class="text-right py-4 px-6 text-white font-semibold text-sm">Reste Avant</th>
                                    <th class="text-right py-4 px-6 text-white font-semibold text-sm">Qté Dispatché</th>
                                    <th class="text-right py-4 px-6 text-white font-semibold text-sm">Reste Après</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <?php foreach ($simulation['attributions'] as $attr): ?>
                                    <tr class="hover:bg-blue-50/50 transition-colors">
                                        <td class="py-4 px-6 font-bold text-gray-900">#<?= $attr['id_besoin'] ?></td>
                                        <td class="py-4 px-6 text-gray-700"><?= htmlspecialchars($attr['ville']) ?></td>
                                        <td class="py-4 px-6 text-gray-700"><?= htmlspecialchars($attr['region']) ?></td>
                                        <td class="py-4 px-6 text-right text-gray-900 font-medium"><?= number_format($attr['quantite_besoin'], 0, ',', ' ') ?></td>
                                        <td class="py-4 px-6 text-right text-gray-600"><?= number_format($attr['reste_besoin_avant'], 0, ',', ' ') ?></td>
                                        <td class="py-4 px-6 text-right">
                                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full font-semibold">
                                                <?= number_format($attr['quantite_dispatch'], 0, ',', ' ') ?>
                                            </span>
                                        </td>
                                        <td class="py-4 px-6 text-right">
                                            <?php if ($attr['reste_besoin_après'] == 0): ?>
                                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full font-semibold">
                                                    0 ✓
                                                </span>
                                            <?php else: ?>
                                                <span class="text-gray-900 font-medium"><?= number_format($attr['reste_besoin_après'], 0, ',', ' ') ?></span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row justify-center gap-4 mt-8">
                    <a href="<?= Flight::get('flight.base_url') ?>test/dispatch/don/<?= $don['id'] ?>" class="inline-flex items-center gap-3 px-8 py-4 bg-gray-500 hover:bg-gray-600 text-white font-bold text-lg rounded-xl shadow-lg transition-all duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Annuler
                    </a>
                    
                    <form method="POST" action="<?= Flight::get('flight.base_url') ?>test/dispatch/don/<?= $don['id'] ?>">
                        <button type="submit" class="inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white font-bold text-lg rounded-xl shadow-lg shadow-emerald-500/30 hover:shadow-emerald-500/50 hover:-translate-y-0.5 transition-all duration-300" onclick="return confirm('Êtes-vous sûr de vouloir valider ce dispatch ? Cette action enregistrera <?= $simulation['nb_besoins_couverts'] ?> attribution(s) dans la base de données.');">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Valider le dispatch
                        </button>
                    </form>
                </div>

                <!-- Info Box -->
                <div class="glass-card rounded-xl p-5 mt-6 border-l-4 border-yellow-500 bg-yellow-50/80">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-yellow-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <div class="flex-1">
                            <h3 class="font-semibold text-yellow-900 mb-1">Important</h3>
                            <p class="text-sm text-yellow-800">
                                Cette simulation montre le résultat du dispatch <strong>sans enregistrer les données</strong>. 
                                Pour enregistrer les attributions dans la base de données, cliquez sur <strong>"Valider le dispatch"</strong>.
                            </p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
</body>
</html>
