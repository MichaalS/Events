<?php
/**
 * Category fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;

/**
 * Class CategoryFixtures.
 */
class CategoryFixtures extends AbstractBaseFixtures
{
    /**
     * Load data.
     *
     * @param ObjectManager $manager Persistence object manager
     */
    public function loadData(ObjectManager $manager): void
    {
        $this->createMany(20, 'categories', function ($i) {
            $category = new Category();
            $category->setCode($this->faker->word);
            $category->setTitle($this->faker->word);
            $category->setCreated_at($this->faker->dateTimeBetween('-100 days', '-1 days'));
            $category->setUpdated_at($this->faker->dateTimeBetween('-100 days', '-1 days'));

            return $category;
        });

        $manager->flush();
    }
}