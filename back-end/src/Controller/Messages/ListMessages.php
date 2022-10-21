<?php

namespace App\Controller\Messages;

use App\Service\MessageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ListMessages extends AbstractController
{
    public function __invoke(MessageService $messageService, Request $request): Response
    {
        $allAttributes = $request->attributes->all();
        $id = $allAttributes['my_id'];
        $idUserB = $allAttributes['id_recevier'];

        $allMessages = $messageService->getMyMessages($id, $idUserB);

        $result = [];
        foreach ($allMessages as $m) {
            $result[] = $m->toJson();
        }

        return $this->json($result, Response::HTTP_OK);
    }


}