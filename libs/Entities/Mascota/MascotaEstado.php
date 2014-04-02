<?php

namespace Entities\Mascota;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Entities\Entity;

/** 
 * @ORM\Entity 
 * @ORM\HasLifecycleCallbacks 
 * @ORM\Table("MascotaEstado")
*/
class MascotaEstado extends Entity  {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /**  
    * @ORM\ManyToOne(targetEntity="Mascota", inversedBy="mascota_estados", cascade={"persist"}) 
    */
    protected $mascota;
    
    /** 
    * @ORM\ManyToOne(targetEntity="Entities\CaracteristicaTipo", cascade={"persist"}) 
    */  
    protected $estado;

    /** @ORM\Column(type="text") */
    protected $valor;
    
    // getters/setters
} 
