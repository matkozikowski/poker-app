<?php

namespace App\Transformer;

use Doctrine\Common\Collections\ArrayCollection;

interface TransformerInterface
{
    public function getData(): ArrayCollection;
    public function setData(string $file): void;
}