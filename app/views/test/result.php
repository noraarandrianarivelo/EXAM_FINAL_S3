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
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-green-50 border border-green-200 rounded-full text-green-700 text-xs font-semibold uppercase tracking-wider mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Résultat Dispatch
                </div>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 tracking-tight mb-3">
                    Don #<span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-600 to-emerald-500"><?= $don['id'] ?></span>
                </h1>
            </div>

            <!-- Alert -->
            <?php if ($resultat): ?>
                <div class="glass-card rounded-xl p-5 mb-8 border-l-4 border-green-500 bg-green-50/80">
                    <div class="flex items-start gap-3">
                        <svg class="w-6 h-6 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div class="flex-1">
                            <h3 class="font-bold text-green-900 mb-1 text-lg">Succès !</h3>
                            <p class="text-green-800">
                                Le dispatch a été exécuté avec succès. <?= count($nouvelles) ?> nouvelle(s) attribution(s) créée(s).
                            </p>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="glass-card rounded-xl p-5 mb-8 border-l-4 border-red-500 bg-red-50/80">
                    <div class="flex items-start gap-3">
                        <svg class="w-6 h-6 text-red-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div class="flex-1">
                            <h3 class="font-bold text-red-900 mb-1 text-lg">Échec</h3>
                            <p class="text-red-800">
                                Le dispatch n'a pas pu être exécuté (don vide ou déjà entièrement dispatché).
                            </p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="glass-card rounded-xl p-6 text-center shadow-lg">
                    <div class="text-sm text-gray-600 mb-2 font-medium">Quantité totale</div>
                    <div class="text-4xl font-bold text-gray-900"><?= number_format($don['quantite'], 0, ',', ' ') ?></div>
                </div>
                <div class="glass-card rounded-xl p-6 text-center shadow-lg">
                    <div class="text-sm text-gray-600 mb-2 font-medium">Quantité utilisée</div>
                    <div class="text-4xl font-bold text-gray-900"><?= number_format($apres['utilise'], 0, ',', ' ') ?></div>
                    <?php if ($apres['utilise'] > $avant['utilise']): ?>
                        <div class="text-sm text-green-600 font-semibold mt-2">
                            +<?= number_format($apres['utilise'] - $avant['utilise'], 0, ',', ' ') ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="glass-card rounded-xl p-6 text-center shadow-lg">
                    <div class="text-sm text-gray-600 mb-2 font-medium">Reste disponible</div>
                    <div class="text-4xl font-bold text-gray-900"><?= number_format($apres['reste'], 0, ',', ' ') ?></div>
                    <?php if ($apres['reste'] < $avant['reste']): ?>
                        <div class="text-sm text-red-600 font-semibold mt-2">
                            <?= number_format($apres['reste'] - $avant['reste'], 0, ',', ' ') ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Comparison Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- AVANT -->
                <div class="glass-card rounded-2xl p-8 shadow-xl">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-gray-500 to-gray-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900">AVANT le dispatch</h2>
                    </div>
                    
                    <h3 class="text-lg font-semibold text-gray-900 mt-6 mb-3">Besoins ouverts (<?= count($avant['besoins']) ?>)</h3>
                    <?php if (empty($avant['besoins'])): ?>
                        <p class="text-gray-500 italic">Aucun besoin ouvert</p>
                    <?php else: ?>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b-2 border-gray-300 bg-gradient-to-r from-gray-500 to-gray-600">
                                        <th class="text-left py-3 px-4 text-white font-semibold text-sm">Besoin</th>
                                        <th class="text-left py-3 px-4 text-white font-semibold text-sm">Ville</th>
                                        <th class="text-left py-3 px-4 text-white font-semibold text-sm">Reste</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    <?php foreach ($avant['besoins'] as $besoin): ?>
                                        <tr class="hover:bg-gray-50/50">
                                            <td class="py-3 px-4 font-bold text-gray-900">#<?= $besoin['id'] ?></td>
                                            <td class="py-3 px-4 text-gray-700"><?= htmlspecialchars($besoin['nom_ville']) ?></td>
                                            <td class="py-3 px-4 text-gray-900 font-medium"><?= number_format($besoin['reste'], 0, ',', ' ') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>

                    <h3 class="text-lg font-semibold text-gray-900 mt-6 mb-3">Attributions (<?= count($avant['attributions']) ?>)</h3>
                    <?php if (empty($avant['attributions'])): ?>
                        <p class="text-gray-500 italic">Aucune attribution</p>
                    <?php else: ?>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b-2 border-gray-300 bg-gradient-to-r from-gray-500 to-gray-600">
                                        <th class="text-left py-3 px-4 text-white font-semibold text-sm">ID</th>
                                        <th class="text-left py-3 px-4 text-white font-semibold text-sm">Ville</th>
                                        <th class="text-left py-3 px-4 text-white font-semibold text-sm">Quantité</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    <?php foreach ($avant['attributions'] as $attr): ?>
                                        <tr class="hover:bg-gray-50/50">
                                            <td class="py-3 px-4 font-bold text-gray-900">#<?= $attr['id'] ?></td>
                                            <td class="py-3 px-4 text-gray-700"><?= htmlspecialchars($attr['nom_ville']) ?></td>
                                            <td class="py-3 px-4 text-gray-900 font-medium"><?= number_format($attr['quantite_dispatch'], 0, ',', ' ') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- APRÈS -->
                <div class="glass-card rounded-2xl p-8 shadow-xl">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900">APRÈS le dispatch</h2>
                    </div>
                    
                    <h3 class="text-lg font-semibold text-gray-900 mt-6 mb-3">Besoins ouverts (<?= count($apres['besoins']) ?>)</h3>
                    <?php if (empty($apres['besoins'])): ?>
                        <div class="glass-card rounded-lg p-4 bg-green-50/80 border border-green-200">
                            <p class="text-green-700 font-semibold inline-flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Tous les besoins ont été satisfaits !
                            </p>
                        </div>
                    <?php else: ?>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b-2 border-green-300 bg-gradient-to-r from-green-500 to-green-600">
                                        <th class="text-left py-3 px-4 text-white font-semibold text-sm">Besoin</th>
                                        <th class="text-left py-3 px-4 text-white font-semibold text-sm">Ville</th>
                                        <th class="text-left py-3 px-4 text-white font-semibold text-sm">Reste</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    <?php foreach ($apres['besoins'] as $besoin): ?>
                                        <tr class="hover:bg-green-50/50">
                                            <td class="py-3 px-4 font-bold text-gray-900">#<?= $besoin['id'] ?></td>
                                            <td class="py-3 px-4 text-gray-700"><?= htmlspecialchars($besoin['nom_ville']) ?></td>
                                            <td class="py-3 px-4 text-gray-900 font-medium"><?= number_format($besoin['reste'], 0, ',', ' ') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>

                    <h3 class="text-lg font-semibold text-gray-900 mt-6 mb-3 inline-flex items-center gap-2">
                        Attributions (<?= count($apres['attributions']) ?>)
                        <?php if (count($nouvelles) > 0): ?>
                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-green-500 text-white rounded-full text-xs font-bold pulse-new">
                                +<?= count($nouvelles) ?> nouvelles
                            </span>
                        <?php endif; ?>
                    </h3>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b-2 border-green-300 bg-gradient-to-r from-green-500 to-green-600">
                                    <th class="text-left py-3 px-4 text-white font-semibold text-sm">ID</th>
                                    <th class="text-left py-3 px-4 text-white font-semibold text-sm">Ville</th>
                                    <th class="text-left py-3 px-4 text-white font-semibold text-sm">Quantité</th>
                                    <th class="text-left py-3 px-4 text-white font-semibold text-sm">Date</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <?php foreach ($apres['attributions'] as $attr): ?>
                                    <?php 
                                    $isNew = false;
                                    foreach ($nouvelles as $nouvelle) {
                                        if ($nouvelle['id'] == $attr['id']) {
                                            $isNew = true;
                                            break;
                                        }
                                    }
                                    ?>
                                    <tr class="<?= $isNew ? 'bg-green-100/80 font-semibold' : 'hover:bg-green-50/50' ?>">
                                        <td class="py-3 px-4 font-bold text-gray-900">
                                            #<?= $attr['id'] ?>
                                            <?= $isNew ? '<span class="ml-2 inline-flex items-center px-2 py-0.5 bg-green-500 text-white rounded-full text-xs font-bold pulse-new">NEW</span>' : '' ?>
                                        </td>
                                        <td class="py-3 px-4 text-gray-700"><?= htmlspecialchars($attr['nom_ville']) ?></td>
                                        <td class="py-3 px-4 text-gray-900 font-medium"><?= number_format($attr['quantite_dispatch'], 0, ',', ' ') ?></td>
                                        <td class="py-3 px-4 text-gray-700"><?= date('d/m/Y H:i', strtotime($attr['date_dispatch'])) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex flex-wrap justify-center gap-4 mt-8">
                <a href="<?= Flight::get('flight.base_url') ?>test/dispatch" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-gray-600 to-gray-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Retour à la liste
                </a>
                <a href="<?= Flight::get('flight.base_url') ?>test/dispatch/don/<?= $don['id'] ?>" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-teal-600 to-teal-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    Tester à nouveau
                </a>
            </div>
        </div>
    </section>
    <?php include dirname(__DIR__) . '/partition/footer.php'; ?>
</body>
</html>
