<?php

declare(strict_types=1);

namespace App\Registry;

interface RegistryInterface
{
    public function addService($service): void;
    public function getServices(): array;
}