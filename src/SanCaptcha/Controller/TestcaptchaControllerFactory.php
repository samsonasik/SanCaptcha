<?php

namespace SanCaptcha\Controller;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class TestcaptchaControllerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return TestcaptchaController
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return $this->getService($container);
    }

    /**
     * @param ServiceLocatorInterface|AbstractPluginManager $serviceLocator
     * @return TestcaptchaController
     * @TODO remove if mvc-3 requirement is enforced
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this->getService($serviceLocator->getServiceLocator());
    }

    /**
     * @param ContainerInterface|ServiceLocatorInterface $container
     * @return TestcaptchaController
     */
    protected function getService($container)
    {
        return new TestcaptchaController($container->get('SanCaptcha'));
    }


}
