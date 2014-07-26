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

	public function actionUserMenu(){
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
	}
}