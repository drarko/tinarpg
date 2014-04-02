<?php

namespace Entities\Banco;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Entities\Entity;

/** @ORM\Entity */

class Banco extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Banco", mappedBy="padre", cascade={"persist"})
     */
    protected $sucursales;

    /**
     * @ORM\ManyToOne(targetEntity="Banco", inversedBy="sucursales", cascade={"persist"})
     */
    protected $padre;

    /** 
    * @ORM\ManyToOne(targetEntity="Entities\Region\Region", cascade={"persist"}) 
    */ 
    protected $region;
    
    /** @ORM\Column(type="string") */
    protected $nombre;

    /** @ORM\Column(type="text") */    
    protected $descripcion;
    
    /** 
    * @ORM\ManyToOne(targetEntity="Moneda", cascade={"persist"}) 
    */  
    protected $moneda;
    
    /** @ORM\Column(type="integer") */    
    protected $reservas;
    
    /** 
    * @ORM\OneToMany(targetEntity="Cambio", mappedBy="banco", cascade={"persist"}) 
    */      
    protected $tipo_cambio;
    
    public function __constructor()
    {
      $this->tipo_cambio = new ArrayCollection();
      $this->sucursales = new ArrayCollection();
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
