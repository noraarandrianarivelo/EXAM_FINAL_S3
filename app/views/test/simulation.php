<?php $this->render('partials/header', ['title' => 'BNGRC - Simulation du Dispatch']); ?>
<?php $base = Flight::get('flight.base_url'); ?>
<?php $don = $result['don'] ?? null; ?>

    <section class="position-relative" style="padding-top: 7rem; padding-bottom: 3rem;">
        <div class="blob bg-primary" style="width:300px;height:300px;top:-40px;right:-60px;opacity:.15;"></div>
        <div class="container position-relative">

            <!-- Back Link -->
            <?php if ($don): ?>
                <a href="<?= $base ?>test/dispatch/don/<?= $don['id'] ?>" class="text-teal fw-semibold text-decoration-none d-inline-flex align-items-center gap-2 mb-4">
                    <i class="bi bi-arrow-left"></i> Retour au don #<?= $don['id'] ?>
                </a>
            <?php else: ?>
                <a href="<?= $base ?>test/dispatch" class="text-teal fw-semibold text-decoration-none d-inline-flex align-items-center gap-2 mb-4">
                    <i class="bi bi-arrow-left"></i> Retour à la liste
                </a>
            <?php endif; ?>

            <!-- Header -->
            <div class="mb-4">
                <span class="badge rounded-pill px-3 py-2 mb-3 text-uppercase fw-bold d-inline-flex align-items-center gap-1" style="font-size:.7rem; letter-spacing: 1px; background: rgba(59,130,246,.1); color: #3b82f6;">
                    <i class="bi bi-eye"></i> Simulation
                </span>
                <h1 class="display-5 fw-bold text-dark mb-2">
                    Résultat de la <span class="hero-gradient">Simulation</span>
                </h1>
                <p class="lead text-muted">
                    Aperçu du dispatch — <strong>aucune donnée n'a été enregistrée</strong>
                </p>
            </div>

            <?php if (!$result['success']): ?>
                <!-- Erreur / Rien à dispatcher -->
                <div class="alert alert-warning d-flex align-items-start gap-2" style="border-radius: .75rem;">
                    <i class="bi bi-exclamation-triangle-fill fs-5 mt-1"></i>
                    <div>
                        <strong>Simulation impossible</strong><br>
                        <?= htmlspecialchars($result['message']) ?>
                    </div>
                </div>

                <?php if ($don): ?>
                    <div class="d-flex justify-content-center mt-4">
                        <a href="<?= $base ?>test/dispatch/don/<?= $don['id'] ?>" class="btn btn-teal rounded-pill px-4 py-2 d-inline-flex align-items-center gap-2">
                            <i class="bi bi-arrow-left"></i> Retour au don
                        </a>
                    </div>
                <?php endif; ?>

            <?php else: ?>

                <!-- Don Info Summary -->
                <div class="glass-card p-4 mb-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #0d9488, #0f766e);">
                            <i class="bi bi-box-seam"></i>
                        </div>
                        <h2 class="fs-5 fw-bold text-dark mb-0">Don #<?= $don['id'] ?> — <?= htmlspecialchars($don['nom_categorie']) ?></h2>
                    </div>
                    <div class="row g-3">
                        <div class="col-6 col-md-3">
                            <div class="bg-light rounded-3 p-3 text-center">
                                <small class="text-muted d-block">Quantité totale</small>
                                <span class="fs-4 fw-bold text-dark"><?= number_format($don['quantite'], 0, ',', ' ') ?></span>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="bg-light rounded-3 p-3 text-center">
                                <small class="text-muted d-block">Déjà attribué</small>
                                <span class="fs-4 fw-bold text-dark"><?= number_format($result['utilise'], 0, ',', ' ') ?></span>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="rounded-3 p-3 text-center" style="background: rgba(16,185,129,.1);">
                                <small class="text-muted d-block">Sera dispatché</small>
                                <span class="fs-4 fw-bold text-success"><?= number_format($result['total_dispatche'], 0, ',', ' ') ?></span>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="rounded-3 p-3 text-center" style="background: rgba(239,68,68,.1);">
                                <small class="text-muted d-block">Restera après</small>
                                <span class="fs-4 fw-bold text-danger"><?= number_format($result['reste_apres'], 0, ',', ' ') ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Simulation Details Table -->
                <div class="glass-card p-4 mb-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #3b82f6, #2563eb);">
                            <i class="bi bi-diagram-3"></i>
                        </div>
                        <div>
                            <h2 class="fs-5 fw-bold text-dark mb-0">Détail de la simulation FIFO</h2>
                            <small class="text-muted"><?= $result['nb_besoins_satisfaits'] ?> besoin<?= $result['nb_besoins_satisfaits'] > 1 ? 's' : '' ?> recevront des dons</small>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr class="text-white" style="background: linear-gradient(135deg, #3b82f6, #2563eb);">
                                    <th class="px-3 py-3 small fw-semibold">#</th>
                                    <th class="px-3 py-3 small fw-semibold">Besoin</th>
                                    <th class="px-3 py-3 small fw-semibold">Ville</th>
                                    <th class="px-3 py-3 small fw-semibold">Région</th>
                                    <th class="px-3 py-3 small fw-semibold">Reste besoin</th>
                                    <th class="px-3 py-3 small fw-semibold">Quantité à dispatcher</th>
                                    <th class="px-3 py-3 small fw-semibold">Reste après</th>
                                    <th class="px-3 py-3 small fw-semibold">Date besoin</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($result['simulation'] as $i => $sim): ?>
                                    <tr>
                                        <td class="px-3 py-3 text-muted"><?= $i + 1 ?></td>
                                        <td class="px-3 py-3 fw-bold">#<?= $sim['id_besoin'] ?></td>
                                        <td class="px-3 py-3"><?= htmlspecialchars($sim['nom_ville']) ?></td>
                                        <td class="px-3 py-3 text-muted"><?= htmlspecialchars($sim['nom_region']) ?></td>
                                        <td class="px-3 py-3">
                                            <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill"><?= number_format($sim['reste_besoin'], 0, ',', ' ') ?></span>
                                        </td>
                                        <td class="px-3 py-3">
                                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill fs-6 fw-bold">
                                                <i class="bi bi-arrow-right me-1"></i><?= number_format($sim['quantite_dispatch'], 0, ',', ' ') ?>
                                            </span>
                                        </td>
                                        <td class="px-3 py-3">
                                            <?php if ($sim['reste_besoin_apres'] == 0): ?>
                                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill">
                                                    <i class="bi bi-check-circle me-1"></i>Satisfait
                                                </span>
                                            <?php else: ?>
                                                <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill"><?= number_format($sim['reste_besoin_apres'], 0, ',', ' ') ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-3 py-3 text-muted small"><?= date('d/m/Y', strtotime($sim['date_besoin'])) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Existing Attributions -->
                <?php if (!empty($attributions)): ?>
                    <div class="glass-card p-4 mb-4">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #8b5cf6, #7c3aed);">
                                <i class="bi bi-clipboard-check"></i>
                            </div>
                            <h2 class="fs-5 fw-bold text-dark mb-0">Attributions déjà existantes</h2>
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

                <!-- Info banner -->
                <div class="alert d-flex align-items-start gap-2 mb-4" style="border-radius: .75rem; background: rgba(59,130,246,.08); border: 1px solid rgba(59,130,246,.2); color: #1e40af;">
                    <i class="bi bi-info-circle-fill fs-5 mt-1"></i>
                    <div>
                        <strong>Ceci est une simulation</strong><br>
                        Aucune attribution n'a été créée en base de données. Cliquez sur <strong>"Valider le dispatch"</strong> pour appliquer réellement ces attributions.
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <!-- Retour -->
                    <a href="<?= $base ?>test/dispatch/don/<?= $don['id'] ?>" class="btn btn-lg rounded-pill px-4 py-3 d-inline-flex align-items-center gap-2 fw-bold" style="background: #e2e8f0; color: #475569; border: none;">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                    <!-- Bouton Valider le dispatch -->
                    <form method="POST" action="<?= $base ?>test/dispatch/don/<?= $don['id'] ?>/valider" onsubmit="return confirm('Êtes-vous sûr de vouloir dispatcher ce don ? Cette action est irréversible.');">
                        <button type="submit" class="btn btn-teal btn-lg rounded-pill px-4 py-3 d-inline-flex align-items-center gap-2 fw-bold">
                            <i class="bi bi-check-circle-fill fs-5"></i> Valider le dispatch
                        </button>
                    </form>
                </div>

            <?php endif; ?>

        </div>
    </section>

<?php $this->render('partials/footer'); ?>
