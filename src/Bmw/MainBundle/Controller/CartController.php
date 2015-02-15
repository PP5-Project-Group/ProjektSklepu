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
				$product = $em -> getRepository('BmwMainBundle:Movie') -> findById($id);
		//	} else {
				//return $this -> render('BmwMainBundle:Cart:cart.html.twig', array('empty' => true, ));
			//}

			return $this -> render('BmwMainBundle:Cart:cart.html.twig', array('product' => $product, ));

		} else {
			return array('empty' => true);
		}

	}

	public function addProduct($page, Request $request) {

		$em = $this -> getDoctrine() -> getEntityManager();
		$movie = $em -> findOneBymovieId($page); ;

		$session = $this -> getRequest() -> getSession();
		$cart = $session -> get('cart', array());
		$session -> set('cart', $cart);
		return $this -> render('BmwMainBundle:Cart:cart.html.twig');
	}

	public function removeProduct($id) {

		$session = $this -> getRequest() -> getSession();
		$cart = $session -> get('cart', array());
		if (!$cart) { $this -> redirect($this -> generateUrl('cart'));
		}

		if (isset($cart[$id])) {
			$cart[$id] = '0';
			unset($cart[$id]);
		} else {
			$this -> get('session') -> setFlash('notice', 'Go to hell');
			return $this -> redirect($this -> generateUrl('cart'));
		}

		$session -> set('cart', $cart);

		$this -> get('session') -> setFlash('notice', 'This product is Remove');
		return $this -> redirect($this -> generateUrl('cart'));
	}

}
