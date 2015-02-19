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

				
				$em = $this -> getDoctrine() -> getEntityManager();
				$movie = $em -> getRepository('BmwMainBundle:Movie') -> findByMovieId($cart);


			return $this -> render('BmwMainBundle:Cart:cart.html.twig', array('movie' => $movie, 'empty' => false));

		} else {
			return array('empty' => true);
		}

	}

	public function addAction(Request $request, $page) {


		
		$session = $this -> getRequest() -> getSession();
		//$cart = $session -> get('cart', array());
		$id = $session->get('movieId', array());

		
		$session -> set('cart', $id);

		
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
		$cart = $session -> get('cart');
	    $em = $this -> getDoctrine() -> getEntityManager();
		$movie = $em -> getRepository('BmwMainBundle:Movie') -> findByMovieId($cart);
			$request->getSession()->getFlashBag()
         	->add('valid', 'Usunięto film z koszyka');

		return $this -> render('BmwMainBundle:Cart:cart.html.twig', array('movie' => $movie, 'empty' => false));
	  
	}

	public function validAction(Request $request)
	{
		$request->getSession()->getFlashBag()
         	->add('valid', 'Musisz sie zalogować aby można było złożyć zamówienie!');
        $request->getSession()->getFlashBag()
         	->add('reg', 'Jeśli nie posiadasz konta, możesz się zarejestrować klikając');
         	

        $session = $this -> getRequest() -> getSession();
		$cart = $session -> get('cart', array());

		If ($cart != '') {

				$em = $this -> getDoctrine() -> getEntityManager();
				$movie = $em -> getRepository('BmwMainBundle:Movie') -> findByMovieId($cart);

			return $this -> render('BmwMainBundle:Cart:cart.html.twig', array('movie' => $movie, 'empty' => false));

		} else {
			return array('empty' => true);
		}
	}

}
