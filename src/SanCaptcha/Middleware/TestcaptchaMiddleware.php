<?php

namespace SanCaptcha\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SanCaptcha\Form\TestCaptchaForm;
use Zend\Captcha\AdapterInterface;
use Zend\Http\Request;

class TestcaptchaMiddleware
{
    /** @var AdapterInterface AdapterInterface */
    protected $captchaService;

    /**
     * TestcaptchaMiddleware constructor.
     * @param AdapterInterface $captchaService
     */
    public function __construct(AdapterInterface $captchaService)
    {
        $this->captchaService = $captchaService;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return array
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        $form = new TestCaptchaForm($this->captchaService);

        if ($request->getMethod() == Request::METHOD_POST) {
            //set data post
            $form->setData($request->getAttributes());

            if ($form->isValid()) {
                echo "captcha is valid ";
            }
        }

        return ['form' => $form];
    }
}
