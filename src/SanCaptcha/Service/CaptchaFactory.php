<?php

namespace SanCaptcha\Service;

use Interop\Container\ContainerInterface;
use Traversable;
use Zend\Captcha\AdapterInterface;
use Zend\Captcha\Factory;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\ArrayUtils;

class CaptchaFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return AdapterInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return $this->getService($container);
    }

    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return AdapterInterface
     * @TODO remove if mvc-3 requirement is enforced
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this->getService($serviceLocator);
    }

    /**
     * @param ContainerInterface|ServiceLocatorInterface $container
     * @return AdapterInterface
     */
    protected function getService($container)
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

    /**
     * @param string $string
     * @param string $end
     * @return bool
     */
    private function endsWith($string, $end)
    {
        $len = strlen($end);
        $string_end = substr($string, strlen($string) - $len);
        return $string_end == $end;
    }

}
