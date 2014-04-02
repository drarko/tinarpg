<?php

namespace Entities\Casa;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Entities\Entity;

/** @ORM\Entity */

class Casa extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;
    
    /** 
    * @ORM\ManyToOne(targetEntity="Entities\Region\Region", cascade={"persist"})
    */  
    protected $region;
    
    /** 
    * @ORM\ManyToOne(targetEntity="Entities\Usuario\Usuario", cascade={"persist"})
    */  
    protected $usuario;
    
    /** @ORM\Column(type="integer") */    
    protected $valor;

    /** 
    * @ORM\OneToMany(targetEntity="Inventario", mappedBy="casa", cascade={"persist"}) 
    */      
    protected $inventario;
    
    /** @ORM\Column(type="integer") */    
    protected $item_max;

    /** @ORM\Column(type="integer") */    
    protected $mascota_max;
    
    /**
    * @ORM\ManyToMany(targetEntity="Entities\Mascota\Mascota", cascade={"persist"})
    * @ORM\JoinTable(name="CasaMascota",
    *      joinColumns={@ORM\JoinColumn(name="casa_id", referencedColumnName="id")},
    *      inverseJoinColumns={@ORM\JoinColumn(name="mascota_id", referencedColumnName="id")}
    *      )
    */
    protected $mascota;
    
    public function __constructor()
    {
      $this->inventario = new ArrayCollection();
    } 
    // getters/setters
} 
