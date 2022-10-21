<?php

namespace App\Controller\Match;

use App\Service\MatchService;
use App\Service\UsersService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ListMyMatch extends AbstractController
{
    public function __invoke(MatchService $matchService, UsersService $usersService, Request $request): Response
    {
        $allAttributes = $request->attributes->all();
        $id = $allAttributes['id']; //default param for this moment because no

        $usersID = array_merge(...$usersService->getMyMatch($id));

        $users = [];
        foreach ($usersID as $userID) {
            $users[] = $usersService->getUserById($userID);
        }

        $result = [];
        foreach ($users as $u) {
            $result[] = $u->toJson();
        }
        return $this->json($result, Response::HTTP_OK);
    }
}