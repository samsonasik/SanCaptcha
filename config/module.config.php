<?php
return array(

    'san_captcha' => array(
        'class' => 'image',
        'options' => array(
            // using tmp sys dir to generate Captcha images
            'imgDir' => sys_get_temp_dir(),
            // true => SanCaptcha Module delete the Captcha image, false => Zend delete the Captcha image after some minutes
            'imgDelete' => true,
            // feel free to add fonts in Module's font directory
            'fontDir' => __DIR__.'/../fonts',
            // if 'font' is not defined, SanCaptcha Module, will pick one randmoly in 'fontDir'
//          'font' => 'arial.ttf',
//          'font' => ['arial.ttf', 'Roboto-Regular.ttf'],
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
            'san-captcha' => __DIR__ . '/../view',
        ),


    ),
);
