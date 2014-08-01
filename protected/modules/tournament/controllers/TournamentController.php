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
                ),
                'users' => array(
                    '*'
                )
            ),
            array(
                'allow',
                'actions' => array(
                    'userMenu',
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
            $this->redirect(array('/torneo/miEquipo')); //If the player is logged redirect to the team view.
	}

    /**
     *  Displays the main user menu. Over here you can see your current teams and make modifications to them.
     */
	public function actionUserMenu()
    {
        if(!Admin::model()->isAdmin()){
    		$user = TournamentPlayer::model()->findByPk(Yii::app()->user->id);

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
                'value' => '$data->idTournamentPlayer->nombre'
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
                    Yii::app()->user->setFlash('success', "Se agregó el folio ".$folio_post." al jugador ".$tournament_player_folio->idTournamentPlayer->nombre." con éxito");
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
                    Yii::app()->user->setFlash('error', "Se rechazó al jugador ".$tournament_player_folio->idTournamentPlayer->nombre.". Por favor mándale un correo a ".$tournament_player_folio->idTournamentPlayer->mail." para comunicarle en detalle el por qué y si se puede arreglar su situación.");
                }
            }
            else
                Yii::app()->user->setFlash('error', "Ocurrió un error al agregar el jugador. Por favor inténtalo nuevamente.");

            if($_POST['next_page'] == 'adminMenu')
                $this->redirect(array('/torneo/adminMenu'));
            else
                $this->redirect(array('/torneo/vistaAutorizar'));
        }else{
            $player         = TournamentPlayer::model()->findByPk($id);
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
}