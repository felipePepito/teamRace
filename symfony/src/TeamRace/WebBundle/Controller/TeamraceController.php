<?php

namespace TeamRace\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use TeamRace\WebBundle\Entity\TeamraceChallenge;
use TeamRace\WebBundle\Form\Type\TeamraceChallengeType;

class TeamraceController extends Controller
{
	
	/**
	 * Teamrace object from DB
	 * @var \TeamRace\WebBundle\Entity\Teamrace
	 */
	private $teamrace;
	
	/**
	 * Role of user in teamrace
	 * 1 => Admin
	 * 2 => Tutor (not in v 1.0)
	 * 3 => Player
	 * @var unknown
	 */
	private $role;
	
	/**
	 * User object
	 * @var \TeamRace\WebBundle\Entity\User
	 */
	private $user;
	
	/**
	 * 
	 */
	private function initialize($idTeamrace) {
		
		$this->user = $this->get('security.context')->getToken()->getUser();
		
		$this->teamrace = $this->getDoctrine()
			->getRepository('TeamRaceWebBundle:Teamrace')
			->find($idTeamrace);
		$this->role = $this->getDoctrine()
			->getRepository('TeamRaceWebBundle:UserTeamrace')
			->findOneBy(array('teamrace' => $idTeamrace, 'user' => $this->user->getIdUser()));
	} 
	
	
	public function homeAction($idTeamrace)
    {
    	$this->initialize($idTeamrace);
    	
    	$content = $this->renderView('TeamRaceWebBundle:Teamrace:home.html.twig',
			array('teamrace' => $this->teamrace));
    	
    	return new Response($content);
    }
    
    public function challengesAction($idTeamrace)
    {
    	$this->initialize($idTeamrace);
    	
    	$content = $this->renderView('TeamRaceWebBundle:Teamrace:challenges.html.twig',
			array('teamrace' => $this->teamrace));
    	return new Response($content);
    }
    
    public function createChallengeAction($idTeamrace)
    {
    	$this->initialize($idTeamrace);
    	
    	$form = $this->createForm(new TeamraceChallengeType(), new TeamraceChallenge(), array(
    			'action' => $this->generateUrl('teamraceDoCreateChallenge', array('idTeamrace' => $idTeamrace)),
    	));
    	 
    	return $this->render(
    			'TeamRaceWebBundle:Teamrace:createChallenge.html.twig',
    			array(	'form' => $form->createView(),
    					'teamrace' => $this->teamrace)
    	);
    	 
    }
    
    public function doCreateChallengeAction(Request $request, $idTeamrace) {
    
    	$this->initialize($idTeamrace);
    	
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
    		$teamraceChallenge->setTeamrace($this->teamrace);
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
