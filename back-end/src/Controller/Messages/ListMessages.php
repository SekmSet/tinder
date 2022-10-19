<?php

namespace App\Controller\Messages;

use App\Service\UsersService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ListMessages extends AbstractController
{
    public function __invoke(UsersService $usersService, Request $request): Response
    {
        $allAttributes = $request->attributes->all();
        $id = $allAttributes['id'];

        return $this->json("ok", Response::HTTP_OK);
    }


}