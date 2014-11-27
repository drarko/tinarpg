<?php

namespace Entities\Usuario;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Entities\Entity;

/** @ORM\Entity */

class Sesion extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /** 
    * @ORM\OneToOne(targetEntity="Usuario", cascade={"persist"}) 
	* @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
    */  
    protected $usuario;

	/** @ORM\Column(type="string") */
	protected $proceso;
	
	/** @ORM\Column(type="string") */
	protected $estado;

    /** 
    * @ORM\OneToOne(targetEntity="Entities\Tweet", cascade={"persist"}) 
	* @ORM\JoinColumn(name="tweet_id", referencedColumnName="id")
    */  
    protected $tweet;

    
    public function __constructor()
    {

    }
    // getters/setters
} 

/*
    public $objetos;
*/