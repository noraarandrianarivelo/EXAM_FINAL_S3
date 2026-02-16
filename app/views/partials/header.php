<?php $base = Flight::get('flight.base_url'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'BNGRC - Tableau de Bord' ?></title>
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
