<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require 'vendor/autoload.php';

$app = AppFactory::create();

// Esta línea debe coincidir con la carpeta donde está tu index.php:
$app->setBasePath("/tecweb/prueba_slim");

$app->get('/', function ($request, $response, $args) {
    $response->getBody()->write("Hola mundo Slim!!!");
    return $response;
});

$app->get("/hola[/{nombre}]", function( $request, $response, $args ){
    $nombre = $args["nombre"] ?? "invitado";
    $response->getBody()->write("Hola, " . $nombre);
    return $response;
});
$app->run();
