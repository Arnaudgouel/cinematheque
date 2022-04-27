<?php

namespace App\Controller;

use App\Repository\FilmsRepository;
use App\Service\ApiResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilmsController extends AbstractController
{
    #[Route('/films', methods: ["GET"], name: 'app_films')]
    public function all(FilmsRepository $filmsRepository): Response
    {
        $films = $filmsRepository->getAll();
        return $this->json($films);
    }

    #[Route('/films/index', methods: ["GET"], name: 'app_films_by_id')]
    public function one(ApiResponse $apiResponse, Request $request, FilmsRepository $filmsRepository): Response
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
        $film = $filmsRepository->getOneById($filmId);
        return $this->json($film);
    }

    #[Route('/films-acteurs/recherche', methods: ["GET"], name: 'app_films_by_id')]
    public function search(ApiResponse $apiResponse, Request $request, FilmsRepository $filmsRepository): Response
    {
        $params = [
            "search" => "string"
        ];
        $apiResponse->setParams($params);
        $response = $apiResponse->isParamsExistAndCorrectType($request);
        if ($apiResponse->hasError) {
            return $this->json($response, 400, ['Content-Type' => 'application/json']);
        }
        $search = $response["search"];
        $result = $filmsRepository->getBySearch($search);
        return $this->json($result);
    }

    #[Route('/films/populaire', methods: ["GET"], name: 'app_films_popular')]
    public function popular(FilmsRepository $filmsRepository): Response
    {
        $films = $filmsRepository->getPopular();
        return $this->json($films, 200, [
            'Content-Type' => 'application/json',
            "Access-Control-Allow-Origin" => "*",
            "Access-Control-Allow-Methods" => "GET, POST, OPTIONS, PUT, DELETE"
        ]);
    }
}
