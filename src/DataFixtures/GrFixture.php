<?php

namespace App\DataFixtures;

use App\Entity\GrUser;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class GrFixture extends Fixture
{
    private UserPasswordHasherInterface $passwordEncoder;

    public function __construct(UserPasswordHasherInterface  $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager): void
    {
        $user = new GrUser();

        $user->setEmail('yvan@gmail.com');
        $user->setFullName('Yvan Vianney');
        $user->setPassword($this->passwordEncoder->hashPassword($user,'admin'));
        $user->setRoles(['ROLE_ADMIN']);

        // $product = new Product();

        $manager->persist($user);
        $manager->flush();
    }
}
