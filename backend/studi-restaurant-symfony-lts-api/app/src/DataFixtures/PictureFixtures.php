<?php

namespace App\DataFixtures;

use App\Entity\Restaurant;
use App\Service\Utils;
use App\Entity\Picture;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;

class PictureFixtures extends Fixture implements DependentFixtureInterface
{

    public const USER_NB_TUPLES = 20;
    
    /** @throws Exception */
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= self::USER_NB_TUPLES; $i++) {
            /** @var Restaurant $restaurant */
            $restaurant = $this->getReference(RestaurantFixtures::RESTAURANT_REFERENCE . random_int(0, 20), Restaurant::class);
            $title = "Article n°$i";

            $picture = (new Picture())
                ->setTitle($title)
                ->setSlug("slug")
                ->setRestaurant($restaurant)
                ->setCreatedAt(new DateTimeImmutable());

            $manager->persist($picture);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [RestaurantFixtures::class];
    }
}