<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: UsersRepository::class)]
#[UniqueEntity('email')]
class Users
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $gender = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $city = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $country = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bio = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $birth_date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $looking_gender = null;

    #[ORM\Column(nullable: true)]
    private ?int $distance = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Assert\Email]
    private ?string $email = null;

    #[ORM\Column]
    private ?int $min_age = null;

    #[ORM\Column]
    private ?int $max_age = null;

    #[ORM\Column]
    private ?bool $status = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Images::class)]
    private Collection $images;

    #[ORM\OneToMany(mappedBy: 'userA', targetEntity: UserMatch::class)]
    private Collection $userMatchesA;

    #[ORM\OneToMany(mappedBy: 'userB', targetEntity: UserMatch::class)]
    private Collection $userMatchesB;

    #[ORM\OneToMany(mappedBy: 'sender', targetEntity: Message::class)]
    private Collection $messagesSender;

    #[ORM\OneToMany(mappedBy: 'receiver', targetEntity: Message::class)]
    private Collection $messagesReceiver;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->userMatchesA = new ArrayCollection();
        $this->userMatchesB = new ArrayCollection();
        $this->messagesSender = new ArrayCollection();
        $this->messagesReceiver = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(?string $bio): self
    {
        $this->bio = $bio;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birth_date;
    }

    public function setBirthDate(\DateTimeInterface $birth_date): self
    {
        $this->birth_date = $birth_date;

        return $this;
    }

    public function getLookingGender(): ?string
    {
        return $this->looking_gender;
    }

    public function setLookingGender(?string $looking_gender): self
    {
        $this->looking_gender = $looking_gender;

        return $this;
    }

    public function getDistance(): ?int
    {
        return $this->distance;
    }

    public function setDistance(?int $distance): self
    {
        $this->distance = $distance;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getMinAge(): ?int
    {
        return $this->min_age;
    }

    public function setMinAge(int $min_age): self
    {
        $this->min_age = $min_age;

        return $this;
    }

    public function getMaxAge(): ?int
    {
        return $this->max_age;
    }

    public function setMaxAge(int $max_age): self
    {
        $this->max_age = $max_age;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, Images>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Images $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setUser($this);
        }

        return $this;
    }

    public function removeImage(Images $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getUser() === $this) {
                $image->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UserMatch>
     */
    public function getUserMatchesA(): Collection
    {
        return $this->userMatchesA;
    }

    /**
     * @return Collection<int, UserMatch>
     */
    public function getUserMatchesB(): Collection
    {
        return $this->userMatchesB;
    }

    public function addUserMatchA(UserMatch $userMatch): self
    {
        if (!$this->userMatchesA->contains($userMatch)) {
            $this->userMatchesA->add($userMatch);
            $userMatch->setUserA($this);
        }

        return $this;
    }

    public function addUserMatchB(UserMatch $userMatch): self
    {
        if (!$this->userMatchesB->contains($userMatch)) {
            $this->userMatchesB->add($userMatch);
            $userMatch->setUserA($this);
        }

        return $this;
    }

    public function removeUserMatchA(UserMatch $userMatchA): self
    {
        if ($this->userMatchesA->removeElement($userMatchA)) {
            // set the owning side to null (unless already changed)
            if ($userMatchA->getUserA() === $this) {
                $userMatchA->setUserA(null);
            }
        }

        return $this;
    }

    public function removeUserMatchB(UserMatch $userMatchB): self
    {
        if ($this->userMatchesB->removeElement($userMatchB)) {
            // set the owning side to null (unless already changed)
            if ($userMatchB->getUserA() === $this) {
                $userMatchB->setUserA(null);
            }
        }
        return $this;
    }

    public function toJson(): array
    {
        $images = $this->constructImagesArray();

        return [
            "id" => $this->id,
            "gender" => $this->gender,
            "city" => $this->city,
            "country" => $this->country,
            "looking_gender" => $this->looking_gender,
            "first_name" => $this->firstName,
            "last_name" => $this->lastName,
//            "age" => $this->convertBirthDateToYearsOld($this->birth_date),
            "bio" => $this->bio,
            "images" => $images,
        ];
    }

    public function toJsonSetting(): array
    {
        $images = $this->constructImagesArray();

        return [
            "id" => $this->id,
            "gender" => $this->gender,
            "city" => $this->city,
            "country" => $this->country,
            "looking_gender" => $this->looking_gender,
            "first_name" => $this->firstName,
            "last_name" => $this->lastName,
            "bio" => $this->bio,
            "birth_date" => $this->birth_date,
            "email" => $this->email,
            "distance" => $this->distance,
            "images" => $images,
        ];
    }

    private function convertBirthDateToYearsOld($date): int {

        if($date === null) {
            return -1;
        }

        $formatDate = $date->format('d/m/Y');
        $today = date('d/m/Y');

        $diff=date_diff($date, date_create($today));
        dd($diff);

        //return 12;
    }

    /**
     * @return array
     */
    private function constructImagesArray (): array
    {
        $images = [];
        foreach ($this->getImages() as $img) {
            $images[] = $img->toJson();
        }
        return $images;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getMessagesSender(): Collection
    {
        return $this->messagesSender;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getMessagesReceiver(): Collection
    {
        return $this->messagesReceiver;
    }

    public function addMessagesSender(Message $messagesSender): self
    {
        if (!$this->messagesSender->contains($messagesSender)) {
            $this->messagesSender->add($messagesSender);
            $messagesSender->setSender($this);
        }

        return $this;
    }

    public function addMessagesReceiver(Message $messagesReceiver): self
    {
        if (!$this->messagesReceiver->contains($messagesReceiver)) {
            $this->messagesReceiver->add($messagesReceiver);
            $messagesReceiver->setSender($this);
        }

        return $this;
    }

    public function removeMessagesSender(Message $messagesSender): self
    {
        if ($this->messagesSender->removeElement($messagesSender)) {
            // set the owning side to null (unless already changed)
            if ($messagesSender->getSender() === $this) {
                $messagesSender->setSender(null);
            }
        }

        return $this;
    }

    public function removeMessagesReceiver(Message $messagesReceiver): self
    {
        if ($this->messagesReceiver->removeElement($messagesReceiver)) {
            // set the owning side to null (unless already changed)
            if ($messagesReceiver->getSender() === $this) {
                $messagesReceiver->setSender(null);
            }
        }

        return $this;
    }
}
