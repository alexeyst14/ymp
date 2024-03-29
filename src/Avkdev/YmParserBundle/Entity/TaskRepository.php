<?php

namespace Avkdev\YmParserBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\Criteria;
use Avkdev\YmParserBundle\Entity\Task;


/**
 * TaskRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TaskRepository extends EntityRepository
{
    public function getUnresolvedTasks()
    {
        $criteria = Criteria::create()
            ->where(Criteria::expr()->lt('runDate', new \DateTime()))
            ->andWhere(Criteria::expr()->in('status', array(Task::STATUS_PENDING,Task::STATUS_ERROR)))
            ->orderBy(array('runDate' => Criteria::ASC));
        return $this->matching($criteria);
    }
}
