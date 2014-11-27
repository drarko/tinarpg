<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use ZendService\Twitter\Twitter;
use Controller\ControllerPublic;

class IndexController extends ControllerPublic
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
	
    public function indexAction()
    {
	

    }
	
	public function runAction()
	{
		$since_id = $this->service->getMaxId();
		
		$res = $this->twitter->getMentions(200, $since_id);
		foreach($res as $status) {
			$this->service->saveTweet($status->getId(),$status);
		}
	}
	
	public function processAction()
	{
		$tweet = $this->service->getNext();
		if($tweet == null) return;
		
		$user = $tweet->tweet->getUser()['screen_name'];
		if(!$this->service->userExists($user)) {
			$this->service->newUser($user,$tweet);		
		}
		
		$usuario = $this->service->getUser($user);
		$sesion = $this->service->getSession($usuario);

		$proc = $sesion->getProceso();
		if($proc == "registro") {
			$this->forward()->dispatch('Application\Controller\Registro', array(
				'action' => 'process',
				'usuario' => $usuario,
				'tweet' => $tweet
			));
		}
		if($proc == "elegir_region") {
			$this->forward()->dispatch('Application\Controller\Region', array(
				'action' => 'process',
				'usuario' => $usuario,
				'tweet' => $tweet
			));
		}		
	}
}
