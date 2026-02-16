<?php $this->render('partials/header', ['title' => 'BNGRC - Gestion des Dons']); ?>
<?php $base = Flight::get('flight.base_url'); ?>

    <!-- Header Section -->
    <section class="position-relative overflow-hidden" style="padding-top: 7rem; padding-bottom: 2rem;">
        <div class="blob bg-success" style="width:300px;height:300px;top:-40px;right:-60px;"></div>
        <div class="container position-relative">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4">
                <div>
                    <span class="badge bg-teal-light text-teal rounded-pill px-3 py-2 mb-3 text-uppercase fw-bold d-inline-flex align-items-center gap-1" style="font-size:.7rem; letter-spacing: 1px;">
                        <i class="bi bi-box-seam"></i> Gestion des Dons
                    </span>
                    <h1 class="display-5 fw-bold text-dark mb-2">
                        📦 Dispatch <span class="hero-gradient">Automatique</span>
                    </h1>
                    <p class="lead text-muted">
                        Les dons sont automatiquement dispatchés aux besoins ouverts selon l'ordre FIFO
                    </p>
                </div>
                <div class="mt-3 mt-md-0">
                    <a href="<?= $base ?>dons/create" class="btn btn-teal rounded-pill px-4 py-2 d-inline-flex align-items-center gap-2">
                        <i class="bi bi-plus-lg"></i> Ajouter un don
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="pb-5">
        <div class="container">
            <?php if (empty($dons)): ?>
                <!-- Empty State -->
                <div class="glass-card p-5 text-center">
                    <div class="bg-teal-light rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width:80px;height:80px;">
                        <i class="bi bi-box-seam fs-1 text-teal"></i>
                    </div>
                    <h2 class="fs-4 fw-bold text-dark mb-2">Aucun don disponible</h2>
                    <p class="text-muted mb-4">Ajoutez votre premier don pour commencer le dispatch automatique</p>
                    <a href="<?= $base ?>dons/create" class="btn btn-teal rounded-pill px-4 py-2 d-inline-flex align-items-center gap-2">
                        <i class="bi bi-plus-lg"></i> Ajouter un don
                    </a>
                </div>
            <?php else: ?>
                <!-- Dons Table -->
                <div class="glass-card overflow-hidden">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr class="text-white" style="background: linear-gradient(135deg, #0d9488, #0f766e);">
                                    <th class="px-3 py-3 text-uppercase small fw-semibold" style="letter-spacing:.5px;">ID</th>
                                    <th class="px-3 py-3 text-uppercase small fw-semibold" style="letter-spacing:.5px;">Catégorie</th>
                                    <th class="px-3 py-3 text-uppercase small fw-semibold" style="letter-spacing:.5px;">Type</th>
                                    <th class="px-3 py-3 text-uppercase small fw-semibold" style="letter-spacing:.5px;">Quantité</th>
                                    <th class="px-3 py-3 text-uppercase small fw-semibold" style="letter-spacing:.5px;">Dispatché</th>
                                    <th class="px-3 py-3 text-uppercase small fw-semibold" style="letter-spacing:.5px;">Reste</th>
                                    <th class="px-3 py-3 text-uppercase small fw-semibold" style="letter-spacing:.5px;">Status</th>
                                    <th class="px-3 py-3 text-uppercase small fw-semibold" style="letter-spacing:.5px;">Date</th>
                                    <th class="px-3 py-3 text-uppercase small fw-semibold" style="letter-spacing:.5px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dons as $don): ?>
                                    <tr>
                                        <td class="px-3 py-3">
                                            <span class="fw-bold text-dark">#<?= htmlspecialchars($don['id']) ?></span>
                                        </td>
                                        <td class="px-3 py-3">
                                            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill"><?= htmlspecialchars($don['nom_categorie']) ?></span>
                                        </td>
                                        <td class="px-3 py-3 text-dark">
                                            <?= htmlspecialchars($don['nom_type_besoin']) ?>
                                        </td>
                                        <td class="px-3 py-3">
                                            <span class="fw-bold text-dark"><?= number_format($don['quantite'], 0, ',', ' ') ?></span>
                                        </td>
                                        <td class="px-3 py-3">
                                            <div class="fw-bold text-dark"><?= number_format($don['utilise'], 0, ',', ' ') ?></div>
                                            <?php if ($don['nb_attributions'] > 0): ?>
                                                <small class="text-muted">(<?= $don['nb_attributions'] ?> attribution<?= $don['nb_attributions'] > 1 ? 's' : '' ?>)</small>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-3 py-3">
                                            <?php if ($don['reste'] > 0): ?>
                                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill"><?= number_format($don['reste'], 0, ',', ' ') ?></span>
                                            <?php else: ?>
                                                <span class="badge bg-light text-secondary rounded-pill">0</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-3 py-3">
                                            <?php
                                            $pourcentage = $don['quantite'] > 0 ? ($don['utilise'] / $don['quantite']) * 100 : 0;
                                            ?>
                                            <div class="mb-1">
                                                <?php if ($pourcentage == 100): ?>
                                                    <span class="badge bg-success bg-opacity-10 text-success badge-status">✓ Complet</span>
                                                <?php elseif ($pourcentage > 0): ?>
                                                    <span class="badge bg-warning bg-opacity-10 text-warning badge-status">⏳ Partiel</span>
                                                <?php else: ?>
                                                    <span class="badge bg-danger bg-opacity-10 text-danger badge-status">✗ Nouveau</span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="progress progress-animated" style="height: 6px; border-radius: 50px;">
                                                <div class="progress-bar" style="width: <?= $pourcentage ?>%"></div>
                                            </div>
                                        </td>
                                        <td class="px-3 py-3 text-muted small">
                                            <?= date('d/m/Y', strtotime($don['date_saisie'])) ?><br>
                                            <span class="text-muted" style="font-size:.75rem;"><?= date('H:i', strtotime($don['date_saisie'])) ?></span>
                                        </td>
                                        <td class="px-3 py-3">
                                            <a href="<?= $base ?>test/dispatch/don/<?= $don['id'] ?>" class="btn btn-sm btn-teal rounded-pill d-inline-flex align-items-center gap-1">
                                                <i class="bi bi-eye"></i> Détails
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

<?php $this->render('partials/footer'); ?>