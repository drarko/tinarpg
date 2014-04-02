<?php

namespace Entities\Region;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Entities\Entity;

/** @ORM\Entity */

class Region extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Region", mappedBy="padre", cascade={"persist"})
     */
    protected $subregiones;

    /**
     * @ORM\ManyToOne(targetEntity="Region", inversedBy="subregiones", cascade={"persist"})
     */
    protected $padre;

    /** @ORM\Column(type="string") */
    protected $nombre;

    /** @ORM\Column(type="text") */    
    protected $descripcion;
    
    /** @ORM\Column(type="string") */    
    protected $imagen;
    
    /**
     * @ORM\OneToMany(targetEntity="Transporte", mappedBy="region", cascade={"persist"})
     */
    protected $transporte;
    
    public function __constructor()
    {
      $this->subregiones = new ArrayCollection();
      $this->transporte = new ArrayCollection();
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
