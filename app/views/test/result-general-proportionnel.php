<?php include dirname(__DIR__) . '/partition/header.php'; ?>

<section class="py-12 px-6">
    <div class="max-w-7xl mx-auto">

        <!-- HEADER -->
        <div class="mb-8">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 tracking-tight mb-3">
                📦 Résultat Dispatch <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-green-500">Général</span>
            </h1>
            <p class="text-lg text-gray-600">
                Résultat réel du dispatch automatique des dons
            </p>
        </div>

        <?php if ($resultat['success']): ?>

            <!-- SUCCESS BOX -->
            <div class="glass-card rounded-xl p-5 mb-6 border-l-4 border-emerald-500 bg-emerald-50/80">
                <div class="flex items-start gap-3">
                    <div class="flex-1">
                        <h3 class="font-semibold text-emerald-900 mb-1">Dispatch effectué avec succès</h3>
                        <p class="text-sm text-emerald-800">
                            <strong><?= $resultat['nb_dons_dispatches'] ?></strong> don(s) dispatchés vers 
                            <strong><?= $resultat['nb_besoins_couverts'] ?></strong> besoin(s) pour un total de 
                            <strong><?= number_format($resultat['nb_attributions'], 0, ',', ' ') ?></strong> attribution(s).
                        </p>
                    </div>
                </div>
            </div>

            <!-- STATS -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

                <div class="glass-card rounded-xl p-6 shadow-xl">
                    <h3 class="text-3xl font-bold text-gray-900 mb-1">
                        <?= $resultat['nb_dons_dispatches'] ?>
                    </h3>
                    <p class="text-sm text-gray-600">Dons dispatchés</p>
                </div>

                <div class="glass-card rounded-xl p-6 shadow-xl">
                    <h3 class="text-3xl font-bold text-gray-900 mb-1">
                        <?= $resultat['nb_besoins_couverts'] ?>
                    </h3>
                    <p class="text-sm text-gray-600">Besoins couverts</p>
                </div>

                <div class="glass-card rounded-xl p-6 shadow-xl">
                    <h3 class="text-3xl font-bold text-gray-900 mb-1">
                        <?= $resultat['nb_attributions'] ?>
                    </h3>
                    <p class="text-sm text-gray-600">Attributions créées</p>
                </div>

            </div>

            <!-- RESULTATS PAR DON -->
            <?php foreach ($resultat['resultats'] as $res): ?>
                <div class="glass-card rounded-xl shadow-xl overflow-hidden mb-6">

                    <!-- HEADER DON -->
                    <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-6 py-4">
                        <h3 class="text-white font-bold text-lg">
                            Don #<?= $res['don']['id'] ?>
                        </h3>
                    </div>

                    <!-- TABLE -->
                    <?php if (!empty($res['nouvelles_attributions'])): ?>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b-2 border-emerald-200 bg-emerald-50">
                                        <th class="text-left py-3 px-6 text-emerald-900 font-semibold text-sm">Besoin</th>
                                        <th class="text-left py-3 px-6 text-emerald-900 font-semibold text-sm">Quantité</th>
                                        <th class="text-left py-3 px-6 text-emerald-900 font-semibold text-sm">Date</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 bg-white/50">
                                    <?php foreach ($res['nouvelles_attributions'] as $attr): ?>
                                        <tr class="hover:bg-emerald-50/50 transition-colors">
                                            <td class="py-3 px-6 font-bold text-gray-900">
                                                #<?= $attr['id_besoin'] ?>
                                            </td>
                                            <td class="py-3 px-6 text-gray-700">
                                                <?= number_format($attr['quantite_dispatch'], 0, ',', ' ') ?>
                                            </td>
                                            <td class="py-3 px-6 text-gray-700">
                                                <?= date('d/m/Y H:i', strtotime($attr['date_dispatch'])) ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>

                </div>
            <?php endforeach; ?>

            <!-- ACTIONS -->
            <div class="flex flex-col sm:flex-row justify-center gap-4 mt-8">

                <a href="<?= Flight::get('flight.base_url') ?>"
                   class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-gray-600 text-white font-bold text-lg rounded-xl shadow-lg hover:bg-gray-700 hover:-translate-y-0.5 transition-all duration-300">
                    Retour Dashboard
                </a>

            </div>

        <?php else: ?>

            <!-- EMPTY STATE -->
            <div class="glass-card rounded-xl p-12 text-center">
                <h2 class="text-2xl font-bold text-gray-900 mb-3">
                    Aucun dispatch effectué
                </h2>
                <p class="text-gray-600 mb-6">
                    Aucun don disponible ou aucun besoin ouvert.
                </p>
            </div>

        <?php endif; ?>

    </div>
</section>

<?php include dirname(__DIR__) . '/partition/footer.php'; ?>
