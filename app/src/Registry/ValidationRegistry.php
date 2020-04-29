<?php

declare(strict_types=1);

namespace App\Registry;

class ValidationRegistry implements RegistryInterface
{
    protected $ruleCollection = [];

    public function addService($service, $priority = 0): void
    {
        $this->ruleCollection[$priority] = $service;
    }

    public function getServices(): array
    {
        ksort($this->ruleCollection);

        return $this->ruleCollection;
    }
}
