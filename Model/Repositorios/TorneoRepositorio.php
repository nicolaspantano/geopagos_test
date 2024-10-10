<?php

use App\Models\Torneo;
use Illuminate\Database\Eloquent\Collection;

class TorneoRepositorio {

    public function obtenerTorneos($filters) : Collection{

        $filters += [
            'fecha' => null,
            'genero' => null,   
            'ganador' => null
        ];

        $torneos = Torneo::when($filters['genero'], function($query, $genero) {
            return $query->where('tipo', $genero);
        })
        ->when($filters['ganador'], function ($query, $ganador) {
            return $query->where('ganador_id', $ganador);
        })
        ->when($filters['fecha'], function ($query, $fecha) {
            return $query->where('fecha', $fecha);

        })
        ->get();

        return $torneos;
    }

    public function crearTorneo($genero) : Torneo
    {
        $torneo = new Torneo();

        $torneo->nombre = 'Torneo ' . time();
        $torneo->tipo = $genero;

        $torneo->save();

        return $torneo;
    }
}