<?php

class TournamentController extends Controller
{
    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl'
        );
    }
    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array(
                'allow',
                'actions' => array(
                    'index',
                    'registration',
                    'resetPassword',
                    'create',
                    'view',
                ),
                'users' => array(
                    '*'
                )
            ),
            array(
                'allow',
                'actions' => array(
                    'userMenu',
                    'inscription',

                ),
                'users' => array(
                    '@'
                )
            ),
            array(
                'allow',
                'actions' => array(
                    'authorize',
                    'authorizeView',
                    'adminMenu',
                    'viewTeam',
                ),
                'users' => Admin::model()->getArrayAdmins()
            ),
            array(
                'deny', // deny all users
                'users' => array(
                    '*'
                )
            )
        );
    }

	public function actionIndex()
	{
        if(!isset(Yii::app()->user->id))
    		$this->render('index');
        else
            $this->redirect(array('/torneo/menuUsuario')); //If the player is logged redirect to the team view.
	}

    /**
     *  Displays the main user menu. Over here you can see your current teams and make modifications to them.
     */
	public function actionUserMenu()
    {
        if(!Admin::model()->isAdmin()){
    		$user = Users::model()->findByPk(Yii::app()->user->id);
    		$next_tournament = Tournament::model()->getNextTournament();
    		
    		$user_tournament_pokemon = TournamentPlayerPokemon::model()->findAllByAttributes(array(
    			'id_tournament_player' => Yii::app()->user->id,
    			'id_tournament'		   => $next_tournament->id
    		));

    		$user_pokemon = TournamentPokemon::model()->findAllByAttributes(array(
    			'id_tournament_player' => Yii::app()->user->id,
    		));

    		$this->render('userMenu', array(
    			'username' 					=> $user->mail,
    			'next_tournament'			=> beautify($next_tournament->name),
    			'user_tournament_pokemon'	=> $user_tournament_pokemon,
    			'user_pokemon'				=> $user_pokemon,
    		));
        }else{
            $this->redirect('adminMenu');
        }

	}


    public function actionResetPassword()
    {
        $this->render('resetPassword');
    }

    public function actionAdminMenu()
    {
        $players_to_check = count(TournamentPlayerFolio::model()->findAllByAttributes(array('folio' => null)));
        if($players_to_check == 1)
            Yii::app()->user->setFlash('notice', "Existe ".$players_to_check." jugador con folio sin revisar");
        if($players_to_check > 1)
            Yii::app()->user->setFlash('notice', "Existen ".$players_to_check." jugadores con folio sin revisar");
        $this->render('adminMenu', array(

        ));
    }

    /**
     *  Renders the administrator view to authorize players (by checking the folium of the entrance uploaded by them)
     */
    public function actionAuthorizeView()
    {
        $id_tournament = Tournament::model()->getNextTournament()->id;
        $criteriaPendingPlayers = TournamentPlayerFolio::model()->findAllByAttributes(array(
            'folio' => null, 
            'id_tournament' => $id_tournament
        ));
        $pendingPlayers = new CArrayDataProvider($criteriaPendingPlayers);

        $pendingPlayersCol = array(
            array(
                'header'=>'Nombre', 
                'value' => '$data->idTournamentPlayer->name'
            ),
            array(
                'header'=>'mail', 
                'value'=>'$data->idTournamentPlayer->mail'
            ),
            array(
                'header'=>'Torneo al que postula', 
                'value' => '$data->idTournament->name'
            ),
            array(
                'header'=>'Preview foto folio', 
                'value' => '"<div class=\'preview_folio\'>".CHtml::image(imageDir()."/foto_folio/".$data->folio_photo)."</div>"', 
                'type'  => 'html'
            ),
            array(
                'header' => 'Ver más detalles',
                'type'  => 'html',
                'value'  => 'CHtml::link("Autorizar o rechazar", array("/torneo/autorizar", "id" => $data->idTournamentPlayer->id))'
            )
        );


        $this->render('authorizeView', array(
            'pendingPlayers'    => $pendingPlayers,
            'pendingPlayersCol' => $pendingPlayersCol,
        ));
    }

    /**
     *  Renders the actual form to authorize players.
     */
    public function actionAuthorize($id){
        if(isset($_POST['folio'], $_POST['player'], $_POST['tournament'], $_POST['folio'], $_POST['next_page'])){
            $id_player_post     = intval($_POST['player']);
            $id_tournament_post = intval($_POST['tournament']);
            $folio_post         = intval($_POST['folio']);
            $tournament_player_folio = TournamentPlayerFolio::model()->findByAttributes(array(
                'id_tournament_player'  => $id_player_post,
                'id_tournament'         => $id_tournament_post
            ));

            if(TournamentPlayerFolio::model()->updateByPk($tournament_player_folio->id, array("folio" => $folio_post))){
                if($folio_post != -1){
                    Yii::app()->user->setFlash('success', "Se agregó el folio ".$folio_post." al jugador ".$tournament_player_folio->idTournamentPlayer->name." con éxito");
                    $body =         '<p> Un administrador acaba de revisar tu perfil de jugador en la Pokéapp y te asignó el número '.$folio_post.' (según tu número de folio). </p>';
                    $body = $body . '<p> Recuerda que las dos condiciones para tener tu inscripción online finalizada son la revisión de perfil y la creación de tu equipo pokémon online, ';
                    $body = $body . 'por lo que si tienes el equipo listo el trámite está finalizado. </p> <p> Además considera que puedes revisar tu perfil en cualquier momento para revisar que tu equipo esté bien ingresado';
                    $body = $body . 'en nuestro sitio web. </p> <p> Ante cualquier duda siéntete libre de contactarnos en este mismo correo y te atenderemos en cuanto antes. </p>';
                    Mail::sendMail( 
                        Yii::app()->params['adminEmail'],
                            $tournament_player_folio->idTournamentPlayer->mail, 
                            'Han autorizado tu perfil en la pokéapp', 
                            'Bienvenido/a!', 
                            $body
                    );
                }else{
                    Yii::app()->user->setFlash('error', "Se rechazó al jugador ".$tournament_player_folio->idTournamentPlayer->name.". Por favor mándale un correo a ".$tournament_player_folio->idTournamentPlayer->mail." para comunicarle en detalle el por qué y si se puede arreglar su situación.");
                }
            }
            else
                Yii::app()->user->setFlash('error', "Ocurrió un error al agregar el jugador. Por favor inténtalo nuevamente.");

            if($_POST['next_page'] == 'adminMenu')
                $this->redirect(array('/torneo/adminMenu'));
            else
                $this->redirect(array('/torneo/vistaAutorizar'));
        }else{
            $player         = Users::model()->findByPk($id);
            $tournament     = Tournament::model()->getNextTournament();

            $model        = TournamentPlayerFolio::model()->findByAttributes(array(
                'id_tournament_player'  => $id, 
                'id_tournament'         => $tournament->id 
            ));

            $array_folio = TournamentPlayerFolio::model()->getRemainingFolio($tournament->id);

            $this->render('authorize', array(
                'player'        => $player,
                'picture'       => $model->folio_photo,
                'model'         => $model,
                'array_folio'   => $array_folio,
                'tournament'    => $tournament,
            ));
        }
    }

    /**
     * Displays the confirmation for the profile creation (that rhymes!)
     * @param string $id the mail of the account.
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'mail' => $id
        ));
    }
    
    /**
     * Creates a new user to the database. 
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Users;       
        $next_tournament = Tournament::model()->findByAttributes(array('active' => 1));

        if (isset($_POST['Users'])) {
            $folio         = CUploadedFile::getInstance($model, 'folio');

            $code = generatePassword();
            $model->code = $model->hashPassword($code);
            $model->name = $_POST['Users']['name'];
            $model->mail = $_POST['Users']['mail'];
            $model->created_on = time();
            if ($model->save()){
                $playerFolio = new TournamentPlayerFolio();
                $id_tournament                      = 1; //TODO: FIX THIS
                $playerFolio->folio_photo           = $id_tournament . "_" . $model->id . "." . $folio->extensionName;
                $playerFolio->id_tournament         = $id_tournament;
                $playerFolio->id_tournament_player  = $model->id;
                if($playerFolio->save())
                    $folio->saveAs('./images/foto_folio/'. $playerFolio->folio_photo);
                $body =         '<p> Se acaba de crear tu perfil de usuario en la pokéapp asociada a esta cuenta de correo electrónico. </p>';
                $body = $body . '<p> Para finalizar la inscripción online se requieren dos pasos:
                                    <ul> <li> El primero es el registro online de tu equipo. Para ello tienes que dirigirte a <a href="http://www.pokedaisuki.cl/pokeapp/torneo"> a la sección de torneos de la pokéapp </a>
                                         e ingresar con tu nombre de usuario (que vendría siendo tu correo, '.$model->mail.') y con la contraseña <b>'.$code.'</b>. Por favor guarda este correo dado que esta contraseña
                                         será encriptada y no tendremos forma de obtenerla posteriormente. </li>
                                         <li> El otro paso será la aprobación de algún administrador del evento  de la foto de la entrada (con el folio visible) que subiste al registrarte. 
                                         Se te avisará por este mismo medio del estado de la aprobación del mismo en el corto plazo. </li>
                                      </ul> </p>';
                $body = $body . '<p> El proceso de inscripción online se considera finalizado una vez que el equipo está creado en el sitio web y el folio de la entrada es aprobado. </p>';
                $body = $body . '<p> Muchas gracias por usar nuestro sistema online y ,ante cualquier duda, siéntete libre de responder este correo. Estaremos atentos! </p>';
                Mail::sendMail( 
                    Yii::app()->params['adminEmail'], //from 
                        $model->mail, //to
                        'Confirmación de creación de nuevo jugador de torneo', //subject
                        '¡Bienvenido!', //mail_title
                        $body//mail body
                );
                $this->redirect(array('/torneo/jugador/'.$model->mail));
            }
        }
        
        $this->render('create', array(
            'model'      => $model,
            'next_event' => $next_tournament->name,
        ));
    }
    
    /**
     *  Display the admin form to see the team of an specific player.
     */
    public function actionViewTeam(){

        $this->render('viewTeam');
    }

    /**
     *  Displays the user view to see their postulation status.
     */
    public function actionInscription(){
        $user = Users::model()->findByPk(Yii::app()->user->id);
        $id_tournament = Tournament::model()->getNextTournament()->id;

        $pokemon_in_team = TournamentPlayerPokemon::model()->pokemonInTeam($id_tournament, $user->id);
        if($pokemon_in_team == 6){
            $team_status    = 'El equipo está completo';
            $team_shorts    = 'Completo'; //I like shorts.
            $team_class     = 'win';
            $complete_team = true;
        }else{
            $team_status    = 'El equipo está incompleto. Se ha elegido '.$pokemon_in_team.' de los 6 pokémon';
            $team_shorts    = 'Incompleto';
            $team_class     = 'fail';
            $complete_team = false;
        }

        $folio = TournamentPlayerFolio::model()->findByAttributes(array(
            'id_tournament_player' => $user->id, 
            'id_tournament' => $id_tournament
        ))->folio;

        if(is_null($folio)){
            $folio_status   = 'Aún no han revisado tu perfil.';
            $folio_shorts   = 'Pendiente';
            $folio_class    = 'neutral';
            $admin_approval = false;
        }elseif($folio == -1){
            $folio_status   = 'Contáctanos a '.Yii::app()->params['adminEmail'].' para conseguir más detalles';
            $folio_shorts   = 'Rechazado';
            $folio_class    = 'fail';
            $admin_approval = false;
        }else{
            $folio_status   = 'Ha sido aceptado con número de folio '.$folio;
            $folio_shorts   = 'Aceptado';
            $folio_class    = 'win';
            $admin_approval = true; 
        }
        
        $complete_inscription = $complete_team&&$admin_approval;

        $this->render('inscription', array(
            'team_status'            => $team_status,
            'team_short'             => $team_shorts,
            'team_class'             => $team_class,
            'folio_status'           => $folio_status,
            'folio_short'            => $folio_shorts,
            'folio_class'            => $folio_class,
            'complete_inscription'   => $complete_inscription,
        ));

    }
}