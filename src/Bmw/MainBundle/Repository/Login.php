<?php

namespace Bmw\MainBundle\Repository;

class Login {

	private $username;
	private $password;

	public function setUsername($username) {
		$this -> username = $username;

		return $this;
	}

	public function getUsername() {
		return $this -> username;
	}

	public function setPassword($password) {
		$this -> password = $password;

		return $this;
	}

	public function getPassword() {
		return $this -> password;
	}

}
