<?php

namespace Bmw\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Bmw\MainBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Bmw\MainBundle\Repository\Login;

class LoginController extends Controller {


	public function loginAction(Request $request) {
		
		$em = $this -> getDoctrine() -> getEntityManager();
		$repository = $em -> getRepository('BmwMainBundle:User');
		$session = $this -> getRequest() -> getSession();
		if ($request -> getMethod() == 'POST') {

			$session -> remove('login');

			$username = $request -> get('username');
			$password = $request -> get('password');
			

			$user = $repository -> findOneBy(array('login' => $username, 'userPassword' => $password));

			if ($user) {
				
					$login = new Login();
					$login -> setUsername($username);
					$login -> setPassword($password);
					$session -> set('login', $login);
					
				
				return $this -> render('BmwMainBundle:Login:welcome.html.twig', array('name' => $user -> getLogin()));
			} else {
				 $request->getSession()->getFlashBag()
   			    ->add('error', 'Podałeś błędne dane');
				return $this -> render('BmwMainBundle:Login:welcome.html.twig');

			}
		} else {
			if ($session -> has('login')) {
				$login = $session -> get('login');
				$username = $login -> getUsername();
				$password = $login -> getPassword();
				$user = $repository -> findOneBy(array('login' => $username, 'userPassword' => $password));
				if ($user) {
					return $this -> render('BmwMainBundle:Login:wlcome.html.twig', array('name' => $user -> getLogin()));
				}
			}
			return $this -> render('BmwMainBundle:Login:welcome.html.twig');
		}

		//return $this -> render('BmwMainBundle:Login:login.html.twig');
	}

	
	public function logoutAction(Request $request) {
		$session = $this -> getRequest() -> getSession();
		$session -> remove('login');
		return $this -> render('BmwMainBundle:Login:goodbye.html.twig');
	}

}
