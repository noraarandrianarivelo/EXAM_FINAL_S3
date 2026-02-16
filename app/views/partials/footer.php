    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-12 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <!-- Logo & Description -->
                <div class="md:col-span-2">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-teal-500 to-teal-700 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <span class="text-lg font-bold text-white">BNGRC</span>
                            <span class="block text-xs text-gray-500">Gestion des Dons</span>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 max-w-md">
                        Le Bureau National de Gestion des Risques et des Catastrophes coordonne 
                        les actions humanitaires pour venir en aide aux populations sinistrées.
                    </p>
                </div>

                <!-- Liens rapides -->
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-gray-300 mb-4">Navigation</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-sm hover:text-teal-400 transition-colors">Accueil</a></li>
                        <li><a href="#" class="text-sm hover:text-teal-400 transition-colors">Villes</a></li>
                        <li><a href="#" class="text-sm hover:text-teal-400 transition-colors">Besoins</a></li>
                        <li><a href="#" class="text-sm hover:text-teal-400 transition-colors">Dons</a></li>
                    </ul>
                </div>

                <!-- Actions -->
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-gray-300 mb-4">Actions</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-sm hover:text-teal-400 transition-colors">Faire un don</a></li>
                        <li><a href="#" class="text-sm hover:text-teal-400 transition-colors">Déclarer un besoin</a></li>
                        <li><a href="#" class="text-sm hover:text-teal-400 transition-colors">Dispatch</a></li>
                        <li><a href="#" class="text-sm hover:text-teal-400 transition-colors">Tableau de bord</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-xs text-gray-500">© 2025 BNGRC - Tous droits réservés</p>
                <div class="flex items-center gap-4">
                    <span class="text-xs text-gray-500">Application de gestion des dons humanitaires</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu Script -->
    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Animate elements on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe all cards
        document.querySelectorAll('.glass-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            observer.observe(card);
        });
    </script>
</body>
</html>
