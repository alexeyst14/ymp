<?php

namespace Avkdev\YmParserBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * CategoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoryRepository extends EntityRepository
{
    public function getList()
    {
        return $this
            ->createQueryBuilder('c')
            ->add('orderBy', 'c.name ASC');
    }
}
