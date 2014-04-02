<?php

namespace Entities\Banco;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Entities\Entity;

/** @ORM\Entity */

class Cambio extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /** 
    * @ORM\ManyToOne(targetEntity="Banco", inversedBy="tipo_cambio", cascade={"persist"}) 
    */  
    protected $banco;
  
    /** 
    * @ORM\ManyToOne(targetEntity="Moneda", cascade={"persist"}) 
    */  
    protected $moneda;
    
    /** @ORM\Column(type="integer") */    
    protected $valor;
    
//     public function __constructor()
//     {
//       $this->usuario_perfil = new ArrayCollection();
//     }
    // getters/setters
} 

/*
    public $cuenta;
    public $objetos;
    public $mascotas;
    public $region;
    public $zona;
    public $rol;
*/ 
