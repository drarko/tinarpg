<?php
namespace Usuarios\Form;

use Zend\Form\Form;
use Zend\Form\Decorator;
use Zend\Form\Element;
use Zend\Form\Fieldset;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;

class RegistroForm extends Form 
{


    public function __construct($name = null, $dbAdapter)
    {
	
        // we want to ignore the name passed
        parent::__construct('registro');
        $this->setAttribute('method', 'post');

        
        $this->add(array(
            'name' => 'usuario',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Nombre de Usuario: ',
            ),
        ));
        $this->add(array(
            'name' => 'clave',
            'attributes' => array(
                'type'  => 'password',
            ),
            'options' => array(
                'label' => 'Contraseña: ',
            ),
        ));
        $this->add(array(
            'name' => 'clave2',
            'attributes' => array(
                'type'  => 'password',
            ),
            'options' => array(
                'label' => 'Confirmar Contraseña: ',
            ),
        ));        
        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'E-mail: ',
            ),
        ));
        $this->add(array(
            'name' => 'email2',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Confirmar E-mail: ',
            ),
        ));
        
        
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Registrar !',
                'id' => 'submitbutton',
            ),
        ));

        $this->add(array(
	  'type' => 'Zend\Form\Element\Csrf',
	  'name' => 'csrf',
	  'options' => array(
	      'csrf_options' => array(
                     'timeout' => 600
             )
     )
 ));        
           

            $inputFilter = new InputFilter();
            $factory     = new InputFactory();

	 
            
            $inputFilter->add($factory->createInput(array(
                'name'     => 'usuario',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                    array(
                        'name'    => 'Alnum',
                        ),
                    array(
			'name'    => 'Db_NoRecordExists',
			'options' => array (
			      'table' => 'portal_usuario',
                              'field' => 'usuario',
                              'adapter' =>  $dbAdapter,
			),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'clave',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 4,
                            'max'      => 20,
                        ),
                    ),
                    array(
                        'name'    => 'Alnum',
                        ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'clave2',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 4,
                            'max'      => 20,
                        ),
                    ),
                    array(
                        'name'    => 'Alnum',
                        ),
                    array(
                        'name'    => 'Identical',
                        'options' => array(
                            'token' => 'clave',
                        ), 
                    ),
                ),
            )));      
            
            
            $inputFilter->add($factory->createInput(array(
                'name'     => 'email',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
			'name'    => 'Db_NoRecordExists',
			'options' => array (
			      'table' => 'portal_usuario',
                              'field' => 'email',
                              'adapter' => $dbAdapter,
			),
                    ),
                    array(
			'name'		=> 'EmailAddress',
			'options'	=> array(
                                      'mx'    => true,
			),
                    ),
                ),
            )));
      
            $inputFilter->add($factory->createInput(array(
                'name'     => 'email2',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
			'name'    => 'Db_NoRecordExists',
			'options' => array (
			      'table' => 'portal_usuario',
                              'field' => 'email',
                              'adapter' => $dbAdapter,
			),
                    ),
                    array(
			'name'		=> 'EmailAddress',
			'options'	=> array(
                                      'mx'    => true,
			),
                    ),
                    array(
                        'name'    => 'Identical',
                        'options' => array(
                            'token' => 'email',
                        ), 
                    ),
                ),
            )));      
            $inputFilter->add($factory->createInput(array(
                'name'     => 'csrf',
                'required' => true,
                
                'validators' => array(
                    array(
			'name'    => 'Csrf',
			),
                   
                    
                ),
            )));      

	$this->setInputFilter($inputFilter);
        
    }
    
    
   
} 
