<?php

namespace TeamRace\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class MainController extends Controller {
	
	public function indexAction() {
		$content = $this->renderView('TeamRaceWebBundle:Main:index.html.twig');
		return new Response($content);
	}
	
	public function aboutAction() {
		$content = $this->renderView('TeamRaceWebBundle:Main:about.html.twig');
		return new Response($content);
	}
	
	public function loginAction(Request $request) {
		
		$session = $request->getSession();
		
		if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
		
		$content = $this->renderView('TeamRaceWebBundle:Main:login.html.twig');
		return new Response($content);
	}
	
	public function registerAction() {
		$content = $this->renderView('TeamRaceWebBundle:Main:register.html.twig');
		return new Response($content);
	}
	
}
