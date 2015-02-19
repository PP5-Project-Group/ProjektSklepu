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
		$category2 = 'Most Ordered';
		$repository = $this->getDoctrine()->getRepository('BmwMainBundle:Movie');		
		$movie = $repository->findByPrice(6.99);

		// $repository = $this->getDoctrine()->getRepository('BmwMainBundle:Review');
		
		  
  
	      $stmt = $this->getDoctrine()->getManager()  
	                   ->getConnection()  
	                   ->prepare(
	                   	'SELECT
	                   	 title, price, img_url, description, Movie.movie_id, SUM( Review.movie_id) Suma, COUNT(title) Count 
	                   	FROM 
	                   	 Review LEFT JOIN Movie 
	                   	ON
	                   	 Review.movie_id = Movie.movie_id
	                   	 GROUP BY 
	                   	title
	                   	 ORDER BY
	                   	Count DESC
	                   	LIMIT 3'
	                   	);  
	      
	      $stmt->execute();  
	      $mostPopular =  $stmt->fetchAll();  
		  
		  $stmy = $this->getDoctrine()->getManager()  
	                   ->getConnection()  
	                   ->prepare(
	                   	'SELECT
	                   	 title, price, img_url, description, Movie.movie_id, SUM( Review.movie_id) Suma, COUNT(title) Count 
	                   	FROM 
	                   	 Review LEFT JOIN Movie 
	                   	ON
	                   	 Review.movie_id = Movie.movie_id
	                   	 GROUP BY 
	                   	title
	                   	 ORDER BY
	                   	Count DESC
	                   	LIMIT 3'
	                   	);  
	      
	      $stmy->execute();  
	      $mostOrdered =  $stmy->fetchAll(); 
	 
	 // exit(\Doctrine\Common\Util\Debug::dump($mostPopular));

		return $this->render('BmwMainBundle:DashBoard:index.html.twig', array(
	    	'movie' => $movie,
	    	'category' => $category,
			'category2' => $category2,
	    	'title' => 'DashBoard',
	    	'popular' => $mostPopular,
	    	'ordered' => $mostOrdered
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
			'movie' => $movie,
			'popular' => '',
			'ordered' => ''
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
