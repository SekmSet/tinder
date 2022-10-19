<?php

namespace App\Entity;

use App\Repository\UserMatchRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserMatchRepository::class)]
class UserMatch
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(length: 255)]
    private ?string $action = null;

    #[ORM\ManyToOne(inversedBy: 'userMatchesA')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $userA = null;

    #[ORM\ManyToOne(inversedBy: 'userMatchesB')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $userB = null;

    public function __construct()
    {
        $this->userA = new ArrayCollection();
        $this->userB = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAction(): ?string
    {
        return $this->action;
    }

    public function setAction(string $action): self
    {
        $this->action = $action;

        return $this;
    }

    public function getUserA(): ?Users
    {
        return $this->userA;
    }

    public function setUserA(?Users $userA): self
    {
        $this->userA = $userA;

        return $this;
    }

    public function getUserB(): ?Users
    {
        return $this->userB;
    }

    public function setUserB(?Users $userB): self
    {
        $this->userB = $userB;

        return $this;
    }
}
