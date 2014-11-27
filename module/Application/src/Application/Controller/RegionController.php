<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use ZendService\Twitter\Twitter;
use Controller\ControllerPublic;

class RegionController extends ControllerPublic
{
	protected $twitter;
	
	public function init()
	{
		parent::init();
		$config = $this->getServiceLocator()->get('Config');
		$this->twitter = new \League\Twitter\Api(
			$config['twitter']['oauth_options']['consumerKey'],
			$config['twitter']['oauth_options']['consumerSecret'],
			$config['twitter']['access_token']['token'],
			$config['twitter']['access_token']['secret']
		);			
	}
	
	public function processAction()
	{
		$usuario = $this->params('usuario');
		$tweet = $this->params('tweet');
		$sesion = $this->service->getSession($usuario);
		
		if(strpos(strtolower($tweet->getTweet()->getText()),"info") !== FALSE) {
			$this->infoRegion($usuario,$tweet,$sesion);
		}
		else if(strpos(strtolower($tweet->getTweet()->getText()),"elegir") !== FALSE) {
			$this->elegirRegion($usuario,$tweet,$sesion);
		} else {
			$user = $usuario->getUsuario();
			$text = 'Hola @'.$user.'! No entendimos tu respuesta. Intenta nuevamente.';
			$reply = $tweet->tweet_id;
			
			$res = $this->twitter->postUpdate($text,$reply);
			$this->service->setSession($usuario,"elegir_region",0,$res);			
		}

	}
	
	public function infoRegion($usuario,$tweet,$sesion)
	{
		$user = $usuario->getUsuario();
		$region = $this->service->getRegionByTweet($tweet);
		if($region) {
			foreach(explode(".",$region->getDescripcion()) as $text) {
				$reply = $tweet->tweet_id;
				$text = $text . "// @" . $user;// . " -id" . time();
				$res = $this->twitter->postUpdate($text,$reply);
			}
			
			$text = 'Puedes obtener información de cada región respondiendo "Info <nombre de región>" // @'.$user . " -id" . time();
			$reply = $res->getId();
			$media_post = $this->twitter->uploadImg("public/mapa2.png");
			$media = $media_post["media_id"];
			$res = $this->twitter->postUpdate($text,$reply,$media);
			
			$text = 'Cuando hayas decidido, responde con "Elegir región" y te diremos los pasos a seguir // @'.$user . " -id" . time();
			$reply = $res->getId();
			$res = $this->twitter->postUpdate($text,$reply);
			
			$this->service->setSession($usuario,"elegir_region",0,$res);				
		} else {
			$user = $usuario->getUsuario();
			$text = 'Hola @'.$user.'! No entendimos tu respuesta. Intenta nuevamente. -id' . time();
			$reply = $tweet->tweet_id;
			
			$res = $this->twitter->postUpdate($text,$reply);
		}
		$this->service->setSession($usuario,"elegir_region",0,$res);
	}
}