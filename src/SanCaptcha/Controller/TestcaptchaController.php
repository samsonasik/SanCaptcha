<?php

namespace SanCaptcha\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use SanCaptcha\Form\TestCaptchaForm;

class TestcaptchaController extends AbstractActionController
{
    public function formAction()
    {
        $captchaService = $this->getServiceLocator()->get('SanCaptcha');
        
        $form = new TestCaptchaForm($captchaService);
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
