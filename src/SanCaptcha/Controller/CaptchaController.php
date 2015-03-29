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
            
            $spec = $config['san_captcha']['options'];
            
            $image = join(DIRECTORY_SEPARATOR, array(
                $spec['imgDir'],
                $id
            ));
            
            if (file_exists($image) !== false) {
                              
                $imageread = file_get_contents($image);
                
                $response->setStatusCode(200);
                $response->setContent($imageread); 
         
                if ($spec['imgDelete'] && file_exists($image)) {
                    unlink($image);
                }
            }
            
        }
        
        return $response;
    }
}