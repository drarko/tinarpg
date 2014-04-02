<?php

namespace Entities\Usuario;

use Doctrine\ORM\Mapping as ORM;

use Entities\Entity;

/**
 * @ORM\Entity 
 * @ORM\Table("UsuarioRelacionTipo")
*/

class RelacionTipo extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;
    
    /** @ORM\Column(type="string") */
    protected $tipo;
    
    // getters/setters
} 
