<?php include dirname(__DIR__) . '/partition/header.php'; ?>


    <!-- Section Formulaire Ajout Besoin -->
    <section class="pt-32 pb-16 px-6 relative">
        <div class="max-w-7xl mx-auto">
            
            <!-- En-tête de section -->
            <div class="text-center max-w-3xl mx-auto mb-12">
                <span class="text-xs font-bold uppercase tracking-widest text-teal-600 mb-2 block">Administration</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 tracking-tight">Déclarer un nouveau besoin</h2>
                <p class="text-lg text-gray-600 leading-relaxed mt-4">
                    Remplissez le formulaire ci-dessous pour ajouter les besoins d'une ville sinistrée.
                </p>
            </div>

            <!-- Carte Formulaire -->
            <div class="card border-0 shadow-xl rounded-2xl overflow-hidden" style="background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px);">
                <div class="card-body p-6 md:p-10">
                    
                    <!-- Message d'erreur -->
                    <?php if(isset($_GET['error'])): ?>
                        <div class="alert alert-danger mb-4 rounded-xl">
                            Veuillez remplir correctement tous les champs obligatoires.
                        </div>
                    <?php endif; ?>

                    <form action="<?= Flight::get('flight.base_url') ?>besoins/store" method="POST">

                        <!-- Ligne 1 : Ville et Catégorie -->
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label for="ville" class="form-label fw-semibold text-gray-700 mb-2">Ville</label>
                                <select class="form-select form-control-lg" id="ville" name="ville" required>
                                    <option value="" selected disabled>Sélectionner une ville</option>
                                    <?php if (!empty($villes)): ?>
                                        <?php foreach ($villes as $v): ?>
                                            <option value="<?= $v['id'] ?>"><?= htmlspecialchars($v['nom']) ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="categorie_besoin" class="form-label fw-semibold text-gray-700 mb-2">Catégorie de besoin</label>
                                <select class="form-select form-control-lg" id="categorie_besoin" name="categorie_besoin" required>
                                    <option value="" selected disabled>Sélectionner une catégorie</option>
                                    <!-- Rendu dynamique basé sur le CategorieBesoinModel -->
                                    <?php if (!empty($categories)): ?>
                                        <?php foreach ($categories as $cat): ?>
                                            <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['nom']) ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>

                        <!-- Ligne 2 : Quantité, Prix et Date -->
                        <div class="row g-4 mb-5">
                            <div class="col-md-4">
                                <label for="quantite" class="form-label fw-semibold text-gray-700 mb-2">Quantité</label>
                                <input type="number" class="form-control form-control-lg" id="quantite" name="quantite" placeholder="Ex: 500" required>
                            </div>
                            <div class="col-md-4">
                                <label for="date_ajout" class="form-label fw-semibold text-gray-700 mb-2">Date d'ajout</label>
                                <input type="datetime-local" class="form-control form-control-lg" id="date_ajout" name="date_ajout" value="<?= date('Y-m-d\TH:i') ?>" required>
                            </div>
                        </div>

                        <!-- Boutons d'action -->
                        <div class="d-flex flex-column flex-sm-row justify-content-end gap-3 pt-4 border-top">
                            <a href="<?= Flight::get('flight.base_url') ?>" class="btn btn-lg" style="border-radius: 0.75rem; background-color: #f1f5f9; color: #475569; font-weight: 600;">
                                Annuler
                            </a>
                            <button type="submit" class="btn btn-lg text-white border-0" style="background: linear-gradient(to right, #0d9488, #0f766e); border-radius: 0.75rem; box-shadow: 0 10px 15px -3px rgba(13, 148, 136, 0.3); font-weight: 600; padding: 0.75rem 2rem;">
                                <svg class="w-5 h-5 inline-block me-2 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Enregistrer le besoin
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap Local JS -->
    <script src="<?= Flight::get('flight.base_url') ?>assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <?php include dirname(__DIR__) . '/partition/footer.php'; ?>
</body>
</html>