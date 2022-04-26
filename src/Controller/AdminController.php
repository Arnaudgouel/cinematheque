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
    #[Route('/login', methods: ["POST"], name: 'app_login')]
    public function login(ApiResponse $apiResponse, Request $request, AdministrateursRepository $administrateursRepository): Response
    {
        $params = [
            "email" => "string",
            "password" => "string"
        ];
        $apiResponse->setParams($params);
        $response = $apiResponse->isBodyExistAndCorrectType($request);
        if ($apiResponse->hasError) {
            return $this->json($response, 400, ['Content-Type' => 'application/json']);
        }
        $email = $response["email"];
        $password = $response["password"];
        $hash = $administrateursRepository->getCredentials($email);
        if(password_verify($password, $hash)) {
            return $this->json([
                "Access" => "OK"
            ]);
        }

        return $this->json([
            "Access" => "DENIED"
        ]);
    }

    #[Route('/admins', methods: ["GET"], name: 'app_admins')]
    public function getAll(AdministrateursRepository $administrateursRepository): Response
    {
        $admins = $administrateursRepository->getAll();
        return $this->json($admins);
    }

    #[Route('/admins/index', methods: ["GET"], name: 'app_admin')]
    public function getOne(ApiResponse $apiResponse, Request $request, AdministrateursRepository $administrateursRepository): Response
    {
        $params = [
            "email" => "string"
        ];
        $apiResponse->setParams($params);
        $response = $apiResponse->isParamsExistAndCorrectType($request);
        if ($apiResponse->hasError) {
            return $this->json($response, 400, ['Content-Type' => 'application/json']);
        }
        $email = $response["email"];
        $admin = $administrateursRepository->getOne($email);
        return $this->json($admin);
    }

    #[Route('/admins/index/update', methods: ["PUT"], name: 'app_admin_update')]
    public function updateOne(ApiResponse $apiResponse, Request $request, AdministrateursRepository $administrateursRepository): Response
    {
        $params = [
            "nom" => "string",
            "prenom" => "string",
            "password" => "string",
            "email" => "string"
        ];
        $apiResponse->setParams($params);
        $response = $apiResponse->isParamsExistAndCorrectType($request);
        if ($apiResponse->hasError) {
            return $this->json($response, 400, ['Content-Type' => 'application/json']);
        }
        $email = $response["email"];
        $nom = $response["nom"];
        $prenom = $response["prenom"];
        $password = password_hash($response["password"], null);
        $email = $response["email"];
        $admin = $administrateursRepository->update($nom, $prenom, $password, $email);
        return $this->json($admin);
    }

    #[Route('/admins/add', methods: ["POST"], name: 'app_admin_add')]
    public function add(ApiResponse $apiResponse, Request $request, AdministrateursRepository $administrateursRepository): Response
    {
        $params = [
            "email" => "string",
            "nom" => "string",
            "prenom" => "string",
            "password" => "string",
        ];
        $apiResponse->setParams($params);
        $response = $apiResponse->isBodyExistAndCorrectType($request);
        if ($apiResponse->hasError) {
            return $this->json($response, 400, ['Content-Type' => 'application/json']);
        }
        $email = $response["email"];
        $nom = $response["nom"];
        $prenom = $response["prenom"];
        $password = password_hash($response["password"], null);
        $admin = $administrateursRepository->add($email, $nom, $prenom, $password);
        return $this->json($admin);
    }
}
