<?php

namespace Entities\Tienda;

use Doctrine\ORM\Mapping as ORM;

use Entities\Entity;

/**
 * @ORM\Entity 
 * @ORM\Table("TiendaStockSubastaOferta")
*/

class SubastaOferta extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /**  
    * @ORM\ManyToOne(targetEntity="Subasta", inversedBy="subasta_oferta", cascade={"persist"}) 
    */
    protected $subasta;

    /**  
    * @ORM\ManyToOne(targetEntity="Entities\Usuario\Usuario", cascade={"persist"}) 
    */
    protected $usuario;
    
    /** @ORM\Column(type="integer") */
    protected $valor;
    

    public function __constructor()
    {
    }
    // getters/setters
} 
