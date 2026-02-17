<!-- Section Formulaire -->
<section class="pt-32 pb-16 px-6 relative">
    <div class="max-w-7xl mx-auto">

        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-xs font-bold uppercase tracking-widest text-teal-600 mb-2 block">Administration</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 tracking-tight">Ajouter une ville</h2>
            <p class="text-lg text-gray-600 leading-relaxed mt-4">
                Renseignez le nom de la ville et sa région d'appartenance.
            </p>
        </div>

        <!-- Carte Formulaire -->
        <div class="card border-0 shadow-xl rounded-2xl overflow-hidden"
            style="background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px);">
            <div class="card-body p-6 md:p-10">

                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger mb-4 rounded-xl">
                        Veuillez remplir correctement tous les champs.
                    </div>
                <?php endif; ?>

                <form action="<?= Flight::get('flight.base_url') ?>villes/store" method="POST">

                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label for="nom" class="form-label fw-semibold text-gray-700 mb-2">Nom de la ville</label>
                            <input type="text" class="form-control form-control-lg" id="nom" name="nom"
                                placeholder="Ex: Antananarivo" required>
                        </div>
                        <div class="col-md-6">
                            <label for="id_region" class="form-label fw-semibold text-gray-700 mb-2">Région</label>
                            <select class="form-select form-control-lg" id="id_region" name="id_region" required>
                                <option value="" selected disabled>Sélectionner une région</option>
                                <?php if (!empty($regions)): ?>
                                    <?php foreach ($regions as $r): ?>
                                        <option value="<?= $r['id'] ?>"><?= htmlspecialchars($r['nom']) ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <!-- Boutons d'action -->
                    <div class="d-flex flex-column flex-sm-row justify-content-end gap-3 pt-4 border-top">
                        <a href="<?= Flight::get('flight.base_url') ?>villes" class="btn btn-lg"
                            style="border-radius: 0.75rem; background-color: #f1f5f9; color: #475569; font-weight: 600;">
                            Annuler
                        </a>
                        <button type="submit" class="btn btn-lg text-white border-0"
                            style="background: linear-gradient(to right, #0d9488, #0f766e); border-radius: 0.75rem; box-shadow: 0 10px 15px -3px rgba(13, 148, 136, 0.3); font-weight: 600; padding: 0.75rem 2rem;">
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>