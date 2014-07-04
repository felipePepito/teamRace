<?php

namespace TeamRace\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use TeamRace\WebBundle\Entity\Teamrace;
use TeamRace\WebBundle\Entity\UserTeamrace;
use TeamRace\WebBundle\Form\Type\CreateTeamRaceType;

class UserController extends Controller
{
    public function homeAction()
    {
    	
    	$user = $this->get('security.context')->getToken()->getUser();
    	
    	// Retrieve Teamraces that user takes part of
    	$userTeamraces = $this->getDoctrine()
    		->getRepository('TeamRaceWebBundle:UserTeamrace')
    		->findByIdUser($user);
    	
    	$content = $this->renderView('TeamRaceWebBundle:User:home.html.twig',
			array('userTeamraces' => $userTeamraces));
    	
    	return new Response($content);
    }
    
    public function profileAction()
    {
    	$content = $this->renderView('TeamRaceWebBundle:User:profile.html.twig');
    	return new Response($content);
    }
    
    public function aboutAction()
    {
    	$content = $this->renderView('TeamRaceWebBundle:User:about.html.twig');
    	return new Response($content);
    }
    
    public function teamRacesAction()
    {
    	
    	// Retrieve all available Teamraces
    	$teamraces = $this->getDoctrine()
    		->getRepository('TeamRaceWebBundle:Teamrace')
    		->findAll();
    	 
    	$content = $this->renderView('TeamRaceWebBundle:User:teamRaces.html.twig',
    			array('teamraces' => $teamraces));
    	return new Response($content);
    }
    
    public function createTeamRaceAction()
    {
    	$user = $this->get('security.context')->getToken()->getUser();
    	$teamRace = new Teamrace($user);
    	
    	$form = $this->createForm(new CreateTeamRaceType(), $teamRace, array(
    			'action' => $this->generateUrl('userDoCreateTeamRace'),
    	));
    	
    	return $this->render(
    			'TeamRaceWebBundle:User:createTeamRace.html.twig',
    			array('form' => $form->createView())
    	);
    	
    }
    
    public function doCreateTeamRaceAction(Request $request) {

    	$em = $this->getDoctrine()->getManager();
    	
    	$user = $this->get('security.context')->getToken()->getUser();
    	$teamrace = new Teamrace($user);
    	
    	$form = $this->createForm(new CreateTeamRaceType(), $teamrace);
    	
    	$form->handleRequest($request);
    	
    	if ($form->isValid()) {
    		
    		$teamrace = $form->getData();
    		
    		// Create corresponding UserTeamrace Entity
    		$userTeamrace = new UserTeamrace();
    		$userTeamrace->setIdUser($user);
    		$userTeamrace->setIdTeamrace($teamrace);
    		$userTeamrace->setRole(1);
    		
    		$em->persist($teamrace);
    		$em->persist($userTeamrace);
    		$em->flush();
    	
    		// TODO successfull redirect flash
    		$redirectUrl = $this->get('router')->generate('userHome');
    		return $this->redirect($redirectUrl);
    	}
    	
    	return $this->render(
    			'TeamRaceWebBundle:User:createTeamRace.html.twig',
    			array('form' => $form->createView())
    	);
    }

}
