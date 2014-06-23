<?php
Yii::setPathOfAlias('bootstrap', dirname(__FILE__) . '/../extensions/bootstrap');
Yii::setPathOfAlias('yii-mail', dirname(__FILE__) . '/../extensions/yii-mail/YiiMailMessage.php');

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Daisuki Pokéapp',
    'language' => 'es',

    'preload' => array(
        'log',
        'bootstrap',
        'yii-mail',
    ),
    
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*'
    ),
    
    'modules' => array(
        'pokeball',     //Catch rate calculator.
        'stats',        //Stats calculator.
        'buscador',     //Pokémon search tool.
        'jugadores',    //Player search tool.

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
            'showScriptName' => false,
            'rules' => array(
                 'jugadores'                => 'jugadores/jugadores/index',
                 'jugadores/crear'          => 'jugadores/jugadores/create',
                 'jugadores/nuevo_codigo'   => 'jugadores/jugadores/newCode',
                 'jugadores/actualizar'     => 'jugadores/jugadores/updateForm',
                 'jugadores/<page>'         => 'jugadores/jugadores/<page>',
                 'pokeball'                 => 'pokeball/pokeball/index',
                 'pokeball/<page>'          => 'pokeball/pokeball/<page>',
                 'stats'                    => 'stats/stats/index',
                 'stats/<page>'             => 'stats/stats/<page>',
                 'sobre_mi'                 => 'site/about',

                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
               
            )
        ),
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=pokeapp',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8'
        ),
        'mail' => array(
            'class' => 'ext.yii-mail.YiiMail',
            'transportType' => 'smtp',
            'transportOptions' => array(
                'host'=>'smtp.gmail.com',
                'username'=>'XXXX',
                'password'=>'YYYY',
                'port'=>'ZZZZ',
                'encryption' => 'ssl'
            ),
            'viewPath' => 'application.views.mail',
            'logging' => true,
            'dryRun' => false
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
        'adminEmail'            => 'jcleyton@gmail.com',
        'pokeball_math_page'    => '[INSERT LINK HERE]',
    )
);