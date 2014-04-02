<?php

namespace Entities\Banco;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Entities\Entity;

/** @ORM\Entity */

class Moneda extends Entity  {
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
    protected $simbolo;
    
    /** @ORM\Column(type="string") */    
    protected $imagen;    
    
//     public function __constructor()
//     {
//       $this->usuario_perfil = new ArrayCollection();
//     }
    public function __get($property)
    {
        // If a method exists to get the property call it.
        if(method_exists($this, 'get' . ucfirst($property)))
        {
            // This will call $this->getCoffee() while getting $this->coffee
            return call_user_func(array($this, 'get' . ucfirst($property)));
        }
        else
        {
            return $this->$property;
        }
    }
    
    public function __set($property, $value)
    {
        // If a method exists to set the property call it.
        if(method_exists($this, 'set' . ucfirst($property)))
        {
            // This will call $this->setCoffee($value) while setting $this->coffee
            return call_user_func(array($this, 'set' . ucfirst($property)), $value);
        }
        else
        {
            $this->$property = $value;
        }
    }
} 

/*
    public $cuenta;
    public $objetos;
    public $mascotas;
    public $region;
    public $zona;
    public $rol;
*/ 
