<?php include dirname(__DIR__) . '/partition/header.php'; ?>

    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 h-20" style="background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(226, 232, 240, 0.5);">
        <div class="max-w-7xl mx-auto px-6 h-full flex items-center justify-between">
            <a href="<?= Flight::get('flight.base_url') ?>" class="flex items-center gap-3 group">
                <div class="w-10 h-10 bg-gradient-to-br from-teal-500 to-teal-700 rounded-xl flex items-center justify-center shadow-lg shadow-teal-500/30">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <span class="text-xl font-bold text-gray-900">BNGRC</span>
            </a>

            <div class="hidden md:flex items-center gap-8">
                <a href="<?= Flight::get('flight.base_url') ?>" class="text-sm font-medium text-gray-600 hover:text-teal-700 transition-colors">Tableau de bord</a>
                <a href="<?= Flight::get('flight.base_url') ?>villes" class="text-sm font-semibold text-teal-700 border-b-2 border-teal-500 pb-1">Villes</a>
                <a href="<?= Flight::get('flight.base_url') ?>besoins" class="text-sm font-medium text-gray-600 hover:text-teal-700 transition-colors">Besoins</a>
            </div>
        </div>
    </nav>

    <!-- Contenu Principal -->
    <section class="pt-24 pb-16 px-6 relative">
        <div class="max-w-7xl mx-auto relative">
            
            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-end md:justify-between mb-10">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-teal-600 mb-2 block">Administration</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 tracking-tight">Liste des Villes</h2>
                </div>
                <div class="mt-4 md:mt-0">
                    <a href="<?= Flight::get('flight.base_url') ?>villes/create" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-teal-600 to-teal-700 text-white text-sm font-semibold rounded-xl shadow-lg shadow-teal-500/30 hover:shadow-teal-500/50 hover:-translate-y-0.5 transition-all duration-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Nouvelle Ville
                    </a>
                </div>
            </div>

            <!-- Alerte Succès -->
            <?php if(isset($_GET['success'])): ?>
                <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 flex items-center gap-3" role="alert">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-medium">Opération réalisée avec succès.</span>
                </div>
            <?php endif; ?>

            <!-- Carte Tableau -->
            <div class="card border-0 shadow-xl rounded-2xl overflow-hidden" style="background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px);">
                <div class="overflow-x-auto">
                    <table class="table mb-0">
                        <thead class="bg-slate-50/50 border-b border-slate-100">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Ville</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Région</th>
                                <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <?php if(!empty($villes)): ?>
                                <?php foreach($villes as $v): ?>
                                    <tr class="hover:bg-slate-50/50 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center text-blue-600">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    </svg>
                                                </div>
                                                <div class="font-semibold text-gray-900"><?= htmlspecialchars($v['nom']) ?></div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2.5 py-1 text-xs font-semibold text-slate-700 bg-slate-100 rounded-lg border border-slate-200">
                                                <?= htmlspecialchars($v['nom_region']) ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <a href="<?= Flight::get('flight.base_url') ?>villes/<?= $v['id'] ?>/edit" class="p-2 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 transition-colors" title="Modifier">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                </a>
                                                <a href="<?= Flight::get('flight.base_url') ?>villes/<?= $v['id'] ?>/delete" 
                                                   onclick="return confirm('Confirmer la suppression ?');" 
                                                   class="p-2 rounded-lg bg-red-50 text-red-500 hover:bg-red-100 transition-colors" title="Supprimer">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" class="text-center py-16">
                                        <div class="flex flex-col items-center">
                                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                </svg>
                                            </div>
                                            <h3 class="text-lg font-semibold text-gray-900 mb-1">Aucune ville</h3>
                                            <p class="text-gray-500 text-sm">Commencez par ajouter une nouvelle ville.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap Local JS -->
    <script src="<?= Flight::get('flight.base_url') ?>assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <?php include dirname(__DIR__) . '/partition/footer.php'; ?>
</body>
</html>