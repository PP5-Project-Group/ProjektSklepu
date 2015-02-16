<?php

namespace Bmw\MainBundle\Controller;

use Bmw\MainBundle\Entity\Review;
use Bmw\MainBundle\Entity\Movie;
use Bmw\MainBundle\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AddReviewController extends Controller 
{
	
	public function addreviewAction($page, Request $request)
	{

		//pobranie wartosci znajujacej sie w tabeli movi dla danego filmu
		$em = $this->getDoctrine()->getEntityManager();
  		$movie_id = $em->getRepository('BmwMainBundle:Movie')->find($page);
		
		$review = new Review();
		$review->setMovie($movie_id);

		$form = $this->createFormBuilder($review)
			->add('reviewText', 'text')
			->add('rate', 'integer')
			->add('User', 'entity', array(
				'class' => 'BmwMainBundle:User',
				'expanded' => false,
				'multiple' =>false,
				'property' => 'login'
				))
			->add('save', 'submit', array('label' => 'Wyślij recenzje'))
			->getForm();

			$form -> handleRequest($request);
			$em = $this->getDoctrine()->getManager();

		if ($form->isValid()) {
    		 
   			 $em = $this->getDoctrine()->getManager();
   			 $em->persist($review);
   			 $em->flush();	
   			
   			 $request->getSession()->getFlashBag()
   			 ->add('success', 'Recenzja została dodana!!');
		}

		$user = $this->get('security.context')->getToken()->getUser();
		$session = $request -> getSession(); 


		$repository = $this->getDoctrine()->getRepository('BmwMainBundle:Movie');				
		$movie = $repository->findOneBymovieId($page);
		
		//exit(\Doctrine\Common\Util\Debug::dump($review));
	if ($request -> getMethod() == 'POST') {
		return $this->render('BmwMainBundle:DashBoard:singleindex.html.twig', array(
			'form' => $form->createView(),
			'title' => 'Recenzja',		
			'movie' => $movie,
			'recenzja' => 'Recenzja została dodana!!!',	
			'user' => $user
			));

	}
	
	return $this->render('BmwMainBundle:AddReview:addreview.html.twig', array(
			'form' => $form->createView(),
			'title' => 'Recenzja',		
			'movie' => $movie,
			'user' => $user
			));
	}	
}