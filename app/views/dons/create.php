<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BNGRC - Ajouter un Don</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        ::selection {
            background: #0d9488;
            color: white;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.6);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 via-teal-50/30 to-slate-100 min-h-screen">
    <section class="py-12 px-6">
        <div class="max-w-3xl mx-auto">
            <!-- Back Link -->
            <a href="<?= Flight::get('flight.base_url') ?>test/dispatch" class="inline-flex items-center gap-2 text-teal-600 hover:text-teal-700 font-medium mb-6 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Retour à la liste des dons
            </a>

            <!-- Header -->
            <div class="mb-8">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-teal-50 border border-teal-200 rounded-full text-teal-700 text-xs font-semibold uppercase tracking-wider mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Nouveau Don
                </div>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 tracking-tight mb-3">
                    Ajouter un <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-600 to-emerald-500">Don</span>
                </h1>
                <p class="text-lg text-gray-600">
                    Le dispatch sera automatiquement exécuté après l'ajout du don
                </p>
            </div>

            <?php if (isset($_GET['error'])): ?>
                <div class="glass-card rounded-xl p-4 mb-6 border-l-4 border-red-500 bg-red-50/80">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div class="flex-1">
                            <h3 class="font-semibold text-red-900 mb-1">Erreur</h3>
                            <p class="text-sm text-red-800">
                                <?php if ($_GET['error'] == 1): ?>
                                    Veuillez remplir tous les champs obligatoires.
                                <?php elseif ($_GET['error'] == 2): ?>
                                    Erreur lors de l'ajout du don: <?= htmlspecialchars($_GET['message'] ?? '') ?>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Info Box -->
            <div class="glass-card rounded-xl p-6 mb-8 border-l-4 border-blue-500">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-gray-900 mb-2">Fonctionnement du dispatch automatique</h3>
                        <p class="text-gray-700 leading-relaxed">
                            Une fois le don ajouté, le système dispatche automatiquement les quantités aux besoins ouverts 
                            selon l'ordre FIFO (First In, First Out). Les besoins les plus anciens sont satisfaits en premier.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="glass-card rounded-2xl p-8 shadow-xl">
                <form method="POST" action="<?= Flight::get('flight.base_url') ?>dons/store" class="space-y-6">
                    <!-- Catégorie -->
                    <div>
                        <label for="id_categorie_besoin" class="block text-sm font-semibold text-gray-900 mb-2">
                            Catégorie de besoin <span class="text-red-500">*</span>
                        </label>
                        <select name="id_categorie_besoin" id="id_categorie_besoin" required 
                                class="w-full px-4 py-3 bg-white border-2 border-gray-300 rounded-xl focus:border-teal-500 focus:ring-4 focus:ring-teal-500/20 transition-all outline-none">
                            <option value="">-- Sélectionnez une catégorie --</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>">
                                    <?= htmlspecialchars($cat['nom']) ?> 
                                    (<?= htmlspecialchars($cat['nom_type_besoin']) ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Quantité -->
                    <div>
                        <label for="quantite" class="block text-sm font-semibold text-gray-900 mb-2">
                            Quantité <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="quantite" id="quantite" min="1" required 
                               placeholder="Ex: 100"
                               class="w-full px-4 py-3 bg-white border-2 border-gray-300 rounded-xl focus:border-teal-500 focus:ring-4 focus:ring-teal-500/20 transition-all outline-none">
                    </div>

                    <!-- Prix Unitaire -->
                    <div>
                        <label for="pu" class="block text-sm font-semibold text-gray-900 mb-2">
                            Prix Unitaire (Ar) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="pu" id="pu" min="0" step="0.01" required 
                               placeholder="Ex: 3000"
                               class="w-full px-4 py-3 bg-white border-2 border-gray-300 rounded-xl focus:border-teal-500 focus:ring-4 focus:ring-teal-500/20 transition-all outline-none">
                    </div>

                    <!-- Date de saisie -->
                    <div>
                        <label for="date_saisie" class="block text-sm font-semibold text-gray-900 mb-2">
                            Date de saisie <span class="text-red-500">*</span>
                        </label>
                        <input type="datetime-local" name="date_saisie" id="date_saisie" 
                               value="<?= date('Y-m-d\TH:i') ?>" required
                               class="w-full px-4 py-3 bg-white border-2 border-gray-300 rounded-xl focus:border-teal-500 focus:ring-4 focus:ring-teal-500/20 transition-all outline-none">
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full flex items-center justify-center gap-3 px-6 py-4 bg-gradient-to-r from-teal-600 to-teal-700 text-white font-bold text-lg rounded-xl shadow-lg shadow-teal-500/30 hover:shadow-teal-500/50 hover:-translate-y-0.5 transition-all duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Ajouter le don et dispatcher automatiquement
                    </button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
