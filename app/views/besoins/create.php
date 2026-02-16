<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau Besoin</title>
    
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
            </div>
        </div>
    </nav>

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
                                <label for="prix_unitaire" class="form-label fw-semibold text-gray-700 mb-2">Prix Unitaire (Ar)</label>
                                <input type="number" step="0.01" class="form-control form-control-lg" id="prix_unitaire" name="prix_unitaire" placeholder="Ex: 2500.00" required>
                            </div>
                            <div class="col-md-4">
                                <label for="date_ajout" class="form-label fw-semibold text-gray-700 mb-2">Date d'ajout</label>
                                <input type="date" class="form-control form-control-lg" id="date_ajout" name="date_ajout" value="<?= date('Y-m-d') ?>" required>
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
</body>
</html>