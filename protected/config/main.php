<?php
Yii::setPathOfAlias('bootstrap', dirname(__FILE__) . '/../extensions/bootstrap');

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Daisuki Pokéapp',
    
    'preload' => array(
        'log',
        'bootstrap',
    ),
    
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*'
    ),
    
    'modules' => array(
        'pokeball', //First pokéapp: Catch rate calculator.

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'gii',
            'ipFilters' => array(
                '127.0.0.1',
                '::1'
            ),
            'generatorPaths' => array(
            	'bootstrap.gii'
        	),
        ),
    ),
    
    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true
        ),
        'bootstrap' => array(
            'class' => 'bootstrap.components.Bootstrap'
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>'
            )
        ),
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=pokeapp',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8'
        ),
        'errorHandler' => array(
            'errorAction' => 'site/error'
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning'
                )
                // uncomment the following to show log messages on web pages
                /*
                array(
                'class'=>'CWebLogRoute',
                ),
                */
            )
        )
    ),
    
    'params' => array(
        'adminEmail' => 'jcleyton@gmail.com'
    )
);