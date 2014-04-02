<?php

namespace Entities\Casa;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Entities\Entity;

/** @ORM\Entity 
*   @ORM\Table("CasaModelo")
*/
class Modelo extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;
    
    /**
    * @ORM\ManyToMany(targetEntity="Entities\Region\Region", cascade={"persist"})
    * @ORM\JoinTable(name="CasaModeloRegionRegion",
    *      joinColumns={@ORM\JoinColumn(name="casamodelo_id", referencedColumnName="id")},
    *      inverseJoinColumns={@ORM\JoinColumn(name="region_id", referencedColumnName="id")}
    *      )
    */
    protected $region;
    
    /** 
    * @ORM\ManyToOne(targetEntity="Entities\Banco\Banco", cascade={"persist"})
    */  
    protected $banco;
    
    /** @ORM\Column(type="integer") */    
    protected $valor;
    
    /** @ORM\Column(type="text") */    
    protected $nombre;

    /** @ORM\Column(type="text") */    
    protected $descripcion;
    
    /** @ORM\Column(type="string") */    
    protected $imagen;
    
    public function __constructor()
    {

    } 
    // getters/setters
} 
