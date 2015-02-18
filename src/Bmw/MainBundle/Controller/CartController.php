<?php

namespace Bmw\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Bmw\MainBundle\Entity\Movie;
use Symfony\Component\HttpFoundation\Request;

class CartController extends Controller {
	/**
	 * @Route("/cart")
	 * @Template()
	 */

	public function cartAction(Request $request) {

		$session = $this -> getRequest() -> getSession();
		$cart = $session -> get('cart', array());

		If ($cart != '') {
			//foreach ($cart as $id => $price) {
			//	$productIds[] = $id;
		//	}
			//if (isset($productIds)) {
				
				$em = $this -> getDoctrine() -> getEntityManager();
				$movie = $em -> getRepository('BmwMainBundle:Movie') -> findByMovieId($cart);
		//	} else {
				//return $this -> render('BmwMainBundle:Cart:cart.html.twig', array('empty' => true, ));
			//}

			return $this -> render('BmwMainBundle:Cart:cart.html.twig', array('movie' => $movie, 'empty' => false));

		} else {
			return array('empty' => true);
		}

	}

	public function addAction(Request $request, $page) {

		//$em = $this -> getDoctrine() -> getEntityManager();
		//$movie = $em -> findOneBymovieId($page);
		
		$session = $this -> getRequest() -> getSession();
		//$cart = $session -> get('cart', array());
		$id = $session->get('movieId');
		
		$session -> set('cart', $id);
		// return $this -> render('BmwMainBundle:Cart:add.html.twig');
		
		 $request->getSession()->getFlashBag()
         ->add('success', 'Film został dodany do koszyka!!');

         $repository = $this->getDoctrine()->getRepository('BmwMainBundle:Movie');
		$session = $this -> getRequest() -> getSession();
         $movie = $repository->findOneBymovieId($page);
		
		return $this->render('BmwMainBundle:DashBoard:singleindex.html.twig', array(
			'movie' => $movie,
			'page' => 'page'
			));
	}

	public function removeAction(Request $request) {

		$session = $this -> getRequest() -> getSession();
		$session->remove('cart');
		//$cart = $session -> get('cart', array());
		//if (!$cart) { $this -> redirect($this -> generateUrl('cart'));
		//}

		//if (isset($cart[1])) {
		//$cart[1] = '0';
		//unset($cart[1]);
		//}
	//	} else {
	//		$this -> get('session') -> setFlash('notice', 'Go to hell');
		//	return $this -> redirect($this -> generateUrl('cart'));
	//	}

	//	$session -> set('cart', $cart);

	//	$this -> get('session') -> setFlash('notice', 'This product is Remove');
	    return $this -> render('BmwMainBundle:Cart:remove.html.twig',array());
	}

}
