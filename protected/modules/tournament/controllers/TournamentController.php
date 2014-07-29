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

    		$next_tournament = Tournament::model()->findByAttributes(array('active' => 1));
    		
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
     *  Loads the administrator view to authorize players (by checking the folium of the entrance uploaded by them)
     */
    public function actionAuthorize()
    {
        $criteriaPendingPlayers = TournamentPlayerFolio::model()->findAllByAttributes(array('folio' => null));
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
                'header'=>'Foto folio', 
                'value' => "asdf.com",
                'type'  => 'html'
            ),
        );


        $this->render('authorize', array(
            'pendingPlayers'    => $pendingPlayers,
            'pendingPlayersCol' => $pendingPlayersCol,
        ));
    }
}