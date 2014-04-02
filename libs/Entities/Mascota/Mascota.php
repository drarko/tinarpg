<?php

namespace Entities\Mascota;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Entities\Entity;

/** @ORM\Entity */
class Mascota extends Entity  {
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
    * @ORM\ManyToOne(targetEntity="Entities\Usuario\Usuario", inversedBy="mascota", cascade={"persist"}) 
    */    
    protected $usuario;

    /** @ORM\Column(type="string") */     
    protected $nombre;

    /** 
    * @ORM\OneToMany(targetEntity="MascotaEstado", mappedBy="mascota", cascade={"persist"}) 
    */  
    protected $mascota_estados;
    
    /** 
    * @ORM\OneToMany(targetEntity="Inventario", mappedBy="mascota", cascade={"persist"}) 
    */      
    protected $inventario;
    
    /** 
    * @ORM\ManyToMany(targetEntity="Entities\Accion", cascade={"persist"})
    * @ORM\JoinTable(name="MascotaAccion",
    *      joinColumns={@ORM\JoinColumn(name="mascota_id", referencedColumnName="id")},
    *      inverseJoinColumns={@ORM\JoinColumn(name="accion_id", referencedColumnName="id")}  
    * )
    */      
    protected $acciones;
    
    public function __constructor()
    {
      $this->mascota_estados = new ArrayCollection();
      $this->inventario = new ArrayCollection();
      $this->acciones = new ArrayCollection();
    } 
    // getters/setters
}

/**
 * @TODO Patrones/Plantillas ... 
 */