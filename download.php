<?php
require 'vendor/autoload.php';
include 'lib.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Slim\App as App;
use \Slim\Container as Container;
use Slim\Views\PhpRenderer as PhpRenderer;


$configuration = [
		'settings' => [
				'displayErrorDetails' => true,
		],
		'renderer' => new PhpRenderer("./templates")
];
$container = new Container($configuration);
$app4 = new App($container);

// Uses a PHP templating system to display HTML when requested
$app4->get('/', function (Request $request, Response $response) {
    return $this->renderer->render($response, "/vDownload.phtml");
});


$app4->get("/viewDld", function(Request $request, Response $response){
	$projects = getAllProjects();
	
	$response = $response->withJson($projects);
	return $response;
});

$app4->run();