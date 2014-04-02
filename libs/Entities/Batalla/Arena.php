<?php

namespace Entities\Batalla;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Entities\Entity;

 /**
  * @ORM\Entity
  */
class Arena extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /** @ORM\Column(type="string") */
    protected $nombre;

    /** @ORM\Column(type="text") */    
    protected $descripcion;
    
    /** @ORM\Column(type="string") */    
    protected $imagen;
    
    /** 
    * @ORM\ManyToOne(targetEntity="Entities\Region\Region", cascade={"persist"}) 
    */ 
    protected $region;
    
    /**
    * @ORM\ManyToMany(targetEntity="Entities\Usuario\Usuario", cascade={"persist"})
    * @ORM\JoinTable(name="ArenaUsuario",
    *      joinColumns={@ORM\JoinColumn(name="arena_id", referencedColumnName="id")},
    *      inverseJoinColumns={@ORM\JoinColumn(name="usuario_id", referencedColumnName="id")}
    *      )
    */
    protected $usuario;

    /**
    * @ORM\ManyToMany(targetEntity="Batalla", cascade={"persist"})
    * @ORM\JoinTable(name="ArenaBatalla",
    *      joinColumns={@ORM\JoinColumn(name="arena_id", referencedColumnName="id")},
    *      inverseJoinColumns={@ORM\JoinColumn(name="batalla_id", referencedColumnName="id")}
    *      )
    */
    protected $batalla;
    
    
    public function __constructor()
    {

      $this->usuario = new ArrayCollection();
      $this->batalla = new ArrayCollection();

    }    
    
    // getters/setters
} 
 
