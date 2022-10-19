<?php

namespace App\Controller\Profil;

use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class UpdateSettings extends AbstractController
{
    public function __invoke(UsersRepository $usersRepository): Response
    {
        $number = random_int(0, 100);

        print_r($usersRepository->findAll());

        return new Response(
            '<html><body>Lucky number settings: '.$number.'</body></html>'
        );
    }
}