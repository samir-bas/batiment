<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $password = $this->encoder->encodePassword($user1,'123456');
        $user1->setEmail("hopper@maboitemail.fr")
        ->setPassword($password)
        ->setFirstname("Grace")
        ->setLastname("Hopper")
        ->setBirthDate(new DateTime("09-12-1906"));
        $manager->persist($user1);

        $user2 = new User();
        $password = $this->encoder->encodePassword($user2,'1234567');
        $user2->setEmail("lovelace@gmail.com")
        ->setPassword($password)
        ->setFirstname("Ada")
        ->setLastname("Lovelace")
        ->setBirthDate(new DateTime("10-12-1815"));
        $manager->persist($user2);

        $user3 = new User();
        $password = $this->encoder->encodePassword($user3,'12345678');
        $user3->setEmail("lamarr@yahoo.fr")
        ->setPassword($password)
        ->setFirstname("Hedy")
        ->setLastname("Lamarr")
        ->setBirthDate(new DateTime("09-11-1914"));
        $manager->persist($user3);      

        $manager->flush();

        $this->addReference("Hopper", $user1);
        $this->addReference("Lovelace", $user2);
        $this->addReference("Lamarr", $user3);

    }
}
