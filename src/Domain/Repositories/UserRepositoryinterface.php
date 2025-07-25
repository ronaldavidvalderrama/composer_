<?php

namespace App\Domain\Repositories;

use App\Domain\Models\user;

interface UserRepositoryinterface 
{
    public function create(array $data): user;
}