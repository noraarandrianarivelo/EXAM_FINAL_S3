<section class="pt-24 pb-16 px-6 relative">
    <div class="max-w-3xl mx-auto relative">
        
        <!-- Header -->
        <div class="mb-8">
            <a href="<?= Flight::get('flight.base_url') ?>categories" class="inline-flex items-center text-sm text-gray-500 hover:text-teal-600 mb-4 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Retour à la liste
            </a>
            <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Nouvelle Catégorie</h2>
        </div>

        <!-- Carte Formulaire -->
        <div class="card border-0 shadow-xl rounded-2xl overflow-hidden" style="background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px);">
            <div class="p-8">
                <form action="<?= Flight::get('flight.base_url') ?>categories" method="POST">
                    
                    <!-- Nom -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nom de la catégorie</label>
                        <input type="text" name="nom" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 outline-none transition-all" placeholder="Ex: Riz, Eau potable...">
                    </div>

                    <!-- Type de Besoin -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Type de Besoin</label>
                        <select name="id_type_besoin" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 outline-none transition-all bg-white">
                            <option value="">-- Sélectionner un type --</option>
                            <?php foreach($types as $t): ?>
                                <option value="<?= $t['id'] ?>"><?= htmlspecialchars($t['nom']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Prix Unitaire -->
                    <div class="mb-8">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Prix Unitaire (PU)</label>
                        <div class="relative">
                            <input type="number" step="0.01" name="pu" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 outline-none transition-all" placeholder="0.00">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm">€</span>
                        </div>
                    </div>

                    <!-- Boutons -->
                    <div class="flex items-center justify-end gap-3">
                        <a href="<?= Flight::get('flight.base_url') ?>categories" class="px-5 py-2.5 text-sm font-semibold text-gray-600 hover:text-gray-800 transition-colors">
                            Annuler
                        </a>
                        <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-teal-600 to-teal-700 text-white text-sm font-semibold rounded-xl shadow-lg shadow-teal-500/30 hover:shadow-teal-500/50 hover:-translate-y-0.5 transition-all duration-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>