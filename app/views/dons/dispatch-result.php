<?php include dirname(__DIR__) . '/partition/header.php'; ?>
    <section class="py-12 px-6">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-green-50 border border-green-200 rounded-full text-green-700 text-xs font-semibold uppercase tracking-wider mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Dispatch Automatique
                </div>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 tracking-tight mb-3">
                    Don Ajouté et <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-600 to-emerald-500">Dispatché</span>
                </h1>
            </div>

            <!-- Alert -->
            <?php if ($nbAttributions > 0): ?>
                <div class="glass-card rounded-xl p-5 mb-8 border-l-4 border-green-500 bg-green-50/80">
                    <div class="flex items-start gap-3">
                        <svg class="w-6 h-6 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div class="flex-1">
                            <h3 class="font-bold text-green-900 mb-1 text-lg">Succès !</h3>
                            <p class="text-green-800">
                                Le don a été ajouté et dispatché automatiquement. <strong><?= $nbAttributions ?></strong> attribution(s) créée(s).
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
                            <h3 class="font-bold text-yellow-900 mb-1 text-lg">Don ajouté</h3>
                            <p class="text-yellow-800">
                                Le don a été enregistré mais aucun besoin ouvert ne correspond à cette catégorie. Le don reste disponible pour un dispatch ultérieur.
                            </p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="glass-card rounded-xl p-6 text-center shadow-lg">
                    <div class="text-sm text-gray-600 mb-2 font-medium">Don #</div>
                    <div class="text-4xl font-bold text-gray-900"><?= $don['id'] ?></div>
                </div>
                <div class="glass-card rounded-xl p-6 text-center shadow-lg">
                    <div class="text-sm text-gray-600 mb-2 font-medium">Quantité totale</div>
                    <div class="text-4xl font-bold text-gray-900"><?= number_format($don['quantite'], 0, ',', ' ') ?></div>
                </div>
                <div class="glass-card rounded-xl p-6 text-center shadow-lg">
                    <div class="text-sm text-gray-600 mb-2 font-medium">Quantité dispatchée</div>
                    <div class="text-4xl font-bold text-green-600"><?= number_format($utilise, 0, ',', ' ') ?></div>
                </div>
                <div class="glass-card rounded-xl p-6 text-center shadow-lg">
                    <div class="text-sm text-gray-600 mb-2 font-medium">Reste disponible</div>
                    <div class="text-4xl font-bold <?= $reste > 0 ? 'text-green-600' : 'text-gray-900' ?>">
                        <?= number_format($reste, 0, ',', ' ') ?>
                    </div>
                </div>
            </div>

            <!-- Don Information -->
            <div class="glass-card rounded-2xl p-8 shadow-xl mb-6">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-teal-500 to-teal-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Informations du Don</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <tbody class="divide-y divide-gray-100">
                            <tr class="hover:bg-teal-50/30">
                                <th class="py-4 px-6 text-left font-semibold text-gray-900 bg-teal-50/50">Catégorie</th>
                                <td class="py-4 px-6 text-gray-700"><?= htmlspecialchars($don['nom_categorie']) ?></td>
                            </tr>
                            <tr class="hover:bg-teal-50/30">
                                <th class="py-4 px-6 text-left font-semibold text-gray-900 bg-teal-50/50">Type</th>
                                <td class="py-4 px-6 text-gray-700"><?= htmlspecialchars($don['nom_type_besoin']) ?></td>
                            </tr>
                            <tr class="hover:bg-teal-50/30">
                                <th class="py-4 px-6 text-left font-semibold text-gray-900 bg-teal-50/50">Prix unitaire</th>
                                <td class="py-4 px-6 text-gray-700"><?= number_format($don['pu'], 0, ',', ' ') ?> Ar</td>
                            </tr>
                            <tr class="hover:bg-teal-50/30">
                                <th class="py-4 px-6 text-left font-semibold text-gray-900 bg-teal-50/50">Date de saisie</th>
                                <td class="py-4 px-6 text-gray-700"><?= date('d/m/Y H:i', strtotime($don['date_saisie'])) ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Attributions Created -->
            <?php if (!empty($attributions)): ?>
                <div class="glass-card rounded-2xl p-8 shadow-xl mb-6">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900">Attributions Créées (<?= count($attributions) ?>)</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b-2 border-green-200 bg-gradient-to-r from-green-500 to-green-600">
                                    <th class="text-left py-4 px-6 text-white font-semibold text-sm">Attribution</th>
                                    <th class="text-left py-4 px-6 text-white font-semibold text-sm">Besoin</th>
                                    <th class="text-left py-4 px-6 text-white font-semibold text-sm">Ville</th>
                                    <th class="text-left py-4 px-6 text-white font-semibold text-sm">Quantité dispatchée</th>
                                    <th class="text-left py-4 px-6 text-white font-semibold text-sm">Date</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <?php foreach ($attributions as $attr): ?>
                                    <tr class="hover:bg-green-50/50 transition-colors">
                                        <td class="py-4 px-6 font-bold text-gray-900">#<?= $attr['id'] ?></td>
                                        <td class="py-4 px-6 text-gray-700">Besoin #<?= $attr['id_besoin'] ?></td>
                                        <td class="py-4 px-6 text-gray-700"><?= htmlspecialchars($attr['nom_ville']) ?></td>
                                        <td class="py-4 px-6">
                                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                <?= number_format($attr['quantite_dispatch'], 0, ',', ' ') ?>
                                            </span>
                                        </td>
                                        <td class="py-4 px-6 text-gray-700"><?= date('d/m/Y H:i', strtotime($attr['date_dispatch'])) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Remaining Open Needs -->
            <?php if (!empty($besoinsOuverts)): ?>
                <div class="glass-card rounded-2xl p-8 shadow-xl mb-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900">Besoins Ouverts Restants (<?= count($besoinsOuverts) ?>)</h2>
                    </div>
                    <p class="text-gray-600 mb-4">
                        Ces besoins n'ont pas pu être satisfaits car la quantité du don était insuffisante.
                    </p>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b-2 border-yellow-200 bg-gradient-to-r from-yellow-500 to-yellow-600">
                                    <th class="text-left py-4 px-6 text-white font-semibold text-sm">Besoin</th>
                                    <th class="text-left py-4 px-6 text-white font-semibold text-sm">Ville</th>
                                    <th class="text-left py-4 px-6 text-white font-semibold text-sm">Région</th>
                                    <th class="text-left py-4 px-6 text-white font-semibold text-sm">Reste à satisfaire</th>
                                    <th class="text-left py-4 px-6 text-white font-semibold text-sm">Date besoin</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <?php foreach ($besoinsOuverts as $besoin): ?>
                                    <tr class="hover:bg-yellow-50/50 transition-colors">
                                        <td class="py-4 px-6 font-bold text-gray-900">#<?= $besoin['id'] ?></td>
                                        <td class="py-4 px-6 text-gray-700"><?= htmlspecialchars($besoin['nom_ville']) ?></td>
                                        <td class="py-4 px-6 text-gray-700"><?= htmlspecialchars($besoin['nom_region']) ?></td>
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
                </div>
            <?php endif; ?>

            <!-- Actions -->
            <div class="flex flex-wrap justify-center gap-4 mt-8">
                <a href="<?= Flight::get('flight.base_url') ?>dons/create" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-teal-600 to-teal-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Ajouter un autre don
                </a>
                <a href="<?= Flight::get('flight.base_url') ?>test/dispatch" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-gray-600 to-gray-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    Voir tous les dons
                </a>
            </div>
        </div>
    </section>
    <?php include dirname(__DIR__) . '/partition/footer.php'; ?>
</body>
</html>
