<?php

namespace TeamRace\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use TeamRace\WebBundle\Entity\TeamraceChallenge;
use TeamRace\WebBundle\Form\Type\TeamraceChallengeType;

class TeamraceController extends Controller
{
    public function homeAction($idTeamrace)
    {
    	
    	$user = $this->get('security.context')->getToken()->getUser();
    	
    	// Retrieve Teamraces that user takes part of
    	$teamrace = $this->getDoctrine()
    		->getRepository('TeamRaceWebBundle:Teamrace')
    		->find($idTeamrace);
    	
    	$content = $this->renderView('TeamRaceWebBundle:Teamrace:home.html.twig',
			array('teamrace' => $teamrace));
    	
    	return new Response($content);
    }
    
    public function challengesAction($idTeamrace)
    {
    	
    	// Retrieve Teamraces that user takes part of
    	$teamrace = $this->getDoctrine()
    	->getRepository('TeamRaceWebBundle:Teamrace')
    	->find($idTeamrace);
    	
    	$content = $this->renderView('TeamRaceWebBundle:Teamrace:challenges.html.twig',
			array('teamrace' => $teamrace));
    	return new Response($content);
    }
    
    public function createChallengeAction($idTeamrace)
    {
    	// Retrieve Teamraces that user takes part of
    	$teamrace = $this->getDoctrine()
    	->getRepository('TeamRaceWebBundle:Teamrace')
    	->find($idTeamrace);
    	
    	$form = $this->createForm(new TeamraceChallengeType(), new TeamraceChallenge(), array(
    			'action' => $this->generateUrl('teamraceDoCreateChallenge', array('idTeamrace' => $idTeamrace)),
    	));
    	 
    	return $this->render(
    			'TeamRaceWebBundle:Teamrace:createChallenge.html.twig',
    			array(	'form' => $form->createView(),
    					'teamrace' => $teamrace)
    	);
    	 
    }
    
    public function doCreateChallengeAction(Request $request, $idTeamrace) {
    
    	// Retrieve Teamraces that user takes part of
    	$teamrace = $this->getDoctrine()
    	->getRepository('TeamRaceWebBundle:Teamrace')
    	->find($idTeamrace);
    	
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
