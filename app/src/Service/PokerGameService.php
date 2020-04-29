<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\PokerGame;
use App\Exception\FileException;
use App\Exception\InvalidDataException;
use App\Manager\FileManager;
use App\Registry\ValidationRegistry;
use App\Repository\PokerGameRepository;
use App\Transformer\DataTransformer;

class PokerGameService
{
    /**
     * @var PokerGameRepository
     */
    private $pokerGameRepository;

    /**
     * @var DataTransformer
     */
    private $dataTransformer;

    /**
     * @var FileManager
     */
    private $fileManager;

    /**
     * @var ValidationRegistry
     */
    private $validationRegistry;

    /**
     * @var array
     */
    private $collection = [];

    public function __construct(
        PokerGameRepository $pokerGameRepository,
        DataTransformer $dataTransformer,
        FileManager $fileManager,
        ValidationRegistry $validationRegistry
    ) {
        $this->pokerGameRepository = $pokerGameRepository;
        $this->dataTransformer = $dataTransformer;
        $this->fileManager = $fileManager;
        $this->validationRegistry = $validationRegistry;
    }

    public function getGameList()
    {
        $pokersList = $this->pokerGameRepository->findAll();

        foreach ($pokersList as $pokerGames) {
            $games = [];
            foreach ($pokerGames->getCards() as $index => $cards) {
                $games[] = [
                    'player' => ++$index,
                    'hands' => $this->getCorrectValidationScore($cards),
                ];
            }
            $this->collection[] = $games;
        }

        return $this->collection;
    }

    public function getScoreGamer(): array
    {
        $scores = [];
        $scoreSumPlayerOne = 0;
        $scoreSumPlayerTwo = 0;

        foreach ($this->collection as $player) {
            $scorePlayerOne = $player[0]['hands']['score'];
            $scorePlayerTwo = $player[1]['hands']['score'];

            if ($scorePlayerOne > $scorePlayerTwo) {
                $scores['player_one'] = $scoreSumPlayerOne++;
            }

            if ($scorePlayerOne < $scorePlayerTwo) {
                $scores['player_two'] = $scoreSumPlayerTwo++;
            }
        }

        return $scores;
    }

    /**
     * @throws FileException
     * @throws InvalidDataException
     * @throws \Hoa\Exception\Exception
     */
    public function uploadDataFromFile(string $file): bool
    {
        $content = $this->fileManager->getContent($file);

        if (empty($content)) {
            throw new FileException(
                sprintf('Content not found for file %s', $file)
            );
        }

        $this->dataTransformer->setData($content);
        $cardsList = $this->dataTransformer->getData();

        if (empty($cardsList)) {
            throw new InvalidDataException('Invalid Transform file data into DTO Format.');
        }

        foreach ($cardsList as $cards) {
            $entity = new PokerGame();

            $entity->setCardsFirst(
                implode(',', $cards->getFirstCards())
            );
            $entity->setCardsSecond(
                implode(',', $cards->getSecondCards())
            );

            $this->pokerGameRepository->save($entity);
        }

        return true;
    }

    private function getCorrectValidationScore(string $cards): array
    {
        $validations = $this->validationRegistry->getServices();

        foreach ($validations as $validation) {
            if ($validation->checkRules($cards)) {
                return [
                    'name' => $validation->getName(),
                    'score' => $validation->getScore(),
                ];
            }
        }

        return [];
    }
}
