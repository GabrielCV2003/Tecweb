<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require 'vendor/autoload.php';

$app = AppFactory::create();

//Ejemplo 1
$app->setBasePath("/tecweb/prueba_slim");

$app->get('/', function ($request, $response, $args) {
    $response->getBody()->write("Hola mundo Slim!!!");
    return $response;
});

//Ejemplo 2
$app->get("/hola[/{nombre}]", function( $request, $response, $args ){
    $nombre = $args["nombre"] ?? "invitado";
    $response->getBody()->write("Hola, " . $nombre);
    return $response;
});

//Ejemplo 3
$app->post("/pruebapost", function( $request, $response, $args ){
    $reqPost = $request->getParsedBody();
    $val1 = $reqPost["val1"] ?? '';
    $val2 = $reqPost["val2"] ?? '';

    $response->getBody()->write("Valores: " . $val1 . " " . $val2);
    return $response;
});

//Ejemplo 4
$app->get("/testjson", function( $request, $response, $args){
    $data = [
        ["nombre" => "Gabriel", "apellidos" => "Corona Valerio"],
        ["nombre" => "Maria", "apellidos" => "Mendez Barragan"]
    ];

    $payload = json_encode($data, JSON_PRETTY_PRINT);

    $response->getBody()->write($payload);
    return $response->withHeader('Content-Type', 'application/json');
});


$app->run();
