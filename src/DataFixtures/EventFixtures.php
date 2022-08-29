<?php
/**
 * Category fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Event;
use Doctrine\Persistence\ObjectManager;

/**
 * Class CategoryFixtures.
 */
class EventFixtures extends AbstractBaseFixtures
{
    /**
     * Load data.
     *
     * @param ObjectManager $manager Persistence object manager
     */
    public function loadData(ObjectManager $manager): void
    {
        $this->createMany(20, 'categories', function ($i) {
            $event = new Event();
            $event->setTitle($this->faker->word);
            $event->setCategory($this->getRandomReference('category'));
            $event->setDate($this->faker->dateTimeBetween('-100 days', '-1 days'));
            $event->setPlace($this->faker->word);

            return $event;
        });

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [Category::class];
    }
}