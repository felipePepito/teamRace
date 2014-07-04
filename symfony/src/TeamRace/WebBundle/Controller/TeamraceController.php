<?php

namespace TeamRace\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use TeamRace\WebBundle\Entity\Teamrace;
use TeamRace\WebBundle\Entity\UserTeamrace;
use TeamRace\WebBundle\Form\Type\CreateTeamRaceType;

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
    
}
