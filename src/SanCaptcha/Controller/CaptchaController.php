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
    private $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * The default action - show the home page
     */
    public function generateAction ()
    {
        $response = $this->getResponse();
        $response->getHeaders()->addHeaderLine('Content-Type', "image/png");

        $id = $this->params('id', false);

        if ($id) {
            if ($this->config instanceof Traversable) {
                $this->config = ArrayUtils::iteratorToArray($this->config);
            }

            $spec = $this->config['san_captcha']['options'];

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
