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
use Avkdev\YmParserBundle\Entity\Task;

class LoadTaskData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        // tasks
        $task = new Task();
        $task
            ->setCategory($manager->merge($this->getReference('cat1')))
            ->setStatus(0)
            ->setIsRepeat(false)
            ->setRunDate(new \DateTime());
        $manager->persist($task);
        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 3;
    }
}
