<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BNGRC - Liste des Achats</title>
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
            <a href="<?= Flight::get('flight.base_url') ?>" class="inline-flex items-center gap-2 text-teal-600 hover:text-teal-700 font-medium mb-6 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Retour au dashboard
            </a>

            <!-- Header -->
            <div class="mb-8">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-teal-50 border border-teal-200 rounded-full text-teal-700 text-xs font-semibold uppercase tracking-wider mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                    Historique des achats
                </div>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 tracking-tight mb-3">
                    Liste des <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-600 to-emerald-500">Achats</span>
                </h1>
                <p class="text-lg text-gray-600">
                    Tous les achats effectués avec les dons en argent
                </p>
            </div>

            <!-- Stats Card -->
            <?php 
                $totalAchats = count($achats);
                $montantTotalAchats = array_sum(array_column($achats, 'montant_total'));
                $quantiteTotaleAchetee = array_sum(array_column($achats, 'quantite_achetee'));
            ?>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Total Achats -->
                <div class="glass-card rounded-2xl p-6 border-l-4 border-blue-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Total Achats</p>
                            <p class="text-3xl font-bold text-gray-900"><?= $totalAchats ?></p>
                        </div>
                        <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Montant Total -->
                <div class="glass-card rounded-2xl p-6 border-l-4 border-emerald-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Montant Total</p>
                            <p class="text-3xl font-bold text-gray-900"><?= number_format($montantTotalAchats, 0, ',', ' ') ?> <span class="text-lg text-gray-600">Ar</span></p>
                        </div>
                        <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Quantité Totale -->
                <div class="glass-card rounded-2xl p-6 border-l-4 border-teal-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Quantité Achetée</p>
                            <p class="text-3xl font-bold text-gray-900"><?= number_format($quantiteTotaleAchetee, 0, ',', ' ') ?></p>
                        </div>
                        <div class="w-14 h-14 bg-gradient-to-br from-teal-500 to-teal-600 rounded-xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filtres -->
            <div class="glass-card rounded-2xl p-6 mb-8">
                <form method="GET" action="<?= Flight::get('flight.base_url') ?>achats" class="flex flex-wrap gap-4 items-end">
                    <div class="flex-1 min-w-64">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Filtrer par ville</label>
                        <select name="id_ville" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-500/20 transition-all outline-none">
                            <option value="">Toutes les villes</option>
                            <?php foreach ($villes as $ville): ?>
                                <option value="<?= $ville['id'] ?>" <?= $id_ville_selected == $ville['id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($ville['nom']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="px-6 py-3 bg-gradient-to-r from-teal-600 to-emerald-600 hover:from-teal-700 hover:to-emerald-700 text-white font-semibold rounded-xl transition-all shadow-lg">
                        Filtrer
                    </button>
                    <?php if ($id_ville_selected): ?>
                        <a href="<?= Flight::get('flight.base_url') ?>achats" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-xl transition-all">
                            Réinitialiser
                        </a>
                    <?php endif; ?>
                </form>
            </div>

            <!-- Actions -->
            <div class="mb-6">
                <a href="<?= Flight::get('flight.base_url') ?>achats/besoins-achetables" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-teal-600 to-emerald-600 hover:from-teal-700 hover:to-emerald-700 text-white font-semibold rounded-xl transition-all shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Faire un nouvel achat
                </a>
            </div>

            <!-- Table -->
            <?php if (empty($achats)): ?>
                <div class="glass-card rounded-2xl p-8 text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-gray-400 to-gray-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Aucun achat trouvé</h3>
                    <p class="text-gray-600 mb-6">Commencez par faire un achat pour couvrir les besoins non satisfaits</p>
                    <a href="<?= Flight::get('flight.base_url') ?>achats/besoins-achetables" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-teal-600 to-emerald-600 hover:from-teal-700 hover:to-emerald-700 text-white font-semibold rounded-xl transition-all shadow-lg">
                        Voir les besoins achetables
                    </a>
                </div>
            <?php else: ?>
                <div class="glass-card rounded-2xl overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gradient-to-r from-teal-600 to-emerald-600 text-white">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Ville</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Catégorie</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Type</th>
                                    <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider">Quantité</th>
                                    <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider">PU</th>
                                    <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider">Frais</th>
                                    <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider">Montant Total</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Date Achat</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <?php foreach ($achats as $achat): ?>
                                    <tr class="hover:bg-teal-50/50 transition-colors">
                                        <td class="px-6 py-4">
                                            <span class="font-mono text-sm text-gray-600">#<?= $achat['id'] ?></span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="font-semibold text-gray-900"><?= htmlspecialchars($achat['nom_ville']) ?></span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="text-gray-700"><?= htmlspecialchars($achat['nom_categorie']) ?></span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                                <?= $achat['type_besoin'] == 'Nature' ? 'bg-green-100 text-green-800' : 'bg-orange-100 text-orange-800' ?>">
                                                <?= htmlspecialchars($achat['type_besoin']) ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <span class="font-bold text-lg text-gray-900"><?= number_format($achat['quantite_achetee'], 0, ',', ' ') ?></span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <span class="text-gray-700"><?= number_format($achat['montant_unitaire'], 0, ',', ' ') ?></span>
                                            <span class="text-xs text-gray-500">Ar</span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800">
                                                <?= $achat['frais_pourcentage'] ?>%
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <span class="font-bold text-lg text-emerald-600"><?= number_format($achat['montant_total'], 0, ',', ' ') ?></span>
                                            <span class="text-sm text-gray-500">Ar</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="text-sm text-gray-600"><?= date('d/m/Y H:i', strtotime($achat['date_achat'])) ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot class="bg-gray-50">
                                <tr class="font-bold">
                                    <td colspan="4" class="px-6 py-4 text-right text-gray-700">TOTAUX:</td>
                                    <td class="px-6 py-4 text-right text-gray-900"><?= number_format($quantiteTotaleAchetee, 0, ',', ' ') ?></td>
                                    <td class="px-6 py-4"></td>
                                    <td class="px-6 py-4"></td>
                                    <td class="px-6 py-4 text-right text-emerald-600"><?= number_format($montantTotalAchats, 0, ',', ' ') ?> Ar</td>
                                    <td class="px-6 py-4"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
</body>
</html>
