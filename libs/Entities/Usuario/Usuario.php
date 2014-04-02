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

    /** @ORM\Column(type="string") */
    protected $clave;
    
    /** @ORM\Column(type="string") */
    protected $email;
    
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
    * @ORM\ManyToMany(targetEntity="Entities\Auth\Rol", cascade={"persist"})
    * @ORM\JoinTable(name="UsuarioRol",
    *      joinColumns={@ORM\JoinColumn(name="usuario_id", referencedColumnName="id")},
    *      inverseJoinColumns={@ORM\JoinColumn(name="rol_id", referencedColumnName="id")}
    *      )
    */
    protected $rol;
    
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
    * @ORM\OneToMany(targetEntity="Relacion", mappedBy="usuario_orig", cascade={"persist"}) 
    */      
    protected $relacion;
    
    public function __constructor()
    {
      $this->mascota = new ArrayCollection();
      $this->usuario_perfil = new ArrayCollection();
      $this->usuario_caracteristica = new ArrayCollection();
      $this->inventario = new ArrayCollection();
      $this->rol = new ArrayCollection();
      $this->relacion = new ArrayCollection();
    }
      
    public function getUsername()
    {
      return $this->usuario;     
    }

    public function getPassword()
    {
      return $this->clave;
    }    
    
    public function getUsuario()
    {
      return $this->usuario;     
    }

    public function getClave()
    {
      return $this->clave;
    }    
    
    public function getEmail()
    {
      return $this->email;
    }
    
    public function setEmail($email)
    {
      $this->email = $email;
    }
 
    // getters/setters
} 

/*
    public $objetos;
*/