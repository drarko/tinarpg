<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Contenido\Controller\Moderar' => 'Contenido\Controller\ModerarController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'contenido' => array(
                'type'    => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/contenido',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Contenido\Controller',
                        'controller'    => 'Moderar',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    // This route is a sane default when developing a module;
                    // as you solidify the routes for your module, however,
                    // you may want to remove it and replace it with more
                    // specific routes.
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]][/page/:page][/:id]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'page'       => '[0-9]+',
                                'id'         => '[0-9]+',
                            ),
                            'defaults' => array(
				'page' => 1,
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),   
    'view_manager' => array(
	'template_map' => array(
    	    'my_pagination_control2'   => __DIR__ . '/../view/pagination/sliding.phtml',
    	    'my_pagination_control3'   => __DIR__ . '/../view/pagination/sliding2.phtml',  
    	    ),
        'template_path_stack' => array(
            'Contenido' => __DIR__ . '/../view',
        ),
    ),
);
