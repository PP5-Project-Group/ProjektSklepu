<?php
namespace Bmw\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Bmw\MainBundle\Form\UserType;
use Bmw\MainBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class RegisterController extends Controller
{
    /**
     * @Route("/register")
     * @Template()
     */
   
    public function registerAction(Request $request)
    {
        
		$user = new User();
		
		
		
    	$form = $this->createForm(new UserType(), $user);
		$form->handleRequest($request);
		
		//trzeba dorobić walidacje
		if ($form->isValid()) {
   			 $user->setRole(1); //rola użytkownika
    		 $user->setItemStatus(1);	//użytkownik aktywny
    		 
   			 $em = $this->getDoctrine()->getManager();
   			 $em->persist($user);
   			 $em->flush();
			 
   			 return $this->redirect($this->generateUrl('user'), 301);
			 
		}
		
  		
        return array(
				'form' => $form->createView(),
        'title' => 'Rejestracja'
			);
		
    }
}