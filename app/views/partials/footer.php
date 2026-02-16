<?php $base = Flight::get('flight.base_url'); ?>
    <!-- Footer -->
    <footer class="py-4 border-top" style="background: rgba(255,255,255,.5); backdrop-filter: blur(8px);">
        <div class="container">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
                <div class="d-flex align-items-center gap-2">
                    <div class="stat-icon bg-teal" style="width:36px;height:36px;font-size:.85rem;border-radius:8px;">
                        <i class="bi bi-heart-fill"></i>
                    </div>
                    <div>
                        <span class="fw-bold text-dark d-block lh-1">BNGRC</span>
                        <small class="text-muted" style="font-size:.65rem;">Bureau National de Gestion des Risques et Catastrophes</small>
                    </div>
                </div>
                <small class="text-muted">&copy; <?= date('Y') ?> BNGRC. Tous droits réservés.</small>
                <small class="text-muted">&copy;  ETU 003886.</small>
                <small class="text-muted">&copy;  ETU 004068</small>
                <small class="text-muted">&copy;  ETU 004196</small>
            </div>
        </div>
    </footer>

    <script src="<?= $base ?>assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
