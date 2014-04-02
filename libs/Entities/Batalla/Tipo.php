<?php

namespace Entities\Batalla;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Entities\Entity;

/** @ORM\Entity
  * @ORM\Table("BatallaTipo")
  *
*/

class Tipo extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /** @ORM\Column(type="string") */
    protected $tipo;
    
    public function __constructor()
    {
 
    } 
 
    // getters/setters
} 

/*
    public $objetos;
    public $mascotas;
    public $zona;
    public $rol;
*/ 
