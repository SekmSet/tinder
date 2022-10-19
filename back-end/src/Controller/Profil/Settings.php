<?php

namespace App\Controller\Profil;

use App\Repository\UsersRepository;
use App\Service\UsersService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use function MongoDB\BSON\toJSON;

class Settings extends AbstractController
{
    public function __invoke(UsersService $usersService, Request $request): Response
    {
        $allAttributes = $request->attributes->all();
        $id = $allAttributes['id'];

        $user = $usersService->getUserInformation($id);

        $result = $user->toJsonSetting();

        return $this->json($result, Response::HTTP_OK);
    }
}