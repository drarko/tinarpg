<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Entities\Entity;

/** @ORM\Entity */

class Accion extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /** 
    * @ORM\ManyToOne(targetEntity="AccionTipo", cascade={"persist"}) 
    */  
    protected $tipo;
    
    /** 
    * @ORM\ManyToMany(targetEntity="Efecto", cascade={"persist"})
    * @ORM\JoinTable(name="AccionEfecto",
    *      joinColumns={@ORM\JoinColumn(name="accion_id", referencedColumnName="id")},
    *      inverseJoinColumns={@ORM\JoinColumn(name="efecto_id", referencedColumnName="id")}  
    * )
    */    
    protected $efecto;   
    
    /** @ORM\Column(type="string") */
    protected $nombre;
    
    /** @ORM\Column(type="text") */    
    protected $descripcion;
    
    /** @ORM\Column(type="string") */    
    protected $imagen;
    
    public function __constructor()
    {
      $this->efecto = new ArrayCollection();
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
