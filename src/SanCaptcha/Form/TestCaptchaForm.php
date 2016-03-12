<?php

namespace SanCaptcha\Form;

use Zend\Captcha\AdapterInterface as CaptchaAdapter;
use Zend\Form\Element\Captcha;
use Zend\Form\Form;

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
                'type' => 'submit',
                'value' => 'Test Captcha Now'
            ],
        ]);
    }

}