<?php

namespace SanCaptcha\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    SanCaptcha\Form\TestCaptchaForm;

class TestcaptchaController extends AbstractActionController
{

    public function generateAction()
    {
        $response = $this->getResponse();
        $response->getHeaders()->addHeaderLine('Content-Type', "image/png");
        
        $id = $this->params('id', false);
        
        if ($id) {
            
            $image = './data/captcha/' . $id;
            
            if (file_exists($image) !== false) {
                $fp        = fopen($image,"r");
                $imageread = fpassthru($fp);
                
                $response->setStatusCode(200);
                $response->setContent($imageread); 
         
                if (file_exists($image) == true) {
                    unlink($image);
                }
            }
            
        }
        
        return $response;
    }
    
    public function formAction()
    {
        $form = new TestCaptchaForm($this->getRequest()->getBaseUrl().'/test/testcaptcha/captcha/');
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

//http://stackoverflow.com/questions/11690320/how-do-i-pass-file-and-post-data-into-a-form
