<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Dispatch - Liste des Dons</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            padding: 30px;
        }
        h1 {
            color: #333;
            margin-bottom: 10px;
            font-size: 2em;
        }
        .description {
            color: #666;
            margin-bottom: 30px;
            font-size: 1.1em;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #667eea;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9em;
            letter-spacing: 0.5px;
        }
        tr:hover {
            background: #f5f5f5;
        }
        .btn {
            display: inline-block;
            padding: 8px 16px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s;
            font-size: 0.9em;
        }
        .btn:hover {
            background: #5568d3;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.85em;
            font-weight: 600;
        }
        .badge-primary {
            background: #e3f2fd;
            color: #1976d2;
        }
        .badge-success {
            background: #d4edda;
            color: #155724;
        }
        .badge-warning {
            background: #fff3cd;
            color: #856404;
        }
        .badge-danger {
            background: #f8d7da;
            color: #721c24;
        }
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #999;
        }
        .empty-state i {
            font-size: 4em;
            margin-bottom: 20px;
            opacity: 0.3;
        }
        .btn-add {
            background: #28a745;
            margin-bottom: 20px;
            padding: 12px 24px;
            font-weight: 600;
        }
        .btn-add:hover {
            background: #218838;
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
        }
        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .progress-bar {
            background: #e9ecef;
            border-radius: 10px;
            height: 8px;
            overflow: hidden;
            margin-top: 5px;
        }
        .progress-fill {
            background: #28a745;
            height: 100%;
            transition: width 0.3s;
        }
    </style>
</head>
<<<<<<< Updated upstream
<body>
    <div class="container">
        <div class="header-actions">
            <div>
                <h1>📦 Gestion des Dons avec Dispatch Automatique</h1>
                <p class="description">
                    Les dons sont automatiquement dispatchés aux besoins ouverts (FIFO)
                </p>
=======
<body class="bg-gradient-to-br from-slate-50 via-teal-50/30 to-slate-100 min-h-screen">
    <!-- Header Section -->
<section class="pt-24 pb-12 px-6">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
            <div>
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-teal-50 border border-teal-200 rounded-full text-teal-700 text-xs font-semibold uppercase tracking-wider mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                    Gestion des Dons
                </div>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 tracking-tight mb-3">
                    📦 Dispatch <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-600 to-emerald-500">Automatique</span>
                </h1>
                <p class="text-lg text-gray-600">
                    Les dons sont automatiquement dispatchés aux besoins ouverts selon l'ordre FIFO
                </p>
            </div>
            
            <!-- Groupe de boutons d'action -->
            <div class="mt-6 md:mt-0 flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                <!-- Nouveau lien : Déclarer un besoin -->
                <a href="<?= Flight::get('flight.base_url') ?>besoins/create" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white border border-gray-200 text-gray-700 font-semibold rounded-xl shadow-sm hover:bg-gray-50 hover:border-gray-300 transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                    Déclarer un besoin
                </a>

                <!-- Bouton existant : Ajouter un don -->
                <a href="<?= Flight::get('flight.base_url') ?>dons/create" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-teal-600 to-teal-700 text-white font-semibold rounded-xl shadow-lg shadow-teal-500/30 hover:shadow-teal-500/50 hover:-translate-y-0.5 transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Ajouter un don
                </a>
>>>>>>> Stashed changes
            </div>
            <a href="/dons/create" class="btn btn-add">➕ Ajouter un nouveau don</a>
        </div>
<<<<<<< Updated upstream
=======
    </div>
</section>
>>>>>>> Stashed changes

        <?php if (empty($dons)): ?>
            <div class="empty-state">
                <div>📦</div>
                <h2>Aucun don disponible</h2>
                <p>Ajoutez un nouveau don pour commencer</p>
                <br>
                <a href="/dons/create" class="btn btn-add">➕ Ajouter un don</a>
            </div>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Catégorie</th>
                        <th>Type</th>
                        <th>Quantité</th>
                        <th>Dispatché</th>
                        <th>Reste</th>
                        <th>Status</th>
                        <th>Date Saisie</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dons as $don): ?>
                        <tr>
                            <td><strong>#<?= htmlspecialchars($don['id']) ?></strong></td>
                            <td>
                                <span class="badge badge-primary">
                                    <?= htmlspecialchars($don['nom_categorie']) ?>
                                </span>
                            </td>
                            <td><?= htmlspecialchars($don['nom_type_besoin']) ?></td>
                            <td><strong><?= number_format($don['quantite'], 0, ',', ' ') ?></strong></td>
                            <td>
                                <strong><?= number_format($don['utilise'], 0, ',', ' ') ?></strong>
                                <?php if ($don['nb_attributions'] > 0): ?>
                                    <br><small style="color: #666;">(<?= $don['nb_attributions'] ?> attribution(s))</small>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($don['reste'] > 0): ?>
                                    <span class="badge badge-success"><?= number_format($don['reste'], 0, ',', ' ') ?></span>
                                <?php elseif ($don['reste'] == 0): ?>
                                    <span class="badge badge-warning">0</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php 
                                $pourcentage = $don['quantite'] > 0 ? ($don['utilise'] / $don['quantite']) * 100 : 0;
                                ?>
                                <?php if ($pourcentage == 100): ?>
                                    <span class="badge badge-success">✅ Complet</span>
                                <?php elseif ($pourcentage > 0): ?>
                                    <span class="badge badge-warning">⏳ Partiel</span>
                                <?php else: ?>
                                    <span class="badge badge-danger">❌ Non dispatché</span>
                                <?php endif; ?>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: <?= $pourcentage ?>%"></div>
                                </div>
                            </td>
                            <td><?= date('d/m/Y H:i', strtotime($don['date_saisie'])) ?></td>
                            <td>
                                <a href="/test/dispatch/don/<?= $don['id'] ?>" class="btn">
                                    Voir détails
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
