<?php
namespace App\Controllers;

require_once 'Model/Entidades/Torneo.php';

require_once 'Model/Repositorios/TorneoRepositorio.php';
require_once 'Model/Repositorios/JugadoresRepositorio.php';


use App\Models\Torneo;
use JugadoresRepositorio;
use TorneoRepositorio;

class APIController {
    
    protected $TorneoRepositorio;
    protected $JugadoresRepositorio;

    public function __construct()
    {
        $this->TorneoRepositorio = new TorneoRepositorio();
        $this->JugadoresRepositorio = new JugadoresRepositorio();

    }

    function obtenerTorneos()
    {
        try
        {
            $parametrosValidos = ['fecha', 'ganador', 'genero'];

            $parametros = array_filter($_GET, function ($parametro) use ($parametrosValidos) {
                return in_array($parametro, $parametrosValidos);
            }, ARRAY_FILTER_USE_KEY);

            if (array_key_exists('fecha', $parametros) && !preg_match('/\d{1,2}\-\d{1,2}\-\d{2,4}/', $parametros['fecha']))
            {
                throw new \Exception('La fecha debe estar en formato yyyy-mm-dd');
            }

            if (array_key_exists('ganador', $parametros) && !is_numeric($parametros['ganador']))
            {
                throw new \Exception('El parametro "ganador" debe ser ser un id');
            }

            if (array_key_exists('genero', $parametros) && !in_array($parametros['genero'], ['Masculino', 'Femenino']))
            {
                throw new \Exception('El genero debe ser "Masculino" o "Femenino"');
            }

            
            $torneos = $this->TorneoRepositorio->obtenerTorneos($parametros);

            $respuesta = [
                'estado' => 'OK',
                'torneos' => $torneos
            ];
        }
        catch(\Exception $e)
        {
            $respuesta = [
                'estado' => 'OK',
                'mensaje_de_error' => $e->getMessage()
            ];
        }
        finally
        {
            return json_encode($respuesta);
        }
    }

    function jugarTorneo()
    {
        try
        {
            $jugadores = json_decode($_POST['jugadores'], true);

            $genero = null;
    
            if (count($jugadores) % 2 != 0)
            {
                throw new \Exception('No se permite un numero impar de jugadores');
            }
        
            foreach ($jugadores as $jugador)
            {
                if (is_null($genero))
                {
                    $genero = $jugador['genero'];
                }
    
                if ($jugador['genero'] != $genero)
                {
                    throw new \Exception('El torneo no puede ser mixto');
                }
            }
    
            $torneo = $this->TorneoRepositorio->crearTorneo($genero);
        
            $jugadores = $this->JugadoresRepositorio->crearJugadoresFaltantes($jugadores);
    
            $ganador = $torneo->jugar($jugadores, $torneo->id);
            $torneo->establecerGanador($ganador->id);

            $respuesta = [
                'estado' => 'OK',
                'ganador' => $ganador
            ];
        }
        catch (\Exception $e)
        {
            $respuesta = [
                'estado' => 'ERROR',
                'mensaje_de_error' => $e->getMessage()
            ];
        }
        finally
        {
            return json_encode($respuesta);
        }
    }

}
