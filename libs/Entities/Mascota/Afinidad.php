<?php

namespace Entities\Mascota;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Entities\Entity;

/** @ORM\Entity
  *
*/

class Afinidad extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;
   
    /**
     * @ORM\ManyToOne(targetEntity="Especie", cascade={"persist"})
     */
    protected $especie;    
    
    /** @ORM\Column(type="integer") */    
    protected $valor;
    
    public function __constructor()
    {
      $this->afinidad = new ArrayCollection();
    } 
 
    // getters/setters
} 

/*
    public $objetos;
    public $mascotas;
    public $zona;
    public $rol;
*/ 
