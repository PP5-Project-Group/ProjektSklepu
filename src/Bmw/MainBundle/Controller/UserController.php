<?php
namespace Bmw\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Bmw\MainBundle\Form\UserType;
use Bmw\MainBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    /**
     * @Route("/user")
     * @Template()
     */
	 
	 public function userAction()
    {
        
        return array(
				'name' => "ELO",
			);
		
    }
}

