<?php
return array(
    'controllers' => array(
        'invokables' => array(
	    'Region\Controller\Ver' => 'Region\Controller\VerController',          
        ),
    ),
    'router' => array(
        'routes' => array(
            'region' => array(
                'type'    => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/region',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Region\Controller',
                        'controller'    => 'Ver',
                        'action'        => 'info',
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
                            'route'    => '/[:controller[/:action]][/:id]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'         => '[0-9]+',
                            ),
                            'defaults' => array(
				
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),  
    'view_manager' => array(
	'template_map' => array(
    	    ),
        'template_path_stack' => array(
            'Region' => __DIR__ . '/../view',
        ),
    ),
);
