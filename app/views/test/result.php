<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultat du Dispatch - Don #<?= $don['id'] ?></title>
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
            max-width: 1400px;
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
        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            border-left: 5px solid #dc3545;
        }
        .comparison {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }
        .card {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
        }
        .card h2 {
            color: #667eea;
            margin-bottom: 15px;
            font-size: 1.3em;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .card-before h2 {
            color: #6c757d;
        }
        .card-after h2 {
            color: #28a745;
        }
        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }
        .stat-item {
            text-align: center;
            padding: 15px;
            background: white;
            border-radius: 5px;
        }
        .stat-label {
            font-size: 0.85em;
            color: #666;
            margin-bottom: 5px;
        }
        .stat-value {
            font-size: 1.5em;
            font-weight: 700;
            color: #333;
        }
        .stat-change {
            font-size: 0.9em;
            margin-top: 5px;
        }
        .stat-change.positive {
            color: #28a745;
        }
        .stat-change.negative {
            color: #dc3545;
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
            font-size: 0.9em;
        }
        th {
            background: #667eea;
            color: white;
            font-weight: 600;
        }
        .card-after th {
            background: #28a745;
        }
        tr:hover {
            background: #f5f5f5;
        }
        .highlight-new {
            background: #d4edda !important;
            font-weight: 600;
        }
        .badge {
            display: inline-block;
            padding: 5px 10px;
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
        .badge-new {
            background: #28a745;
            color: white;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
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
        @media (max-width: 768px) {
            .comparison {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="/test/dispatch" class="back-link">← Retour à la liste des dons</a>
        
        <h1>✅ Résultat du Dispatch - Don #<?= $don['id'] ?></h1>

        <?php if ($resultat): ?>
            <div class="alert alert-success">
                <strong>✅ Succès !</strong> Le dispatch a été exécuté avec succès. 
                <?= count($nouvelles) ?> nouvelle(s) attribution(s) créée(s).
            </div>
        <?php else: ?>
            <div class="alert alert-danger">
                <strong>❌ Échec</strong> Le dispatch n'a pas pu être exécuté (don vide ou déjà entièrement dispatché).
            </div>
        <?php endif; ?>

        <div class="stats">
            <div class="stat-item">
                <div class="stat-label">Quantité totale</div>
                <div class="stat-value"><?= number_format($don['quantite'], 0, ',', ' ') ?></div>
            </div>
            <div class="stat-item">
                <div class="stat-label">Quantité utilisée</div>
                <div class="stat-value"><?= number_format($apres['utilise'], 0, ',', ' ') ?></div>
                <?php if ($apres['utilise'] > $avant['utilise']): ?>
                    <div class="stat-change positive">
                        +<?= number_format($apres['utilise'] - $avant['utilise'], 0, ',', ' ') ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="stat-item">
                <div class="stat-label">Reste disponible</div>
                <div class="stat-value"><?= number_format($apres['reste'], 0, ',', ' ') ?></div>
                <?php if ($apres['reste'] < $avant['reste']): ?>
                    <div class="stat-change negative">
                        <?= number_format($apres['reste'] - $avant['reste'], 0, ',', ' ') ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="comparison">
            <!-- AVANT -->
            <div class="card card-before">
                <h2>⏪ AVANT le dispatch</h2>
                
                <h3 style="margin-top: 20px; margin-bottom: 10px; font-size: 1.1em;">Besoins ouverts (<?= count($avant['besoins']) ?>)</h3>
                <?php if (empty($avant['besoins'])): ?>
                    <p style="color: #999; font-style: italic;">Aucun besoin ouvert</p>
                <?php else: ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Besoin</th>
                                <th>Ville</th>
                                <th>Reste</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($avant['besoins'] as $besoin): ?>
                                <tr>
                                    <td>#<?= $besoin['id'] ?></td>
                                    <td><?= htmlspecialchars($besoin['nom_ville']) ?></td>
                                    <td><?= number_format($besoin['reste'], 0, ',', ' ') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>

                <h3 style="margin-top: 20px; margin-bottom: 10px; font-size: 1.1em;">Attributions (<?= count($avant['attributions']) ?>)</h3>
                <?php if (empty($avant['attributions'])): ?>
                    <p style="color: #999; font-style: italic;">Aucune attribution</p>
                <?php else: ?>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ville</th>
                                <th>Quantité</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($avant['attributions'] as $attr): ?>
                                <tr>
                                    <td>#<?= $attr['id'] ?></td>
                                    <td><?= htmlspecialchars($attr['nom_ville']) ?></td>
                                    <td><?= number_format($attr['quantite_dispatch'], 0, ',', ' ') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>

            <!-- APRÈS -->
            <div class="card card-after">
                <h2>⏩ APRÈS le dispatch</h2>
                
                <h3 style="margin-top: 20px; margin-bottom: 10px; font-size: 1.1em;">Besoins ouverts (<?= count($apres['besoins']) ?>)</h3>
                <?php if (empty($apres['besoins'])): ?>
                    <p style="color: #28a745; font-weight: 600;">✅ Tous les besoins ont été satisfaits !</p>
                <?php else: ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Besoin</th>
                                <th>Ville</th>
                                <th>Reste</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($apres['besoins'] as $besoin): ?>
                                <tr>
                                    <td>#<?= $besoin['id'] ?></td>
                                    <td><?= htmlspecialchars($besoin['nom_ville']) ?></td>
                                    <td><?= number_format($besoin['reste'], 0, ',', ' ') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>

                <h3 style="margin-top: 20px; margin-bottom: 10px; font-size: 1.1em;">
                    Attributions (<?= count($apres['attributions']) ?>)
                    <?php if (count($nouvelles) > 0): ?>
                        <span class="badge badge-new">+<?= count($nouvelles) ?> nouvelles</span>
                    <?php endif; ?>
                </h3>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Ville</th>
                            <th>Quantité</th>
                            <th>Date</th>
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
                            <tr <?= $isNew ? 'class="highlight-new"' : '' ?>>
                                <td>
                                    #<?= $attr['id'] ?>
                                    <?= $isNew ? '<span class="badge badge-new">NEW</span>' : '' ?>
                                </td>
                                <td><?= htmlspecialchars($attr['nom_ville']) ?></td>
                                <td><?= number_format($attr['quantite_dispatch'], 0, ',', ' ') ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($attr['date_dispatch'])) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="actions">
            <a href="/test/dispatch" class="btn">← Retour à la liste</a>
            <a href="/test/dispatch/don/<?= $don['id'] ?>" class="btn btn-success">🔄 Tester à nouveau</a>
        </div>
    </div>
</body>
</html>
