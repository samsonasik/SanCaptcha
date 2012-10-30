<?php

namespace SanCaptcha\Form;

use Zend\Form\Form,
    Zend\Form\Element\Captcha,
    Zend\Captcha\Image as CaptchaImage;
    
class TestCaptchaForm extends Form
{
    public function __construct($urlcaptcha = null)
    {
        parent::__construct('Test Form Captcha');
        $this->setAttribute('method', 'post');
        
        $dirdata = './data';
        
        $captchaImage = new CaptchaImage(  array(
                'font' => $dirdata . '/fonts/arial.ttf',
                'width' => 250,
                'height' => 100,
                'dotNoiseLevel' => 40,
                'lineNoiseLevel' => 3)
        );
        $captchaImage->setImgDir($dirdata.'/captcha');
        $captchaImage->setImgUrl($urlcaptcha);
        
        $captcha = new Captcha('captcha');
        $captcha->setCaptcha($captchaImage);
        $captcha->setLabel('Please verify you are human ');
        
        $this->add($captcha);
       
        
        
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Test Captcha Now'
            ),
        )); 
    }
    
}