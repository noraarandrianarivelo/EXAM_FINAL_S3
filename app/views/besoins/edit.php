<?php include dirname(__DIR__) . '/partition/header.php'; ?>

    <!-- Navigation -->
    

    <!-- Contenu Principal -->
    <div class="pt-24 pb-12 px-6 relative">
        <div class="max-w-3xl mx-auto">
            
            <!-- En-tête -->
            <div class="text-center mb-8">
                <span class="text-xs font-bold uppercase tracking-widest text-teal-600 mb-2 block">Administration</span>
                <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Modifier le besoin</h2>
            </div>

            <!-- Carte Formulaire -->
            <div class="card border-0 shadow-xl rounded-2xl overflow-hidden" style="background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px);">
                <div class="card-body p-6 md:p-10">
                    <form action="<?= Flight::get('flight.base_url') ?>besoins/<?= $besoin['id'] ?>/update" method="POST">
                        
                        <!-- Ville & Catégorie -->
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-gray-700 mb-2">Ville</label>
                                <select name="ville" class="form-select form-control-lg" required>
                                    <?php foreach($villes as $v): ?>
                                        <option value="<?= $v['id'] ?>" <?= $v['id'] == $besoin['id_ville'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($v['nom']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-gray-700 mb-2">Catégorie</label>
                                <select name="categorie_besoin" class="form-select form-control-lg" required>
                                    <?php foreach($categories as $c): ?>
                                        <option value="<?= $c['id'] ?>" <?= $c['id'] == $besoin['id_categorie_besoin'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($c['nom']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <!-- Quantité, Prix, Date -->
                        <div class="row g-4 mb-5">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-gray-700 mb-2">Quantité</label>
                                <input type="number" name="quantite" value="<?= $besoin['quantite'] ?>" class="form-control form-control-lg" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-gray-700 mb-2">Date</label>
                                <input type="datetime-local" name="date_ajout" value="<?= date('Y-m-d\TH:i', strtotime($besoin['date_besoin'])) ?>" class="form-control form-control-lg" required>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="d-flex flex-column flex-sm-row justify-content-end gap-3 pt-4 border-top">
                            <a href="<?= Flight::get('flight.base_url') ?>besoins" class="btn btn-lg" style="border-radius: 0.75rem; background-color: #f1f5f9; color: #475569; font-weight: 600;">
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