<?php $this->render('partials/header', ['title' => 'BNGRC - Don #' . $don['id']]); ?>
<?php $base = Flight::get('flight.base_url'); ?>

    <section class="position-relative" style="padding-top: 7rem; padding-bottom: 3rem;">
        <div class="container">
            <!-- Back Link -->
            <a href="<?= $base ?>test/dispatch" class="text-teal fw-semibold text-decoration-none d-inline-flex align-items-center gap-2 mb-4">
                <i class="bi bi-arrow-left"></i> Retour à la liste des dons
            </a>

            <!-- Header -->
            <div class="mb-4">
                <span class="badge bg-teal-light text-teal rounded-pill px-3 py-2 mb-3 text-uppercase fw-bold d-inline-flex align-items-center gap-1" style="font-size:.7rem; letter-spacing: 1px;">
                    <i class="bi bi-clipboard-check"></i> Pré-dispatch
                </span>
                <h1 class="display-5 fw-bold text-dark mb-2">
                    Don #<span class="hero-gradient"><?= $don['id'] ?></span>
                </h1>
                <p class="lead text-muted">État du don avant dispatch automatique</p>
            </div>

            <!-- Don Information Card -->
            <div class="glass-card p-4 mb-4">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="stat-icon" style="background: linear-gradient(135deg, #0d9488, #0f766e);">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    <h2 class="fs-4 fw-bold text-dark mb-0">Informations du Don</h2>
                </div>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="bg-light rounded-3 p-3">
                            <small class="text-muted d-block">Catégorie</small>
                            <span class="fs-5 fw-semibold text-dark"><?= htmlspecialchars($don['nom_categorie']) ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-light rounded-3 p-3">
                            <small class="text-muted d-block">Type</small>
                            <span class="fs-5 fw-semibold text-dark"><?= htmlspecialchars($don['nom_type_besoin']) ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-light rounded-3 p-3">
                            <small class="text-muted d-block">Quantité totale</small>
                            <span class="fs-5 fw-semibold text-dark"><?= number_format($don['quantite'], 0, ',', ' ') ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-light rounded-3 p-3">
                            <small class="text-muted d-block">Prix unitaire</small>
                            <span class="fs-5 fw-semibold text-dark"><?= number_format($don['pu'], 0, ',', ' ') ?> Ar</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-light rounded-3 p-3">
                            <small class="text-muted d-block">Déjà attribué</small>
                            <span class="fs-5 fw-semibold text-dark"><?= number_format($utilise, 0, ',', ' ') ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-light rounded-3 p-3">
                            <small class="text-muted d-block">Reste disponible</small>
                            <?php if ($reste > 0): ?>
                                <span class="badge bg-success bg-opacity-10 text-success fs-6 fw-semibold px-3 py-2">
                                    <i class="bi bi-check-circle me-1"></i><?= number_format($reste, 0, ',', ' ') ?>
                                </span>
                            <?php else: ?>
                                <span class="badge bg-warning bg-opacity-10 text-warning fs-6 fw-semibold px-3 py-2">
                                    <i class="bi bi-exclamation-triangle me-1"></i>0
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php if ($reste <= 0): ?>
                <div class="alert alert-warning d-flex align-items-start gap-2 mb-4" style="border-radius: .75rem;">
                    <i class="bi bi-exclamation-triangle-fill mt-1"></i>
                    <div>
                        <strong>Attention</strong><br>
                        Ce don a déjà été entièrement dispatché. Aucune quantité disponible pour un nouveau dispatch.
                    </div>
                </div>
            <?php endif; ?>

            <!-- Open Needs -->
            <div class="glass-card p-4 mb-4">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="stat-icon" style="background: linear-gradient(135deg, #3b82f6, #2563eb);">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>
                    <h2 class="fs-4 fw-bold text-dark mb-0">Besoins Ouverts pour "<?= htmlspecialchars($don['nom_categorie']) ?>"</h2>
                </div>

                <?php if (empty($besoins)): ?>
                    <div class="alert alert-info d-flex align-items-start gap-2" style="border-radius: .75rem;">
                        <i class="bi bi-info-circle-fill mt-1"></i>
                        <span>Aucun besoin ouvert pour cette catégorie. Tous les besoins ont été satisfaits.</span>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr class="text-white" style="background: linear-gradient(135deg, #0d9488, #0f766e);">
                                    <th class="px-3 py-3 small fw-semibold">ID</th>
                                    <th class="px-3 py-3 small fw-semibold">Ville</th>
                                    <th class="px-3 py-3 small fw-semibold">Région</th>
                                    <th class="px-3 py-3 small fw-semibold">Quantité totale</th>
                                    <th class="px-3 py-3 small fw-semibold">Reste à satisfaire</th>
                                    <th class="px-3 py-3 small fw-semibold">Date besoin</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($besoins as $besoin): ?>
                                    <tr>
                                        <td class="px-3 py-3 fw-bold">#<?= $besoin['id'] ?></td>
                                        <td class="px-3 py-3"><?= htmlspecialchars($besoin['nom_ville']) ?></td>
                                        <td class="px-3 py-3"><?= htmlspecialchars($besoin['nom_region']) ?></td>
                                        <td class="px-3 py-3 fw-medium"><?= number_format($besoin['quantite'], 0, ',', ' ') ?></td>
                                        <td class="px-3 py-3">
                                            <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill"><?= number_format($besoin['reste'], 0, ',', ' ') ?></span>
                                        </td>
                                        <td class="px-3 py-3 text-muted"><?= date('d/m/Y H:i', strtotime($besoin['date_besoin'])) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Existing Attributions -->
            <?php if (!empty($attributions)): ?>
                <div class="glass-card p-4 mb-4">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #8b5cf6, #7c3aed);">
                            <i class="bi bi-clipboard-check"></i>
                        </div>
                        <h2 class="fs-4 fw-bold text-dark mb-0">Attributions Existantes</h2>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr class="text-white" style="background: linear-gradient(135deg, #8b5cf6, #7c3aed);">
                                    <th class="px-3 py-3 small fw-semibold">ID</th>
                                    <th class="px-3 py-3 small fw-semibold">Besoin</th>
                                    <th class="px-3 py-3 small fw-semibold">Ville</th>
                                    <th class="px-3 py-3 small fw-semibold">Quantité</th>
                                    <th class="px-3 py-3 small fw-semibold">Date dispatch</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($attributions as $attr): ?>
                                    <tr>
                                        <td class="px-3 py-3 fw-bold">#<?= $attr['id'] ?></td>
                                        <td class="px-3 py-3">Besoin #<?= $attr['id_besoin'] ?></td>
                                        <td class="px-3 py-3"><?= htmlspecialchars($attr['nom_ville']) ?></td>
                                        <td class="px-3 py-3 fw-medium"><?= number_format($attr['quantite_dispatch'], 0, ',', ' ') ?></td>
                                        <td class="px-3 py-3 text-muted"><?= date('d/m/Y H:i', strtotime($attr['date_dispatch'])) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Action Buttons: Simuler + Valider -->
            <?php if ($reste > 0 && !empty($besoins)): ?>
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <!-- Bouton Simuler -->
                    <form method="POST" action="<?= $base ?>test/dispatch/don/<?= $don['id'] ?>/simuler">
                        <button type="submit" class="btn btn-lg rounded-pill px-4 py-3 d-inline-flex align-items-center gap-2 fw-bold" style="background: linear-gradient(135deg, #3b82f6, #2563eb); color: #fff; border: none;">
                            <i class="bi bi-eye fs-5"></i> Simuler le dispatch
                        </button>
                    </form>
                    <!-- Bouton Valider -->
                    <form method="POST" action="<?= $base ?>test/dispatch/don/<?= $don['id'] ?>/valider" onsubmit="return confirm('Êtes-vous sûr de vouloir dispatcher ce don ? Cette action est irréversible.');">
                        <button type="submit" class="btn btn-teal btn-lg rounded-pill px-4 py-3 d-inline-flex align-items-center gap-2 fw-bold">
                            <i class="bi bi-lightning-fill fs-5"></i> Valider le dispatch
                        </button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </section>

<?php $this->render('partials/footer'); ?>