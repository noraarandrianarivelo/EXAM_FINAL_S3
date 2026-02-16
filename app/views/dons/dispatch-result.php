<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultat du Dispatch Automatique - Don #<?= $don['id'] ?></title>
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
        .alert {
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            font-size: 1.1em;
        }
        .alert-success {
            background: #d4edda;
            color: #155724;
            border-left: 5px solid #28a745;
        }
        .alert-warning {
            background: #fff3cd;
            color: #856404;
            border-left: 5px solid #ffc107;
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
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }
        .stat-item {
            text-align: center;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .stat-label {
            font-size: 0.9em;
            color: #666;
            margin-bottom: 8px;
        }
        .stat-value {
            font-size: 2em;
            font-weight: 700;
            color: #667eea;
        }
        .stat-value.success {
            color: #28a745;
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
        }
        tr:hover {
            background: #f5f5f5;
        }
        .badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85em;
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
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s;
            font-weight: 600;
            margin-right: 10px;
        }
        .btn:hover {
            background: #5568d3;
            transform: translateY(-2px);
        }
        .btn-success {
            background: #28a745;
        }
        .btn-success:hover {
            background: #218838;
        }
        .actions {
            text-align: center;
            margin-top: 30px;
        }
        .empty-state {
            text-align: center;
            padding: 40px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>✅ Don Ajouté et Dispatché Automatiquement</h1>

        <?php if ($nbAttributions > 0): ?>
            <div class="alert alert-success">
                <strong>✅ Succès !</strong> Le don a été ajouté et dispatché automatiquement. 
                <strong><?= $nbAttributions ?></strong> attribution(s) créée(s).
            </div>
        <?php else: ?>
            <div class="alert alert-warning">
                <strong>⚠️ Don ajouté</strong> Le don a été enregistré mais aucun besoin ouvert ne correspond à cette catégorie.
                Le don reste disponible pour un dispatch ultérieur.
            </div>
        <?php endif; ?>

        <div class="stats">
            <div class="stat-item">
                <div class="stat-label">Don #</div>
                <div class="stat-value"><?= $don['id'] ?></div>
            </div>
            <div class="stat-item">
                <div class="stat-label">Quantité totale</div>
                <div class="stat-value"><?= number_format($don['quantite'], 0, ',', ' ') ?></div>
            </div>
            <div class="stat-item">
                <div class="stat-label">Quantité dispatchée</div>
                <div class="stat-value success"><?= number_format($utilise, 0, ',', ' ') ?></div>
            </div>
            <div class="stat-item">
                <div class="stat-label">Reste disponible</div>
                <div class="stat-value <?= $reste > 0 ? 'success' : '' ?>">
                    <?= number_format($reste, 0, ',', ' ') ?>
                </div>
            </div>
        </div>

        <div class="card">
            <h2>📦 Informations du Don</h2>
            <table>
                <tr>
                    <th>Catégorie</th>
                    <td><?= htmlspecialchars($don['nom_categorie']) ?></td>
                </tr>
                <tr>
                    <th>Type</th>
                    <td><?= htmlspecialchars($don['nom_type_besoin']) ?></td>
                </tr>
                <tr>
                    <th>Prix unitaire</th>
                    <td><?= number_format($don['pu'], 0, ',', ' ') ?> Ar</td>
                </tr>
                <tr>
                    <th>Date de saisie</th>
                    <td><?= date('d/m/Y H:i', strtotime($don['date_saisie'])) ?></td>
                </tr>
            </table>
        </div>

        <?php if (!empty($attributions)): ?>
            <div class="card">
                <h2>✅ Attributions Créées (<?= count($attributions) ?>)</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Attribution</th>
                            <th>Besoin</th>
                            <th>Ville</th>
                            <th>Quantité dispatchée</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($attributions as $attr): ?>
                            <tr>
                                <td><strong>#<?= $attr['id'] ?></strong></td>
                                <td>Besoin #<?= $attr['id_besoin'] ?></td>
                                <td><?= htmlspecialchars($attr['nom_ville']) ?></td>
                                <td>
                                    <span class="badge badge-success">
                                        <?= number_format($attr['quantite_dispatch'], 0, ',', ' ') ?>
                                    </span>
                                </td>
                                <td><?= date('d/m/Y H:i', strtotime($attr['date_dispatch'])) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        <?php if (!empty($besoinsOuverts)): ?>
            <div class="card">
                <h2>⏳ Besoins Ouverts Restants (<?= count($besoinsOuverts) ?>)</h2>
                <p style="color: #666; margin-bottom: 15px;">
                    Ces besoins n'ont pas pu être satisfaits car la quantité du don était insuffisante.
                </p>
                <table>
                    <thead>
                        <tr>
                            <th>Besoin</th>
                            <th>Ville</th>
                            <th>Région</th>
                            <th>Reste à satisfaire</th>
                            <th>Date besoin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($besoinsOuverts as $besoin): ?>
                            <tr>
                                <td><strong>#<?= $besoin['id'] ?></strong></td>
                                <td><?= htmlspecialchars($besoin['nom_ville']) ?></td>
                                <td><?= htmlspecialchars($besoin['nom_region']) ?></td>
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
            </div>
        <?php endif; ?>

        <div class="actions">
            <a href="/dons/create" class="btn btn-success">➕ Ajouter un autre don</a>
            <a href="/test/dispatch" class="btn">📋 Voir tous les dons</a>
        </div>
    </div>
</body>
</html>
