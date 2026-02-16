<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Don</title>
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
            max-width: 700px;
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
        .subtitle {
            color: #666;
            margin-bottom: 30px;
            font-size: 1.1em;
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
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }
        input, select {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
            transition: border-color 0.3s;
        }
        input:focus, select:focus {
            outline: none;
            border-color: #667eea;
        }
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s;
            font-size: 1em;
            font-weight: 600;
            border: none;
            cursor: pointer;
            width: 100%;
        }
        .btn:hover {
            background: #218838;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
        }
        .alert {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }
        .info-box {
            background: #e7f3ff;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border-left: 4px solid #2196f3;
        }
        .info-box h3 {
            color: #1976d2;
            margin-bottom: 10px;
            font-size: 1.1em;
        }
        .info-box p {
            color: #555;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="/test/dispatch" class="back-link">← Retour à la liste des dons</a>
        
        <h1>➕ Ajouter un Nouveau Don</h1>
        <p class="subtitle">Le dispatch sera automatiquement exécuté après l'ajout</p>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-error">
                <?php if ($_GET['error'] == 1): ?>
                    ❌ Veuillez remplir tous les champs obligatoires.
                <?php elseif ($_GET['error'] == 2): ?>
                    ❌ Erreur lors de l'ajout du don: <?= htmlspecialchars($_GET['message'] ?? '') ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="info-box">
            <h3>ℹ️ Fonctionnement du dispatch automatique</h3>
            <p>
                Une fois le don ajouté, le système dispatche automatiquement les quantités aux besoins ouverts 
                selon l'ordre FIFO (First In, First Out). Les besoins les plus anciens sont satisfaits en premier.
            </p>
        </div>

        <form method="POST" action="/dons/store">
            <div class="form-group">
                <label for="id_categorie_besoin">Catégorie de besoin *</label>
                <select name="id_categorie_besoin" id="id_categorie_besoin" required>
                    <option value="">-- Sélectionnez une catégorie --</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>">
                            <?= htmlspecialchars($cat['nom']) ?> 
                            (<?= htmlspecialchars($cat['nom_type_besoin']) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="quantite">Quantité *</label>
                <input type="number" name="quantite" id="quantite" min="1" required 
                       placeholder="Ex: 100">
            </div>

            <div class="form-group">
                <label for="pu">Prix Unitaire (Ar) *</label>
                <input type="number" name="pu" id="pu" min="0" step="0.01" required 
                       placeholder="Ex: 3000">
            </div>

            <div class="form-group">
                <label for="date_saisie">Date de saisie *</label>
                <input type="datetime-local" name="date_saisie" id="date_saisie" 
                       value="<?= date('Y-m-d\TH:i') ?>" required>
            </div>

            <button type="submit" class="btn">
                ✅ Ajouter le don et dispatcher automatiquement
            </button>
        </form>
    </div>
</body>
</html>
