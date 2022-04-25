<?php

namespace App\Controller;

use App\Repository\AdministrateursRepository;
use App\Service\ApiResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/login', methods: ["GET"], name: 'app_login')]
    public function login(ApiResponse $apiResponse, Request $request, AdministrateursRepository $administrateursRepository): Response
    {
        $params = [
            "film_id" => "integer"
        ];
        $apiResponse->setParams($params);
        $response = $apiResponse->isParamsExistAndCorrectType($request);
        if ($apiResponse->hasError) {
            return $this->json($response, 400, ['Content-Type' => 'application/json']);
        }
        $filmId = $response["film_id"];
        $film = $administrateursRepository->getOneById($filmId);
        return $this->json($film);
    }

    #[Route('/admins', methods: ["GET"], name: 'app_login')]
    public function getAll(ApiResponse $apiResponse, Request $request, AdministrateursRepository $administrateursRepository): Response
    {
        $params = [
            "film_id" => "integer"
        ];
        $apiResponse->setParams($params);
        $response = $apiResponse->isParamsExistAndCorrectType($request);
        if ($apiResponse->hasError) {
            return $this->json($response, 400, ['Content-Type' => 'application/json']);
        }
        $filmId = $response["film_id"];
        $film = $administrateursRepository->getOneById($filmId);
        return $this->json($film);
    }
}
