<?php

namespace Avkdev\YmParserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 */
class Category
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $yandex_cat_id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $products;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set yandex_cat_id
     *
     * @param integer $yandexCatId
     * @return Category
     */
    public function setYandexCatId($yandexCatId)
    {
        $this->yandex_cat_id = $yandexCatId;

        return $this;
    }

    /**
     * Get yandex_cat_id
     *
     * @return integer 
     */
    public function getYandexCatId()
    {
        return $this->yandex_cat_id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Category
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
     * Add products
     *
     * @param \Avkdev\YmParserBundle\Entity\Product $products
     * @return Category
     */
    public function addProduct(\Avkdev\YmParserBundle\Entity\Product $products)
    {
        $this->products[] = $products;

        return $this;
    }

    /**
     * Remove products
     *
     * @param \Avkdev\YmParserBundle\Entity\Product $products
     */
    public function removeProduct(\Avkdev\YmParserBundle\Entity\Product $products)
    {
        $this->products->removeElement($products);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProducts()
    {
        return $this->products;
    }

    public function __toString()
    {
        return $this->getName();
    }

}
