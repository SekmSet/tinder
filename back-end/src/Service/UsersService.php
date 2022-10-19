<?php

namespace App\Service;

use App\Entity\Users;
use App\Repository\UsersRepository;

class UsersService
{

    private UsersRepository $usersRepository;

    public function __construct(UsersRepository $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    /**
     * @return Users[]
     */
    public function getAllUsers(): array
    {
        return $this->usersRepository->findAll();
    }

    /**
     * @return Users[]
     */
    public function getUserWithParams($params) : array {
        return $this->usersRepository->findBy($params);
    }

    public function getUserInformation($id): Users {
        $toStr = (string)$id;
        return $this->usersRepository->findOneBy(["id" => $toStr]);
    }
}