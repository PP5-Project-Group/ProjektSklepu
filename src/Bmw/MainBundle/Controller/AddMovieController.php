<?php

namespace Bmw\MainBundle\Controller;

use Bmw\MainBundle\Entity\Movie;
use Bmw\MainBundle\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class AddMovieController extends Controller
{
	/**
	     * @Route("/add")
	     * @Template()
	     */
	public function indexAction()
	{
		
		$repository = $this->getDoctrine()->getRepository('BmwMainBundle:Movie');
		


		$movieId=20;
		$movie = $repository->findAll();
		
		return $this->render('BmwMainBundle:AddMovie:add.html.twig', array(
	    	'movie' => $movie
	    	));
		

	    // $product = new Movie();
	    // $product->setTitle(50);
	    // $product->setPrice(9.99);
	    // $product->setDescription('Lorem ipsum dolor');
	    // $product->setImgUrl('url');
	    // $product->setActors('actor1, actor2, actro3');
	    // $product->setItemStatus(1);
	    // $category = new Category();
	    // $product->setCategory($category->getCategory(3)) ;

	    // $em = $this->getDoctrine()->getManager();
	    // $em->persist($product);
	    // $em->flush();

	    // return new Response('Created product id '.$product->getCategory());
	    // return array(
	    // 	'name' => 'Cos'
	    // 	);


	    // $movieId=23;

		   //  $product = $this->getDoctrine()
	    //     ->getRepository('BmwMainBundle:Movie')
	    //     ->find($movieId);

	    // if (!$product) {
	    //     throw $this->createNotFoundException(
	    //         'No Movie found for id '.$id
	    //     );
	    // }

	    // exit(\Doctrine\Common\Util\Debug::dump($product));

	    
	}

	
}

