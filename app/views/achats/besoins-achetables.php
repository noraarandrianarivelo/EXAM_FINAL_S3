<?php include dirname(__DIR__) . '/partition/header.php'; ?>
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    Achats avec dons en argent
                </div>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 tracking-tight mb-3">
                    Besoins <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-600 to-emerald-500">Achetables</span>
                </h1>
                <p class="text-lg text-gray-600">
                    Couvrir les besoins restants en utilisant les dons en argent avec frais de <?= htmlspecialchars($frais) ?>%
                </p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Montant Disponible -->
                <div class="glass-card rounded-2xl p-6 border-l-4 border-emerald-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Argent Disponible</p>
                            <p class="text-3xl font-bold text-gray-900"><?= number_format($montantTotalDisponible, 0, ',', ' ') ?> <span class="text-lg text-gray-600">Ar</span></p>
                        </div>
                        <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Besoins Achetables -->
                <div class="glass-card rounded-2xl p-6 border-l-4 border-blue-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Besoins Non Couverts</p>
                            <p class="text-3xl font-bold text-gray-900"><?= count($besoins) ?></p>
                        </div>
                        <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Frais d'Achat -->
                <div class="glass-card rounded-2xl p-6 border-l-4 border-amber-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Frais d'Achat</p>
                            <p class="text-3xl font-bold text-gray-900"><?= htmlspecialchars($frais) ?><span class="text-lg text-gray-600">%</span></p>
                        </div>
                        <div class="w-14 h-14 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filtres -->
            <div class="glass-card rounded-2xl p-6 mb-8">
                <form method="GET" action="<?= Flight::get('flight.base_url') ?>achats/besoins-achetables" class="flex flex-wrap gap-4 items-end">
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
                        <a href="<?= Flight::get('flight.base_url') ?>achats/besoins-achetables" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-xl transition-all">
                            Réinitialiser
                        </a>
                    <?php endif; ?>
                </form>
            </div>

            <!-- Info Box -->
            <?php if (empty($besoins)): ?>
                <div class="glass-card rounded-2xl p-8 text-center border-l-4 border-green-500">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Aucun besoin achetable</h3>
                    <p class="text-gray-600">Tous les besoins sont couverts ou ont encore des dons directs disponibles.</p>
                </div>
            <?php else: ?>
                <!-- Instructions -->
                <div class="glass-card rounded-xl p-6 mb-8 border-l-4 border-blue-500">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-bold text-gray-900 mb-2">Comment effectuer un achat ?</h3>
                            <p class="text-gray-700 leading-relaxed mb-3">
                                Les besoins ci-dessous sont en <strong>Nature</strong> ou <strong>Matériaux</strong> et n'ont plus de dons directs disponibles. 
                                Vous pouvez les couvrir en utilisant les dons en argent.
                            </p>
                            <ul class="list-disc list-inside text-gray-700 space-y-1 text-sm">
                                <li>Saisissez la quantité à acheter (maximum = Qté Restante)</li>
                                <li>Le montant sera calculé avec le prix unitaire + <?= htmlspecialchars($frais) ?>% de frais</li>
                                <li>L'achat sera effectué avec le premier don en argent disponible (FIFO)</li>
                                <li>Un message d'erreur apparaîtra si des dons directs existent encore</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="glass-card rounded-2xl overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gradient-to-r from-teal-600 to-emerald-600 text-white">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Ville</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Catégorie</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Type</th>
                                    <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider">PU</th>
                                    <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider">Qté Restante</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Date Besoin</th>
                                    <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <?php foreach ($besoins as $besoin): ?>
                                    <tr class="hover:bg-teal-50/50 transition-colors" data-besoin-id="<?= $besoin['id'] ?>">
                                        <td class="px-6 py-4">
                                            <span class="font-semibold text-gray-900"><?= htmlspecialchars($besoin['nom_ville']) ?></span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="text-gray-700"><?= htmlspecialchars($besoin['nom_categorie']) ?></span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                                <?= $besoin['type_besoin'] == 'Nature' ? 'bg-green-100 text-green-800' : 'bg-orange-100 text-orange-800' ?>">
                                                <?= htmlspecialchars($besoin['type_besoin']) ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <span class="font-semibold text-gray-900"><?= number_format($besoin['pu_categorie'], 0, ',', ' ') ?></span>
                                            <span class="text-xs text-gray-500">Ar</span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <span class="font-bold text-lg text-teal-600"><?= number_format($besoin['quantite_restante'], 0, ',', ' ') ?></span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="text-sm text-gray-600"><?= date('d/m/Y', strtotime($besoin['date_besoin'])) ?></span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                <input type="number" 
                                                       min="1" 
                                                       max="<?= $besoin['quantite_restante'] ?>"
                                                       placeholder="Qté"
                                                       class="w-24 px-3 py-2 text-sm border-2 border-gray-200 rounded-lg focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 transition-all outline-none"
                                                       data-quantite-input="<?= $besoin['id'] ?>">
                                                <button onclick="acheter(<?= $besoin['id'] ?>, <?= $besoin['pu_categorie'] ?>, <?= $frais ?>)"
                                                        class="px-4 py-2 bg-gradient-to-r from-teal-600 to-emerald-600 hover:from-teal-700 hover:to-emerald-700 text-white text-sm font-semibold rounded-lg transition-all shadow-md hover:shadow-lg">
                                                    Acheter
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Link to Achats List -->
                <div class="mt-8 text-center">
                    <a href="<?= Flight::get('flight.base_url') ?>achats" class="inline-flex items-center gap-2 px-6 py-3 bg-white border-2 border-teal-600 text-teal-600 hover:bg-teal-50 font-semibold rounded-xl transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                        Voir la liste des achats effectués
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <script>
        function acheter(besoinId, pu, frais) {
            const inputQte = document.querySelector(`input[data-quantite-input="${besoinId}"]`);
            const quantite = parseInt(inputQte.value);

            if (!quantite || quantite <= 0) {
                alert('Veuillez saisir une quantité valide');
                return;
            }

            const maxQte = parseInt(inputQte.max);
            if (quantite > maxQte) {
                alert(`La quantité ne peut pas dépasser ${maxQte}`);
                return;
            }

            // Calcul du montant
            const montantSansFrais = pu * quantite;
            const montantFrais = montantSansFrais * (frais / 100);
            const montantTotal = montantSansFrais + montantFrais;

            const confirmation = confirm(
                `Confirmer l'achat ?\n\n` +
                `Quantité: ${quantite}\n` +
                `Prix unitaire: ${pu.toLocaleString('fr-FR')} Ar\n` +
                `Montant sans frais: ${montantSansFrais.toLocaleString('fr-FR')} Ar\n` +
                `Frais (${frais}%): ${montantFrais.toLocaleString('fr-FR')} Ar\n` +
                `MONTANT TOTAL: ${montantTotal.toLocaleString('fr-FR')} Ar`
            );

            if (!confirmation) return;

            // Envoi de la requête
            fetch('<?= Flight::get('flight.base_url') ?>achats/acheter', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    id_besoin: besoinId,
                    quantite: quantite
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Achat effectué avec succès !\n\n' + 
                          'Montant total: ' + data.details.montant_total.toLocaleString('fr-FR') + ' Ar');
                    location.reload();
                } else {
                    alert('Erreur: ' + data.message);
                }
            })
            .catch(error => {
                alert('Erreur lors de l\'achat: ' + error.message);
            });
        }
    </script>
</body>
</html>
