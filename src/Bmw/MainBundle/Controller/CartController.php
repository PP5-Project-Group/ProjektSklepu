<?php

namespace Bmw\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CartController extends Controller
{
    /**
     * @Route("/cart")
     * @Template()
     */
   
    public function cartAction()
    {
        
        return array(
				'name' => "ELO",
			);
		
    }
}