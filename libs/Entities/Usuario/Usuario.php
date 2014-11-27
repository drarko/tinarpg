<?php

namespace Entities\Usuario;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Entities\Entity;

/** @ORM\Entity */

class Usuario extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /** 
    * @ORM\OneToMany(targetEntity="UsuarioPerfil", mappedBy="usuario", cascade={"persist"}) 
    */  
    protected $usuario_perfil;

    /** @ORM\Column(type="string") */
    protected $usuario;
    
    /** 
    * @ORM\OneToOne(targetEntity="Entities\Banco\Cuenta", mappedBy="usuario", cascade={"persist"}) 
    */  
    protected $cuenta_bancaria;
    
    /**
    * @ORM\ManyToMany(targetEntity="Entities\Region\Region", cascade={"persist"})
    * @ORM\JoinTable(name="UsuarioRegion",
    *      joinColumns={@ORM\JoinColumn(name="usuario_id", referencedColumnName="id")},
    *      inverseJoinColumns={@ORM\JoinColumn(name="region_id", referencedColumnName="id")}
    *      )
    */
    protected $region;
    
    /** 
    * @ORM\OneToMany(targetEntity="UsuarioCaracteristica", mappedBy="usuario", cascade={"persist"}) 
    */  
    protected $usuario_caracteristica;
    
    /** 
    * @ORM\OneToMany(targetEntity="Entities\Mascota\Mascota", mappedBy="usuario", cascade={"persist"}) 
    */      
    protected $mascota;
    
    /** 
    * @ORM\OneToMany(targetEntity="Inventario", mappedBy="usuario", cascade={"persist"}) 
    */      
    protected $inventario;
    
    /** 
    * ORM\OneToMany(targetEntity="Relacion", mappedBy="usuario_orig", cascade={"persist"}) 
    */      
    //protected $relacion;
    
    public function __constructor()
    {
      $this->mascota = new ArrayCollection();
      $this->usuario_perfil = new ArrayCollection();
      $this->usuario_caracteristica = new ArrayCollection();
      $this->inventario = new ArrayCollection();
      //$this->relacion = new ArrayCollection();
    }
      
    public function getUsername()
    {
      return $this->usuario;     
    }

        
    public function getUsuario()
    {
      return $this->usuario;     
    }
	
    // getters/setters
} 

/*
    public $objetos;
*/