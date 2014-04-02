<?php

namespace Entities\Tienda;

use Doctrine\ORM\Mapping as ORM;

use Entities\Entity;

/**
 * @ORM\Entity 
 * @ORM\Table("TiendaStock")
*/

class Stock extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /**  
    * @ORM\ManyToOne(targetEntity="Tienda", inversedBy="stock", cascade={"persist"}) 
    */
    protected $tienda;

    /** 
    * @ORM\ManyToOne(targetEntity="Entities\Item\Item", cascade={"persist"}) 
    */  
    protected $item;

    
    /** @ORM\Column(type="integer") */
    protected $valor;

    /** @ORM\Column(type="integer") */
    protected $cantidad;
    
    /** 
    * @ORM\OneToMany(targetEntity="Oferta", mappedBy="stock", cascade={"persist"}) 
    */      
    protected $oferta;
    
    /** 
    * @ORM\OneToMany(targetEntity="Subasta", mappedBy="stock", cascade={"persist"}) 
    */      
    protected $subasta;
    
    
    public function __constructor()
    {
      $this->oferta = new ArrayCollection();
      $this->subasta = new ArrayCollection();
    }    
    // getters/setters
} 
