<?php

namespace Bmw\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MorderHasMovie
 *
 * @ORM\Table(name="Morder_has_Movie", indexes={@ORM\Index(name="movie_id", columns={"movie_id"}), @ORM\Index(name="order_id", columns={"order_id"})})
 * @ORM\Entity
 */
class MorderHasMovie
{
    /**
     * @var integer
     *
     * @ORM\Column(name="morder_has_movie_id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $morderHasMovieId;

    /**
     * @var \Bmw\MainBundle\Entity\Morder
     *
     * @ORM\ManyToOne(targetEntity="Bmw\MainBundle\Entity\Morder")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="order_id", referencedColumnName="order_id")
     * })
     */
    private $order;

    /**
     * @var \Bmw\MainBundle\Entity\Movie
     *
     * @ORM\ManyToOne(targetEntity="Bmw\MainBundle\Entity\Movie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="movie_id", referencedColumnName="movie_id")
     * })
     */
    private $movie;



    /**
     * Get morderHasMovieId
     *
     * @return integer 
     */
    public function getMorderHasMovieId()
    {
        return $this->morderHasMovieId;
    }

    /**
     * Set order
     *
     * @param \Bmw\MainBundle\Entity\Morder $order
     * @return MorderHasMovie
     */
    public function setOrder(\Bmw\MainBundle\Entity\Morder $order = null)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \Bmw\MainBundle\Entity\Morder 
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set movie
     *
     * @param \Bmw\MainBundle\Entity\Movie $movie
     * @return MorderHasMovie
     */
    public function setMovie(\Bmw\MainBundle\Entity\Movie $movie = null)
    {
        $this->movie = $movie;

        return $this;
    }

    /**
     * Get movie
     *
     * @return \Bmw\MainBundle\Entity\Movie 
     */
    public function getMovie()
    {
        return $this->movie;
    }
}
