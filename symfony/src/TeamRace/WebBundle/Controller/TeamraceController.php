<?php

namespace TeamRace\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use TeamRace\WebBundle\Entity\TeamraceChallenge;
use TeamRace\WebBundle\Form\Type\TeamraceChallengeType;
use TeamRace\WebBundle\Entity\UserTeamrace;
use TeamRace\WebBundle\Form\Model\AddMember;
use TeamRace\WebBundle\Form\Type\AddMemberType;

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
	 * Initialize the user, teamrace and role members
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
    	
    	$challenges = $this->getDoctrine()
    	->getRepository('TeamRaceWebBundle:TeamraceChallenge')
    	->findBy(array('teamrace' => $idTeamrace), array('date' => 'DESC'));
    	
    	$content = $this->renderView('TeamRaceWebBundle:Teamrace:challenges.html.twig',
			array(	'teamrace' => $this->teamrace,
    				'challenges' => $challenges));
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
    
    public function membersAction($idTeamrace)
    {
    	$this->initialize($idTeamrace);
    	 
    	$members = $this->getDoctrine()
    	->getRepository('TeamRaceWebBundle:UserTeamrace')
    	->findBy(array('teamrace' => $idTeamrace));
    	 
    	$content = $this->renderView('TeamRaceWebBundle:Teamrace:members.html.twig',
    			array(	'teamrace' => $this->teamrace,
    					'members' => $members));
    	return new Response($content);
    }
    
    public function addMemberAction($idTeamrace)
    {
    	$this->initialize($idTeamrace);
    	 
    	$form = $this->createForm(new AddMemberType(), new AddMember(), array(
    			'action' => $this->generateUrl('teamraceDoAddMember', array('idTeamrace' => $idTeamrace)),
    	));
    
    	return $this->render(
    			'TeamRaceWebBundle:Teamrace:addMember.html.twig',
    			array(	'form' => $form->createView(),
    					'teamrace' => $this->teamrace)
    	);
    
    }
    
    public function doAddMemberAction(Request $request, $idTeamrace) {
    
    	$this->initialize($idTeamrace);
    	 
    	$form = $this->createForm(new AddMemberType(), new AddMember());
    
    	$form->handleRequest($request);
    
    	if ($form->isValid()) {
    
    		$email = $form->getData()->getEmail();
    		
    		// Type of Challenge
    		// v 1.0 -> always type 1
    		$user = $this->getDoctrine()
    		->getRepository('TeamRaceWebBundle:User')
    		->findOneBy(array('email' => $email));
    		
    		if (!empty($user)) {
    			 
    			$userTeamrace = new UserTeamrace();
    			$userTeamrace->setUser($user);
    			$userTeamrace->setTeamrace($this->teamrace);
    			// Role: Teamrace Player
    			$userTeamrace->setRole(2);
    			
    			$em = $this->getDoctrine()->getManager();
    			$em->persist($userTeamrace);
    			$em->flush();
    			 
    		}
    			
    		// TODO successfull redirect flash
    		$redirectUrl = $this->get('router')->generate('teamraceMembers', array('idTeamrace' => $idTeamrace));
    		return $this->redirect($redirectUrl);
    	}
    
    	return $this->render(
    			'TeamRaceWebBundle:User:createTeamRace.html.twig',
    			array('form' => $form->createView())
    	);
    }
    
    public function removeMemberAction($idTeamrace, $idUser)
    {
    	$this->initialize($idTeamrace);
    
    	$userTeamrace = $this->getDoctrine()
    	->getRepository('TeamRaceWebBundle:UserTeamrace')
    	->findOneBy(array('user' => $idUser));
    	
    	if (!empty($userTeamrace)) {
    		$em = $this->getDoctrine()->getManager();
    		$em->remove($userTeamrace);
    		$em->flush();
    	}
    
    	// TODO successfull redirect flash
    	$redirectUrl = $this->get('router')->generate('teamraceMembers', array('idTeamrace' => $idTeamrace));
    	return $this->redirect($redirectUrl);
    	
    }
    
}
