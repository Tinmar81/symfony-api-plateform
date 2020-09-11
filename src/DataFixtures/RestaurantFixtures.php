<?php

namespace App\DataFixtures;

use App\Entity\Restaurant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class RestaurantFixtures extends Fixture implements DependentFixtureInterface
{
    const RESTAURANT_NAMES = [
        "french-touch" => "French Touch",
        "kebahb-deluxe" => "Kebahb Deluxe",
        "pizza-venezia" => "Pizza Venezia",
        "quality-fast-food" => "Quality Fastfood",
        "sushi-master" => "Sushi Master",
        "tapas-tapas" => "Tapas Tapas"
    ];
    const RESTAURANT_SLOT_REF = "restaurant-slot";

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        foreach(self::RESTAURANT_NAMES as $imgRef => $restaurantName ) {
            $restaurant = new Restaurant();
            $restaurant->setName($restaurantName)
                ->setDescription($faker->text(200))
                ->setImage($this->getReference(RestaurantImageFixtures::RESTAURANT_IMG_REF . "-$imgRef"));
            $manager->persist($restaurant);

            $this->addReference(self::RESTAURANT_SLOT_REF. "-" . $imgRef, $restaurant);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            RestaurantImageFixtures::class
        );
    }
}
