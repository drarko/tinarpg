<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Entities\Entity;

/** @ORM\Entity
  * @ORM\Table("CaracteristicaTipo")
  *
*/

class CaracteristicaTipo extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /** 
    * @ORM\Column(type="string")
    */  
    protected $caracteristica;

 
    // getters/setters
} 
