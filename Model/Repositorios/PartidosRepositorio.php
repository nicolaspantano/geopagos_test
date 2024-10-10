<?php

use App\Models\Partido;

class PartidosRepositorio {

    public function crearPartido($torneoId)
    {
        $partido = new Partido([
            'torneo_id' => $torneoId
        ]);

        $partido->save();

        return $partido;
    }
}
