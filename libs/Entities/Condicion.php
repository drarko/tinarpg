<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Entities\Entity;

/** @ORM\Entity
  * @ORM\Table("PlantillaCondicion")
  *
*/

class Condicion extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /** 
    * @ORM\ManyToOne(targetEntity="Entities\CaracteristicaTipo", cascade={"persist"}) 
    */ 
    protected $caracteristica;

    /** 
    * @ORM\Column(type="integer")
    */  
    protected $valor;

 
    // getters/setters
} 
