<?php

header('Content-Type: application/json');

use App\Controllers\APIController;

require_once 'vendor/autoload.php';
require_once 'Model/Entidades/Jugador.php';
require_once 'Model/Entidades/Torneo.php';
require_once 'Model/Entidades/Partido.php';

require_once 'Model/Repositorios/TorneoRepositorio.php';
require_once 'Model/Repositorios/JugadoresRepositorio.php';

require_once 'Controller/ApiController.php';

require_once 'config/conexion_bd.php';

$router = new AltoRouter();

$apiController = new APIController();

$router->map('GET', '/torneos', function() use ($apiController){
    echo $apiController->obtenerTorneos();
});

$router->map('POST', '/torneos/jugar', function() use ($apiController) {

    if (empty($_POST) || !array_key_exists('jugadores', $_POST))
    {
        echo 'Se requiere una lista de jugadores'; 
    }

    echo $apiController->jugarTorneo();
});

$match = $router->match();

if ($match && is_callable($match['target']))
{
    call_user_func_array($match['target'], $match['params']);
}
else
{
    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    
    echo 'Ruta no encontrada';
}
