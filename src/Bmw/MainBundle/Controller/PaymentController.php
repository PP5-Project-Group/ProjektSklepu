<?php

namespace Bmw\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
//use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class PaymentController extends Controller
{
	public function payAction()
	{
		$session = $this -> getRequest() -> getSession();
	 	$login = $session->get('login');
	 	$cart = $session->get('cart');


	 	

	 	$username = $login -> getUsername();

	 	$em = $this->getDoctrine()->getManager();
	 	//wyciąganie loginu, emaila, telefonu
		$query = $em->createQuery(
		'SELECT u.login, u.mail, u.telephonNumber
		FROM BmwMainBundle:User u
		WHERE u.login  = :login
		'
		)->setParameter('login', $username)
		->getScalarResult();

		// wyciaganie kosztu filmu
		$query2 = $em->createQuery(
		'SELECT u.price, u.title
		FROM BmwMainBundle:Movie u
		WHERE u.movieId  = :id_movie
		'
		)->setParameter('id_movie', $cart)
		->getScalarResult();

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

		$request = $this->getRequest();
		$urlDotPay = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath(). 'app_dev.php/payment/handle';
		$urlDashBoard = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath(). 'app_dev.php/';
		

		$data = [
			'id' => 72890,
			'kwota' => $cost,
			'waluta' => 'USD',
			'kanal' => 3,
			'opis' => 'Płatność za wypożyczenie: '.$title,
			'control' => 'WZP0000012',
			'URLC' => $urlDotPay,
			'firstname' => $userFromSession,
			'nazwisko' => 'Nazwisko',
			'email' => $mailFromSession,
			'phone' => $telFromSession, 
			'URL' => $urlDashBoard,
			'typ' => 1
		];
		
		$params = http_build_query($data);
		
		$url = sprintf(
			'%s?%s',
			'https://ssl.dotpay.pl/',
			$params
		);
		
		return new RedirectResponse($url);
	}
	
	public function receivePaymentAction(Request $request)
	{
		$logger = $this->get('logger');
		$logger->info('masz nowy URLC');
		$logger->info(var_export($request->request->all(), true));
		
		$response = $this->get('payment.handler')
			->handlePayment($request->request->all())
			;
			
		return new Response($response);
	}
}