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
                    'statistics',
                ),
                'users' => array(
                    '*'
                )
            ),
            array(
                'allow',
                'actions' => array(
                    'userMenu',
                    'inscriptionStatus',
                    'uploadPhotoFolio',
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
                    'TournamentSummary',
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

            if(!TournamentPlayerFolio::model()->hasUploadedPhoto(Yii::app()->user->id)){
                Yii::app()->getComponent('user')->setFlash('error',
                '<b>Ojo!</b> Recuerda que debes de subir tu foto de folio para completar tu registro. Revisa la opción "subir foto de folio" en el menú de la derecha.');
            }
    		$this->render('userMenu', array(
    			'username' 					=> $user->mail,
    			'next_tournament'			=> beautify($next_tournament->name),
    			'user_tournament_pokemon'	=> $user_tournament_pokemon,
    			'user_pokemon'				=> $user_pokemon,
    		));
        }else{ //The admin shouldn't see the user menu, redirect over there =P.
            $this->redirect('adminMenu');
        }

	}

    /**
     *  This function display the main admin menu. This could have been done way better than how I actually did it =P
     *  It shows a small summary of the status of the players that are in the tournament and of their teams.
     */
    public function actionAdminMenu()
    {
        $tournament = Tournament::model()->getNextTournament();
        $players_to_check = count(TournamentPlayerFolio::model()->findAllByAttributes(array('folio' => null)));
        if($players_to_check == 1)
            Yii::app()->user->setFlash('notice', "Existe ".$players_to_check." jugador con folio sin revisar");
        if($players_to_check > 1)
            Yii::app()->user->setFlash('notice', "Existen ".$players_to_check." jugadores con folio sin revisar");
        $player_status = TournamentPlayer::model()->completePlayers($tournament->id);
        $this->render('adminMenu', array(
            'total_players'           => $tournament->total_folio_number,
            'finished_players'        => $player_status['complete'],
            'between_one_and_four'    => $player_status['between_one_and_four'],
            'exactly_four'            => $player_status['exactly_four'],
            'other'                   => $player_status['other'],
            'zero'                    => $player_status['zero'],
            'tournament_name'         => $tournament->name,
            'registered_players'      => $player_status['folio_ok'],
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
                    $body = $body . 'por lo que si tienes el equipo listo el trámite está finalizado. </p>';
                    $body = $body . '<p> Puedes revisar el estado de tu postulación en '.CHtml::link('el siguiente link', $this->createAbsoluteUrl('/torneo/estadoInscripcion')).'</p>';
                    $body = $body . '<p> Ante cualquier duda siéntete libre de contactarnos en este mismo correo y te atenderemos en cuanto antes. </p>';
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
        require_once Yii::app()->basePath . '/extensions/qr/qr.php';

        $model = new Users('createTournament');       
        $next_tournament = Tournament::model()->getNextTournament();

        if (isset($_POST['Users'])) {
            $folio         = CUploadedFile::getInstance($model, 'folio');           
            $code = generatePassword();
            $model->code = $model->hashPassword($code);
            $model->name = $_POST['Users']['name'];
            $model->mail = $_POST['Users']['mail'];
            $model->created_on = time();
            if(is_null($folio)){
                Yii::app()->user->setFlash('error', "Se debe de subir una foto de folio para poder continuar");
                $this->redirect(array('/torneo/registro'));
            }else{
                if ($model->save()){
                    $playerFolio = new TournamentPlayerFolio();
                    $id_tournament                      = $next_tournament->id;
                    $playerFolio->folio_photo           = $id_tournament . "_" . $model->id . "." . $folio->extensionName;
                    $playerFolio->id_tournament         = $id_tournament;
                    $playerFolio->id_tournament_player  = $model->id;
                    if($playerFolio->save())
                        $folio->saveAs('./images/foto_folio/'. $playerFolio->folio_photo);
                    if($_POST['Users']['tipo_registro'] == 'region'){
                
                    }
                    $body =         '<p> Se acaba de crear tu perfil de usuario en la pokéapp asociada a esta cuenta de correo electrónico. </p>';
                    $body = $body . '<p> Para finalizar la inscripción online se requieren dos pasos:
                                        <ul> <li> El primero es el registro online de tu equipo. Para ello tienes que dirigirte a <a href="http://www.pokedaisuki.cl/pokeapp/torneo"> a la sección de torneos de la pokéapp </a>
                                             e ingresar con tu nombre de usuario (que vendría siendo tu correo, '.$model->mail.') y con la contraseña <b>'.$code.'</b>. Por favor guarda este correo dado que esta contraseña
                                             será encriptada y no tendremos forma de obtenerla posteriormente. </li>
                                             <li> El otro paso será la aprobación de algún administrador del evento  de la foto de la entrada (con el folio visible) que subiste al registrarte. 
                                             Se te avisará por este mismo medio del estado de la aprobación del mismo en el corto plazo. </li>
                                          </ul> </p>';
                    $body = $body . '<p> El proceso de inscripción online se considera finalizado una vez que el equipo está creado en el sitio web y el folio de la entrada es aprobado. </p>';
                    $body = $body . '<p> Muchas gracias por usar nuestro sistema online y, ante cualquier duda, siéntete libre de responder este correo. Estaremos atentos! </p>';
                    Mail::sendMail( 
                        Yii::app()->params['adminEmail'], //from 
                            $model->mail, //to
                            'Confirmación de creación de nuevo jugador de torneo', //subject
                            'Te damos la bienvenida!', //mail_title
                            $body//mail body
                    );
                    $this->redirect(array('/torneo/jugador/'.$model->mail));
                }
            }
        }
        
        $this->render('create', array(
            'model'      => $model,
            'next_event' => $next_tournament->name,
        ));
    }

    /**
     *  Displays the user view to see their postulation status.
     */
    public function actionInscriptionStatus(){
        $user = Users::model()->findByPk(Yii::app()->user->id);
        $id_tournament = Tournament::model()->getNextTournament()->id;

        $pokemon_in_team = TournamentPlayerPokemon::model()->pokemonInTeam($id_tournament, $user->id);
        if($pokemon_in_team == 6){
            $team_status    = 'El equipo está completo';
            $team_shorts    = 'Completo'; //I like shorts.
            $team_class     = 'win';
            $complete_team = true;
        }else{
            $team_status    = 'El equipo está incompleto. Se ha elegido '.$pokemon_in_team.' de los 6 Pokémon';
            $team_shorts    = 'Incompleto';
            $team_class     = 'fail';
            $complete_team = false;
        }

        $folio_model = TournamentPlayerFolio::model()->findByAttributes(array(
            'id_tournament_player' => $user->id, 
            'id_tournament' => $id_tournament
        ));

        if(!TournamentPlayerFolio::model()->hasUploadedPhoto($user->id)){
            $folio_status   = 'Aún no has subido tu foto de folio';
            $folio_shorts   = 'Pendiente';
            $folio_class    = 'fail';
            $admin_approval = false;
        }
        elseif(is_null($folio_model->folio)){
            $folio_status   = 'Aún no han revisado tu perfil.';
            $folio_shorts   = 'Pendiente';
            $folio_class    = 'neutral';
            $admin_approval = false;
        }elseif($folio_model->folio == -1){
            $folio_status   = 'Contáctanos a '.Yii::app()->params['adminEmail'].' para conseguir más detalles';
            $folio_shorts   = 'Rechazado';
            $folio_class    = 'fail';
            $admin_approval = false;
        }else{
            $folio_status   = 'Ha sido aceptado con número de folio '.$folio_model->folio;
            $folio_shorts   = 'Aceptado';
            $folio_class    = 'win';
            $admin_approval = true; 
        }
        
        $complete_inscription = $complete_team&&$admin_approval;

        $this->render('inscriptionStatus', array(
            'team_status'            => $team_status,
            'team_short'             => $team_shorts,
            'team_class'             => $team_class,
            'folio_status'           => $folio_status,
            'folio_short'            => $folio_shorts,
            'folio_class'            => $folio_class,
            'complete_inscription'   => $complete_inscription,
        ));
    }

    /**
     *  This view displays a summary of every player in a certain tournament. This includes the player team and inscription status.
     *  To do this it checks every folio in the tournament and saves the information in an array (named out).
     *  The array has the following structure:
     *  $out[number_of_folio]['assigned'] If true the folio number is assigned to a player, otherwise its not used.
     *  These are filled only if the assgined value is true.
     *  $out[number_of_folio]['folio']          The folio number.
     *  $out[number_of_folio]['player_name']    The name of the player according to the Users table.
     *  $out[number_of_folio]['player_mail']    The email of the player according to the Users table.
     *  $out[number_of_folio]['player_picture'] The picture of the players ticket (as uploaded when they registered)
     *  $out[number_of_folio]['number_pokemon'] The number of the pokémon that the player has selected for the tournament.
     *  $oyt[number_of_folio]['date']           The date of the registration for the user.
     */
    public function actionTournamentSummary()
    {
        $next_tournament = Tournament::model()->getNextTournament();
        $total_folio_number = $next_tournament->total_folio_number;
        $out = array();
        for($folio = 1 ; $folio < $total_folio_number ; $folio = $folio+1){
            $model = TournamentPlayerFolio::model()->findByAttributes(array('folio' => $folio));
            if(!isset($model)){
                $out[$folio]['assigned'] = false;
            }else{
                $picture = imageDir()."/foto_folio/". $model->folio_photo;
                $out[$folio]['folio']          = $folio;
                $out[$folio]['assigned']       = true;
                $out[$folio]['player_name']    = $model->idTournamentPlayer->name;
                $out[$folio]['player_mail']    = $model->idTournamentPlayer->mail;
                $out[$folio]['player_picture'] = CHtml::link('click!', $picture);
                $out[$folio]['number_pokemon'] = $model->numberPokemon;
                $out[$folio]['date']           = date("M jS, Y G:s", $model->idTournamentPlayer->created_on);
            }
        }
        $this->render('tournamentSummary', array(
            'players'           => $out,
            'tournament_name'   => $next_tournament->name,
        ));
    }

    /**
     *  This view shows statistics about a certain tournament. 
     */
    public function actionStatistics()
    {
        //Register G-raphael for the charts.
        $baseUrl = Yii::app()->baseUrl; 
        $cs = Yii::app()->getClientScript();
        $cs->registerScriptFile($baseUrl.'/js/raphael.js');
        $cs->registerScriptFile($baseUrl.'/js/g.raphael-min.js');
        $cs->registerScriptFile($baseUrl.'/js/g.pie-min.js');

        if(!isset($_POST['id_tournament'])){
            $model = Tournament::model()->getNextTournament();        
        }else{
            $model = Tournament::model()->findByPk(intval($_POST['id_tournament']));
        }
    
        if(is_null($model->date_end)){
            $date = date('d-m-y', $model->date); 
        }else{
            $date = date('d-m-y', $model->date).' - '.date('d-m-y', $model->date_end);
        }

        $pokemon = TournamentPlayerPokemon::model()->mostPopularPokemon($model->id);
        $items   = TournamentPlayerPokemon::model()->mostPopularItems($model->id);
        $silly   = TournamentPlayerPokemon::model()->silly($model->id);

        reset($pokemon);
        $most_popular_pokemon = PokemonSpecies::model()->findByPk(key($pokemon))->pokemonName;

        $this->render('statistics', array(
            'tournament'        => $model,
            'date'              => $date,
            'pokemon'           => $pokemon,
            'items'             => $items,
            'silly'             => $silly,
            'most_popular'      => $most_popular_pokemon,
            'banned_pokemon'    => TournamentPokemonBan::model()->findAllByAttributes(array('id_ruleset' => $model->id_ruleset)),
            'banned_items'      => TournamentItemBan::model()->findAllByAttributes(array('id_ruleset' => $model->id_ruleset)),
            'banned_moves'      => TournamentMoveBan::model()->findAllByAttributes(array('id_ruleset' => $model->id_ruleset)),
        ));
    }

    /**
     *  Renders the folio photo upload form
     */
    public function actionUploadPhotoFolio()
    {
        $model = new Tournament('uploadPhoto');
        if(isset($_POST['Tournament'])){
            if($model->validate()){
                $model->photo_folio_upload   = CUploadedFile::getInstance($model,'photo_folio_upload');
            
                $last_id = Yii::app()->db->createCommand()->select('max(id) as max')->from('tournament_player_folio')->queryScalar()+1;
                $id_tournament = Tournament::model()->getNextTournament()->id;
                $photo_name = $id_tournament.'_'.$last_id.'.'.$model->photo_folio_upload->extensionName;
                
                $folio = new TournamentPlayerFolio();
                $folio->id_tournament_player = Yii::app()->user->id;
                $folio->id_tournament        = $id_tournament;
                $folio->folio_photo          = $photo_name;

                if($folio->save()){
                    $model->photo_folio_upload->saveAs("./images/foto_folio/".$photo_name);
                    Yii::app()->user->setFlash('success', "Se subió tu foto con éxito y será revisada en cuanto antes por un administrador.");
                    $this->redirect('userMenu');
                }
            }
        }
        $this->render('uploadPhotoFolio', array(
            'model' => $model
        ));
    }
}