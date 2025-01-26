<?php
require_once 'libs/response.php';
require_once 'middlewares/session.auth.middleware.php';
require_once 'middlewares/verify.auth.middleware.php';
require_once 'app/controllers/auth.controller.php';
require_once 'app/controllers/puntuacion.controller.php';
require_once 'app/controllers/peli.controller.php';




define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$res = new Response();

$action = 'listar'; // accion por defecto si no se envia ninguna
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

switch ($params[0]) {
    case 'listar':
        sessionAuthMiddleware($res); // Setea $res->user si existe session
        $controllerPeli = new PeliController($res);
        $controllerPeli->showPelis();
        $controllerPuntuacion = new PuntuacionController($res);
        $controllerPuntuacion->showPuntajes();
        break;
    case 'nueva':
        sessionAuthMiddleware($res); // Setea $res->user si existe session
        verifyAuthMiddleware($res); // Verifica que el usuario esté logueado o redirige a login
        $controllerPeli = new PeliController($res);
        $controllerPeli->addPeli();
        break;
    case 'eliminarPeli':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res); // Verifica que el usuario esté logueado o redirige a login
        $controllerPeli = new PeliController($res);
        $controllerPeli->removePeli($params[1]);
        break;


    case 'editarPeli':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controllerPeli = new PeliController($res);
        $controllerPeli->editarPeli($params[1]);
        break;
    case 'updatePeli':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controllerPeli = new PeliController($res);
        $controllerPeli->updatePeli();
        break;


    case 'mostrarPuntaje':
        sessionAuthMiddleware($res); 
        $controllerPuntuacion = new PuntuacionController($res);
        $controllerPuntuacion->verPuntuaciones($params[1]);
        break;
    case 'nuevaPuntuacion':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res); // Si es necesario que el usuario esté autenticado
        $controllerPuntuacion = new PuntuacionController($res);
        $controllerPuntuacion->addPuntuacion();
        break;
    case 'eliminarPuntaje':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res); // Verifica que el usuario esté logueado o redirige a login
        $controllerPuntuacion = new PuntuacionController($res);
        $controllerPuntuacion->removePuntaje($params[1]);
        break;
    case 'editarPuntaje':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controllerPuntuacion= new PuntuacionController($res);
        $controllerPuntuacion->editarPuntaje($params[1]);
        break;
    case 'updatePuntaje':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controllerPuntuacion = new PuntuacionController($res);
        $controllerPuntuacion->updatePuntaje();
        break;
    case 'showLogin':
        $controller = new AuthController($res);
        $controller->showLogin();
        break;
    case 'login':
        $controller = new AuthController($res);
        $controller->login();
        break;  
    case 'logout':
        $controller = new AuthController($res);
        $controller->logout();
    default: 
        echo "404 Page Not Found"; // deberiamos llamar a un controlador que maneje esto
        break;
}
