<?php

namespace Entities\Batalla;

use Doctrine\ORM\Mapping as ORM;

use Entities\Entity;

/** @ORM\Entity */

class BatallaEnemigo extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /**  
    * @ORM\ManyToOne(targetEntity="Batalla", inversedBy="enemigo", cascade={"persist"}) 
    */
    protected $batalla;

    /**  
    * @ORM\ManyToOne(targetEntity="Entities\Mascota\Enemigo", cascade={"persist"}) 
    */
    protected $enemigo;
    
    // getters/setters
} 
 
 
 
