<!-- Navigation -->
<?php 
// Récupération de l'URL actuelle
 $current_url = $_SERVER['REQUEST_URI'];
 $base_url = Flight::get('flight.base_url');

// Classes CSS prédéfinies
 $active_class = "text-sm font-semibold text-teal-700 border-b-2 border-teal-500 pb-1";
 $inactive_class = "text-sm font-medium text-gray-600 hover:text-teal-700 transition-colors";
?>

<nav class="glass-nav fixed top-0 left-0 right-0 z-50 h-20 " style="background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(226, 232, 240, 0.5);">
    <div class="max-w-7xl mx-auto px-6 h-full flex items-center justify-between">
        <!-- Logo -->
        <a href="<?= $base_url ?>" class="flex items-center gap-3 group">
            <div class="w-12 h-12 bg-gradient-to-br from-teal-500 to-teal-700 rounded-xl flex items-center justify-center shadow-lg shadow-teal-500/30 group-hover:shadow-teal-500/50 transition-all duration-300">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
            </div>
            <div>
                <span class="text-xl font-bold text-gray-900 tracking-tight">BNGRC</span>
                <span class="block text-xs text-gray-500 font-medium -mt-0.5">Gestion des Dons</span>
            </div>
        </a>

        <!-- Menu Principal -->
        <div class="hidden md:flex items-center gap-8">
            <?php $is_home = ($current_url == $base_url || $current_url == '/' || strpos($current_url, 'index') !== false); ?>
            <a href="<?= $base_url ?>" class="<?= $is_home ? $active_class : $inactive_class ?>">Tableau de bord</a>
            
            <a href="<?= $base_url ?>recapitulation" class="<?= strpos($current_url, 'recapitulation') !== false ? $active_class : $inactive_class ?>">Récapitulation</a>
            
            <a href="<?= $base_url ?>dons/create" class="<?= strpos($current_url, 'dons/create') !== false ? $active_class : $inactive_class ?>">Nouveau Don</a>
            
            <a href="<?= $base_url ?>test/dispatch" class="<?= strpos($current_url, 'test/dispatch') !== false ? $active_class : $inactive_class ?>">Dispatch</a>
            
            <a href="<?= $base_url ?>achats/besoins-achetables" class="<?= strpos($current_url, 'achats/besoins-achetables') !== false ? $active_class : $inactive_class ?>">Achats</a>
            
            <?php $is_achats_list = strpos($current_url, 'achats') !== false && strpos($current_url, 'besoins-achetables') === false && strpos($current_url, 'achats/besoins-achetables') === false; ?>
            <a href="<?= $base_url ?>achats" class="<?= $is_achats_list ? $active_class : $inactive_class ?>">Liste Achats</a>
            
            <a href="<?= $base_url ?>besoins" class="<?= strpos($current_url, 'besoins') !== false ? $active_class : $inactive_class ?>">Besoins</a>
            
            <a href="<?= $base_url ?>villes" class="<?= strpos($current_url, 'villes') !== false ? $active_class : $inactive_class ?>">Villes</a>
            
            <a href="<?= $base_url ?>categories" class="<?= strpos($current_url, 'categories') !== false ? $active_class : $inactive_class ?>">Categories Besoins</a>
        </div>

        <!-- CTA -->
        <div class="flex items-center gap-4">
            <a href="<?= $base_url ?>dons/create" class="hidden sm:inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-teal-600 to-teal-700 text-white text-sm font-semibold rounded-xl shadow-lg shadow-teal-500/30 hover:shadow-teal-500/50 hover:-translate-y-0.5 transition-all duration-300">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Faire un don
            </a>
            <!-- Mobile menu button -->
            <button class="md:hidden p-2 text-gray-600 hover:text-teal-700" id="mobile-menu-btn">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>
</nav>