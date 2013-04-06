<?php
return array(
    
    'san_captcha' => array(
        'class' => 'image',
        'options' => array(
            'imgDir' => './data/captcha',
            'fontDir' => './data/fonts',
            'font' => 'arial.ttf',
            'width' => 200,
            'height' => 50,
            'dotNoiseLevel' => 40,
            'lineNoiseLevel' => 3
        ),
    ),
      
    'controllers' => array(
        
        'invokables' => array(
            'SanCaptcha\Controller\Captcha' => 'SanCaptcha\Controller\CaptchaController',
            'SanCaptcha\Controller\Testcaptcha' => 'SanCaptcha\Controller\TestcaptchaController'
        ),
        
    ),
    

    'router' => array(
    
        'routes' => array(
            
            'SanCaptcha' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/san-captcha',
                    'defaults' => array(
                        'controller'    => 'SanCaptcha\Controller\Testcaptcha',
                        'action'        => 'form',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                
                    'captcha_form' => array(
                        'type'    => 'segment',
                        'options' => array(
                            'route'    => '/[:action[/]]',
                             'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                'action' => 'form',                     
                            ),
                        ),
                    ),
                    
                    'captcha_form_generate' => array(
                        'type'    => 'segment',
                        'options' => array(
                            'route'    =>  '/captcha/[:id]',
                            'defaults' => array(
                                'controller' => 'SanCaptcha\Controller\Captcha',
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
