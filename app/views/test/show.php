<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Dispatch - Don #<?= $don['id'] ?></title>
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
        }
        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #667eea;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        .card {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .card h2 {
            color: #667eea;
            margin-bottom: 15px;
            font-size: 1.3em;
        }
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }
        .info-item {
            display: flex;
            flex-direction: column;
        }
        .info-label {
            font-size: 0.85em;
            color: #666;
            margin-bottom: 5px;
        }
        .info-value {
            font-size: 1.2em;
            font-weight: 600;
            color: #333;
        }
        .badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.9em;
            font-weight: 600;
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #667eea;
            color: white;
            font-weight: 600;
            font-size: 0.9em;
        }
        tr:hover {
            background: #f5f5f5;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s;
            font-size: 1em;
            font-weight: 600;
            border: none;
            cursor: pointer;
        }
        .btn:hover {
            background: #218838;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
        }
        .btn-container {
            text-align: center;
            margin-top: 30px;
        }
        .alert {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .alert-warning {
            background: #fff3cd;
            color: #856404;
            border-left: 4px solid #ffc107;
        }
        .alert-info {
            background: #d1ecf1;
            color: #0c5460;
            border-left: 4px solid #17a2b8;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="/test/dispatch" class="back-link">← Retour à la liste des dons</a>
        
        <h1>État du Don #<?= $don['id'] ?> avant dispatch</h1>

        <div class="card">
            <h2>📦 Informations du Don</h2>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Catégorie</span>
                    <span class="info-value"><?= htmlspecialchars($don['nom_categorie']) ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Type</span>
                    <span class="info-value"><?= htmlspecialchars($don['nom_type_besoin']) ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Quantité totale</span>
                    <span class="info-value"><?= number_format($don['quantite'], 0, ',', ' ') ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Prix unitaire</span>
                    <span class="info-value"><?= number_format($don['pu'], 0, ',', ' ') ?> Ar</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Déjà attribué</span>
                    <span class="info-value"><?= number_format($utilise, 0, ',', ' ') ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Reste disponible</span>
                    <span class="info-value">
                        <?php if ($reste > 0): ?>
                            <span class="badge badge-success"><?= number_format($reste, 0, ',', ' ') ?></span>
                        <?php elseif ($reste == 0): ?>
                            <span class="badge badge-warning">0</span>
                        <?php endif; ?>
                    </span>
                </div>
            </div>
        </div>

        <?php if ($reste <= 0): ?>
            <div class="alert alert-warning">
                ⚠️ Ce don a déjà été entièrement dispatché. Aucune quantité disponible pour un nouveau dispatch.
            </div>
        <?php endif; ?>

        <div class="card">
            <h2>🎯 Besoins Ouverts pour "<?= htmlspecialchars($don['nom_categorie']) ?>"</h2>
            <?php if (empty($besoins)): ?>
                <div class="alert alert-info">
                    ℹ️ Aucun besoin ouvert pour cette catégorie. Tous les besoins ont été satisfaits.
                </div>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Ville</th>
                            <th>Région</th>
                            <th>Quantité totale</th>
                            <th>Reste à satisfaire</th>
                            <th>Date besoin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($besoins as $besoin): ?>
                            <tr>
                                <td><strong>#<?= $besoin['id'] ?></strong></td>
                                <td><?= htmlspecialchars($besoin['nom_ville']) ?></td>
                                <td><?= htmlspecialchars($besoin['nom_region']) ?></td>
                                <td><?= number_format($besoin['quantite'], 0, ',', ' ') ?></td>
                                <td>
                                    <span class="badge badge-warning">
                                        <?= number_format($besoin['reste'], 0, ',', ' ') ?>
                                    </span>
                                </td>
                                <td><?= date('d/m/Y H:i', strtotime($besoin['date_besoin'])) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>

        <?php if (!empty($attributions)): ?>
            <div class="card">
                <h2>📋 Attributions Existantes</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Besoin</th>
                            <th>Ville</th>
                            <th>Quantité</th>
                            <th>Date dispatch</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($attributions as $attr): ?>
                            <tr>
                                <td>#<?= $attr['id'] ?></td>
                                <td>Besoin #<?= $attr['id_besoin'] ?></td>
                                <td><?= htmlspecialchars($attr['nom_ville']) ?></td>
                                <td><?= number_format($attr['quantite_dispatch'], 0, ',', ' ') ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($attr['date_dispatch'])) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        <?php if ($reste > 0 && !empty($besoins)): ?>
            <div class="btn-container">
                <form method="POST" action="/test/dispatch/don/<?= $don['id'] ?>">
                    <button type="submit" class="btn">
                        🚀 Exécuter le dispatch automatique
                    </button>
                </form>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
