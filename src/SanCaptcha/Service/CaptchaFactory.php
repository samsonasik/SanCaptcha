<?php

namespace SanCaptcha\Service;

use Traversable;
use Zend\Captcha\Factory;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\ArrayUtils;

class CaptchaFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $sm)
    {
         $config  = $sm->get('config');
        
        if ($config instanceof Traversable) {
            $config = ArrayUtils::iteratorToArray($config);
        }
        
        $spec = $config['san_captcha'];
        
        if ('image' === $spec['class'])
        {
            // use configured fonts
            if(isset($spec['options']['font']))
            {
                $font = $spec['options']['font'];
                
                if (is_array($font)) {
                    $rand = array_rand($font);
                    $font = $font[$rand];
                }
                $spec['options']['font'] = join(DIRECTORY_SEPARATOR, array(
                    $spec['options']['fontDir'],
                    $font
                ));
            }
            else // or search for availalbe fonts and pick one
            {
                exec('ls ' . $spec['options']['fontDir'], $fileList);
                
                // collect all fonts
                $allFonts = array();
                
                foreach ($fileList as $file)
                {
                	if ($this->endsWith($file, ".ttf"))
                	{
                		array_push($allFonts, $file);
                	}
                }
                
                $rand = array_rand($allFonts);
                $spec['options']['font'] = join(DIRECTORY_SEPARATOR, array(
                    $spec['options']['fontDir'],
                    $allFonts[$rand]
                ));
            }
            
            $plugins = $sm->get('ViewHelperManager');
            $urlHelper = $plugins->get('url');
            
            $spec['options']['imgUrl'] = $urlHelper('SanCaptcha/captcha_form_generate');
        }
        
        $captcha = Factory::factory($spec);
        
        return $captcha;
    }
    
    private function endsWith($string, $end)
    {
    	$len = strlen($end);
    	$string_end = substr($string, strlen($string) - $len);
    	return $string_end == $end;
    }
    
}
