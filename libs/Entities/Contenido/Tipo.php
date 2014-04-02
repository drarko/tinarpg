<?php

namespace Entities\Contenido;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Entities\Entity;

/** @ORM\Entity
  * @ORM\Table("ContenidoTipo")
  *
*/

class Tipo extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /** 
    * @ORM\Column(type="string")
    */  
    protected $tipo;

 
    // getters/setters
} 

/*
    public $objetos;
    public $mascotas;
    public $zona;
    public $rol;
*/ 
