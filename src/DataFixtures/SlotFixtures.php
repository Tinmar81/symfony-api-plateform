<?php

namespace App\DataFixtures;

use App\Entity\Restaurant;
use App\Entity\Slot;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SlotFixtures extends Fixture implements DependentFixtureInterface
{
    const RESTAURANT_SLOTS = [
        "french-touch" => [
            ["slot_from" => "11:30", "slot_to" => "12:30"],
            ["slot_from" => "12:30", "slot_to" => "13:15"],
            ["slot_from" => "13:15", "slot_to" => "14:00"],
            ["slot_from" => "18:30", "slot_to" => "19:30"],
            ["slot_from" => "19:30", "slot_to" => "20:30"],
            ["slot_from" => "20:30", "slot_to" => "21:30"],
            ["slot_from" => "21:30", "slot_to" => "22:30"],

        ],
        "kebahb-deluxe" => [
            ["slot_from" => "12:00", "slot_to" => "12:30"],
            ["slot_from" => "12:30", "slot_to" => "13:30"],
            ["slot_from" => "13:30", "slot_to" => "14:00"],
            ["slot_from" => "20:00", "slot_to" => "21:00"],
            ["slot_from" => "21:00", "slot_to" => "22:00"],
            ["slot_from" => "22:00", "slot_to" => "23:00"],
            ["slot_from" => "23:00", "slot_to" => "24:00"]
        ],
        "pizza-venezia" => [
            ["slot_from" => "12:30", "slot_to" => "13:15"],
            ["slot_from" => "13:15", "slot_to" => "14:00"],
            ["slot_from" => "18:30", "slot_to" => "19:30"],
            ["slot_from" => "19:00", "slot_to" => "20:00"],
            ["slot_from" => "20:00", "slot_to" => "21:00"],
            ["slot_from" => "21:00", "slot_to" => "22:00"],
            ["slot_from" => "22:00", "slot_to" => "23:00"],

        ],
        "quality-fast-food" => [
            ["slot_from" => "11:00", "slot_to" => "12:00"],
            ["slot_from" => "12:00", "slot_to" => "12:30"],
            ["slot_from" => "12:30", "slot_to" => "13:30"],
            ["slot_from" => "19:30", "slot_to" => "20:30"],
            ["slot_from" => "20:30", "slot_to" => "21:30"],
            ["slot_from" => "21:30", "slot_to" => "22:30"],
            ["slot_from" => "22:30", "slot_to" => "23:30"],

        ],
        "sushi-master" => [
            ["slot_from" => "11:30", "slot_to" => "12:30"],
            ["slot_from" => "12:30", "slot_to" => "13:15"],
            ["slot_from" => "13:15", "slot_to" => "14:00"],
            ["slot_from" => "14:00", "slot_to" => "14:30"],
            ["slot_from" => "19:30", "slot_to" => "20:30"],
            ["slot_from" => "20:30", "slot_to" => "21:30"],
            ["slot_from" => "21:30", "slot_to" => "22:30"],
            ["slot_from" => "22:30", "slot_to" => "23:30"],
        ],
        "tapas-tapas" => [
            ["slot_from" => "11:00", "slot_to" => "12:00"],
            ["slot_from" => "12:00", "slot_to" => "12:30"],
            ["slot_from" => "12:30", "slot_to" => "13:30"],
            ["slot_from" => "13:30", "slot_to" => "14:00"],
            ["slot_from" => "14:00", "slot_to" => "14:30"],
            ["slot_from" => "14:30", "slot_to" => "15:00"],
            ["slot_from" => "20:30", "slot_to" => "21:30"],
            ["slot_from" => "21:30", "slot_to" => "22:30"],
            ["slot_from" => "22:30", "slot_to" => "23:30"],
            ["slot_from" => "23:30", "slot_to" => "00:30"],

        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach(self::RESTAURANT_SLOTS as $ref => $slots) {
            foreach ($slots as $s) {
                $slot = (new Slot())
                    ->setSlotFrom($s["slot_from"])
                    ->setSlotTo($s["slot_to"])
                    ->setAffluence(rand(1,3))
                    ->setRestaurant($this->getReference(RestaurantFixtures::RESTAURANT_SLOT_REF . "-" . $ref));
                $manager->persist($slot);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            RestaurantFixtures::class
        );
    }
}
