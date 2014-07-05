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
    	
    	$form = $this->createForm(new TeamraceChallengeType(), new TeamraceChallenge());
    	 
    	$form->handleRequest($request);
    	 
    	if ($form->isValid()) {
    		
    		// Type of Challenge
    		// v 1.0 -> always type 1
    		$challenge = $this->getDoctrine()
    		->getRepository('TeamRaceWebBundle:Challenge')
    		->find("1");
    		 
    		$user = $this->get('security.context')->getToken()->getUser();
    
    		$teamraceChallenge = $form->getData();
    		
    		$teamraceChallenge->setTutor($user);
    		$teamraceChallenge->setTeamrace($teamrace);
    		$teamraceChallenge->setChallenge($challenge);
    		 
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($teamraceChallenge);
    		$em->flush();
    		 
    		// TODO successfull redirect flash
    		$redirectUrl = $this->get('router')->generate('teamraceChallenges', array('idTeamrace' => $idTeamrace));
    		return $this->redirect($redirectUrl);
    	}
    	 
    	return $this->render(
    			'TeamRaceWebBundle:User:createTeamRace.html.twig',
    			array('form' => $form->createView())
    	);
    }
    
}
