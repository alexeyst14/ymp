<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 29.08.14
 * Time: 20:11
 */

namespace Avkdev\YmParserBundle\Parser;

use Avkdev\YmParserBundle\Entity\Task;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\Security\Acl\Exception\Exception;

abstract class AbstractParser extends ContainerAware
{
    /**
     * @var \Avkdev\YmParserBundle\Entity\Task
     */
    protected $task;

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var int
     */
    protected $numPage = 1;

    /**
     * Run parser
     */
    public function run()
    {
        $this->em = $this->container->get('doctrine.orm.entity_manager');
        /** @var $tasks \Doctrine\Common\Collections\ArrayCollection */
        $tasks = $this->container->get('avkdev_ym_parser.task_repository')->getUnresolvedTasks();

        echo "Num tasks: " . $tasks->count() . "\n";

        /** @var $task \Avkdev\YmParserBundle\Entity\Task */
        foreach ($tasks as $task) {
            $this->task = $task;
            $this->persistStatus(Task::STATUS_PROCESSING);
            try {
                $this->parse();
                $this->persistStatus(Task::STATUS_DONE);
            } catch(Exception $e) {
                $this->persistStatus(Task::STATUS_ERROR);
            }
        }
    }

    /**
     * Save task status
     * @param $status integer
     */
    public function persistStatus($status)
    {
        $this->task->setStatus($status);
//        $this->em->persist($this->task);
//        $this->em->flush();
    }

    protected function setNumPage($num)
    {
        $this->numPage = $num;
        return $this;
    }

    /**
     * Calculate page offset for load a specified page
     * @param $numPage
     * @return int
     */
    protected function buildPageOffset($numPage)
    {
        return $numPage;
    }

    /**
     * Build url for creating request
     * @return string
     */
    abstract protected function buildUrl();

    /**
     * @return mixed
     */
    abstract public function parse();

}
