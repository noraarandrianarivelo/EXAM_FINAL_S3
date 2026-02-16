<?php $base = Flight::get('flight.base_url'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BNGRC - Tableau de Bord</title>
    <link rel="stylesheet" href="<?= $base ?>assets/bootstrap/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #f8f9fa 0%, #e8f5f3 50%, #f1f3f5 100%);
            min-height: 100vh;
        }
        ::selection { background: #0d9488; color: white; }

        /* Navbar glass effect */
        .glass-nav { background: rgba(255,255,255,0.88) !important; backdrop-filter: blur(16px); border-bottom: 1px solid rgba(255,255,255,0.6); }

        /* Glass card (stats + villes) */
        .glass-card { background: rgba(255,255,255,0.7); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.6); border-radius: 1rem; transition: all .3s; }
        .glass-card:hover { box-shadow: 0 10px 40px rgba(0,0,0,.08); transform: translateY(-2px); }

        /* Teal palette */
        .text-teal { color: #0d9488 !important; }
        .bg-teal { background-color: #0d9488 !important; }
        .bg-teal-light { background-color: rgba(13,148,136,.1) !important; }
        .border-teal { border-color: #0d9488 !important; }
        .btn-teal { background: linear-gradient(135deg, #0d9488, #0f766e); color:#fff; border:none; }
        .btn-teal:hover { background: linear-gradient(135deg, #0f766e, #115e59); color:#fff; transform: translateY(-1px); box-shadow: 0 4px 15px rgba(13,148,136,.35); }

        /* Icon boxes */
        .stat-icon { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 1.25rem; }
        .stat-icon-sm { width: 56px; height: 56px; border-radius: 12px; display: flex; align-items: center; justify-content: center; }

        /* Animated progress */
        .progress-animated .progress-bar {
            background: linear-gradient(90deg, #14b8a6, #0d9488, #0f766e);
            background-size: 200% 100%;
            animation: shimmer 2s linear infinite;
        }
        @keyframes shimmer { 0% { background-position: 200% 0; } 100% { background-position: -200% 0; } }

        /* Badge styles */
        .badge-status { font-size: .7rem; font-weight: 600; padding: .35em .75em; border-radius: 50px; }

        /* Besoin item */
        .besoin-item { background: #fff; border: 1px solid #e9ecef; border-radius: .75rem; padding: 1rem; margin-bottom: .75rem; }

        /* Gradient text */
        .hero-gradient { color: transparent; background: linear-gradient(135deg, #0d9488, #10b981); -webkit-background-clip: text; background-clip: text; }

        /* Pulse dot */
        @keyframes pulse-dot { 0%, 100% { opacity: 1; } 50% { opacity: .4; } }
        .pulse-dot { display: inline-block; width: 6px; height: 6px; border-radius: 50%; animation: pulse-dot 1.5s ease-in-out infinite; }

        /* Decorative blobs */
        .blob { position: absolute; border-radius: 50%; filter: blur(80px); opacity: .3; pointer-events: none; }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-md fixed-top shadow-sm glass-nav">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center gap-2" href="<?= $base ?>">
                <div class="stat-icon bg-teal" style="width:40px;height:40px;font-size:1rem;">
                    <i class="bi bi-heart-fill"></i>
                </div>
                <div>
                    <span class="fw-bold text-dark d-block lh-1">BNGRC</span>
                    <small class="text-muted" style="font-size:.65rem;">Gestion des Dons</small>
                </div>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNav">
                <!-- Menu Principal -->
                <ul class="navbar-nav mx-auto mb-2 mb-md-0">
                    <li class="nav-item"><a class="nav-link fw-semibold text-teal border-bottom border-2 border-teal" href="<?= $base ?>">Tableau de bord</a></li>
                    <li class="nav-item"><a class="nav-link text-secondary" href="<?= $base ?>dons/create">Nouveau Don</a></li>
                    <li class="nav-item"><a class="nav-link text-secondary" href="<?= $base ?>test/dispatch">Dispatch</a></li>
                </ul>

                <!-- CTA -->
                <a href="<?= $base ?>dons/create" class="btn btn-teal btn-sm rounded-pill px-3 d-none d-sm-inline-flex align-items-center gap-1">
                    <i class="bi bi-plus-lg"></i> Faire un don
                </a>
            </div>
        </div>
    </nav>

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

    <!-- Footer -->
    <footer class="py-4 border-top" style="background: rgba(255,255,255,.5); backdrop-filter: blur(8px);">
        <div class="container">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
                <div class="d-flex align-items-center gap-2">
                    <div class="stat-icon bg-teal" style="width:36px;height:36px;font-size:.85rem;border-radius:8px;">
                        <i class="bi bi-heart-fill"></i>
                    </div>
                    <div>
                        <span class="fw-bold text-dark d-block lh-1">BNGRC</span>
                        <small class="text-muted" style="font-size:.65rem;">Bureau National de Gestion des Risques et Catastrophes</small>
                    </div>
                </div>
                <small class="text-muted">&copy; <?= date('Y') ?> BNGRC. Tous droits réservés.</small>
            </div>
        </div>
    </footer>

    <script src="<?= $base ?>assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>