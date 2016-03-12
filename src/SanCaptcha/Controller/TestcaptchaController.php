<?php

namespace SanCaptcha\Controller;

use SanCaptcha\Form\TestCaptchaForm;
use Zend\Captcha\AdapterInterface;
use Zend\Http\Request;
use Zend\Mvc\Controller\AbstractActionController;

class TestcaptchaController extends AbstractActionController
{
    /** @var AdapterInterface AdapterInterface */
    protected $captchaService;

    /**
     * TestcaptchaController constructor.
     * @param AdapterInterface $captchaService
     */
    public function __construct(AdapterInterface $captchaService)
    {
        $this->captchaService = $captchaService;
    }

    /**
     * @return array
     */
    public function formAction()
    {
        $form = new TestCaptchaForm($this->captchaService);

        /** @var Request $request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            //set data post
            $form->setData($request->getPost());

            if ($form->isValid()) {
                echo "captcha is valid ";
            }
        }

        return ['form' => $form];
    }
}
