<?php

namespace Entities\Batalla;

use Doctrine\ORM\Mapping as ORM;

use Entities\Entity;

/** @ORM\Entity */

class BatallaContrincante extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /**  
    * @ORM\ManyToOne(targetEntity="Batalla", inversedBy="contrincante", cascade={"persist"}) 
    */
    protected $batalla;

    /**  
    * @ORM\ManyToOne(targetEntity="Entities\Usuario\Usuario", cascade={"persist"}) 
    */
    protected $usuario;

    /**  
    * @ORM\ManyToOne(targetEntity="Entities\Mascota\Mascota", cascade={"persist"}) 
    */
    protected $mascota;    
    
    // getters/setters
} 
 
 
