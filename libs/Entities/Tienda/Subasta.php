<?php

namespace Entities\Tienda;

use Doctrine\ORM\Mapping as ORM;

use Entities\Entity;

/**
 * @ORM\Entity 
 * @ORM\Table("TiendaStockSubasta")
*/

class Subasta extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /**  
    * @ORM\ManyToOne(targetEntity="Stock", inversedBy="subasta", cascade={"persist"}) 
    */
    protected $stock;

    /** @ORM\Column(type="datetime") */
    protected $inicio;
    
    /** @ORM\Column(type="datetime") */
    protected $fin;
   
    /** 
    * @ORM\OneToMany(targetEntity="SubastaOferta", mappedBy="subasta", cascade={"persist"}) 
    */      
    protected $subasta_oferta;

    public function __constructor()
    {
      $this->subasta_oferta = new ArrayCollection();
    }
    // getters/setters
} 
