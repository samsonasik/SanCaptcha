Captcha sample module.
======================

- Install:

```
composer require san/san-captcha:1.*
```

- register at application.config.php
```
'modules' => array(
    'Application', // your app
    'Zend\Form',
    'Zend\I18n',
    'Zend\Router',
    'Zend\Validator',
    'Zend\Session',
    'SanCaptcha'
),
```
- call in browser http://localhost/yourzfproject/public/san-captcha
