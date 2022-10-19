<?php

namespace App\Controller\Match;

use App\Repository\UsersRepository;
use App\Service\UsersService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Users;

class ListMatch extends AbstractController
{
    public function __invoke(UsersService $usersService, Request $request): Response
    {
        $allAttributes = $request->attributes->all();
        $id = $allAttributes['id'];
        $user = $usersService->getUserInformation($id);

        $sqlArg = [];

        if($user->getLookingGender() !== "Chut" || $user->getLookingGender() !== "Other") {
            $sqlArg["gender"] = $user->getLookingGender();
        }
        $sqlArg["city"] = $user->getCity();
        $sqlArg["country"] = $user->getCountry();
        $sqlArg["status"] = 1;

        //$sqlArg["ageMin"] = $getUserParam['ageMin'];
        //$sqlArg["ageMax"] = $getUserParam['ageMax'];

        // query database
        $result = [];

        // Handle error
        if (empty($sqlArg)) {
            $users = $usersService->getAllUsers();
        } else {
            $users = $usersService->getUserWithParams($sqlArg);
        }

        foreach ($users as $user) {
            $result[] = $user->toJson();
        }

        //  if()
        // return response
        return $this->json($result, Response::HTTP_OK);
    }
}