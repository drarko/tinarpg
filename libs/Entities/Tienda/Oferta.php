<?php

namespace Entities\Tienda;

use Doctrine\ORM\Mapping as ORM;

use Entities\Entity;

/**
 * @ORM\Entity 
 * @ORM\Table("TiendaStockOferta")
*/

class Oferta extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /**  
    * @ORM\ManyToOne(targetEntity="Stock", inversedBy="oferta", cascade={"persist"}) 
    */
    protected $stock;
    
    /** @ORM\Column(type="integer") */
    protected $descuento;

    /** @ORM\Column(type="datetime") */
    protected $inicio;
    
    /** @ORM\Column(type="datetime") */
    protected $fin;
    
    // getters/setters
} 
