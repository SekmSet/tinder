<?php

namespace App\DataFixtures;

use App\Entity\Images;
use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        $users = Array();
        $images = Array();
        $status = [true, false];
        $cities = ["Paris", "Marseille", "Lille", "Toulouse", "Nice", "Nantes"];
        $gender = ["Male", "Female", "Other", "Chut"];

        for ($i = 0; $i <= 4; $i++) {
            $users[$i] = new Users();
            $users[$i]->setEmail($faker->email);
            $users[$i]->setPassword($faker->password);
            $users[$i]->setLastName($faker->lastName);
            $users[$i]->setFirstName($faker->firstName);
            $users[$i]->setCountry("France");
            $users[$i]->setCity($faker->randomElement($cities));
            $users[$i]->setMinAge($faker->numberBetween(18, 99));
            $users[$i]->setMaxAge($faker->numberBetween(18, 99));
            $users[$i]->setDistance($faker->numberBetween(5, 100));
            $users[$i]->setBio("Ma BIO " . $i);
            $users[$i]->setStatus($faker->randomElement($status));
            $users[$i]->setGender($faker->randomElement($gender));
            $users[$i]->setLookingGender($faker->randomElement($gender));
            $users[$i]->setBirthDate($faker->dateTime('d-m-Y', 'now'));

            $manager->persist($users[$i]);
        }

        $userCount = count($users);

        for ($user = 0;  $user < $userCount; $user++) {
            for ($j = 0; $j < 5; $j++) {
                $images[$j] = new Images();
                $images[$j]->setUser($users[$user]);
                $images[$j]->setUrl("https://picsum.photos/200/300");
                $images[$j]->setPosition($j);
                $manager->persist($images[$j]);
            }
        }

        $manager->flush();
    }
}
