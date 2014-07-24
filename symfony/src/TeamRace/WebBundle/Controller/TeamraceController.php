<?php

namespace TeamRace\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use TeamRace\WebBundle\Entity\Challenge;
use TeamRace\WebBundle\Form\Type\TeamraceChallengeType;
use TeamRace\WebBundle\Entity\UserTeamrace;
use TeamRace\WebBundle\Form\Model\AddMember;
use TeamRace\WebBundle\Form\Type\AddMemberType;
use TeamRace\WebBundle\Entity\Team;
use TeamRace\WebBundle\Entity\UserTeam;
use TeamRace\WebBundle\Entity\ChallengeTeam;
use TeamRace\WebBundle\Entity\Blog;
use TeamRace\WebBundle\Form\Type\BlogType;


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
			->findOneBy(array('teamrace' => $idTeamrace, 'user' => $this->user->getIdUser()))
			->getRole();
	} 
	
	
	public function homeAction(Request $request, $idTeamrace)
    {
    	$this->initialize($idTeamrace);
    	
    	$blogs = $this->getDoctrine()
    		->getRepository('TeamRaceWebBundle:Blog')
    		->findBy(array('teamrace' => $idTeamrace), array('date' => 'DESC'));
    	 
    	$form = $this->createForm(new BlogType(), new Blog(), array(
    			'action' => $this->generateUrl('teamraceHome', array('idTeamrace' => $idTeamrace))));
    	
    	if ($this->role == 1) {
    		$form->handleRequest($request);
    		 
	    	if($form->isValid()) {
	    		 
	    		$blog = $form->getData();
	    		$blog->setTeamrace($this->teamrace);
	    		$blog->setDate(new \DateTime());
	    		
	    		$em = $this->getDoctrine()->getManager();
	    		$em->persist($blog);
	    		$em->flush();
	    		
	    		// TODO successfull redirect flash
	    		$redirectUrl = $this->get('router')->generate('teamraceHome', array('idTeamrace' => $idTeamrace));
	    		return $this->redirect($redirectUrl);
	    		 
	    	}
    	}
    	
    	return $this->render(
    			'TeamRaceWebBundle:Teamrace:home.html.twig',
    			array(	'form' => $form->createView(),
    					'blogs' => $blogs,
    					'teamrace' => $this->teamrace,
    					'role' => $this->role)
    	);
    	
    }
    
    
    
    /***** CHALLENGES *****/
    
    
    public function challengesAction($idTeamrace)
    {
    	$this->initialize($idTeamrace);
    	
    	$challenges = $this->getDoctrine()
    	->getRepository('TeamRaceWebBundle:Challenge')
    	->findBy(array('teamrace' => $idTeamrace), array('date' => 'DESC'));
    	
    	$content = $this->renderView('TeamRaceWebBundle:Teamrace:challenges.html.twig',
			array(	'teamrace' => $this->teamrace,
    				'challenges' => $challenges,
    				'role' => $this->role));
    	return new Response($content);
    }
    
    public function createChallengeAction(Request $request, $idTeamrace)
    {
    	$this->initialize($idTeamrace);
    	
    	// Check credentials to access
    	if ($this->role != 1) {
	    	$redirectUrl = $this->get('router')->generate('teamraceChallenges', array('idTeamrace' => $idTeamrace));
	    	return $this->redirect($redirectUrl);
    	}
    	
    	$form = $this->createForm(new TeamraceChallengeType(), new Challenge(), array(
    			'action' => $this->generateUrl('teamraceCreateChallenge', array('idTeamrace' => $idTeamrace)),
    	));
    	
    	
    	$form->handleRequest($request);
    	
    	if ($form->isValid()) {
    	
    		$user = $this->get('security.context')->getToken()->getUser();
    	
    		$challenge = $form->getData();
    	
    		$challenge->setTutor($user);
    		$challenge->setTeamrace($this->teamrace);
    		 
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($challenge);
    		$em->flush();
    		 
    		// TODO successfull redirect flash
    		$redirectUrl = $this->get('router')->generate('teamraceChallenges', array('idTeamrace' => $idTeamrace));
    		return $this->redirect($redirectUrl);
	    
    	}
    	 
    	return $this->render(
    			'TeamRaceWebBundle:Teamrace:createChallenge.html.twig',
    			array(	'form' => $form->createView(),
    					'teamrace' => $this->teamrace,
    					'role' => $this->role)
    	);
    	 
    }
    
    
    public function challengeSetResultsAction(Request $request, $idTeamrace, $idChallenge)
    {
    	$this->initialize($idTeamrace);
    	
    	// Check credentials to access
    	if ($this->role != 1) {
    		$redirectUrl = $this->get('router')->generate('teamraceChallenges', array('idTeamrace' => $idTeamrace));
    		return $this->redirect($redirectUrl);
    	}
    	
    	$challenge = $this->getDoctrine()
    		->getRepository('TeamRaceWebBundle:Challenge')
    		->find($idChallenge);
    	 
    	$teams = $this->getDoctrine()
    		->getRepository('TeamRaceWebBundle:Team')
    		->findBy(array('teamrace' => $idTeamrace));
    		
		$builder = $this->createFormBuilder(array(
				'action' => $this->generateUrl('teamraceChallengeSetResults', 
						array('idTeamrace' => $idTeamrace, 'idChallenge' => $idChallenge))));
    	
		$idTeams = array();
    	foreach($teams as $team) {
    		array_push($idTeams, $team->getIdTeam());
    		$builder->add('points_'.$team->getIdTeam(), 'integer', 
    				array('label' => $team->getName(),
    					'attr' => array('min' => 0, 'max' => $challenge->getMaxPoints())));
    	}
    	
    	$builder->add('submit', 'submit');
    	
    	$form = $builder->getForm();
    	
    	$form->handleRequest($request);
    	 
    	if($form->isValid()) {
    		
    		$em = $this->getDoctrine()->getManager();
    		
    		// Delete all Results already set
    		$challengeTeams = $this->getDoctrine()
    			->getRepository('TeamRaceWebBundle:ChallengeTeam')
    			->findBy(array('challenge' => $idChallenge));

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
    					'challenge' => $challenge,
    					'role' => $this->role)
    	);
    }
    
    public function challengeViewResultsAction($idTeamrace, $idChallenge) {
    	
    	$this->initialize($idTeamrace);
    	 
    	$challengeTeams = $this->getDoctrine()
    		->getRepository('TeamRaceWebBundle:ChallengeTeam')
    		->findBy(array('challenge' => $idChallenge));
    	
    	$challenge = $this->getDoctrine()
    		->getRepository('TeamRaceWebBundle:Challenge')
    		->find($idChallenge);
    		
    	return $this->render(
    			'TeamRaceWebBundle:Teamrace:challengeViewResults.html.twig',
    			array(	'teamrace' => $this->teamrace,
    					'challengeTeams' => $challengeTeams,
    					'challenge' => $challenge,
    					'role' => $this->role));
    }
    
    /***** MEMBERS *****/
    
    
    public function membersAction(Request $request, $idTeamrace)
    {
    	$this->initialize($idTeamrace);
    	
    	$members = $this->getDoctrine()
    	->getRepository('TeamRaceWebBundle:UserTeamrace')
    	->findBy(array('teamrace' => $idTeamrace));

    	$teams = $this->getDoctrine()
    	->getRepository('TeamRaceWebBundle:Team')
    	->findBy(array('teamrace' => $idTeamrace));
    	 
    	
    	// FORM add a new member to teamrace
    	
    	$builder = $this->createFormBuilder(
    			array('action' => $this->generateUrl('teamraceMembers', array('idTeamrace' => $idTeamrace))));
    	$builder->add('email', 'email');
    	$builder->add('submit', 'submit');
    	$form = $builder->getForm();
    	
    	if ($this->role == 1) {
    		$form->handleRequest($request);
    		 
    		if($form->isValid()) {
    			
    			$email = $form->getData()['email'];
    			
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
    				$userTeamrace->setRole(3);
    				 
    				$em = $this->getDoctrine()->getManager();
    				$em->persist($userTeamrace);
    				$em->flush();
    			
    			}
    			 
    			// TODO successfull redirect flash
    			$redirectUrl = $this->get('router')->generate('teamraceMembers', array('idTeamrace' => $idTeamrace));
    			return $this->redirect($redirectUrl);

    		}
    	}
    	
    	
    	$content = $this->renderView('TeamRaceWebBundle:Teamrace:members.html.twig',
    			array(	'teamrace' => $this->teamrace,
    					'members' => $members,
    					'teams' => $teams,
    					'form' => $form->createView(),
    					'role' => $this->role));
    	return new Response($content);
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
    			array(	'form' => $form->createView(),
    					'role' => $this->role)
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
    
    	// Fetch all users and the teams they participate in
    	$userAndTeams = $this->getDoctrine()
    		->getRepository('TeamRaceWebBundle:UserTeam')
    		->getUserAndTeams($idTeamrace);

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
    					'teamrace' => $this->teamrace,
    					'role' => $this->role)
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
    					'teamrace' => $this->teamrace,
    					'role' => $this->role)
    	);
    
    }
}
