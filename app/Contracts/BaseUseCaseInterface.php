<?php

namespace App\Contracts;

interface BaseUseCaseInterface
{
    public function execute(array $data);
}
