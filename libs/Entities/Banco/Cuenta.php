<?php

namespace Entities\Banco;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Entities\Entity;

/** @ORM\Entity */

class Cuenta extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /** 
    * @ORM\ManyToOne(targetEntity="Banco", cascade={"persist"})
    * @ORM\JoinColumn(name="banco_id", referencedColumnName="id")
    */  
    protected $banco;

    /** 
    * @ORM\OneToOne(targetEntity="Entities\Usuario\Usuario", inversedBy="cuenta_bancaria", cascade={"persist"}) 
    */  
    protected $usuario;
    
    /** @ORM\Column(type="integer") */    
    protected $saldo;
 
    public function __constructor()
    {

    }
    
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
