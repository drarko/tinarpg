<?php

namespace Entities\Batalla;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Entities\Entity;

 /**
  * @ORM\Entity
  */
class Batalla extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /** 
    * @ORM\ManyToOne(targetEntity="Tipo", cascade={"persist"}) 
    */  
    protected $tipo;
    
    /**  
    * @ORM\OneToMany(targetEntity="BatallaCaracteristica", mappedBy="batalla", cascade={"persist"}) 
    */
    protected $caracteristica;

    /**  
    * @ORM\OneToMany(targetEntity="BatallaContrincante", mappedBy="batalla", cascade={"persist"}) 
    */
    protected $contrincante;
    
    /**  
    * @ORM\OneToMany(targetEntity="BatallaEnemigo", mappedBy="batalla", cascade={"persist"}) 
    */
    protected $enemigo;
    
    /**
    * @ORM\OneToOne(targetEntity="Apuesta", mappedBy="batalla", cascade={"persist"})
    */
    protected $apuesta;
    
    public function __constructor()
    {

      $this->caracteristica = new ArrayCollection();
      $this->contrincante = new ArrayCollection();
      $this->enemigo = new ArrayCollection();      

    }    
    
    // getters/setters
} 
 
