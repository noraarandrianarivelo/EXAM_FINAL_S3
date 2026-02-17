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
            </div>
        </div>
    </nav>

    <!-- Contenu Principal -->
    <div class="pt-24 pb-12 px-6 relative">
        <div class="max-w-3xl mx-auto">
            
            <div class="text-center mb-8">
                <span class="text-xs font-bold uppercase tracking-widest text-teal-600 mb-2 block">Administration</span>
                <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Modifier la ville</h2>
            </div>

            <!-- Carte Formulaire -->
            <div class="card border-0 shadow-xl rounded-2xl overflow-hidden" style="background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px);">
                <div class="card-body p-6 md:p-10">
                    <form action="<?= Flight::get('flight.base_url') ?>villes/<?= $ville['id'] ?>/update" method="POST">
                        
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label for="nom" class="form-label fw-semibold text-gray-700 mb-2">Nom de la ville</label>
                                <input type="text" class="form-control form-control-lg" id="nom" name="nom" value="<?= htmlspecialchars($ville['nom']) ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="id_region" class="form-label fw-semibold text-gray-700 mb-2">Région</label>
                                <select class="form-select form-control-lg" id="id_region" name="id_region" required>
                                    <?php foreach($regions as $r): ?>
                                        <option value="<?= $r['id'] ?>" <?= $r['id'] == $ville['id_region'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($r['nom']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="d-flex flex-column flex-sm-row justify-content-end gap-3 pt-4 border-top">
                            <a href="<?= Flight::get('flight.base_url') ?>villes" class="btn btn-lg" style="border-radius: 0.75rem; background-color: #f1f5f9; color: #475569; font-weight: 600;">
                                Annuler
                            </a>
                            <button type="submit" class="btn btn-lg text-white border-0" style="background: linear-gradient(to right, #0d9488, #0f766e); border-radius: 0.75rem; box-shadow: 0 10px 15px -3px rgba(13, 148, 136, 0.3); font-weight: 600; padding: 0.75rem 2rem;">
                                Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Local JS -->
    <script src="<?= Flight::get('flight.base_url') ?>assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <?php include dirname(__DIR__) . '/partition/footer.php'; ?>
</body>
</html>