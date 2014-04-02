<?php

namespace Entities\Region;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Entities\Entity;

/** @ORM\Entity */

class Transporte extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Region", inversedBy="transporte", cascade={"persist"})
     */
    protected $region;

    /** @ORM\Column(type="string") */
    protected $nombre;

    /** @ORM\Column(type="text") */    
    protected $descripcion;
    
    /** @ORM\Column(type="string") */    
    protected $imagen;
    
    /** 
    * @ORM\ManyToOne(targetEntity="Entities\Banco\Banco", cascade={"persist"})
    */  
    protected $banco;
    
    /** @ORM\Column(type="integer") */    
    protected $costo;

    /** @ORM\Column(type="integer") */    
    protected $tiempo;

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
