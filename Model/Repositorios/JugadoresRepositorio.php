<?php

use App\Models\Jugador;

class JugadoresRepositorio {

    // Función para crear un jugador
    public function crearJugador($datosJugador)
    {
        try {
            $jugador = new Jugador([
                'nombre' => $datosJugador['nombre'],
                'habilidad'   => $datosJugador['habilidad'],
                'genero' => $datosJugador['genero']
            ]);

            switch ($jugador->genero)
            {
                case 'Masculino':
                    $jugador->fuerza = $datosJugador['fuerza'];
                    $jugador->velocidad_de_desplazamiento = $datosJugador['velocidad_de_desplazamiento'];
                    break;
                case 'Femenino':
                    $jugador->tiempo_de_reaccion = $datosJugador['tiempo_de_reaccion'];
            }

            $jugador->save();
            return $jugador;
        } catch (\Exception $e) {
            return "Error al crear el jugador: " . $e->getMessage();
        }
    }

    // Función para verificar si un jugador existe y retornarlo
    public function obtenerJugadorPorNombreYGenero($nombre, $genero)
    {
        return Jugador::where([
            'nombre' => $nombre,
            'genero' => $genero
        ])->first();
    }

    public function crearJugadoresFaltantes($jugadores)
    {
        foreach ($jugadores as &$jugadorArr)
        {
            $jugador = $this->obtenerJugadorPorNombreYGenero($jugadorArr['nombre'], $jugadorArr['genero']);
            
            if (!$jugador)
            {
                $jugador = $this->crearJugador($jugadorArr);
            }
            
            $jugadorArr = $jugador; 
        }

        return $jugadores;
    }
}
