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
                'usuario/resetearCodigo'            => 'users/resetCodeForm',                           //Displays the form to reset the user's password
                'usuario/cambiarClave'              => 'users/changePassword',                          //Displays the change password form (for a user created password)
                'usuario/cambiarCorreo'             => 'users/changeMail',                              //Displays the change mail form for a certain user
                'usuario/confirmarCorreo'           => 'users/confirmMailChange',                       //Actually changes the mail for a user.
                'jugadores/resetearClave'           => 'users/resetCodeForm',                           //Displays the form to reset the user's password
                'torneo/resetearClave'              => 'users/resetCodeForm',                           //Same link as the last one (but from tournament module)
                'torneo'                            => 'tournament/tournament/index',                   //Main tournament window
                'torneo/estadisticas'               => 'tournament/tournament/statistics',              //Statistics module for a certain tournament.
                'torneo/resumenTorneo'              => 'tournament/tournament/tournamentSummary',       //Admin view for a quick summary of every player in a certain tourament
                'torneo/estadoInscripcion'          => 'tournament/tournament/inscriptionStatus',       //User view to check the inscription status
                'torneo/menuUsuario'                => 'tournament/tournament/userMenu',                //User menu
                'torneo/vistaAutorizar'             => 'tournament/tournament/authorizeView',           //Admin view to pick a player to authorize
                'torneo/autorizar/<id:\d+>'         => 'tournament/tournament/authorize',               //View for the admin to actually authorize a player
                'torneo/verEquipoJugador'           => 'tournament/tournamentPokemon/viewPlayerTeam',   //View for the admin to check for players teams
                'torneo/registro'                   => 'tournament/tournament/create',                  //Profile creation on the tournament module                
                'torneo/jugador/<id>'               => 'tournament/tournament/view/id/<id>',            //User profile confirmation (to be called after create)
                'torneo/agregarPokemon'             => 'tournament/tournamentPokemon/create',           //Form to create a new pokémon for a tournament user.
                'torneo/verPokemon/<id:\d+>'        => 'tournament/tournamentPokemon/view/id/<id>',     //View details of an specific tournament pokémon
                'torneo/borrarPokemon/<id>'         => 'tournament/tournamentPokemon/delete/id/<id>',   //Deletes a tournament pokémon
                'torneo/pokemonTorneo'              => 'tournament/tournamentPokemon/admin',            //I should remember what this was...TODO
                'torneo/modificarPokemon/<id:\d+>'  => 'tournament/tournamentPokemon/update/id/<id>',   //Modify a tournament pokémon
                'torneo/modificarPokemon'           => 'tournament/tournamentPokemon/index',            //Modify a tournament pokémon                
                'torneo/<page>'                     => 'tournament/tournament/<page>',                  //Generic page for tournament (Im not aware that this is in use but just in case)
                'buscador'                          => 'buscador/buscador/index',                       //Index page for the search module
                'jugadores'                         => 'jugadores/jugadores/index',                     //Index page for the players module 
                'jugadores/crear'                   => 'jugadores/jugadores/create',                    //Create view for the players module
                'jugadores/actualizar'              => 'jugadores/jugadores/update',                    //Update view players module
                'jugadores/<page>'                  => 'jugadores/jugadores/<page>',                    //Generic page for the players module
                'pokeball'                          => 'pokeball/pokeball/index',                       //Index page for the pokéball module
                'pokeball/<page>'                   => 'pokeball/pokeball/<page>',                      //Generic page pokéball module (not in use)
                'stats'                             => 'stats/stats/index',                             //Index page for the stats calculator module
                'stats/<page>'                      => 'stats/stats/<page>',                            //Generic page for the stats module
                'sobre_mi'                          => 'site/about',                                    //About me page
                'gii'                               => 'gii/default/login',                             //Gii page (DO NOT UPLOAD THIS)
                'portada'                           => 'site/index',                                    //Renders the main page for the application.
                '<page>'                            => 'site/<page>',                                   //Generic for any page on the site controller.
                '<controller:\w+>/<id:\d+>'         => '<controller>/view',                             //Yii generated route
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',                    //Yii generated route (I hate this one, its sooo long)
                '<controller:\w+>/<action:\w+>'     => '<controller>/<action>',                         //Yii generated route
               
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