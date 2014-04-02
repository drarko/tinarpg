<?php

namespace Entities\Contenido;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Entities\Entity;

/** @ORM\Entity */
class Contenido extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Contenido", mappedBy="padre", cascade={"persist"})
     */
    protected $subcontenidos;

    /**
     * @ORM\ManyToOne(targetEntity="Contenido", inversedBy="subcontenidos", cascade={"persist"})
     */
    protected $padre;

    /** 
    * @ORM\ManyToOne(targetEntity="Tipo", cascade={"persist"}) 
    */  
    protected $tipo;

    /** 
    * @ORM\ManyToOne(targetEntity="Entities\Usuario\Usuario", cascade={"persist"}) 
    */      
    protected $usuario;

    /** @ORM\Column(type="datetime") */    
    protected $fecha;

    /** @ORM\Column(type="string") */    
    protected $titulo;
    
    /** @ORM\Column(type="text") */
    protected $resumen;
    
    /** @ORM\Column(type="text") */    
    protected $contenido;
 
    public function __constructor()
    {
      $this->subcontenidos = new ArrayCollection();
    } 
    // getters/setters
} 

/*
    public $objetos;
    public $mascotas;
    public $zona;
    public $rol;
*/ 
