<?php $this->render('partials/header', ['title' => 'BNGRC - Tableau de Bord']); ?>
<?php $base = Flight::get('flight.base_url'); ?>

    <!-- Hero Section -->
    <section class="position-relative overflow-hidden" style="padding-top: 7rem; padding-bottom: 3rem;">
        <!-- Decorative blobs -->
        <div class="blob bg-success" style="width:380px;height:380px;top:-40px;right:-60px;"></div>
        <div class="blob" style="width:320px;height:320px;bottom:-40px;left:-60px;background:#fbbf24;"></div>

        <div class="container position-relative">
            <div class="text-center mx-auto mb-5" style="max-width: 720px;">
                <!-- Badge -->
                <span class="badge bg-teal-light text-teal rounded-pill px-3 py-2 mb-3 text-uppercase fw-bold" style="font-size:.7rem; letter-spacing: 1px;">
                    <i class="bi bi-bar-chart-fill me-1"></i> Tableau de bord
                </span>

                <h1 class="display-5 fw-bold text-dark mb-3">
                    Distribution des <span class="hero-gradient">Dons Humanitaires</span>
                </h1>

                <p class="lead text-muted">
                    Suivi en temps réel de la distribution des dons aux villes sinistrées.
                    Vue d'ensemble des besoins et des attributions par ville.
                </p>
            </div>

            <!-- Stats Cards -->
            <div class="row g-3 g-md-4">
                <!-- Total Villes -->
                <div class="col-6 col-lg-3">
                    <div class="glass-card p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #3b82f6, #2563eb);">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>
                            <span class="badge bg-primary bg-opacity-10 text-primary badge-status">Villes</span>
                        </div>
                        <div class="fs-2 fw-bold text-dark"><?= $stats['total_villes'] ?></div>
                        <small class="text-muted">Villes touchées</small>
                    </div>
                </div>
                <!-- Total Besoins -->
                <div class="col-6 col-lg-3">
                    <div class="glass-card p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #f59e0b, #ea580c);">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                            </div>
                            <span class="badge bg-warning bg-opacity-10 text-warning badge-status">Urgent</span>
                        </div>
                        <div class="fs-2 fw-bold text-dark"><?= number_format($stats['total_besoins']) ?></div>
                        <small class="text-muted">Besoins totaux</small>
                    </div>
                </div>
                <!-- Total Dons -->
                <div class="col-6 col-lg-3">
                    <div class="glass-card p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #10b981, #059669);">
                                <i class="bi bi-gift-fill"></i>
                            </div>
                            <span class="badge bg-success bg-opacity-10 text-success badge-status">
                                <span class="pulse-dot bg-success me-1"></span> Actif
                            </span>
                        </div>
                        <div class="fs-2 fw-bold text-dark"><?= number_format($stats['total_dons']) ?></div>
                        <small class="text-muted">Dons reçus</small>
                    </div>
                </div>
                <!-- Total Attributions -->
                <div class="col-6 col-lg-3">
                    <div class="glass-card p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #14b8a6, #06b6d4);">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <span class="badge bg-teal-light text-teal badge-status">Distribué</span>
                        </div>
                        <div class="fs-2 fw-bold text-dark"><?= number_format($stats['total_attributions']) ?></div>
                        <small class="text-muted">Distributions effectuées</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Dons avec boutons Simuler / Valider -->
    <section class="py-5">
        <div class="container">
            <div class="d-flex flex-column flex-md-row align-items-md-end justify-content-between mb-4">
                <div>
                    <small class="text-teal fw-bold text-uppercase" style="letter-spacing: 2px;">Dispatch automatique</small>
                    <h2 class="fw-bold text-dark mb-0">Liste des Dons</h2>
                </div>
                <a href="<?= $base ?>dons/create" class="btn btn-teal rounded-pill px-3 py-2 d-inline-flex align-items-center gap-2">
                    <i class="bi bi-plus-lg"></i> Nouveau don
                </a>
            </div>

            <?php if (empty($dons)): ?>
                <div class="glass-card p-5 text-center">
                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width:64px;height:64px;">
                        <i class="bi bi-box-seam fs-3 text-muted"></i>
                    </div>
                    <h5 class="fw-bold text-dark">Aucun don disponible</h5>
                    <p class="text-muted mb-0">Ajoutez votre premier don pour commencer le dispatch.</p>
                </div>
            <?php else: ?>
                <div class="glass-card overflow-hidden">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr class="text-white" style="background: linear-gradient(135deg, #0d9488, #0f766e);">
                                    <th class="px-3 py-3 text-uppercase small fw-semibold" style="letter-spacing:.5px;">ID</th>
                                    <th class="px-3 py-3 text-uppercase small fw-semibold" style="letter-spacing:.5px;">Catégorie</th>
                                    <th class="px-3 py-3 text-uppercase small fw-semibold" style="letter-spacing:.5px;">Quantité</th>
                                    <th class="px-3 py-3 text-uppercase small fw-semibold" style="letter-spacing:.5px;">Dispatché</th>
                                    <th class="px-3 py-3 text-uppercase small fw-semibold" style="letter-spacing:.5px;">Reste</th>
                                    <th class="px-3 py-3 text-uppercase small fw-semibold" style="letter-spacing:.5px;">Status</th>
                                    <th class="px-3 py-3 text-uppercase small fw-semibold" style="letter-spacing:.5px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dons as $don): ?>
                                    <?php $pourcentageDon = $don['quantite'] > 0 ? ($don['utilise'] / $don['quantite']) * 100 : 0; ?>
                                    <tr>
                                        <td class="px-3 py-3"><span class="fw-bold text-dark">#<?= $don['id'] ?></span></td>
                                        <td class="px-3 py-3"><span class="badge bg-primary bg-opacity-10 text-primary rounded-pill"><?= htmlspecialchars($don['nom_categorie'] ?? 'N/A') ?></span></td>
                                        <td class="px-3 py-3 fw-bold"><?= number_format($don['quantite'], 0, ',', ' ') ?></td>
                                        <td class="px-3 py-3">
                                            <?= number_format($don['utilise'], 0, ',', ' ') ?>
                                            <?php if ($don['nb_attributions'] > 0): ?>
                                                <small class="text-muted d-block">(<?= $don['nb_attributions'] ?> attr.)</small>
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
                                            <?php if ($pourcentageDon == 100): ?>
                                                <span class="badge bg-success bg-opacity-10 text-success badge-status">✓ Complet</span>
                                            <?php elseif ($pourcentageDon > 0): ?>
                                                <span class="badge bg-warning bg-opacity-10 text-warning badge-status">⏳ Partiel</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger bg-opacity-10 text-danger badge-status">✗ Nouveau</span>
                                            <?php endif; ?>
                                            <div class="progress progress-animated mt-1" style="height: 5px; border-radius: 50px;">
                                                <div class="progress-bar" style="width: <?= $pourcentageDon ?>%"></div>
                                            </div>
                                        </td>
                                        <td class="px-3 py-3">
                                            <div class="d-flex flex-wrap gap-1">
                                                <a href="<?= $base ?>test/dispatch/don/<?= $don['id'] ?>" class="btn btn-sm btn-outline-secondary rounded-pill d-inline-flex align-items-center gap-1" title="Détails">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <form action="<?= $base ?>test/dispatch/don/<?= $don['id'] ?>/simuler" method="POST" class="d-inline">
                                                    <button type="submit" class="btn btn-sm btn-primary rounded-pill d-inline-flex align-items-center gap-1" title="Simuler le dispatch">
                                                        <i class="bi bi-lightning"></i> Simuler
                                                    </button>
                                                </form>
                                                <form action="<?= $base ?>test/dispatch/don/<?= $don['id'] ?>/valider" method="POST" class="d-inline" onsubmit="return confirm('⚠️ Êtes-vous sûr de vouloir dispatcher ce don ? Cette action est irréversible.')">
                                                    <button type="submit" class="btn btn-sm btn-teal rounded-pill d-inline-flex align-items-center gap-1" title="Valider le dispatch">
                                                        <i class="bi bi-check-circle"></i> Valider
                                                    </button>
                                                </form>
                                            </div>
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

    <!-- Section Villes avec leurs besoins -->
    <section class="py-5">
        <div class="container">
            <div class="d-flex flex-column flex-md-row align-items-md-end justify-content-between mb-4">
                <div>
                    <small class="text-teal fw-bold text-uppercase" style="letter-spacing: 2px;">Distribution par ville</small>
                    <h2 class="fw-bold text-dark mb-0">Villes et besoins</h2>
                </div>
                <a href="<?= $base ?>test/dispatch" class="text-teal fw-semibold text-decoration-none mt-2 mt-md-0">
                    Gérer les dons <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>

            <?php if (empty($villesData)): ?>
                <div class="glass-card p-5 text-center">
                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width:64px;height:64px;">
                        <i class="bi bi-inbox fs-3 text-muted"></i>
                    </div>
                    <h5 class="fw-bold text-dark">Aucune donnée disponible</h5>
                    <p class="text-muted mb-0">Aucune ville avec des besoins n'a été trouvée dans la base de données.</p>
                </div>
            <?php else: ?>
                <?php foreach ($villesData as $ville): ?>
                    <?php
                    $pourcentage = $ville['pourcentage'];
                    $statusBadge = 'bg-danger bg-opacity-10 text-danger';
                    $statusText = 'Urgent';

                    if ($pourcentage >= 80) {
                        $statusBadge = 'bg-success bg-opacity-10 text-success';
                        $statusText = 'Bon';
                    } elseif ($pourcentage >= 50) {
                        $statusBadge = 'bg-warning bg-opacity-10 text-warning';
                        $statusText = 'Moyen';
                    }
                    ?>

                    <!-- Carte Ville -->
                    <div class="glass-card p-4 mb-4">
                        <!-- En-tête de la ville -->
                        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between pb-3 mb-3 border-bottom">
                            <div class="d-flex align-items-center gap-3 mb-3 mb-md-0">
                                <div class="stat-icon-sm bg-light" style="color: #6b7280;">
                                    <i class="bi bi-geo-alt fs-4"></i>
                                </div>
                                <div>
                                    <h4 class="fw-bold text-dark mb-0"><?= htmlspecialchars($ville['nom']) ?></h4>
                                    <small class="text-muted"><?= htmlspecialchars($ville['region']) ?> &bull; <?= $ville['nb_besoins'] ?> besoin<?= $ville['nb_besoins'] > 1 ? 's' : '' ?></small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <div class="text-end">
                                    <small class="text-muted d-block">Couverture globale</small>
                                    <span class="fs-4 fw-bold text-teal"><?= number_format($pourcentage, 1) ?>%</span>
                                </div>
                                <span class="badge <?= $statusBadge ?> badge-status"><?= $statusText ?></span>
                            </div>
                        </div>

                        <!-- Statistiques résumées -->
                        <div class="row g-3 mb-3">
                            <div class="col-4">
                                <div class="bg-light rounded-3 p-3">
                                    <small class="text-muted d-block">Total requis</small>
                                    <span class="fs-5 fw-bold text-dark"><?= number_format($ville['total_besoins']) ?></span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="bg-light rounded-3 p-3">
                                    <small class="text-muted d-block">Reçu</small>
                                    <span class="fs-5 fw-bold text-success"><?= number_format($ville['total_recus']) ?></span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="bg-light rounded-3 p-3">
                                    <small class="text-muted d-block">Reste</small>
                                    <span class="fs-5 fw-bold text-danger"><?= number_format($ville['reste']) ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- Barre de progression -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <small class="text-secondary fw-medium">Progression de la distribution</small>
                                <small class="text-muted"><?= number_format($ville['total_recus']) ?> / <?= number_format($ville['total_besoins']) ?></small>
                            </div>
                            <div class="progress progress-animated" style="height: 10px; border-radius: 50px;">
                                <div class="progress-bar" style="width: <?= $pourcentage ?>%"></div>
                            </div>
                        </div>

                        <!-- Liste des besoins -->
                        <?php if (!empty($ville['besoins'])): ?>
                            <h6 class="text-muted text-uppercase fw-bold mb-3" style="font-size:.75rem; letter-spacing: 1px;">Détail des besoins</h6>
                            <?php foreach ($ville['besoins'] as $besoin): ?>
                                <?php
                                $besoinPourcentage = $besoin['quantite_besoin'] > 0 ?
                                    ($besoin['quantite_recue'] / $besoin['quantite_besoin'] * 100) : 0;
                                $besoinBadge = 'text-bg-danger';
                                if ($besoinPourcentage >= 100) {
                                    $besoinBadge = 'text-bg-success';
                                } elseif ($besoinPourcentage >= 50) {
                                    $besoinBadge = 'text-bg-warning';
                                }
                                ?>
                                <div class="besoin-item">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <span class="fw-semibold text-dark"><?= htmlspecialchars($besoin['nom_categorie']) ?></span>
                                            <span class="badge bg-light text-secondary ms-2" style="font-size:.7rem;"><?= htmlspecialchars($besoin['nom_type']) ?></span>
                                            <br><small class="text-muted">Demandé le <?= date('d/m/Y', strtotime($besoin['date_besoin'])) ?></small>
                                        </div>
                                        <span class="badge <?= $besoinBadge ?> rounded-pill"><?= number_format($besoinPourcentage, 0) ?>%</span>
                                    </div>
                                    <div class="row g-2 mb-2">
                                        <div class="col-4">
                                            <small class="text-muted d-block">Requis</small>
                                            <span class="fw-bold text-dark"><?= number_format($besoin['quantite_besoin']) ?></span>
                                        </div>
                                        <div class="col-4">
                                            <small class="text-muted d-block">Reçu</small>
                                            <span class="fw-bold text-success"><?= number_format($besoin['quantite_recue']) ?></span>
                                        </div>
                                        <div class="col-4">
                                            <small class="text-muted d-block">Reste</small>
                                            <span class="fw-bold text-danger"><?= number_format($besoin['reste']) ?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-animated" style="height: 6px; border-radius: 50px;">
                                        <div class="progress-bar" style="width: <?= min($besoinPourcentage, 100) ?>%"></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>

<?php $this->render('partials/footer'); ?>