<?php

namespace SanCaptcha\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use SanCaptcha\Form\TestCaptchaForm;

class TestcaptchaController extends AbstractActionController
{
    public function __construct($captchaService)
    {
        $this->captchaService = $captchaService;
    }

    public function formAction()
    {
        $form = new TestCaptchaForm($this->captchaService);
        $request = $this->getRequest();
        if ($request->isPost()) {
            //set data post
            $form->setData($request->getPost());

            if ($form->isValid()) {
                echo "captcha is valid ";
            }
        }

        return array('form' => $form);
    }
}
