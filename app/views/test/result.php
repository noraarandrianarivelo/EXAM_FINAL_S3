<?php $this->render('partials/header', ['title' => 'BNGRC - Résultat Dispatch']); ?>
<?php $base = Flight::get('flight.base_url'); ?>

    <section class="position-relative" style="padding-top: 7rem; padding-bottom: 3rem;">
        <div class="container">
            <!-- Back Link -->
            <a href="<?= $base ?>test/dispatch" class="text-teal fw-semibold text-decoration-none d-inline-flex align-items-center gap-2 mb-4">
                <i class="bi bi-arrow-left"></i> Retour à la liste des dons
            </a>

            <!-- Header -->
            <div class="mb-4">
                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 mb-3 text-uppercase fw-bold d-inline-flex align-items-center gap-1" style="font-size:.7rem; letter-spacing: 1px;">
                    <i class="bi bi-check-circle"></i> Résultat Dispatch
                </span>
                <h1 class="display-5 fw-bold text-dark mb-2">
                    Don #<span class="hero-gradient"><?= $don['id'] ?></span>
                </h1>
            </div>

            <!-- Alert -->
            <?php if ($resultat): ?>
                <div class="alert alert-success d-flex align-items-start gap-2 mb-4" style="border-radius: .75rem;">
                    <i class="bi bi-check-circle-fill fs-4 mt-1"></i>
                    <div>
                        <strong class="fs-5">Succès !</strong><br>
                        Le dispatch a été exécuté avec succès. <?= count($nouvelles) ?> nouvelle(s) attribution(s) créée(s).
                        <?php if (!empty($validated)): ?>
                            <br><small class="text-success fw-semibold"><i class="bi bi-shield-check"></i> Validé après simulation</small>
                        <?php endif; ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-danger d-flex align-items-start gap-2 mb-4" style="border-radius: .75rem;">
                    <i class="bi bi-x-circle-fill fs-4 mt-1"></i>
                    <div>
                        <strong class="fs-5">Échec</strong><br>
                        Le dispatch n'a pas pu être exécuté (don vide ou déjà entièrement dispatché).
                    </div>
                </div>
            <?php endif; ?>

            <!-- Stats Cards -->
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="glass-card p-4 text-center">
                        <small class="text-muted d-block mb-1">Quantité totale</small>
                        <span class="fs-2 fw-bold text-dark"><?= number_format($don['quantite'], 0, ',', ' ') ?></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="glass-card p-4 text-center">
                        <small class="text-muted d-block mb-1">Quantité utilisée</small>
                        <span class="fs-2 fw-bold text-dark"><?= number_format($apres['utilise'], 0, ',', ' ') ?></span>
                        <?php if ($apres['utilise'] > $avant['utilise']): ?>
                            <div class="text-success fw-semibold small">+<?= number_format($apres['utilise'] - $avant['utilise'], 0, ',', ' ') ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="glass-card p-4 text-center">
                        <small class="text-muted d-block mb-1">Reste disponible</small>
                        <span class="fs-2 fw-bold text-dark"><?= number_format($apres['reste'], 0, ',', ' ') ?></span>
                        <?php if ($apres['reste'] < $avant['reste']): ?>
                            <div class="text-danger fw-semibold small"><?= number_format($apres['reste'] - $avant['reste'], 0, ',', ' ') ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Comparison -->
            <div class="row g-4 mb-4">
                <!-- AVANT -->
                <div class="col-lg-6">
                    <div class="glass-card p-4">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #6b7280, #4b5563);">
                                <i class="bi bi-clock-history"></i>
                            </div>
                            <h2 class="fs-5 fw-bold text-dark mb-0">AVANT le dispatch</h2>
                        </div>

                        <h6 class="fw-semibold text-dark mt-3 mb-2">Besoins ouverts (<?= count($avant['besoins']) ?>)</h6>
                        <?php if (empty($avant['besoins'])): ?>
                            <p class="text-muted fst-italic">Aucun besoin ouvert</p>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-sm table-hover align-middle mb-0">
                                    <thead>
                                        <tr class="text-white" style="background: linear-gradient(135deg, #6b7280, #4b5563);">
                                            <th class="px-3 py-2 small">Besoin</th>
                                            <th class="px-3 py-2 small">Ville</th>
                                            <th class="px-3 py-2 small">Reste</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($avant['besoins'] as $besoin): ?>
                                            <tr>
                                                <td class="px-3 py-2 fw-bold">#<?= $besoin['id'] ?></td>
                                                <td class="px-3 py-2"><?= htmlspecialchars($besoin['nom_ville']) ?></td>
                                                <td class="px-3 py-2 fw-medium"><?= number_format($besoin['reste'], 0, ',', ' ') ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>

                        <h6 class="fw-semibold text-dark mt-3 mb-2">Attributions (<?= count($avant['attributions']) ?>)</h6>
                        <?php if (empty($avant['attributions'])): ?>
                            <p class="text-muted fst-italic">Aucune attribution</p>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-sm table-hover align-middle mb-0">
                                    <thead>
                                        <tr class="text-white" style="background: linear-gradient(135deg, #6b7280, #4b5563);">
                                            <th class="px-3 py-2 small">ID</th>
                                            <th class="px-3 py-2 small">Ville</th>
                                            <th class="px-3 py-2 small">Quantité</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($avant['attributions'] as $attr): ?>
                                            <tr>
                                                <td class="px-3 py-2 fw-bold">#<?= $attr['id'] ?></td>
                                                <td class="px-3 py-2"><?= htmlspecialchars($attr['nom_ville']) ?></td>
                                                <td class="px-3 py-2 fw-medium"><?= number_format($attr['quantite_dispatch'], 0, ',', ' ') ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- APRÈS -->
                <div class="col-lg-6">
                    <div class="glass-card p-4">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #10b981, #059669);">
                                <i class="bi bi-check-circle"></i>
                            </div>
                            <h2 class="fs-5 fw-bold text-dark mb-0">APRÈS le dispatch</h2>
                        </div>

                        <h6 class="fw-semibold text-dark mt-3 mb-2">Besoins ouverts (<?= count($apres['besoins']) ?>)</h6>
                        <?php if (empty($apres['besoins'])): ?>
                            <div class="alert alert-success py-2 d-flex align-items-center gap-2" style="border-radius:.5rem;">
                                <i class="bi bi-check-lg"></i> Tous les besoins ont été satisfaits !
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-sm table-hover align-middle mb-0">
                                    <thead>
                                        <tr class="text-white" style="background: linear-gradient(135deg, #10b981, #059669);">
                                            <th class="px-3 py-2 small">Besoin</th>
                                            <th class="px-3 py-2 small">Ville</th>
                                            <th class="px-3 py-2 small">Reste</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($apres['besoins'] as $besoin): ?>
                                            <tr>
                                                <td class="px-3 py-2 fw-bold">#<?= $besoin['id'] ?></td>
                                                <td class="px-3 py-2"><?= htmlspecialchars($besoin['nom_ville']) ?></td>
                                                <td class="px-3 py-2 fw-medium"><?= number_format($besoin['reste'], 0, ',', ' ') ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>

                        <h6 class="fw-semibold text-dark mt-3 mb-2 d-flex align-items-center gap-2">
                            Attributions (<?= count($apres['attributions']) ?>)
                            <?php if (count($nouvelles) > 0): ?>
                                <span class="badge bg-success rounded-pill" style="animation: pulse 2s infinite;">+<?= count($nouvelles) ?> nouvelles</span>
                            <?php endif; ?>
                        </h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-hover align-middle mb-0">
                                <thead>
                                    <tr class="text-white" style="background: linear-gradient(135deg, #10b981, #059669);">
                                        <th class="px-3 py-2 small">ID</th>
                                        <th class="px-3 py-2 small">Ville</th>
                                        <th class="px-3 py-2 small">Quantité</th>
                                        <th class="px-3 py-2 small">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($apres['attributions'] as $attr): ?>
                                        <?php
                                        $isNew = false;
                                        foreach ($nouvelles as $nouvelle) {
                                            if ($nouvelle['id'] == $attr['id']) {
                                                $isNew = true;
                                                break;
                                            }
                                        }
                                        ?>
                                        <tr class="<?= $isNew ? 'table-success fw-semibold' : '' ?>">
                                            <td class="px-3 py-2 fw-bold">
                                                #<?= $attr['id'] ?>
                                                <?= $isNew ? '<span class="badge bg-success ms-1">NEW</span>' : '' ?>
                                            </td>
                                            <td class="px-3 py-2"><?= htmlspecialchars($attr['nom_ville']) ?></td>
                                            <td class="px-3 py-2 fw-medium"><?= number_format($attr['quantite_dispatch'], 0, ',', ' ') ?></td>
                                            <td class="px-3 py-2 text-muted small"><?= date('d/m/Y H:i', strtotime($attr['date_dispatch'])) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="d-flex flex-wrap justify-content-center gap-3 mt-4">
                <a href="<?= $base ?>test/dispatch" class="btn btn-lg rounded-pill px-4 py-3 d-inline-flex align-items-center gap-2 fw-bold" style="background: #e2e8f0; color: #475569; border: none;">
                    <i class="bi bi-arrow-left"></i> Retour à la liste
                </a>
                <a href="<?= $base ?>test/dispatch/don/<?= $don['id'] ?>" class="btn btn-teal btn-lg rounded-pill px-4 py-3 d-inline-flex align-items-center gap-2 fw-bold">
                    <i class="bi bi-arrow-repeat"></i> Tester à nouveau
                </a>
            </div>
        </div>
    </section>

<?php $this->render('partials/footer'); ?>