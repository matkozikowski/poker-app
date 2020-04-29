<?php

declare(strict_types=1);

namespace App\Transformer;

use App\Model\HandsDTO;
use Doctrine\Common\Collections\ArrayCollection;

class DataTransformer implements TransformerInterface
{
    private const CARDS_HAND_LIMIT = 10;

    protected $collection;

    public function __construct()
    {
        $this->collection = new ArrayCollection();
    }

    public function getData(): ArrayCollection
    {
        return $this->collection;
    }

    public function setData(string $content): void
    {
        foreach (explode(PHP_EOL, $content) as $row) {
            $elements = explode(' ', $row);

            if (is_array($elements) && count($elements) == self::CARDS_HAND_LIMIT) {
                $handsDTO = new HandsDTO();
                $handsDTO->setCards(
                    array_chunk($elements, 5)
                );

                $this->collection->add($handsDTO);
            }
        }
    }
}
