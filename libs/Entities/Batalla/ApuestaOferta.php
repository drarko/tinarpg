<?php

namespace Entities\Batalla;

use Doctrine\ORM\Mapping as ORM;

use Entities\Entity;

/** @ORM\Entity */

class ApuestaOferta extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /**  
    * @ORM\ManyToOne(targetEntity="Apuesta", inversedBy="oferta", cascade={"persist"}) 
    */
    protected $apuesta;

    /** 
    * @ORM\OneToOne(targetEntity="Entities\Usuario\Usuario", cascade={"persist"}) 
    */  
    protected $usuario;
       
    /** 
    * @ORM\OneToOne(targetEntity="BatallaContrincante", cascade={"persist"}) 
    */  
    protected $contrincante;

    /** @ORM\Column(type="integer") */
    protected $valor;
    
    // getters/setters
} 
 
