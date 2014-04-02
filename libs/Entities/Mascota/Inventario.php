<?php

namespace Entities\Mascota;

use Doctrine\ORM\Mapping as ORM;

use Entities\Entity;

/**
 * @ORM\Entity 
 * @ORM\Table("MascotaInventario")
*/

class Inventario extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /**  
    * @ORM\ManyToOne(targetEntity="Mascota", inversedBy="inventario", cascade={"persist"}) 
    */
    protected $mascota;

    /** 
    * @ORM\ManyToOne(targetEntity="Entities\Item\Item", cascade={"persist"}) 
    */  
    protected $item;

    
    /** @ORM\Column(type="integer") */
    protected $cantidad;
    
    // getters/setters
} 