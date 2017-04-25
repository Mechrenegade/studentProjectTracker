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
$app = new App($container);

// Uses a PHP templating system to display HTML when requested
$app->get('/', function (Request $request, Response $response) {
    return $this->renderer->render($response, "/index.phtml");
});


$app->get("/projects", function(Request $request, Response $response){
	$projects = getAllProjects();
	
	$response = $response->withJson($projects);
	return $response;
});

$app->post("/projects", function(Request $request, Response $response){
	$post = $request->getParsedBody();
	$name = $post['name'];
	$price = $post['price'];
	$countryId = $post['country'];
	// print "Name: $name, Price:$price, Country: $countryId";
	$res = saveProject($name, $price, $countryId);
	// print ($res);
	if ($res > 0){
		$response = $response->withStatus(201);
		$response = $response->withJson(array( "id" => $res));
	} else {
		$response = $response->withStatus(400);
	}
	return $response;
});

$app->get('/signup', function (Request $request, Response $response) {
    return $this->renderer->render($response, "/signup.phtml");
});

$app->post("/signUpAction", function(Request $request, Response $response){

	$post = $request->getParsedBody();

	$username = $post['username'];
	$password = $post['password'];
	$password = sha1($password);
	$fname = $post['fname'];
    $lname = $post['lname'];
    $schoolId = $post['sid'];
    $email = $post['email'];
    $acctype = $post['accountType'];
   

	// print "Name: $name, Price:$price, Country: $countryId";
	$res = createUser($username, $password, $fname, $lname, $schoolId, $acctype, $email);
	// print ($res);
	if ($res > 0){
		return $response->withRedirect('/project/index.php');
		//$response = $response->withStatus(201);
		//header("Location:http://localhost:8080/project/");
		//$response = $response->withJson(array( "id" => $res));
	} else {
		$response = $response->withStatus(400);
	}
    //header("Location: http://localhost/project/");
	return $response;
});

$app->get('/signin', function (Request $request, Response $response) {
    return $this->renderer->render($response, "/signin.phtml");
});

$app->post("/loginAction", function(Request $request, Response $response){

	$post = $request->getParsedBody();

	echo loginUser($post['username'], $post['password']);
	$res = 1;
	// print "Name: $name, Price:$price, Country: $countryId";
	if ($res > 0){
		//$response = $response->withStatus(201);
		//header("Location:http://localhost:8080/project/");
		//$response = $response->withJson(array( "id" => $res));
	} else {
		$response = $response->withStatus(400);
	}
    //header("Location: http://localhost/project/");
	return $response;
});


$app->run();
?>

