<?php

namespace Bmw\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Review
 *
 * @ORM\Table(name="Review", indexes={@ORM\Index(name="movie_id", columns={"movie_id"}), @ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class Review
{
    /**
     * @var string
     *
     * @ORM\Column(name="review_text", type="string", length=512, nullable=false)
     */
    private $reviewText;

    /**
     * @var integer
     *
     * @ORM\Column(name="rate", type="smallint", nullable=true)
     */
    private $rate;

    /**
     * @var integer
     *
     * @ORM\Column(name="review_id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $reviewId;

    /**
     * @var \Bmw\MainBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Bmw\MainBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     * })
     */
    private $user;

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
     * Set reviewText
     *
     * @param string $reviewText
     * @return Review
     */
    public function setReviewText($reviewText)
    {
        $this->reviewText = $reviewText;

        return $this;
    }

    /**
     * Get reviewText
     *
     * @return string 
     */
    public function getReviewText()
    {
        return $this->reviewText;
    }

    /**
     * Set rate
     *
     * @param integer $rate
     * @return Review
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return integer 
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Get reviewId
     *
     * @return integer 
     */
    public function getReviewId()
    {
        return $this->reviewId;
    }

    /**
     * Set user
     *
     * @param \Bmw\MainBundle\Entity\User $user
     * @return Review
     */
    public function setUser(\Bmw\MainBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Bmw\MainBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set movie
     *
     * @param \Bmw\MainBundle\Entity\Movie $movie
     * @return Review
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
