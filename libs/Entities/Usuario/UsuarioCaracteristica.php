<?php

namespace Entities\Usuario;

use Doctrine\ORM\Mapping as ORM;

use Entities\Entity;

/** @ORM\Entity @ORM\HasLifecycleCallbacks */

class UsuarioCaracteristica extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /**  
    * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="usuario_caracteristica", cascade={"persist"}) 
    */
    protected $usuario;

    /** 
    * @ORM\ManyToOne(targetEntity="Entities\CaracteristicaTipo", cascade={"persist"}) 
    */  
    protected $caracteristica;

    
    /** @ORM\Column(type="text") */
    protected $valor;


    // getters/setters
} 
