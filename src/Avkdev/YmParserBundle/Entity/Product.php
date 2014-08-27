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
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $retail;

    /**
     * @var integer
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
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
     * @param integer $currency
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
     * @return integer 
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
}
