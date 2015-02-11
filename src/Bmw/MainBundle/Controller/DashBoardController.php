<?php

namespace Bmw\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DashBoardController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
   
    public function indexAction()
    {
        
        return array(
				'name' => "ELO",
			);
		
		
    }
	
	public function positionAction(){
		
		return array(
			'name' => $movieName,
			'price' => $moviePrice,
			'img' => $movieImg,
			'note' => $movieNote,
			'reviews' => $reviewsNumber,
			'position' => $moviePostion
		);
		
	}
}
