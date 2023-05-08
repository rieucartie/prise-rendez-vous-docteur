<?php
namespace App\DataFixtures;
use Faker\Factory;
use App\Entity\Users;
use Faker\Generator;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture 
{
    private \Faker\Generator $faker;
    private UserPasswordEncoderInterface $passwordEncoder;
    private ObjectManager $manager;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder=$passwordEncoder;
    }
    public function load(ObjectManager $manager):void
    { 
        $this->manager=$manager;
        $this->faker=Factory::create();
        $this->generateUsers(2);
        $manager->flush();
    }
    /**
     * 
     */
    private function generateUsers(int $number):void
    {
    $Roles=[['ROLE_USER'],['ROLE_ADMIN']];
    for($i=0;$i<$number;$i++){
        $user= new Users();
        $user->setPatientNom($this->faker->sentence(4));
        $user->setEmail($this->faker->email);
        $user->setUsername($this->faker->userName);
        $user->setPassword($this->passwordEncoder->encodePassword($user,'mdp'));
        $user->setRoles($Roles[$i]);

        $this->manager->persist($user);

            }
    }
}
