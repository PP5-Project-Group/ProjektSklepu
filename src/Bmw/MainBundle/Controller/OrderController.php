<?php

namespace Bmw\MainBundle\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Bmw\MainBundle\Entity\Morder;
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
		
			      $stmt = $this->getDoctrine()->getManager()  
	                   ->getConnection()  
	                   ->prepare(
						'SELECT
						 order_data, order_status, Movie.title, Movie.price
						FROM 
						Morder LEFT JOIN Morder_has_Movie ON Morder.order_id = Morder_has_Movie.order_id
						JOIN Movie ON Movie.movie_id = Morder_has_Movie.movie_id
						WHERE
						Morder.user_id = 5
						GROUP BY 
						order_data
						ORDER BY
						order_status DESC'
	                   	); 
						
	      $stmt->execute();  
	      $orders =  $stmt->fetchAll();  
		  
		return $this -> render('BmwMainBundle:Order:history.html.twig', array('title' => "My orders", 'orders' => $orders));

	}



	public function orderAction(Request $request){
			
		$order = new Morder();
		$session = $this -> getRequest() -> getSession();
		
		$order->setOrderStatus(1);
		$order->setOrderData(date('d.m.Y H:i'));
		$order->setItemStatus(1);
		
		$login = $session->get('login');
		$username = $login -> getUsername();
	   
	    $em = $this->getDoctrine()->getManager();
	    $query = $em->createQuery(
		'SELECT u.userId 
		FROM BmwMainBundle:User u
		WHERE u.login  = :login
		'
		)->setParameter('login', $username)
		->getScalarResult();
		$ids = array_column($query, "userId");

		$userLp = $ids[0];
		$user_id = $em->getRepository('BmwMainBundle:User')->find($userLp);
		// exit(\Doctrine\Common\Util\Debug::dump($user_id));
		$order->setUser($user_id);
	
		$em->persist($order);
   		$em->flush();
		
		     $request->getSession()->getFlashBag()
         	->add('reg', 'Jeśli nie posiadasz konta, możesz się zarejestrować klikając');
	}
}
