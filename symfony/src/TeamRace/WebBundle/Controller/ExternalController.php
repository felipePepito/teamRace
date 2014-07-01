<?php

namespace TeamRace\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class ExternalController extends Controller {

	public function indexAction() {
		$content = $this->renderView('TeamRaceWebBundle:External:index.html.twig');
		return new Response($content);
	}

	public function aboutAction() {
		$content = $this->renderView('TeamRaceWebBundle:External:about.html.twig');
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

		$content = $this->renderView('TeamRaceWebBundle:External:login.html.twig', array(
			// last username entered by the user
			'last_username' => $session->get(SecurityContext::LAST_USERNAME),
			'error'         => $error,
		));
		return new Response($content);
	}

	public function registerAction() {
		$content = $this->renderView('TeamRaceWebBundle:External:register.html.twig');
		return new Response($content);
	}
	
	public function languageSwitchAction($locale) {
		
		
		$request = $this->getRequest();
		$referer = $request->headers->get('referer'); 
		$languages = array("/\/de\//", "/\/en\//");
		
		$redirect = preg_replace($languages, "/".$locale."/", $referer);
		
		return $this->redirect($redirect);
		
	}
	

}