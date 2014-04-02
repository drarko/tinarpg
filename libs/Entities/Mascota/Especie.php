<?php

namespace Entities\Mascota;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Entities\Entity;

/** @ORM\Entity */
class Especie extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;
    
    /**
     * @ORM\OneToMany(targetEntity="Especie", mappedBy="padre", cascade={"persist"})
     */
    protected $subespecies;

    /**
     * @ORM\ManyToOne(targetEntity="Especie", inversedBy="subespecies", cascade={"persist"})
     */
    protected $padre;
    
    /**
    * @ORM\ManyToMany(targetEntity="Entities\Region\Region", cascade={"persist"})
    * @ORM\JoinTable(name="EspecieRegion",
    *      joinColumns={@ORM\JoinColumn(name="especie_id", referencedColumnName="id")},
    *      inverseJoinColumns={@ORM\JoinColumn(name="region_id", referencedColumnName="id")}
    *      )
    */
    protected $region;
    
    /** 
    * @ORM\OneToMany(targetEntity="EspecieCaracteristica", mappedBy="especie", cascade={"persist"}) 
    */  
    protected $especie_caracteriscas;
    
    /** @ORM\Column(type="text") */    
    protected $nombre;

    /** @ORM\Column(type="text") */    
    protected $descripcion;
    
    /** @ORM\Column(type="string") */    
    protected $imagen;
    
    public function __constructor()
    {

      $this->subespecies = new ArrayCollection();
      $this->especie_caracteriscas = new ArrayCollection();
      
    } 
    // getters/setters
} 
