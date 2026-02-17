<?php 
namespace app\utils;

use flight\Engine;

class FunctionUtils
{
    protected Engine $app;

    public function __construct(Engine $app)
    {
        $this->app = $app;
    }

    // Ajout de 'public' pour que la méthode soit accessible depuis le contrôleur
    public function renderPage(string $viewName, array $data = [])
    {
        // 1. Capture le contenu de la vue spécifique dans la variable $content
        $this->app->render($viewName, $data, 'content');
        
        // 2. Rend le layout principal
        // Note: On met 'partials/body' et non 'app/views/...' car Flight part du dossier views
        $this->app->render('partials/body');
    }
}
?>