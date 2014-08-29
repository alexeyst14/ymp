<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 27.08.14
 * Time: 18:55
 */

namespace Avkdev\YmParserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Avkdev\YmParserBundle\Entity\Category;

class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // categories
        $cat1 = new Category();
        $cat1
            ->setYandexCatId('117929')
            ->setName("Вытяжки");
        $manager->persist($cat1);

        $cat2 = new Category();
        $cat2
            ->setYandexCatId(106388)
            ->setName("Посудомоечные машины");
        $manager->persist($cat2);
        $manager->flush();

        $this->addReference('cat1', $cat1);
        $this->addReference('cat2', $cat2);
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 1;
    }
}
