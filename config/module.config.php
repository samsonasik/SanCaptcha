<?php
return array(
      
    'controllers' => array(
        
        'invokables' => array(
             'SanCaptcha\Controller\Testcaptcha' => 'SanCaptcha\Controller\TestcaptchaController'
        ),
        
    ),
    

    'router' => array(
    
        'routes' => array(
            
            'SanCaptcha' => array(
                'type'    => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/san-captcha',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'SanCaptcha\Controller',
                        'controller'    => 'testcaptcha',
                        'action'        => 'form',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                
                    'captcha_form' => array(
                        'type'    => 'segment',
                        'options' => array(
                            'route'    => '[/][:controller[/[:action[/]]]]',
                             'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                'controller' => 'testcaptcha',
                                'action' => 'form',                     
                            ),
                        ),
                    ),
                    
                    'captcha_form_generate' => array(
                        'type'    => 'segment',
                        'options' => array(
                            'route'    =>  '[/:controller[/captcha/[:id]]]',
                             'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                'controller' => 'testcaptcha',
                                'action' => 'generate',                    
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'Test' => __DIR__ . '/../view',
        ),
         
        
    ),
);
