<?php

namespace App\DataFixtures;

use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Factory\DragonTreasureFactory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        UserFactory::createMany(10);
        DragonTreasureFactory::createMany(40, function () {
            return [
                'owner' => UserFactory::random(),
            ];
        });

        $manager->flush();
    }
}
