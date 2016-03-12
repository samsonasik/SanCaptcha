<?php

namespace SanCaptcha\Form;

use Zend\Form\Form;
use Zend\Form\Element\Captcha;
use Zend\Captcha\AdapterInterface as CaptchaAdapter;
    
class TestCaptchaForm extends Form
{
    /**
     * TestCaptchaForm constructor.
     * @param CaptchaAdapter|null $captchaAdapter
     */
    public function __construct(CaptchaAdapter $captchaAdapter = null)
    {
        parent::__construct('Test Form Captcha');
        $this->setAttribute('method', 'post');
        
        $captcha = new Captcha('captcha');
        $captcha->setCaptcha($captchaAdapter);
        $captcha->setOptions(['label' => 'Please verify you are human.']);
        $this->add($captcha);
        
        $this->add([
            'name' => 'submit',
            'attributes' => [
                'type'  => 'submit',
                'value' => 'Test Captcha Now'
            ],
        ]);
    }
    
}