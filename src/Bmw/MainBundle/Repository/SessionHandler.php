<?php

namespace Bmw\MainBundle\Repository;
use Symfony\Component\HttpFoundation\Session\Session;

class SesionHandler {
	private $session;

	
	public function sessionStart(){
		$this->session = new Session();
		$this->session->start();
		$this->session->set('name', 'id');	
	}
	
	public function getSession() {
		$this->session->get('name', 'id');
	}
	
	public function destroySession(){
		
	}

}
