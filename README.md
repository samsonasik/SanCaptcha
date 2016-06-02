Captcha sample module.
======================

- Install:

```
composer require san/san-captcha:0.*
```

- register at application.config.php
```
'modules' => array(
    'Application',
    'Zend\Form',
    'Zend\I18n',
    'Zend\Router',
    'Zend\Validator',
    'Zend\Session'
),
```
- call in browser http://localhost/yourzfproject/public/san-captcha
