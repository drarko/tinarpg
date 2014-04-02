<?php

namespace Entities\Batalla;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Entities\Entity;

 /**
  * @ORM\Entity
  */
class Apuesta extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /** 
    * @ORM\Column(type="integer")
    */  
    protected $pozo;
    
    /**
    * @ORM\ManyToOne(targetEntity="DesafioEstado", cascade={"persist"})
    */
    protected $estado;
    
    /**
    * @ORM\OneToOne(targetEntity="Batalla", inversedBy="apuesta", cascade={"persist"})
    */
    protected $batalla;
    
    /** 
    * @ORM\OneToMany(targetEntity="ApuestaOferta", mappedBy="apuesta", cascade={"persist"}) 
    */      
    protected $oferta;
        
    public function __constructor()
    {
      $this->oferta = new ArrayCollection();
    }    
    
    // getters/setters
} 

