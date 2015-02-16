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
     	$category = 'Most Popular';
		$repository = $this->getDoctrine()->getRepository('BmwMainBundle:Movie');
		
		$movie = $repository->findByPrice(6.99);
		
		return $this->render('BmwMainBundle:DashBoard:index.html.twig', array(
	    	'movie' => $movie,
	    	'category' => $category,
	    	'title' => 'DashBoard'
	    	));
		
	}

	public function selectAction($type)
	{
		$repository = $this->getDoctrine()->getRepository('BmwMainBundle:Movie');
		
		$category = '';
		if ($type == 'action'){
			$type = 1;
			$category = 'Akcji';
			$movie = $repository->findBycategory($type);
		}
		if($type == 'comedy'){
			$type = 2;
			$category = 'Komedie';
			$movie = $repository->findBycategory($type);
		} if ($type == 'horror'){
			$type = 3;
			$category = 'Horror';
			$movie = $repository->findBycategory($type);
		} if ($type == 'scifiction'){
			$type = 4;
			$category = 'Fantasy';
			$movie = $repository->findBycategory($type);
		} if ($type == 'all'){
			$category = 'Wszystkie';
			$movie = $repository->findAll();
		}
		//exit(\Doctrine\Common\Util\Debug::dump($movie));
		return $this->render('BmwMainBundle:DashBoard:index.html.twig', array(
			'title' => 'Kategoria: '.$category,
			'category' => $category,
			'movie' => $movie
			));
	}

	public function movieAction($page)
	{
	
		$repository = $this->getDoctrine()->getRepository('BmwMainBundle:Movie');
		$session = $this -> getRequest() -> getSession();
		$session -> remove('movieId');
		$session ->set('movieId', $page);

				
		$movie = $repository->findOneBymovieId($page);
		//exit(\Doctrine\Common\Util\Debug::dump($movie));
		return $this->render('BmwMainBundle:DashBoard:singleindex.html.twig', array(
			'title' => 'Wybrany film',
			'movie' => $movie,
			'page' => $page
			));
	}
}
