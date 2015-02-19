<?php

namespace Bmw\MainBundle\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Bmw\MainBundle\Entity\Morder;
use Bmw\MainBundle\Entity\MorderHasMovie;
use Bmw\MainBundle\Entity\Movie;
use Bmw\MainBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class OrderController extends Controller {

	/**
	 * @Route("/history")
	 * @Template()
	 */
	public function historyAction() {
			
		$repository = $this->getDoctrine()->getRepository('BmwMainBundle:Morder');
		
	
				// widoczne sa zamowienia wszytskich uzytkownikow	
			      $stmt = $this->getDoctrine()->getManager()  
	                   ->getConnection()  
	                   ->prepare(
						'SELECT 
						Movie.title, Movie.price, Morder.order_data, Morder.order_status 
						FROM 
						(Morder LEFT JOIN Morder_has_Movie ON Morder.order_id = Morder_has_Movie.order_id)
						INNER JOIN Movie ON Morder_has_Movie.movie_id = Movie.movie_id 
						ORDER BY 
						title DESC'
	                   	);
						
	      $stmt->execute();  
	      $orders =  $stmt->fetchAll();  
		  
		return $this -> render('BmwMainBundle:Order:history.html.twig', array('title' => "My orders", 'orders' => $orders));

	}

}
