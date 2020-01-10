<?php

namespace SanCaptcha\Service;

use Psr\Container\ContainerInterface;
use Traversable;
use Laminas\Captcha\AdapterInterface;
use Laminas\Captcha\Factory;
use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;
use Laminas\Stdlib\ArrayUtils;

class CaptchaFactory
{
    public function __invoke(ContainerInterface $container) : AdapterInterface
    {
        $config = $container->get('config');

        if ($config instanceof Traversable) {
            $config = ArrayUtils::iteratorToArray($config);
        }

        $spec = $config['san_captcha'];

        if ('image' === $spec['class']) {
            // use configured fonts
            if (isset($spec['options']['font'])) {
                $font = $spec['options']['font'];

                if (is_array($font)) {
                    $rand = array_rand($font);
                    $font = $font[$rand];
                }
                $spec['options']['font'] = join(DIRECTORY_SEPARATOR, [
                    $spec['options']['fontDir'],
                    $font
                ]);
            } else {
                // or search for available fonts and pick one

                $fileList = scandir($spec['options']['fontDir']);

                // collect all fonts
                $allFonts = [];

                foreach ($fileList as $file) {
                    if ($this->endsWith($file, ".ttf")) {
                        array_push($allFonts, $file);
                    }
                }

                $rand = array_rand($allFonts);
                $spec['options']['font'] = join(DIRECTORY_SEPARATOR, [
                    $spec['options']['fontDir'],
                    $allFonts[$rand]
                ]);
            }

            $plugins = $container->get('ViewHelperManager');
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
