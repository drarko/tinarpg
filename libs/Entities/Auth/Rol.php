<?php

namespace Entities\Auth;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Entities\Entity;

/** @ORM\Entity */
class Rol extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;
    
    /**
     * @ORM\OneToMany(targetEntity="Rol", mappedBy="padre", cascade={"persist"})
     */
    protected $subroles;

    /**
     * @ORM\ManyToOne(targetEntity="Rol", inversedBy="subroles", cascade={"persist"})
     */
    protected $padre;
    
    /** @ORM\Column(type="string") */     
    protected $nombre;
    
    public function __constructor()
    {
      $this->subroles = new ArrayCollection();
    } 
    // getters/setters
} 

/*
    public $objetos;
    public $rol;
*/ 
