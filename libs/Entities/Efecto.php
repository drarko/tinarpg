<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Entities\Entity;

/** @ORM\Entity */

class Efecto extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /** 
    * @ORM\ManyToOne(targetEntity="EfectoTipo", cascade={"persist"}) 
    */  
    protected $tipo;
    
    /** 
    * @ORM\ManyToOne(targetEntity="CaracteristicaTipo", cascade={"persist"}) 
    */  
    protected $caracteristica;
    
    /** @ORM\Column(type="integer") */
    protected $valor;
    
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
