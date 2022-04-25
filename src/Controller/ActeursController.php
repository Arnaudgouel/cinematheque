<?php

namespace App\Controller;

use App\Repository\ActeursRepository;
use App\Service\ApiResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActeursController extends AbstractController
{
    #[Route('/acteurs', methods: ["GET"], name: 'app_acteurs')]
    public function all(ActeursRepository $acteursRepository): Response
    {
        $acteurs = $acteursRepository->getAll();
        return $this->json($acteurs);
    }

    #[Route('/acteurs/one', methods: ["GET"], name: 'app_acteurs_by_id')]
    public function one(ApiResponse $apiResponse, Request $request, ActeursRepository $acteursRepository): Response
    {
        $params = [
            "acteur_id" => "integer"
        ];
        $apiResponse->setParams($params);
        $response = $apiResponse->isParamsExistAndCorrectType($request);
        if ($apiResponse->hasError) {
            return $this->json($response, 400, ['Content-Type' => 'application/json']);
        }
        $acteurId = $response["acteur_id"];
        $acteur = $acteursRepository->getOneById($acteurId);
        return $this->json($acteur);
    }
}
