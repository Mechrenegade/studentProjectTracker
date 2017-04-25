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
$app2 = new App($container);

// Uses a PHP templating system to display HTML when requested
$app2->get('/addproj', function (Request $request, Response $response) {
    return $this->renderer->render($response, "/addproj.phtml");
});

$app2->get('/compare', function (Request $request, Response $response) {
    return $this->renderer->render($response, "/compare.phtml");
});

$app2->get('/home', function (Request $request, Response $response) {
    return $this->renderer->render($response, "/stuProfile.phtml");
})->setName('home');

$app2->get('/download', function (Request $request, Response $response) {
    return $this->renderer->render($response, "/vDownload.phtml");
});


$app2->get("/viewDld", function(Request $request, Response $response){
	$projects = getAllProjects();
	
	$response = $response->withJson($projects);
	return $response;
});

$app2->get('/pending', function (Request $request, Response $response) {
    return $this->renderer->render($response, "/pendAcc.phtml");
});

$app2->get('/change', function (Request $request, Response $response) {
    return $this->renderer->render($response, "/change.phtml");
});

$app2->get('/change2', function (Request $request, Response $response) {
    return $this->renderer->render($response, "/change2.phtml");
});

$app2->get('/thank', function (Request $request, Response $response) {
    return $this->renderer->render($response, "/thank.phtml");
});

$app2->get('/sorry', function (Request $request, Response $response) {
    return $this->renderer->render($response, "/sorry.phtml");
});

$app2->get('/logout', function (Request $request, Response $response) {
    session_destroy();
	return $response->withRedirect('/project/index.php');
});

$app2->post("/addAction", function(Request $request, Response $response) use ($app2){
	

	$post = $request->getParsedBody();
	$filename = upload();
	
	//echo("<script>console.log('PHP: ".$post."');</script>");
	
	$name = $post['name'];
	$cname = $post['cname'];
	$ccode = $post['ccode'];
    $ghlink = $post['ghlink'];
    $year = $post['year'];


	$res = createProject($name, $cname, $ccode, $ghlink, $year, $filename);
	if ($name == " "){
		$res = 0;
	}
	// print ($res);
	if ($res > 0){		
		//$response = $response->withStatus(201);
		return $response->withRedirect('/project/profile.php/thank');
		//$response = $response->withJson(array( "id" => $res));
	} else {
		return $response->withRedirect('/project/profile.php/sorry');
		//$response = $response->withStatus(400);

	}

});

$app2->post("/approve", function(Request $request, Response $response){
	
	$post = $request->getParsedBody();
	
	$id = $post['id'];
	
   	approve($id);
	$res = 1;
	
	if ($res > 0){	
	
		return $response->withRedirect('/project/profile.php/pending');

	} else {

		$response = $response->withStatus(400);

	}

});

$app2->post("/delete", function(Request $request, Response $response){
	
	$post = $request->getParsedBody();
	
	$id = $post['id'];
	
   	delete($id);
	$res = 1;
	
	if ($res > 0){	
	
		return $response->withRedirect('/project/profile.php/pending');

	} else {

		$response = $response->withStatus(400);

	}

});

$app2->post("/dld", function(Request $request, Response $response){
	
	$post = $request->getParsedBody();
	

});

$app2->post("/updateAction", function(Request $request, Response $response){
	
	$post = $request->getParsedBody();
	$picname = upPic();
	$id = $post['id'];

	createUserData($id, $picname);

	return $response->withRedirect('/project/profile.php/change2');


});

$app2->post("/updateDesc", function(Request $request, Response $response){
	
	$post = $request->getParsedBody();
	$id = $post['id'];
	$desc = $post['desc'];

	updateDesc($id, $desc);

	return $response->withRedirect('/project/profile.php/home');


});



$app2->run();

?>
