<?php

namespace Entities\Batalla;

use Doctrine\ORM\Mapping as ORM;

use Entities\Entity;

/** @ORM\Entity */

class BatallaCaracteristica extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /**  
    * @ORM\ManyToOne(targetEntity="Batalla", inversedBy="caracteristica", cascade={"persist"}) 
    */
    protected $batalla;

    /** 
    * @ORM\ManyToOne(targetEntity="Entities\CaracteristicaTipo", cascade={"persist"}) 
    */  
    protected $caracteristica;
   
    /** @ORM\Column(type="text") */
    protected $valor;
    
    // getters/setters
} 
 
