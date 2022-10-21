<?php

namespace App\Controller\Messages;

use App\Service\MessageService;
use App\Service\UsersService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class SendMessage extends AbstractController
{
    public function __invoke(Request $request, MessageService $messageService, UsersService $usersService) : Response
    {
        $getData = json_decode($request->getContent(), true);

        $idSender = $getData['sender'];
        $text = $getData['message'];
        $idReceiver = $getData['receiver'];

        $getSender = $usersService->getUserById($idSender);
        $getReceiver =  $usersService->getUserById($idReceiver);

        $messageService->addNewMessage($getSender, $text, $getReceiver);

        return $this->json("Your message have been send", Response::HTTP_OK);
    }

}