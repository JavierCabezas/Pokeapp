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
            $this->redirect(array('/torneo/miEquipo'));
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
        $player         = TournamentPlayer::model()->findByPk($id);
        $tournament     = Tournament::model()->getNextTournament();

        $model        = TournamentPlayerFolio::model()->findByAttributes(array(
            'id_tournament_player'  => $id, 
            'id_tournament'         => $tournament->id 
        ));

        $array_folio = array();
        $array_folio = TournamentPlayerFolio::model()->getRemainingFolio($id_tournament);

        $this->render('authorize', array(
            'player'    => $player,
            'picture'   => $model->folio_photo,
            'model'     => $model
        ));
    }
}