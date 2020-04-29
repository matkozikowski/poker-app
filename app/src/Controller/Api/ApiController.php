<?php

namespace App\Controller\Api;

use App\Service\PokerGameService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends AbstractFOSRestController
{
    /**
     * @var PokerGameService
     */
    private $pokerGameService;

    /**
     * @param PokerGameService $pokerGameService
     */
    public function __construct(PokerGameService $pokerGameService)
    {
        $this->pokerGameService = $pokerGameService;
    }

    public function upload(Request $request): Response
    {
        $file = $request->request->get("file");

        try {
            $status = $this->pokerGameService->uploadDataFromFile($file);

            return $this->json(
                [
                    'status' => $status,
                ]
            );
        } catch (\Exception $e) {
            return $this->json(
                [
                    'status' => false,
                    'message' => $e->getMessage()
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    public function scores(): Response
    {
        $gameList = $this->pokerGameService->getGameList();

        return $this->json(
            [
                'status' => true,
                'scores' => $this->pokerGameService->getScoreGamer(),
                'list' => $gameList,
            ]
        );
    }
}
