<?php

namespace Avkdev\YmParserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Task
 */
class Task
{
    const STATUS_PENDING = 0;
    const STATUS_PROCESSING = 1;
    const STATUS_DONE = 2;
    const STATUS_ERROR = 3;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $yandexCatId;

    /**
     * @var \DateTime
     */
    private $createDate;

    /**
     * @var integer
     */
    private $status;

    /**
     * @var array
     */
    private $progressStatus;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set yandexCatId
     *
     * @param integer $yandexCatId
     * @return Task
     */
    public function setYandexCatId($yandexCatId)
    {
        $this->yandexCatId = $yandexCatId;

        return $this;
    }

    /**
     * Get yandexCatId
     *
     * @return integer 
     */
    public function getYandexCatId()
    {
        return $this->yandexCatId;
    }

    /**
     * Set createDate
     *
     * @param \DateTime $createDate
     * @return Task
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;

        return $this;
    }

    /**
     * Get createDate
     *
     * @return \DateTime 
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Task
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set progressStatus
     *
     * @param array $progressStatus
     * @return Task
     */
    public function setProgressStatus($progressStatus)
    {
        $this->progressStatus = $progressStatus;

        return $this;
    }

    /**
     * Get progressStatus
     *
     * @return array 
     */
    public function getProgressStatus()
    {
        return $this->progressStatus;
    }

    public function getProgressStatusStr()
    {
        return print_r($this->getProgressStatus(), true);
    }
    /**
     * @var \DateTime
     */
    private $runDate;

    /**
     * @var boolean
     */
    private $isRepeat;


    /**
     * Set runDate
     *
     * @param \DateTime $runDate
     * @return Task
     */
    public function setRunDate($runDate)
    {
        $this->runDate = $runDate;

        return $this;
    }

    /**
     * Get runDate
     *
     * @return \DateTime 
     */
    public function getRunDate()
    {
        return $this->runDate;
    }

    /**
     * Set isRepeat
     *
     * @param boolean $isRepeat
     * @return Task
     */
    public function setIsRepeat($isRepeat)
    {
        $this->isRepeat = $isRepeat;

        return $this;
    }

    /**
     * Get isRepeat
     *
     * @return boolean 
     */
    public function getIsRepeat()
    {
        return $this->isRepeat;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreateDateValue()
    {
        $this->setCreateDate(new \DateTime());
        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function setStatusValue()
    {
        $this->setStatus(0);
        return $this;
    }
    /**
     * @var integer
     */
    private $categoryId;


    /**
     * Set categoryId
     *
     * @param integer $categoryId
     * @return Task
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * Get categoryId
     *
     * @return integer 
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }
    /**
     * @var \Avkdev\YmParserBundle\Entity\Category
     */
    private $category;


    /**
     * Set category
     *
     * @param \Avkdev\YmParserBundle\Entity\Category $category
     * @return Task
     */
    public function setCategory(\Avkdev\YmParserBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Avkdev\YmParserBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return array
     */
    public static function getStatusList()
    {
        return array (
            self::STATUS_DONE => 'Выполнено',
            self::STATUS_ERROR => 'Ошибка',
            self::STATUS_PENDING => 'Ожидает выполнения',
            self::STATUS_PROCESSING => 'В процессе',
        );
    }


    public function getStatusString()
    {
        return self::getStatusList()[$this->getStatus()];
    }

    public function __toString()
    {
        return '#' . $this->getId()  . ' | ' . $this->getCategory()->getName();
    }

    /**
     * @ORM\PrePersist
     */
    public function setIsRepeatValue()
    {
        $this->setIsRepeat(0);
        return $this;
    }
}
