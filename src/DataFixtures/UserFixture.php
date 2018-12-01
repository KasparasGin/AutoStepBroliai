<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {


        $user = new User();
        $user->setEmail('test@test.com');
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'test'
        ));
        $user->setRoles(['ROLE_USER']);
        $manager->persist($user);

        $manager->flush();
    }
}
