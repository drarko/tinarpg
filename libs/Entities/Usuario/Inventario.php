<?php

namespace Entities\Usuario;

use Doctrine\ORM\Mapping as ORM;

use Entities\Entity;

/**
 * @ORM\Entity 
 * @ORM\Table("UsuarioInventario")
*/

class Inventario extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /**  
    * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="inventario", cascade={"persist"}) 
    */
    protected $usuario;

    /** 
    * @ORM\ManyToOne(targetEntity="Entities\Item\Item", cascade={"persist"}) 
    */  
    protected $item;

    
    /** @ORM\Column(type="integer") */
    protected $cantidad;
    
    // getters/setters
} 
