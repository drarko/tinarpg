<?php

namespace Entities\Usuario;

use Doctrine\ORM\Mapping as ORM;

use Entities\Entity;

/** @ORM\Entity */

class PlantillaUsuario extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /** 
    * @ORM\ManyToOne(targetEntity="Entities\CaracteristicaTipo", cascade={"persist"}) 
    */  
    protected $caracteristica;

    
    /** 
    * @ORM\ManyToOne(targetEntity="Entities\Efecto", cascade={"persist"})
    */    
    protected $efecto;

    /** 
    * @ORM\ManyToMany(targetEntity="Entities\Condicion", cascade={"persist"})
    * @ORM\JoinTable(name="PlantillaUsuarioCondicion",
    *      joinColumns={@ORM\JoinColumn(name="plantillausuario_id", referencedColumnName="id")},
    *      inverseJoinColumns={@ORM\JoinColumn(name="condicion_id", referencedColumnName="id")}  
    * )
    */    
    protected $condicion; 
} 
