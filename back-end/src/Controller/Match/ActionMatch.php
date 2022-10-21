<?php

namespace App\Controller\Match;

use App\Service\MatchService;
use App\Service\UsersService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ActionMatch extends AbstractController
{
    public function __invoke(MatchService $matchService, UsersService $usersService, Request $request) : Response
    {
        $getData = json_decode($request->getContent(), true);
        $id = $getData['id'];
        $action = $getData['action'];
        $idUserMatch = $getData['idUserMatch'];

        $getUserA = $usersService->getUserById($id);
        $getUserB =  $usersService->getUserById($idUserMatch);

        echo "{$id} {$action} {$idUserMatch}";

        $matchService->createNewMatch($getUserA, $action, $getUserB);
        return $this->json("ok", Response::HTTP_OK);
    }

}