<?php

use app\controllers\DashboardController;
use app\controllers\TestController;
use app\controllers\DonController;
use app\controllers\AchatController;
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
	});

	// Routes pour les achats
	$router->group('/achats', function(Router $router) {
		$router->get('', [ AchatController::class, 'index' ]);
		$router->get('/besoins-achetables', [ AchatController::class, 'listBesoinsAchetables' ]);
		$router->post('/acheter', [ AchatController::class, 'acheter' ]);
		$router->get('/@id:[0-9]+', [ AchatController::class, 'show' ]);
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