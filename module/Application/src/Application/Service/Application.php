<?php

namespace Application\Service;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Collections\ArrayCollection;

use Service\Entity as EntityService;


class Application extends EntityService
{
	public function saveTweet($status_id,$status)
	{
		$tw = new \Entities\Tweet;
		$tw->tweet_id = $status_id;
		$tw->tweet = $status;
		$tw->estado = "new";
		
		$this->em->persist($tw);
		$this->em->flush();
		
	}
	
	public function getMaxId()
	{
		$res = $this->em->getRepository("Entities\Tweet")->findBy(array(),array('tweet_id' => 'DESC'),1);
		if($res == null) return null;
		return  $res[0]->tweet_id;
	}
	
	public function getNext()
	{
		$res = $this->em->getRepository("Entities\Tweet")->findBy(array("estado" => "new"),array('tweet_id' => 'ASC'),1);
		if($res == null) return null;
		$tweet = $res[0];
		$tweet->estado = "proc";
		
		$this->em->persist($tweet);
		$this->em->flush();
		
		return $tweet;
	}
	
	public function newUser($user,$tweet)
	{
		$u = new \Entities\Usuario\Usuario;
		$u->setUsuario($user);
		$this->em->persist($u);
		
		$s = new \Entities\Usuario\Sesion;
		$s->setProceso("registro");
		$s->setEstado("0");
		$s->setUsuario($u);
		$s->setTweet($tweet);
		$this->em->persist($s);
		
		$this->em->flush();
	}
	
	public function getUser($user)
	{
		return $this->em->getRepository("Entities\Usuario\Usuario")->findOneByUsuario($user);
	}
	
	public function getSession($usuario)
	{
		return $this->em->getRepository("Entities\Usuario\Sesion")->findOneByUsuario($usuario);
	}
	
	public function setSession($usuario,$proceso,$estado,$tweet)
	{
		$tw = new \Entities\Tweet;
		$tw->tweet_id = $tweet->getId();
		$tw->tweet = $tweet;
		$tw->estado = "back";
		
		$this->em->persist($tw);
		$this->em->flush();
		
		$sesion = $this->getSession($usuario);
		$sesion->setProceso($proceso);
		$sesion->setEstado($estado);
		$sesion->setTweet($tw);
		$this->em->persist($sesion);
		$this->em->flush();
	}
	
	public function userExists($user)
	{
		$res = $this->em->getRepository("Entities\Usuario\Usuario")->findOneByUsuario($user);
		if($res != null) return true;
		return false;
	}
	
	public function getRegionByTweet($tweet)
	{
		$valido = 0;
		$regiones = $this->em->getRepository("Entities\Region\Region")->findAll();
		foreach($regiones as $reg){
			if(strpos(strtolower($tweet->getTweet()->getText()),strtolower($reg->getNombre()))!==false)
				return $reg;
		}
		return false;
	}
} 
