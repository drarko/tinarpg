<?php

namespace Entities\Usuario;

use Doctrine\ORM\Mapping as ORM;

use Entities\Entity;

/**
 * @ORM\Entity 
 * @ORM\Table("UsuarioRelacion")
*/

class Relacion extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /**  
    * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="relacion", cascade={"persist"}) 
    */
    protected $usuario_orig;

    /** 
    * @ORM\ManyToOne(targetEntity="Usuario", cascade={"persist"}) 
    */  
    protected $usuario_dest;

    
    /** 
    * @ORM\ManyToOne(targetEntity="RelacionTipo", cascade={"persist"}) 
    */  
    protected $tipo;
    
    // getters/setters
} 
