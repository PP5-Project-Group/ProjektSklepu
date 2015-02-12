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
     
		$repository = $this->getDoctrine()->getRepository('BmwMainBundle:Movie');
		
		$movie = $repository->findAll();
		
		return $this->render('BmwMainBundle:DashBoard:index.html.twig', array(
	    	'movie' => $movie
	    	));
		
	}
}
