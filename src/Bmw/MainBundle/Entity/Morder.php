<?php

namespace Bmw\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Morder
 *
 * @ORM\Table(name="Morder", indexes={@ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class Morder
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="order_data", type="date", nullable=false)
     */
    private $orderData;

    /**
     * @var integer
     *
     * @ORM\Column(name="order_status", type="smallint", nullable=false)
     */
    private $orderStatus;

    /**
     * @var integer
     *
     * @ORM\Column(name="item_status", type="smallint", nullable=true)
     */
    private $itemStatus;

    /**
     * @var integer
     *
     * @ORM\Column(name="order_id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $orderId;

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
     * Set orderData
     *
     * @param \DateTime $orderData
     * @return Morder
     */
    public function setOrderData($orderData)
    {
        $this->orderData = $orderData;

        return $this;
    }

    /**
     * Get orderData
     *
     * @return \DateTime 
     */
    public function getOrderData()
    {
        return $this->orderData;
    }

    /**
     * Set orderStatus
     *
     * @param integer $orderStatus
     * @return Morder
     */
    public function setOrderStatus($orderStatus)
    {
        $this->orderStatus = $orderStatus;

        return $this;
    }

    /**
     * Get orderStatus
     *
     * @return integer 
     */
    public function getOrderStatus()
    {
        return $this->orderStatus;
    }

    /**
     * Set itemStatus
     *
     * @param integer $itemStatus
     * @return Morder
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
     * Get orderId
     *
     * @return integer 
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * Set user
     *
     * @param \Bmw\MainBundle\Entity\User $user
     * @return Morder
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
}
