<?php
require_once './libs/Router.php';
require_once './app/controllers/Api-Juegos-Controller.php';
require_once './app/controllers/Api-Comentarios-Controller.php';
require_once './app/controllers/Auth-Api-Controller.php';

// crea el router
$router = new Router();


// Juegos
$router->addRoute('games', 'GET', 'ApiController', 'getApiGames');
$router->addRoute('game/:ID', 'GET', 'ApiController', 'getApiGame');
$router->addRoute('game/:ID', 'DELETE', 'ApiController', 'DeleteApiGame');
$router->addRoute('game', 'POST', 'ApiController', 'insertApiGame');
$router->addRoute('game/:ID', 'PUT', 'ApiController', 'UpdateApiGame'); 




// Comentarios
$router->addRoute('game/:ID/comentario','POST','ApiComentariosController','InsertComment');
$router->addRoute('game/:ID/comentario/:comentarioID','DELETE','ApiComentariosController','DeleteComment');
$router->addRoute('comentario/:ID', 'GET', 'ApiComentariosController', 'getComment');
$router->addRoute('game/:ID/comentarios', 'GET', 'ApiComentariosController', 'getGameComments');
$router->addRoute('comentarios', 'GET', 'ApiComentariosController', 'getComments');

// TOKEN
$router->addRoute("auth/token", "GET", "authApiController", "getToken");
// ejecuta la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);