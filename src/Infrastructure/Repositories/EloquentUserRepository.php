<?php

namespace App\Infrastructure\Repositories;


use App\Domain\Models\user;
use App\Domain\Repositories\UserRepositoryinterface;
use Exception;

class EloquentUserRepository implements UserRepositoryinterface 
{

    public function create(array $data): User
    {
        $exists = User::where('email', $data['email'])->first();
        if ($exists) {
            //mostrar error
            throw new Exception('Error el usuario ya existe');
        }

        return User::create($data);
    }
}