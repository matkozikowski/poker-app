<?php

declare(strict_types=1);

namespace App\Manager;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class FileManager
{
    private $parameterBag;

    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->parameterBag = $parameterBag;
    }

    public function getContent(string $file): string
    {
        return \file_get_contents($file);
    }
}