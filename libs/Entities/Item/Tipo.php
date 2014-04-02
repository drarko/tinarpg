<?php

namespace Entities\Item;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Entities\Entity;

/** @ORM\Entity
  * @ORM\Table("ItemTipo")
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

    /** 
    * @ORM\ManyToMany(targetEntity="Entities\Mascota\Afinidad", cascade={"persist"})
    * @ORM\JoinTable(name="ItemTipoAfinidad",
    *      joinColumns={@ORM\JoinColumn(name="itemtipo_id", referencedColumnName="id")},
    *      inverseJoinColumns={@ORM\JoinColumn(name="afinidad_id", referencedColumnName="id")}  
    * )
    */        
    protected $afinidad;  
    
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
