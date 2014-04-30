<?php

namespace TeamRace\ExternalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class MainController extends Controller {
	
	public function indexAction() {
		$content = $this->renderView('TeamRaceExternalBundle:Main:index.html.php');
		return new Response($content);
	}
	
	public function aboutAction() {
		$content = $this->renderView('TeamRaceExternalBundle:Main:about.html.php');
		return new Response($content);
	}
	
	public function loginAction() {
		$content = $this->renderView('TeamRaceExternalBundle:Main:login.html.php');
		return new Response($content);
	}
	
	public function registerAction() {
		$content = $this->renderView('TeamRaceExternalBundle:Main:register.html.php');
		return new Response($content);
	}
	
}
