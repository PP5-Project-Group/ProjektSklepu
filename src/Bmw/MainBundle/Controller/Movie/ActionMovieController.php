<?php

namespace Bmw\MainBundle\Controller\Movie;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ActionMovieController extends Controller
{
    /**
     * @Route("/movies/action")
     * @Template()
     */
   
    public function indexAction()
    {
     
		$repository = $this->getDoctrine()->getRepository('BmwMainBundle:Movie');
		
		// $movie = $repository->findBy(
		// 	array('category_id' => 1)
		// 	);
		$category_id=1;
		$movie = $repository->findByPrice(6.99);

		return $this->render('BmwMainBundle:MovieDisplay:actionmovie.html.twig', array(
	    	'movie' => $movie
	    	));
		
	}
}
