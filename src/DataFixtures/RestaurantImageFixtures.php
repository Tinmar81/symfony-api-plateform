<?php

namespace App\DataFixtures;

use App\Entity\RestaurantImage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RestaurantImageFixtures extends Fixture
{
    const IMG_PATH = "/build/images/";
    const IMG_FORMAT_JPG = ".jpg";
    const IMG_NAMES = ["french-touch", "kebahb-deluxe", "pizza-venezia", "quality-fast-food", "sushi-master", "tapas-tapas"];
    const RESTAURANT_IMG_REF = "restaurant-img";

    public function load(ObjectManager $manager)
    {
        foreach (self::IMG_NAMES as $name) {
            $img = new RestaurantImage();
            $img->setFilename($name)
                ->setFormat(self::IMG_FORMAT_JPG)
                ->setPath(self::IMG_PATH);

            $manager->persist($img);
            $manager->flush();

            $this->addReference(self::RESTAURANT_IMG_REF . "-$name", $img);
        }

    }
}
