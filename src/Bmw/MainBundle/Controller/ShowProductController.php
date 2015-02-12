<?php

namespace Bmw\MainBundle\Controller;

use Bmw\MainBundle\Entity\Movie;
use Bmw\MainBundle\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class ShowProductController extends Controller
{
	/**
	     * @Route("/show")
	     * @Template()
	     */
	
	public function showAction($title)
	{
	    $product = $this->getDoctrine()
	        ->getRepository('BmwMainBundle:Movie')
	        ->find($title);

	    if (!$product) {
	        throw $this->createNotFoundException(
	            'No product found for id '.$title
	        );
	    }

	    // ... zrobić coś, na przykład przekazać obiekt $product do szablonu
	}
}

