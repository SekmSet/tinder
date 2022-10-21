<?php

namespace App\Service;

use App\Entity\Message;
use App\Entity\Users;
use App\Repository\MessageRepository;

class MessageService
{
    private MessageRepository $messageRepository;

    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    public function addNewMessage($idSender, $text, $idReceiver) {
        $message = new Message();
        $message->setReceiver($idReceiver);
        $message->setSender($idSender);
        $message->setText($text);

        $this->messageRepository->save($message, true);
    }

    /**
     * @return Message[]
     */
    public function getMyMessages($id, $idUserB) : array {
        return $this->messageRepository->getMyMessages($id, $idUserB);
    }

}