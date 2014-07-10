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
use TeamRace\WebBundle\Entity\Team;
use TeamRace\WebBundle\Entity\UserTeam;
use TeamRace\WebBundle\Entity\ChallengeTeam;


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
    
    
    
    /***** CHALLENGES *****/
    
    
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
    
    public function challengeSetResultsAction(Request $request, $idTeamrace, $idTeamraceChallenge)
    {
    	$this->initialize($idTeamrace);
    	
    	$challenge = $this->getDoctrine()
    		->getRepository('TeamRaceWebBundle:TeamraceChallenge')
    		->find($idTeamraceChallenge);
    	 
    	$teams = $this->getDoctrine()
    		->getRepository('TeamRaceWebBundle:Team')
    		->findBy(array('teamrace' => $idTeamrace));
    		
		$builder = $this->createFormBuilder(array(
				'action' => $this->generateUrl('teamraceChallengeSetResults', 
						array('idTeamrace' => $idTeamrace, 'idTeamraceChallenge' => $idTeamraceChallenge))));
    		
    	foreach($teams as $team) {
    		$builder->add('points_'.$team->getIdTeam(), 'integer', array('label' => $team->getName()));
    	}
    	
    	$builder->add('Set Results', 'submit');
    	
    	$form = $builder->getForm();
    	
    	$form->handleRequest($request);
    	 
    	if($form->isValid()) {
    		
    		$em = $this->getDoctrine()->getManager();
    		
    		// Delete all Results already set
    		$challengeTeams = $this->getDoctrine()
    			->getRepository('TeamRaceWebBundle:ChallengeTeam')
    			->findBy(array('challenge' => $idTeamraceChallenge));

    		foreach ($challengeTeams as $challengeTeam) {
    			$em->remove($challengeTeam);
    		}
    		
    		$data = $form->getData();
    		
    		foreach($data as $key => $value) {
    			if($key != "action") {
    				$idTeam = explode("_", $key)[1];
    				$team = $this->getDoctrine()
    					->getRepository('TeamRaceWebBundle:Team')
    					->find($idTeam);
    				$challengeTeam = new ChallengeTeam();
    				$challengeTeam->setTeam($team);
    				$challengeTeam->setPoints($value);
    				$challengeTeam->setChallenge($challenge);
    				
    				$em->persist($challengeTeam);
    			}
    		}
    		
    		$em->flush();
    		$redirectUrl = $this->get('router')->generate('teamraceChallenges', array('idTeamrace' => $idTeamrace));
    		return $this->redirect($redirectUrl);
    		 
    	}
    	 
    	return $this->render(
    			'TeamRaceWebBundle:Teamrace:challengeSetResults.html.twig',
    			array(	'form' => $form->createView(),
    					'teams' => $teams,
    					'teamrace' => $this->teamrace,
    					'challenge' => $challenge)
    	);
    }
    
    public function challengeViewResultsAction($idTeamrace, $idTeamraceChallenge) {
    	
    	$this->initialize($idTeamrace);
    	 
    	$challengeTeams = $this->getDoctrine()
    		->getRepository('TeamRaceWebBundle:ChallengeTeam')
    		->findBy(array('challenge' => $idTeamraceChallenge));
    	
    	$challenge = $this->getDoctrine()
    		->getRepository('TeamRaceWebBundle:TeamraceChallenge')
    		->find($idTeamraceChallenge);
    		
    	return $this->render(
    			'TeamRaceWebBundle:Teamrace:challengeViewResults.html.twig',
    			array(	'teamrace' => $this->teamrace,
    					'challengeTeams' => $challengeTeams,
    					'teamraceChallenge' => $challenge));
    }
    
    /***** MEMBERS *****/
    
    
    public function membersAction($idTeamrace)
    {
    	$this->initialize($idTeamrace);
    	
    	$teams = $this->getDoctrine()
    		->getRepository('TeamRaceWebBundle:Team')
    		->findBy(array('teamrace' => $idTeamrace));
    	
    	$formAddToTeam = $this->createFormBuilder(array(
    			'action' => $this->generateUrl('teamraceTeams', array('idTeamrace' => $idTeamrace))));
    	$formAddToTeam->add('team', 'entity', array(
    		'class' => 'TeamRaceWebBundle:Team',
    		'choices' => $teams,
    		'property' => 'name'
    	));
    	$formAddToTeam->add('Add to team', 'submit');
    	$formAddToTeam = $formAddToTeam->getForm();
    	
    	$members = $this->getDoctrine()
    	->getRepository('TeamRaceWebBundle:UserTeamrace')
    	->findBy(array('teamrace' => $idTeamrace));
    	 
    	$content = $this->renderView('TeamRaceWebBundle:Teamrace:members.html.twig',
    			array(	'teamrace' => $this->teamrace,
    					'members' => $members,
    					'teams' => $teams,
    					'formAddToTeam' => $formAddToTeam->createView()));
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
    
    /***** TEAMS *****/

    
    public function teamsAction(Request $request, $idTeamrace)
    {
    	$this->initialize($idTeamrace);
    
    	$userAndTeams = $this->getDoctrine()
    		->getRepository('TeamRaceWebBundle:UserTeam')
    		->getUserAndTeams($idTeamrace);
    	//print("<pre>");print_r($userAndTeams);print "</pre>"; exit;
    	$teams = $this->getDoctrine()
    	->getRepository('TeamRaceWebBundle:Team')
    	->findBy(array('teamrace' => $idTeamrace));
    	
    	$form = $this->createFormBuilder(array(
    			'action' => $this->generateUrl('teamraceTeams', array('idTeamrace' => $idTeamrace))));
    	$form->add('name', 'text');
    	$form->add('Create Team', 'submit');
    	
    	$form = $form->getForm();
    	 
    	$form->handleRequest($request);
    	
    	if($form->isValid()) {
    	
    		$team = new Team();
    		$team->setName($form->getData()['name']);
    		$team->setTeamrace($this->teamrace);
    	
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($team);
    		$em->flush();
    	
    	}
    	
    	return $this->render(
    			'TeamRaceWebBundle:Teamrace:teams.html.twig',
    			array(	'form' => $form->createView(),
    					'teams' => $teams,
    					'teamrace' => $this->teamrace)
    	);
    }
    
    public function removeTeamAction($idTeamrace, $idTeam)
    {
    	$this->initialize($idTeamrace);
    
    	$team = $this->getDoctrine()
    	->getRepository('TeamRaceWebBundle:Team')
    	->findOneBy(array('idTeam' => $idTeam));
    	 
    	if (!empty($team)) {
    		$em = $this->getDoctrine()->getManager();
    		$em->remove($team);
    		$em->flush();
    	}
    
    	// TODO successfull redirect flash
    	$redirectUrl = $this->get('router')->generate('teamraceTeams', array('idTeamrace' => $idTeamrace));
    	return $this->redirect($redirectUrl);
    	 
    }

    public function addMemberToTeamAction(Request $request, $idTeamrace, $idUser)
    {
    	$this->initialize($idTeamrace);
    	
    	$em = $this->getDoctrine()->getManager();
    	
    	$idTeam = $request->get('idTeam');
    
    	// Check if user is already member in other team, if so, delete the membership
    	$userTeamArray = $this->getDoctrine()
    	->getRepository('TeamRaceWebBundle:UserTeam')
    	->findUserTeam($idUser, $idTeamrace);
    	
    	if(!empty($userTeamArray)) {
	    	$em->remove($userTeamArray[0]);
	    } 
    	
	    // Create the membership in the team
    	$user = $this->getDoctrine()
	    	->getRepository('TeamRaceWebBundle:User')
	    	->find($idUser);
    		
    	$team = $this->getDoctrine()
	    	->getRepository('TeamRaceWebBundle:Team')
	    	->find($idTeam);
    	
    	if(!empty($user) & !empty($team)) {
    		$userTeam = new UserTeam();
    		$userTeam->setRole(3);
    		$userTeam->setUser($user);
    		$userTeam->setTeam($team);

    		$em->persist($userTeam);
    		$em->flush();
    		 
    	}
    	
    	// TODO successfull redirect flash
    	$redirectUrl = $this->get('router')->generate('teamraceMembers', array('idTeamrace' => $idTeamrace));
    	return $this->redirect($redirectUrl);
    
    }
    
    public function removeMemberFromTeamAction($idTeamrace, $idUser, $idTeam)
    {
    	$this->initialize($idTeamrace);

    	$userTeam = $this->getDoctrine()
    	->getRepository('TeamRaceWebBundle:User')
    	->findBy(array('user' => $idUser, 'team' => $idTeam));
    	 
    	 
    	if (!empty($userTeam)) {
    		$em = $this->getDoctrine()->getManager();
    		$em->remove($userTeam);
    		$em->flush();
    	}
    
    	// TODO successfull redirect flash
    	$redirectUrl = $this->get('router')->generate('teamraceTeams', array('idTeamrace' => $idTeamrace));
    	return $this->redirect($redirectUrl);
    	 
    }
    
    /***** STANDINGS *****/
    
    public function standingsAction($idTeamrace)
    {
    	$this->initialize($idTeamrace);
    
    	$challengeTeams = $this->getDoctrine()
    		->getRepository('TeamRaceWebBundle:ChallengeTeam')
    		->findChallengeTeam($idTeamrace);
    	
    	
    	$results = array();
    	$i = 0;
    	foreach($challengeTeams as $challengeTeam) {
    		if(isset($results[$challengeTeam->getTeam()->getName()])) {
    			$results[$challengeTeam->getTeam()->getName()] = $results[$challengeTeam->getTeam()->getName()]
    																+ $challengeTeam->getPoints();
    		} else {
    			$results[$challengeTeam->getTeam()->getName()] = $challengeTeam->getPoints();
    		}								
    	}
    	asort($results);
    	$results = array_reverse($results);
    	
    	return $this->render(
    			'TeamRaceWebBundle:Teamrace:standings.html.twig',
    			array(	'results' => $results,
    					'teamrace' => $this->teamrace)
    	);
    
    }
}
