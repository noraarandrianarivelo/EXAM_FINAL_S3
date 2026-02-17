<?php include dirname(__DIR__) . '/partition/header.php'; ?>
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
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-pink-50 border border-pink-200 rounded-full text-pink-700 text-xs font-semibold uppercase tracking-wider mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    Simulation Dispatch Proportionnel
                </div>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 tracking-tight mb-3">
                    Don #<span class="text-transparent bg-clip-text bg-gradient-to-r from-pink-600 to-pink-500"><?= $don['id'] ?></span>
                </h1>
                <p class="text-lg text-gray-600">
                    Prévisualisation du dispatch proportionnel (sans enregistrement)
                </p>
            </div>

            <!-- Don Information -->
            <div class="glass-card rounded-2xl p-8 shadow-xl mb-6">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-pink-500 to-pink-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Informations du Don</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div>
                        <span class="block text-sm text-gray-600 mb-1">Catégorie</span>
                        <span class="block text-lg font-semibold text-gray-900"><?= htmlspecialchars($don['nom_categorie']) ?></span>
                    </div>
                    <div>
                        <span class="block text-sm text-gray-600 mb-1">Type</span>
                        <span class="block text-lg font-semibold text-gray-900"><?= htmlspecialchars($don['nom_type_besoin']) ?></span>
                    </div>
                    <div>
                        <span class="block text-sm text-gray-600 mb-1">Stock disponible</span>
                        <span class="block text-lg font-semibold text-pink-600"><?= number_format($avant['reste'], 0, ',', ' ') ?></span>
                    </div>
                    <div>
                        <span class="block text-sm text-gray-600 mb-1">Déjà dispatché</span>
                        <span class="block text-lg font-semibold text-gray-900"><?= number_format($avant['utilise'], 0, ',', ' ') ?></span>
                    </div>
                </div>
            </div>

            <!-- Simulation Results -->
            <div class="glass-card rounded-2xl p-8 shadow-xl mb-6">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Résultats du Dispatch Proportionnel (<?= count($simulated) ?> besoins)</h2>
                </div>

                <?php if (!empty($simulated)): ?>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b-2 border-purple-200 bg-gradient-to-r from-purple-600 to-purple-700">
                                    <th class="text-left py-4 px-6 text-white font-semibold text-sm">Besoin</th>
                                    <th class="text-left py-4 px-6 text-white font-semibold text-sm">Ville</th>
                                    <th class="text-left py-4 px-6 text-white font-semibold text-sm">Région</th>
                                    <th class="text-center py-4 px-6 text-white font-semibold text-sm">Quantité Besoin</th>
                                    <th class="text-center py-4 px-6 text-white font-semibold text-sm">Part Exacte</th>
                                    <th class="text-center py-4 px-6 text-white font-semibold text-sm">Part Entière</th>
                                    <th class="text-center py-4 px-6 text-white font-semibold text-sm">Décimal</th>
                                    <th class="text-center py-4 px-6 text-white font-semibold text-sm">Après Reliquat</th>
                                    <th class="text-center py-4 px-6 text-white font-semibold text-sm">Reste</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <?php foreach ($simulated as $sim): ?>
                                    <tr class="hover:bg-purple-50/50 transition-colors">
                                        <td class="py-4 px-6 font-bold text-gray-900">#<?= $sim['besoin']['id'] ?></td>
                                        <td class="py-4 px-6 text-gray-700"><?= htmlspecialchars($sim['besoin']['nom_ville']) ?></td>
                                        <td class="py-4 px-6 text-gray-700"><?= htmlspecialchars($sim['besoin']['nom_region']) ?></td>
                                        <td class="py-4 px-6 text-center font-medium text-gray-900"><?= number_format($sim['besoin']['reste'], 0, ',', ' ') ?></td>
                                        <td class="py-4 px-6 text-center text-gray-700"><?= number_format($sim['part'], 2, ',', ' ') ?></td>
                                        <td class="py-4 px-6 text-center">
                                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold">
                                                <?= $sim['entier'] ?>
                                            </span>
                                        </td>
                                        <td class="py-4 px-6 text-center text-gray-700"><?= number_format($sim['decimal'], 4, ',', ' ') ?></td>
                                        <td class="py-4 px-6 text-center">
                                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-gradient-to-r from-purple-100 to-pink-100 text-purple-800 rounded-full text-sm font-semibold">
                                                <?= $sim['entier'] ?>
                                            </span>
                                        </td>
                                        <td class="py-4 px-6 text-center">
                                            <?php $reste = $sim['besoin']['reste'] - $sim['entier']; ?>
                                            <?php if ($reste == 0): ?>
                                                <span class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">
                                                    ✓ Couvert
                                                </span>
                                            <?php else: ?>
                                                <span class="inline-flex items-center gap-1 px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold">
                                                    <?= number_format($reste, 0, ',', ' ') ?> manque
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Info Box -->
                    <div class="glass-card rounded-xl p-5 mt-6 border-l-4 border-pink-500 bg-pink-50/80">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-pink-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="flex-1">
                                <h3 class="font-semibold text-pink-900 mb-1">Règle du Dispatch Proportionnel</h3>
                                <p class="text-sm text-pink-800">
                                    • Chaque besoin reçoit un nombre proportionnel arrondi à l'entier inférieur<br>
                                    • Le reliquat (décimales restantes) est distribué à ceux qui ont le plus grand décimal<br>
                                    • La quantité dispatchée ne dépasse jamais le besoin maximal
                                </p>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="glass-card rounded-xl p-5 border-l-4 border-yellow-500 bg-yellow-50/80">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-yellow-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                            <div class="flex-1">
                                <h3 class="font-bold text-yellow-900 mb-1">Aucun besoin à dispatcher</h3>
                                <p class="text-sm text-yellow-800">
                                    Aucun besoin ouvert pour cette catégorie ou le don a déjà été entièrement dispatché.
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Actions -->
            <div class="flex flex-wrap justify-center gap-4 mt-8">
                <a href="<?= Flight::get('flight.base_url') ?>test/dispatch/don/<?= $don['id'] ?>" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-gray-600 to-gray-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Retour
                </a>
                <form method="POST" action="<?= Flight::get('flight.base_url') ?>test/dispatch/don/<?= $don['id'] ?>/proportionnel">
                    <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-pink-600 to-pink-700 text-white font-semibold rounded-xl shadow-lg shadow-pink-500/30 hover:shadow-pink-500/50 hover:-translate-y-0.5 transition-all duration-300" onclick="return confirm('Êtes-vous sûr de vouloir valider ce dispatch proportionnel ? Cette action est définitive.');">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Valider le dispatch
                    </button>
                </form>
            </div>
        </div>
    </section>
    <?php include dirname(__DIR__) . '/partition/footer.php'; ?>
</body>
</html>
