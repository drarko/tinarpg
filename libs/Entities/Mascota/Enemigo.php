<?php

namespace Entities\Mascota;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Entities\Entity;

/** @ORM\Entity 
*   @ORM\Table("MascotaEnemigo")
*/
class Enemigo extends Entity  {
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

    /** 
    * @ORM\OneToMany(targetEntity="MascotaEstado", mappedBy="mascota", cascade={"persist"}) 
    */  
    protected $mascota_estados;
    
    /** 
    * @ORM\ManyToMany(targetEntity="Entities\Accion", cascade={"persist"})
    * @ORM\JoinTable(name="MascotaEnemigoAccion",
    *      joinColumns={@ORM\JoinColumn(name="enemigo_id", referencedColumnName="id")},
    *      inverseJoinColumns={@ORM\JoinColumn(name="accion_id", referencedColumnName="id")}  
    * )
    */      
    protected $acciones;
    
    public function __constructor()
    {
      $this->mascota_estados = new ArrayCollection();
      $this->acciones = new ArrayCollection();
    } 
    // getters/setters
}

/**
 * @TODO Patrones/Plantillas ... 
 */