<?php

namespace Bmw\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="User")
 * @ORM\Entity
 */
class User
{
    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=30, nullable=false)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="user_password", type="string", length=60, nullable=false)
     */
    private $userPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=30, nullable=false)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="telephon_number", type="string", length=16, nullable=false)
     */
    private $telephonNumber;

    /**
     * @var integer
     *
     * @ORM\Column(name="role", type="smallint", nullable=false)
     */
    private $role;

    /**
     * @var integer
     *
     * @ORM\Column(name="item_status", type="smallint", nullable=true)
     */
    private $itemStatus;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userId;



    /**
     * Set login
     *
     * @param string $login
     * @return User
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string 
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set userPassword
     *
     * @param string $userPassword
     * @return User
     */
    public function setUserPassword($userPassword)
    {
        $this->userPassword = $userPassword;

        return $this;
    }

    /**
     * Get userPassword
     *
     * @return string 
     */
    public function getUserPassword()
    {
        return $this->userPassword;
    }

    /**
     * Set mail
     *
     * @param string $mail
     * @return User
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set telephonNumber
     *
     * @param string $telephonNumber
     * @return User
     */
    public function setTelephonNumber($telephonNumber)
    {
        $this->telephonNumber = $telephonNumber;

        return $this;
    }

    /**
     * Get telephonNumber
     *
     * @return string 
     */
    public function getTelephonNumber()
    {
        return $this->telephonNumber;
    }

    /**
     * Set role
     *
     * @param integer $role
     * @return User
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return integer 
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set itemStatus
     *
     * @param integer $itemStatus
     * @return User
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
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }
}
