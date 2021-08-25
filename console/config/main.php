<?php
// get config of urlManager from frontend for correctly create urls in console app
//$frontend = require(__DIR__ . '/../../frontend/config/main.php');

return [

    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'components' => [
        'urlManager' => [
            'baseUrl' => 'http://ozisim.com',
            ]
    ],
    'controllerNamespace' => 'console\controllers',

];