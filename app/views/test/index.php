<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BNGRC - Gestion des Dons</title>
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
        @keyframes shimmer {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
        .progress-bar {
            background: linear-gradient(90deg, #14b8a6, #0d9488, #0f766e);
            background-size: 200% 100%;
            animation: shimmer 2s linear infinite;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 via-teal-50/30 to-slate-100 min-h-screen">
    <!-- Header Section -->
    <section class="pt-24 pb-12 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
                <div>
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-teal-50 border border-teal-200 rounded-full text-teal-700 text-xs font-semibold uppercase tracking-wider mb-4">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                        Gestion des Dons
                    </div>
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 tracking-tight mb-3">
                        📦 Dispatch <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-600 to-emerald-500">Automatique</span>
                    </h1>
                    <p class="text-lg text-gray-600">
                        Les dons sont automatiquement dispatchés aux besoins ouverts selon l'ordre FIFO
                    </p>
                </div>
                <div class="mt-6 md:mt-0">
                    <a href="<?= Flight::get('flight.base_url') ?>dons/create" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-teal-600 to-teal-700 text-white font-semibold rounded-xl shadow-lg shadow-teal-500/30 hover:shadow-teal-500/50 hover:-translate-y-0.5 transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Ajouter un don
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="pb-16 px-6">
        <div class="max-w-7xl mx-auto">
            <?php if (empty($dons)): ?>
                <!-- Empty State -->
                <div class="glass-card rounded-2xl p-16 text-center shadow-xl">
                    <div class="w-24 h-24 bg-gradient-to-br from-teal-100 to-teal-200 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-3">Aucun don disponible</h2>
                    <p class="text-gray-600 mb-8">Ajoutez votre premier don pour commencer le dispatch automatique</p>
                    <a href="<?= Flight::get('flight.base_url') ?>dons/create" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-teal-600 to-teal-700 text-white font-semibold rounded-xl shadow-lg shadow-teal-500/30 hover:shadow-teal-500/50 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Ajouter un don
                    </a>
                </div>
            <?php else: ?>
                <!-- Dons Table -->
                <div class="glass-card rounded-2xl shadow-xl overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gradient-to-r from-teal-600 to-teal-700 text-white">
                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">Catégorie</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">Type</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">Quantité</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">Dispatché</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">Reste</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white/50 divide-y divide-gray-200">
                                <?php foreach ($dons as $don): ?>
                                    <tr class="hover:bg-white/80 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="font-bold text-gray-900">#<?= htmlspecialchars($don['id']) ?></span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-700">
                                                <?= htmlspecialchars($don['nom_categorie']) ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <?= htmlspecialchars($don['nom_type_besoin']) ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="font-bold text-gray-900"><?= number_format($don['quantite'], 0, ',', ' ') ?></span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="font-bold text-gray-900"><?= number_format($don['utilise'], 0, ',', ' ') ?></div>
                                            <?php if ($don['nb_attributions'] > 0): ?>
                                                <div class="text-xs text-gray-500">(<?= $don['nb_attributions'] ?> attribution<?= $don['nb_attributions'] > 1 ? 's' : '' ?>)</div>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <?php if ($don['reste'] > 0): ?>
                                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                                                    <?= number_format($don['reste'], 0, ',', ' ') ?>
                                                </span>
                                            <?php else: ?>
                                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-600">0</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?php 
                                            $pourcentage = $don['quantite'] > 0 ? ($don['utilise'] / $don['quantite']) * 100 : 0;
                                            ?>
                                            <div class="flex items-center gap-2 mb-1">
                                                <?php if ($pourcentage == 100): ?>
                                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">✓ Complet</span>
                                                <?php elseif ($pourcentage > 0): ?>
                                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-700">⏳ Partiel</span>
                                                <?php else: ?>
                                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">✗ Nouveau</span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="w-full bg-gray-200 rounded-full h-1.5">
                                                <div class="progress-bar h-1.5 rounded-full" style="width: <?= $pourcentage ?>%"></div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            <?= date('d/m/Y', strtotime($don['date_saisie'])) ?><br>
                                            <span class="text-xs text-gray-400"><?= date('H:i', strtotime($don['date_saisie'])) ?></span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="<?= Flight::get('flight.base_url') ?>test/dispatch/don/<?= $don['id'] ?>" class="inline-flex items-center gap-1 px-4 py-2 bg-teal-600 text-white text-sm font-medium rounded-lg hover:bg-teal-700 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                Détails
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
</body>
</html>
