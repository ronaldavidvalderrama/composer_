<?php

use App\Domain\Repositories\CamperRepositoryInterface;
use App\Infrastructure\Repositories\EloquentCamperRepositoy;
use DI\Container;

$container = new Container();

$container->set(CamperRepositoryInterface::class, function() {
    return new EloquentCamperRepositoy();
});

return $container;