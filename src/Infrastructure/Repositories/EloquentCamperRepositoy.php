<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\Camper;
use App\Domain\Repositories\CamperRepositoryInterface;


class EloquentCamperRepositoy implements CamperRepositoryInterface
{
    // GET NORMAL QUE TRAE TODO
    public function getAll(): array{
        // SELECT * FROM campers;
        return Camper::all()->toArray();
    }

    // GET QUE SE BUSCA POR EL ID
    public function getById(int $documento): ? Camper{
        return Camper::find($documento);
    }
    
    // INSERSION DE UN NUEVO CAMPER 
    public function create(array $data): Camper{
        return Camper::create($data);
    }

    // ACTUALIZACION DE UN NUEVO CAMPER
    public function update(int $documento, array $data): bool {
        // SELECT * FROM campers WHERE id = documentos;
        $camper = Camper::find($documento);
        //UPDATE campers SET nombre= $data[x] ...WHERE id = $documentos;
        return $camper ? $camper->update($data) : false;
    }

    // ELIMINACION DE UN CAMPER
    public function delete(int $documento): bool {
        // SELECT * FROM campers WHERE id = documentos;
        $camper = Camper::find($documento);
        //DELETE FROM campers WHERE id = $documentos;
        return $camper ? $camper->delete() : false;
    }
}