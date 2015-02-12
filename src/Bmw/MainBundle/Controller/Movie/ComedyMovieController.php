<?php

namespace Bmw\MainBundle\Controller\Movie;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class AllMovieController extends Controller
{
    /**
     * @Route("/movies/comedy")
     * @Template()
     */
   
    public function indexAction()
    {
     
		$repository = $this->getDoctrine()->getRepository('BmwMainBundle:Movie');
		
		$movie = $repository->findAll();
		
		return $this->render('BmwMainBundle:MovieDisplay:comedymovie.html.twig', array(
	    	'movie' => $movie
	    	));
		
	}
}
