<?php

namespace Entities\Casa;

use Doctrine\ORM\Mapping as ORM;

use Entities\Entity;

/**
 * @ORM\Entity 
 * @ORM\Table("CasaInventario")
*/

class Inventario extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /**  
    * @ORM\ManyToOne(targetEntity="Casa", inversedBy="inventario", cascade={"persist"}) 
    */
    protected $casa;

    /** 
    * @ORM\ManyToOne(targetEntity="Entities\Item\Item", cascade={"persist"}) 
    */  
    protected $item;

    
    /** @ORM\Column(type="integer") */
    protected $cantidad;
    
    // getters/setters
} 
