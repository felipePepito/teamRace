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

}
