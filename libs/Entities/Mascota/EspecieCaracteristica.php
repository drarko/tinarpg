<?php

namespace Entities\Mascota;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Entities\Entity;

/** 
 * @ORM\Entity 
*/
class EspecieCaracteristica extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /**  
    * @ORM\ManyToOne(targetEntity="Especie", inversedBy="especie_caracteriscas", cascade={"persist"}) 
    */
    protected $especie;
    
    /** 
    * @ORM\ManyToOne(targetEntity="Entities\CaracteristicaTipo", cascade={"persist"}) 
    */  
    protected $caracteristica;

    /** @ORM\Column(type="text") */
    protected $valor;
    
    // getters/setters
} 
