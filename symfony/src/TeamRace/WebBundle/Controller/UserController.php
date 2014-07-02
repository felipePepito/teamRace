<?php

namespace TeamRace\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function homeAction()
    {
    	$content = $this->renderView('TeamRaceWebBundle:User:home.html.twig');
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
    	$content = $this->renderView('TeamRaceWebBundle:User:teamRaces.html.twig');
    	return new Response($content);
    }
    
    public function createTeamRaceAction()
    {
    	$content = $this->renderView('TeamRaceWebBundle:User:createTeamRace.html.twig');
    	return new Response($content);
    }

}
