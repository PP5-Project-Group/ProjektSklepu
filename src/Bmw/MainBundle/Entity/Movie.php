<?php

namespace Bmw\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Movie
 *
 * @ORM\Table(name="Movie", indexes={@ORM\Index(name="category_id", columns={"category_id"})})
 * @ORM\Entity
 */
class Movie
{
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=30, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=9, scale=2, nullable=false)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=256, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="img_url", type="string", length=124, nullable=true)
     */
    private $imgUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="actors", type="string", length=124, nullable=true)
     */
    private $actors;

    /**
     * @var integer
     *
     * @ORM\Column(name="item_status", type="smallint", nullable=true)
     */
    private $itemStatus;

    /**
     * @var integer
     *
     * @ORM\Column(name="movie_id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $movieId;

    /**
     * @var \Bmw\MainBundle\Entity\Category
     *
     * @ORM\ManyToOne(targetEntity="Bmw\MainBundle\Entity\Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="category_id")
     * })
     */
    private $category;



    /**
     * Set title
     *
     * @param string $title
     * @return Movie
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return Movie
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Movie
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set imgUrl
     *
     * @param string $imgUrl
     * @return Movie
     */
    public function setImgUrl($imgUrl)
    {
        $this->imgUrl = $imgUrl;

        return $this;
    }

    /**
     * Get imgUrl
     *
     * @return string 
     */
    public function getImgUrl()
    {
        return $this->imgUrl;
    }

    /**
     * Set actors
     *
     * @param string $actors
     * @return Movie
     */
    public function setActors($actors)
    {
        $this->actors = $actors;

        return $this;
    }

    /**
     * Get actors
     *
     * @return string 
     */
    public function getActors()
    {
        return $this->actors;
    }

    /**
     * Set itemStatus
     *
     * @param integer $itemStatus
     * @return Movie
     */
    public function setItemStatus($itemStatus)
    {
        $this->itemStatus = $itemStatus;

        return $this;
    }

    /**
     * Get itemStatus
     *
     * @return integer 
     */
    public function getItemStatus()
    {
        return $this->itemStatus;
    }

    /**
     * Get movieId
     *
     * @return integer 
     */
    public function getMovieId()
    {
        return $this->movieId;
    }

    /**
     * Set category
     *
     * @param \Bmw\MainBundle\Entity\Category $category
     * @return Movie
     */
    public function setCategory(\Bmw\MainBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Bmw\MainBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
}
