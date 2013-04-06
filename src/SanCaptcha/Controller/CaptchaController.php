<?php

namespace SanCaptcha\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Stdlib\ArrayUtils;
use Traversable;

/**
 * CaptchaController
 *
 * @author
 *
 * @version
 *
 */
class CaptchaController extends AbstractActionController
{
    /**
     * The default action - show the home page
     */
    public function generateAction ()
    {
        $response = $this->getResponse();
        $response->getHeaders()->addHeaderLine('Content-Type', "image/png");
        
        $id = $this->params('id', false);
        
        if ($id) {
            $config = $this->getServiceLocator()->get('config');
            
            if ($config instanceof Traversable) {
                $config = ArrayUtils::iteratorToArray($config);
            }
            
            $spec = $config['san_captcha'];
            
            $image = join('/', array(
                $spec['options']['imgDir'],
                $id
            ));
            
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
}