<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le besoin</title>
    
    <!-- Bootstrap Local CSS -->
    <link href="<?= Flight::get('flight.base_url') ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        .form-control, .form-select {
            border-radius: 0.75rem !important;
            border: 1px solid #e2e8f0 !important;
            background-color: #f8fafc !important;
            padding: 0.75rem 1rem !important;
            transition: all 0.3s ease;
        }
        .form-control:focus, .form-select:focus {
            border-color: #14b8a6 !important;
            box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.2) !important;
            background-color: #fff !important;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-50 via-teal-50/30 to-slate-100 min-h-screen">

    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 h-20" style="background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(226, 232, 240, 0.5);">
        <div class="max-w-7xl mx-auto px-6 h-full flex items-center justify-between">
            <a href="<?= Flight::get('flight.base_url') ?>" class="flex items-center gap-3 group">
                <div class="w-10 h-10 bg-gradient-to-br from-teal-500 to-teal-700 rounded-xl flex items-center justify-center shadow-lg shadow-teal-500/30">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <span class="text-xl font-bold text-gray-900">BNGRC</span>
            </a>

            <div class="hidden md:flex items-center gap-8">
                <a href="<?= Flight::get('flight.base_url') ?>" class="text-sm font-medium text-gray-600 hover:text-teal-700 transition-colors">Tableau de bord</a>
                <a href="<?= Flight::get('flight.base_url') ?>besoins" class="text-sm font-semibold text-teal-700 border-b-2 border-teal-500 pb-1">Besoins</a>
                <a href="<?= Flight::get('flight.base_url') ?>dons/create" class="text-sm font-medium text-gray-600 hover:text-teal-700 transition-colors">Nouveau Don</a>
            </div>
        </div>
    </nav>

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
                                <label class="form-label fw-semibold text-gray-700 mb-2">Prix Unitaire</label>
                                <input type="number" step="0.01" name="prix_unitaire" value="<?= $besoin['pu'] ?>" class="form-control form-control-lg" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-gray-700 mb-2">Date</label>
                                <input type="date" name="date_ajout" value="<?= $besoin['date_besoin'] ?>" class="form-control form-control-lg" required>
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
</body>
</html>