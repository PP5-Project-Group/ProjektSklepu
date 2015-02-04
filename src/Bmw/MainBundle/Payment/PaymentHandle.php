<?php

namespace Bmw\MainBundle\Payment;

class PaymentHandle 
{
	const TRANSACTION_OK = 2;
	protected $clientId;
	protected $pin;
	protected $repository;
	
	
	public function __construct($clientId, $pin)
	{
		$this->clientId = $clientId;
		$this->pin = $pin;
	}
	
	public function handlePayment(array $parameters)
	{
		$hash = $this->calculateHash($parameters);
		
		if($this->isTransactionValid($hash, $parameters))
		{
			return 'OK';
		} else 
		{
			return 'ERROR';
		}
	}
	
	private funciton calculateHash($parameters)
	{
		$service = isset($parameters['service']) ? $parameters['service' : '';
		$username = isset($parameters['username']) ? $parameters['username' : '';
		$password = isset($parameters['password']) ? $parameters['password' : '';
		$code = isset($parameters['code']) ? $parameters['code' : '';
		
		$hash = sprintf(
			'%s:%s:$s:%s:%s:%s:%s:%s:%s:$s:%s'
			$this->pin,
			$this->clientId,
			$parameters['control'],
			$parameters['t_id'],
			$parameters['amoutn'],
			$parameters['email'],
			$service,
			$code,
			$username,
			$password,
			$parameters['t_status'],
		);
		
		return $hash;
	}
	
	private function isTransactionValid($hash, $parameters)
	{
		if ( $hash != $parameters['md5'])
		{
			return false;
		}
		if ($parameters['t_status'] != self:TRANSACTION_OK)
		{
			return false;
		}
		if (!$this->repository->findOneBy([
				'number'] => $parameters['control'],
			])	{	
			return false;
		}
		return true;
	}
}