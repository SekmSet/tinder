<?php

namespace App\Service;

use App\Entity\UserMatch;
use App\Repository\UserMatchRepository;

class MatchService
{

    private UserMatchRepository $userMatchRepository;

    public function __construct(UserMatchRepository $userMatchRepository)
    {
        $this->userMatchRepository = $userMatchRepository;
    }

    /**
     * @return UserMatch[]
     */
    public function getMyMatch($param): array {
        return $this->userMatchRepository->findBy($param);
    }

    public function createNewMatch($userA, $action, $userB) {
        $match = new UserMatch();
        $match->setUserA($userA);
        $match->setUserB($userB);
        $match->setAction($action);

        $this->userMatchRepository->save($match, true);
    }
}