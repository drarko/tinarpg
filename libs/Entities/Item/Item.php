<?php

namespace Entities\Item;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Entities\Entity;

/** @ORM\Entity */

class Item extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /** 
    * @ORM\ManyToOne(targetEntity="Tipo", cascade={"persist"}) 
    */  
    protected $tipo;
    
    /** 
    * @ORM\ManyToMany(targetEntity="Entities\Efecto", cascade={"persist"})
    * @ORM\JoinTable(name="ItemEfecto",
    *      joinColumns={@ORM\JoinColumn(name="item_id", referencedColumnName="id")},
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
