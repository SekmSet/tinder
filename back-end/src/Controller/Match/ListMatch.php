<?php

namespace App\Controller\Match;

use App\Service\MatchService;
use App\Service\UsersService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ListMatch extends AbstractController
{
    public function __invoke(MatchService $matchService, UsersService $usersService, Request $request): Response
    {
        $allAttributes = $request->attributes->all();
        $id = $allAttributes['id']; //default param for this moment because no
        $user = $usersService->getUserInformation($id);

        $sqlArg = [];

        if ($user->getLookingGender() !== "Chut" || $user->getLookingGender() !== "Other") {
            $sqlArg["gender"] = $user->getLookingGender();
        }
        $sqlArg["city"] = $user->getCity();
        $sqlArg["country"] = $user->getCountry();
        $sqlArg["status"] = 1;
        //$sqlArg["ageMin"] = $getUserParam['ageMin'];
        //$sqlArg["ageMax"] = $getUserParam['ageMax'];

        // Handle error
        if (empty($sqlArg)) {
            $users = $usersService->getAllUsers();
        } else {
            $users = $usersService->getUserNotMatchWithParams($id, $sqlArg);
        }

        $result = [];
        foreach ($users as $u) {
            $result[] = $u->toJson();
        }
        return $this->json($result, Response::HTTP_OK);
    }
}