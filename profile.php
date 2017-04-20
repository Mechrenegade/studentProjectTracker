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
$app3 = new App($container);

// Uses a PHP templating system to display HTML when requested
$app3->get('/', function (Request $request, Response $response) {
    return $this->renderer->render($response, "/addproj.phtml");
});

$app3->post("/addAction", function(Request $request, Response $response){
	$post = $request->getParsedBody();
	
	echo("<script>console.log('PHP: ".$post."');</script>");
	
	$name = $post['name'];
	$cname = $post['cname'];
	$ccode = $post['ccode'];
    $ghlink = $post['ghlink'];
    $year = $post['year'];
   

	// print "Name: $name, Price:$price, Country: $countryId";
	$res = createProject($name, $cname, $ccode, $ghlink, $year);
	// print ($res);
	if ($res > 0){
		$response = $response->withStatus(201);
		$response = $response->withJson(array( "id" => $res));
	} else {
		$response = $response->withStatus(400);
	}
	return $response;
});

$app3->run();
?>
