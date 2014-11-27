<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use ZendService\Twitter\Twitter;
use Controller\ControllerPublic;

class RegistroController extends ControllerPublic
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
		
		if($sesion->getEstado() == 0) {
			$this->iniciarRegistro($usuario,$tweet,$sesion);
		}
		if($sesion->getEstado() == 1) {
			$this->mapaRegiones($usuario,$tweet,$sesion);
		}

	}
	
	public function iniciarRegistro($usuario,$tweet,$sesion)
	{
		$user = $usuario->getUsuario();
		$text = 'Hola @'.$user.'! Bienvenido a Mi Tamagochi, para empezar a jugar, por favor responde este tuit con "Comenzar"';
		$reply = $tweet->tweet_id;
		
		$res = $this->twitter->postUpdate($text,$reply);
		$this->service->setSession($usuario,"registro",1,$res);
	}
	
	public function mapaRegiones($usuario,$tweet,$sesion)
	{
		if($tweet->getTweet()->getInReplyToStatusId() == $sesion->getTweet()->getTweet()->getId()) {
			if(strpos(strtolower($tweet->getTweet()->getText()),"comenzar") !== FALSE) {
				$user = $usuario->getUsuario();
				$text = 'Bienvenido @'.$user.' a Danador un mundo lleno de aventuras. A continuación te mostramos un mapa del mismo:';
				$reply = $tweet->tweet_id;
				$media_post = $this->twitter->uploadImg("public/mapa2.png");
				$media = $media_post["media_id"];
				$res = $this->twitter->postUpdate($text,$reply,$media);
				
				$text = 'Primero debes elegir una región. Puedes obtener información de cada una respondiendo "Info <nombre de región>" // @'.$user;
				$reply = $res->getId();
				$res = $this->twitter->postUpdate($text,$reply);
				
				$text = 'Cuando hayas decidido, responde con "Elegir región" y te diremos los pasos a seguir // @'.$user;
				$reply = $res->getId();
				$res = $this->twitter->postUpdate($text,$reply);
				$this->service->setSession($usuario,"elegir_region",0,$res);				
				
			} else {
				$user = $usuario->getUsuario();
				$text = 'Hola @'.$user.'! No entendimos tu respuesta. Para comenzar a jugar, por favor responde este tuit con "Comenzar" - id:' . time();
				$reply = $tweet->tweet_id;
				
				$res = $this->twitter->postUpdate($text,$reply);
				$this->service->setSession($usuario,"registro",1,$res);				
			}
		} else {
			throw new Exception("Error, respuesta no esperada");
		}
	}
}