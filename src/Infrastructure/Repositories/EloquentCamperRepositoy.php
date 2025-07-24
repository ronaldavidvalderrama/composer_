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
        // SELECT * FROM campers WHERE id = $documentos;
        //returns Campers::($documento);

        //SELECT * FROM campers WHERE documento = $documento LIMIT 1,1;
        return Camper::where('documento', $documento)->first();
    }
    
    // INSERSION DE UN NUEVO CAMPER 
    public function create(array $data): Camper
    {
        $exists = $this->getById($data['documento']);
        if ($exists) {
            return $exists;
        }
        return Camper::create($data);
    }

    // ACTUALIZACION DE UN NUEVO CAMPER
    public function update(int $documento, array $data): bool {
        // SELECT * FROM campers WHERE id = documentos;
        $camper = $this->getById($data['documento']);
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