<?php

use app\controllers\DashboardController;
use app\controllers\TestController;
use app\controllers\DonController;
use app\controllers\AchatController;
use app\controllers\BesoinController;
use app\controllers\VilleController;
use app\middlewares\SecurityHeadersMiddleware;
use flight\Engine;
use flight\net\Router;

/** 
 * @var Router $router 
 * @var Engine $app
 */

// This wraps all routes in the group with the SecurityHeadersMiddleware
$router->group('', function(Router $router) use ($app) {

	$router->get('/', [ DashboardController::class, 'showDashboard' ]);

	// Routes pour la récapitulation
	$router->get('/recapitulation', [ DashboardController::class, 'recapitulation' ]);
	$router->get('/api/stats-recapitulation', [ DashboardController::class, 'getStatsRecapitulation' ]);
	
	// Route pour réinitialiser les données
	$router->post('/admin/reset', [ DashboardController::class, 'resetData' ]);

	// Routes pour les dons (sans dispatch automatique)
	$router->group('/dons', function(Router $router) {
		$router->get('/create', [ DonController::class, 'create' ]);
		$router->post('/store', [ DonController::class, 'store' ]);
	});

	// Routes de test pour le dispatch
	$router->group('/test', function(Router $router) {
		$router->get('/dispatch', [ TestController::class, 'index' ]);
		$router->get('/dispatch/don/@id:[0-9]+', [ TestController::class, 'showDon' ]);
		$router->get('/dispatch/don/@id:[0-9]+/simuler', [ TestController::class, 'simuler' ]);
		$router->post('/dispatch/don/@id:[0-9]+', [ TestController::class, 'dispatch' ]);
		
		// Routes pour dispatch GÉNÉRAL (tous les dons)
		$router->get('/dispatch/simuler-tout', [ TestController::class, 'simulerTout' ]);
		$router->post('/dispatch/valider-tout', [ TestController::class, 'dispatcherTout' ]);
		$router->post('/dispatch/valider-tout-croissant', [ TestController::class, 'dispatcherToutCroissant' ]);
		$router->get('/dispatch/simuler-tout-croissant', [ TestController::class, 'simulerToutCroissant' ]);
	});

	// Routes pour les achats
	$router->group('/achats', function(Router $router) {
		$router->get('', [ AchatController::class, 'index' ]);
		$router->get('/besoins-achetables', [ AchatController::class, 'listBesoinsAchetables' ]);
		$router->post('/acheter', [ AchatController::class, 'acheter' ]);
		$router->get('/@id:[0-9]+', [ AchatController::class, 'show' ]);
	});

	// Routes pour les besoins (CRUD complet)
 $router->group('/besoins', function(Router $router) {
    $router->get('/', [ BesoinController::class, 'index' ]);          // Liste
    $router->get('/create', [ BesoinController::class, 'create' ]);   // Formulaire création
    $router->post('/store', [ BesoinController::class, 'store' ]);    // Traitement création
    
    $router->get('/@id:[0-9]+/edit', [ BesoinController::class, 'edit' ]);     // Formulaire édition
    $router->post('/@id:[0-9]+/update', [ BesoinController::class, 'update' ]); // Traitement édition
    $router->get('/@id:[0-9]+/delete', [ BesoinController::class, 'delete' ]); // Suppression
});

// Routes pour les villes
 $router->group('/villes', function(Router $router) {
    $router->get('/', [ VilleController::class, 'index' ]);
    $router->get('/create', [ VilleController::class, 'create' ]);
    $router->post('/store', [ VilleController::class, 'store' ]);
    
    $router->get('/@id:[0-9]+/edit', [ VilleController::class, 'edit' ]);
    $router->post('/@id:[0-9]+/update', [ VilleController::class, 'update' ]);
    $router->get('/@id:[0-9]+/delete', [ VilleController::class, 'delete' ]);
});

	// $router->get('/uploader', function() use ($app) {
	// 	$app->render('upload', null);
	// });

	// $router->group('/api', function() use ($router) {
	// 	$router->get('/images', [ ApiController::class, 'getImages' ]);
	// 	$router->get('/images/@id:[0-9]', [ ApiController::class, 'getImage' ]);
	// 	$router->post('/images/@id:[0-9]', [ ApiController::class, 'update' ]);
	// 	$router->post('/save', [ ApiController::class, 'save' ]);
	// });
	
}, [ SecurityHeadersMiddleware::class ]);