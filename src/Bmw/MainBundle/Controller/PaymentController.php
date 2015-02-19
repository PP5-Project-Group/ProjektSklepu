<?php

namespace Bmw\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
//use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Bmw\MainBundle\Entity\Morder;
use Bmw\MainBundle\Entity\MorderHasMovie;
use Bmw\MainBundle\Entity\Movie;
use Bmw\MainBundle\Entity\User;
use Symfony\Component\HttpFoundati;

class PaymentController extends Controller {
	public function payAction(Request $request) {

		$session = $this -> getRequest() -> getSession();
		$cart = $session -> get('cart');

		if ($cart == '') {

			$request -> getSession() -> getFlashBag() -> add('pusty', 'Koszyk jest pusty');
			$em = $this -> getDoctrine() -> getEntityManager();
			$movie = $em -> getRepository('BmwMainBundle:Movie') -> findByMovieId($cart);
			return $this -> render('BmwMainBundle:Cart:cart.html.twig', array('movie' => $movie, 'empty' => true));
		}

		$order = new Morder();

		$order -> setOrderStatus(1);

		$order -> setOrderData($this -> updated = new \DateTime("now"));
		$order -> setItemStatus(1);

		$login = $session -> get('login');
		$username = $login -> getUsername();

		$em = $this -> getDoctrine() -> getManager();
		$query = $em -> createQuery('SELECT u.userId 
		FROM BmwMainBundle:User u
		WHERE u.login  = :login
		') -> setParameter('login', $username) -> getScalarResult();
		$ids = array_column($query, "userId");

		$userLp = $ids[0];
		$user_id = $em -> getRepository('BmwMainBundle:User') -> find($userLp);
		//exit(\Doctrine\Common\Util\Debug::dump($user_id));
		$order -> setUser($user_id);

		$em -> persist($order);
		$em -> flush();

		$ohm = new MorderHasMovie();
		$ohm -> setOrder($order);

		$movie_id = $em -> getRepository('BmwMainBundle:Movie') -> find($cart);
		$ohm -> setMovie($movie_id);

		$em -> persist($ohm);
		$em -> flush();

		$session = $this -> getRequest() -> getSession();
		$login = $session -> get('login');
		$cart = $session -> get('cart');

		$username = $login -> getUsername();

		$em = $this -> getDoctrine() -> getManager();
		//wyciąganie loginu, emaila, telefonu
		$query = $em -> createQuery('SELECT u.login, u.mail, u.telephonNumber
		FROM BmwMainBundle:User u
		WHERE u.login  = :login
		') -> setParameter('login', $username) -> getScalarResult();

		// wyciaganie kosztu filmu
		$query2 = $em -> createQuery('SELECT u.price, u.title
		FROM BmwMainBundle:Movie u
		WHERE u.movieId  = :id_movie
		') -> setParameter('id_movie', $cart) -> getScalarResult();

		$costTab = array_column($query2, "price");
		$titleTab = array_column($query2, "title");
		$cost = $costTab[0];
		$title = $titleTab[0];

		// exit(\Doctrine\Common\Util\Debug::dump($title));

		$log = array_column($query, "login");
		$email = array_column($query, "mail");
		$tel = array_column($query, "telephonNumber");

		$userFromSession = $log[0];
		$mailFromSession = $email[0];
		$telFromSession = $tel[0];

		// exit(\Doctrine\Common\Util\Debug::dump($title));

		$request = $this -> getRequest();
		$urlDotPay = $request -> getScheme() . '://' . $request -> getHttpHost() . $request -> getBasePath() . 'app_dev.php/payment/handle';
		$urlDashBoard = $request -> getScheme() . '://' . $request -> getHttpHost() . $request -> getBasePath() . '/app_dev.php/';

		$data = ['id' => 72890, 'kwota' => $cost, 'waluta' => 'USD', 'kanal' => 3, 'opis' => 'Płatność za wypożyczenie: ' . $title, 'control' => 'WZP0000012', 'URLC' => $urlDotPay, 'firstname' => $userFromSession, 'nazwisko' => 'Nazwisko', 'email' => $mailFromSession, 'phone' => $telFromSession, 'URL' => $urlDashBoard, 'typ' => 3];

		$params = http_build_query($data);

		$url = sprintf('%s?%s', 'https://ssl.dotpay.pl/', $params);

		return new RedirectResponse($url);
	}

	public function receivePaymentAction(Request $request) {
		$logger = $this -> get('logger');
		$logger -> info('masz nowy URLC');
		$logger -> info(var_export($request -> request -> all(), true));

		$response = $this -> get('payment.handler') -> handlePayment($request -> request -> all());

		return new Response($response);
	}

}
