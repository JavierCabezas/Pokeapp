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
        'tournament',   //Tournament pokémon registration module.

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
            'allowAutoLogin' => true
        ),
        'bootstrap' => array(
            'class' => 'bootstrap.components.Bootstrap'
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                'torneo'                        => 'tournament/tournament/index',
                'torneo/miEquipo'               => 'tournament/tournament/userMenu',
                'torneo/registro'               => 'tournament/tournamentPlayer/create',
                'torneo/resetearClave'          => 'tournament/tournamentPlayer/resetPassword',
                'torneo/jugador/<id>'           => 'tournament/tournamentPlayer/view/id/<id>',
                'torneo/agregarPokemon'         => 'tournament/tournamentPokemon/create',
                'torneo/verPokemon/<id>'        => 'tournament/tournamentPokemon/view/id/<id>',
                'torneo/borrarPokemon/<id>'     => 'tournament/tournamentPokemon/delete/id/<id>',
                'torneo/pokemonTorneo'          => 'tournament/tournamentPokemon/admin',
                'torneo/modificarPokemon/<id>'  => 'tournament/tournamentPokemon/update/id/<id>',
                'torneo/<page>'                 => 'tournament/tournament/<page>',
                'buscador'                      => 'buscador/buscador/index',
                'jugadores'                     => 'jugadores/jugadores/index',
                'jugadores/crear'               => 'jugadores/jugadores/create',
                'jugadores/nuevo_codigo'        => 'jugadores/jugadores/newCode',
                'jugadores/actualizar'          => 'jugadores/jugadores/updateForm',
                'jugadores/<page>'              => 'jugadores/jugadores/<page>',
                'pokeball'                      => 'pokeball/pokeball/index',
                'pokeball/<page>'               => 'pokeball/pokeball/<page>',
                'stats'                         => 'stats/stats/index',
                'stats/<page>'                  => 'stats/stats/<page>',
                'sobre_mi'                      => 'site/about',
                'gii'                           => 'gii/default/login',
                '<page>'                        => 'site/<page>',
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
                'username'=>'prueba.skymarket@gmail.com',
                'password'=>'testsky2014',
                'port'=>'465',
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
            )
        )
    ),
    
    'params' => array(
        'adminEmail'            => 'jcleyton@gmail.com',
        'pokeball_math_page'    => '[INSERT LINK HERE]',
    )
);