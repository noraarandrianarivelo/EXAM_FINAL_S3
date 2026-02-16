<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BNGRC - Don #<?= $don['id'] ?></title>
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
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 via-teal-50/30 to-slate-100 min-h-screen">
    <section class="py-12 px-6">
        <div class="max-w-7xl mx-auto">
            <!-- Back Link -->
            <a href="<?= Flight::get('flight.base_url') ?>test/dispatch" class="inline-flex items-center gap-2 text-teal-600 hover:text-teal-700 font-medium mb-6 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Retour à la liste des dons
            </a>

            <!-- Header -->
            <div class="mb-8">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-teal-50 border border-teal-200 rounded-full text-teal-700 text-xs font-semibold uppercase tracking-wider mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    Pré-dispatch
                </div>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 tracking-tight mb-3">
                    Don #<span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-600 to-emerald-500"><?= $don['id'] ?></span>
                </h1>
                <p class="text-lg text-gray-600">
                    État du don avant dispatch automatique
                </p>
            </div>

            <!-- Don Information Card -->
            <div class="glass-card rounded-2xl p-8 shadow-xl mb-6">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-teal-500 to-teal-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Informations du Don</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div>
                        <span class="block text-sm text-gray-600 mb-1">Catégorie</span>
                        <span class="block text-xl font-semibold text-gray-900"><?= htmlspecialchars($don['nom_categorie']) ?></span>
                    </div>
                    <div>
                        <span class="block text-sm text-gray-600 mb-1">Type</span>
                        <span class="block text-xl font-semibold text-gray-900"><?= htmlspecialchars($don['nom_type_besoin']) ?></span>
                    </div>
                    <div>
                        <span class="block text-sm text-gray-600 mb-1">Quantité totale</span>
                        <span class="block text-xl font-semibold text-gray-900"><?= number_format($don['quantite'], 0, ',', ' ') ?></span>
                    </div>
                    <div>
                        <span class="block text-sm text-gray-600 mb-1">Prix unitaire</span>
                        <span class="block text-xl font-semibold text-gray-900"><?= number_format($don['pu'], 0, ',', ' ') ?> Ar</span>
                    </div>
                    <div>
                        <span class="block text-sm text-gray-600 mb-1">Déjà attribué</span>
                        <span class="block text-xl font-semibold text-gray-900"><?= number_format($utilise, 0, ',', ' ') ?></span>
                    </div>
                    <div>
                        <span class="block text-sm text-gray-600 mb-1">Reste disponible</span>
                        <?php if ($reste > 0): ?>
                            <span class="inline-flex items-center gap-2 px-4 py-2 bg-green-100 text-green-800 rounded-full text-lg font-semibold">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <?= number_format($reste, 0, ',', ' ') ?>
                            </span>
                        <?php elseif ($reste == 0): ?>
                            <span class="inline-flex items-center gap-2 px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full text-lg font-semibold">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                                0
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <?php if ($reste <= 0): ?>
                <div class="glass-card rounded-xl p-5 mb-6 border-l-4 border-yellow-500 bg-yellow-50/80">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-yellow-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <div class="flex-1">
                            <h3 class="font-semibold text-yellow-900 mb-1">Attention</h3>
                            <p class="text-sm text-yellow-800">
                                Ce don a déjà été entièrement dispatché. Aucune quantité disponible pour un nouveau dispatch.
                            </p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Open Needs -->
            <div class="glass-card rounded-2xl p-8 shadow-xl mb-6">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Besoins Ouverts pour "<?= htmlspecialchars($don['nom_categorie']) ?>"</h2>
                </div>
                
                <?php if (empty($besoins)): ?>
                    <div class="glass-card rounded-xl p-5 border-l-4 border-blue-500 bg-blue-50/80">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-sm text-blue-800">
                                Aucun besoin ouvert pour cette catégorie. Tous les besoins ont été satisfaits.
                            </p>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b-2 border-teal-200 bg-gradient-to-r from-teal-600 to-teal-700">
                                    <th class="text-left py-4 px-6 text-white font-semibold text-sm">ID</th>
                                    <th class="text-left py-4 px-6 text-white font-semibold text-sm">Ville</th>
                                    <th class="text-left py-4 px-6 text-white font-semibold text-sm">Région</th>
                                    <th class="text-left py-4 px-6 text-white font-semibold text-sm">Quantité totale</th>
                                    <th class="text-left py-4 px-6 text-white font-semibold text-sm">Reste à satisfaire</th>
                                    <th class="text-left py-4 px-6 text-white font-semibold text-sm">Date besoin</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <?php foreach ($besoins as $besoin): ?>
                                    <tr class="hover:bg-teal-50/50 transition-colors">
                                        <td class="py-4 px-6 font-bold text-gray-900">#<?= $besoin['id'] ?></td>
                                        <td class="py-4 px-6 text-gray-700"><?= htmlspecialchars($besoin['nom_ville']) ?></td>
                                        <td class="py-4 px-6 text-gray-700"><?= htmlspecialchars($besoin['nom_region']) ?></td>
                                        <td class="py-4 px-6 text-gray-900 font-medium"><?= number_format($besoin['quantite'], 0, ',', ' ') ?></td>
                                        <td class="py-4 px-6">
                                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold">
                                                <?= number_format($besoin['reste'], 0, ',', ' ') ?>
                                            </span>
                                        </td>
                                        <td class="py-4 px-6 text-gray-700"><?= date('d/m/Y H:i', strtotime($besoin['date_besoin'])) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Existing Attributions -->
            <?php if (!empty($attributions)): ?>
                <div class="glass-card rounded-2xl p-8 shadow-xl mb-6">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900">Attributions Existantes</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b-2 border-purple-200 bg-gradient-to-r from-purple-600 to-purple-700">
                                    <th class="text-left py-4 px-6 text-white font-semibold text-sm">ID</th>
                                    <th class="text-left py-4 px-6 text-white font-semibold text-sm">Besoin</th>
                                    <th class="text-left py-4 px-6 text-white font-semibold text-sm">Ville</th>
                                    <th class="text-left py-4 px-6 text-white font-semibold text-sm">Quantité</th>
                                    <th class="text-left py-4 px-6 text-white font-semibold text-sm">Date dispatch</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <?php foreach ($attributions as $attr): ?>
                                    <tr class="hover:bg-purple-50/50 transition-colors">
                                        <td class="py-4 px-6 font-bold text-gray-900">#<?= $attr['id'] ?></td>
                                        <td class="py-4 px-6 text-gray-700">Besoin #<?= $attr['id_besoin'] ?></td>
                                        <td class="py-4 px-6 text-gray-700"><?= htmlspecialchars($attr['nom_ville']) ?></td>
                                        <td class="py-4 px-6 text-gray-900 font-medium"><?= number_format($attr['quantite_dispatch'], 0, ',', ' ') ?></td>
                                        <td class="py-4 px-6 text-gray-700"><?= date('d/m/Y H:i', strtotime($attr['date_dispatch'])) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Dispatch Button -->
            <?php if ($reste > 0 && !empty($besoins)): ?>
                <div class="flex justify-center mt-8">
                    <form method="POST" action="<?= Flight::get('flight.base_url') ?>test/dispatch/don/<?= $don['id'] ?>">
                        <button type="submit" class="inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-teal-600 to-teal-700 text-white font-bold text-lg rounded-xl shadow-lg shadow-teal-500/30 hover:shadow-teal-500/50 hover:-translate-y-0.5 transition-all duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            Exécuter le dispatch automatique
                        </button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </section>
</body>
</html>
