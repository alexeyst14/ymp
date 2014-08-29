<?php

namespace Avkdev\YmParserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 */
class Product
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $categoryId;

    /**
     * @var integer
     */
    private $yandexModelId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $retail;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var string
     */
    private $descr;

    /**
     * @var string
     */
    private $urlOriginal;

    /**
     * @var string
     */
    private $urlPhoto;

    /**
     * @var \Avkdev\YmParserBundle\Entity\Category
     */
    private $category;


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
     * Set categoryId
     *
     * @param integer $categoryId
     * @return Product
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
     * Set yandexModelId
     *
     * @param integer $yandexModelId
     * @return Product
     */
    public function setYandexModelId($yandexModelId)
    {
        $this->yandexModelId = $yandexModelId;

        return $this;
    }

    /**
     * Get yandexModelId
     *
     * @return integer 
     */
    public function getYandexModelId()
    {
        return $this->yandexModelId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set retail
     *
     * @param string $retail
     * @return Product
     */
    public function setRetail($retail)
    {
        $this->retail = $retail;

        return $this;
    }

    /**
     * Get retail
     *
     * @return string 
     */
    public function getRetail()
    {
        return $this->retail;
    }

    /**
     * Set currency
     *
     * @param string $currency
     * @return Product
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return string 
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set descr
     *
     * @param string $descr
     * @return Product
     */
    public function setDescr($descr)
    {
        $this->descr = $descr;

        return $this;
    }

    /**
     * Get descr
     *
     * @return string 
     */
    public function getDescr()
    {
        return $this->descr;
    }

    /**
     * Set urlOriginal
     *
     * @param string $urlOriginal
     * @return Product
     */
    public function setUrlOriginal($urlOriginal)
    {
        $this->urlOriginal = $urlOriginal;

        return $this;
    }

    /**
     * Get urlOriginal
     *
     * @return string 
     */
    public function getUrlOriginal()
    {
        return $this->urlOriginal;
    }

    /**
     * Set urlPhoto
     *
     * @param string $urlPhoto
     * @return Product
     */
    public function setUrlPhoto($urlPhoto)
    {
        $this->urlPhoto = $urlPhoto;

        return $this;
    }

    /**
     * Get urlPhoto
     *
     * @return string 
     */
    public function getUrlPhoto()
    {
        return $this->urlPhoto;
    }

    /**
     * Set category
     *
     * @param \Avkdev\YmParserBundle\Entity\Category $category
     * @return Product
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
}
