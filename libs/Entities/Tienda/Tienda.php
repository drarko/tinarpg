<?php

namespace Entities\Tienda;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Entities\Entity;

/** @ORM\Entity */

class Tienda extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Tienda", mappedBy="padre", cascade={"persist"})
     */
    protected $sucursales;

    /**
     * @ORM\ManyToOne(targetEntity="Tienda", inversedBy="sucursales", cascade={"persist"})
     */
    protected $padre;

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

    /** 
    * @ORM\ManyToOne(targetEntity="Entities\Region\Region", cascade={"persist"})
    */  
    protected $region;
        
    /** 
    * @ORM\OneToMany(targetEntity="Stock", mappedBy="tienda", cascade={"persist"}) 
    */      
    protected $stock;
    
    public function __constructor()
    {
      $this->sucursales = new ArrayCollection();
      $this->stock = new ArrayCollection();
    }
    
  // getters/setters
} 

