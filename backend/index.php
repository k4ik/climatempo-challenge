<?php
require "vendor/autoload.php"
use Controller\WeatherController;

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\ConfigureRoutes $r) {
  $r->addRoute('POST', '/location', 'postLocation');
  $r->addRoute('GET', '/data', 'getData');
});

$httpMethod = $_SERVER["REQUEST_METHOD"];
$uri = $_SERVER["REQUEST_URI"];

if (false !== $pos = strpos($uri, '?')) {
  $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
  case FastRoute\Dispatcher::NOT_FOUND:
    header("HTTP/1.0 404 Not Found");
    break;
  case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
    $allowedMethods = $routeInfo[1];
    header("HTTP/1.0 405 Method Not Allowed");
    break;
  case FastRoute\Dispatcher::FOUND:
    $handler = $routeInfo[1];
    $vars = $routeInfo[2];
    call_user_func([new WeatherController(), $handler], $vars);
    break;
}
