<?php

class TournamentPokemonController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';
    
    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl' // perform access control for CRUD operations
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
                'allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array(
                    'create',
                    'update',
                    'view',
                    'delete',
                    'index',
                ),
                'users' => array(
                    '@'
                )
            ),
            array(
                'allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array(
                    'viewPlayerTeam',
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
    
    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $model = TournamentPokemon::model()->findByAttributes(array('id_tournament_player' => Yii::app()->user->id, 'id' => $id));
        if(isset($model))
            $this->render('view', array(
                'model' => $this->loadModel($id)
            ));
        else
            throw new CHttpException(403, 'No estás autorizado a ver Pokémon de otros jugadores.');
    }
    
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        if(TournamentPlayerPokemon::model()->pokemonInTeam(Tournament::model()->getNextTournament()->id, Yii::app()->user->id) > 5){
            Yii::app()->user->setFlash('error', "Ya tienes 6 Pokémon en tu equipo. Si quieres agregar más tienes que eliminar, al menos, uno de ellos.");
            $this->redirect(array('/torneo/menuUsuario'));
        }

        $model = new TournamentPokemon;
        if (isset($_POST['TournamentPokemon'])) {
            $model->attributes = $_POST['TournamentPokemon'];
            $model->id_tournament_player = Yii::app()->user->id;
            if ($model->save()){
                $id_tournament = Tournament::model()->getNextTournament()->id; //intval($_POST['torneo']); TODO Check later
                if($id_tournament != -1){ //-1 means that the player does not want to add the Pokémon to any specific tournament.
                    $tpp = new TournamentPlayerPokemon;
                    $tpp->id_tournament = $id_tournament;
                    $tpp->id_tournament_pokemon = $model->id;
                    $tpp->id_tournament_player = Yii::app()->user->id;
                    $tpp->save();
                }
                $this->redirect(array(
                    'view',
                    'id' => $model->id
                ));
            }
        }
        
        $this->render('create', array(
            'model' 			=> $model,
            'array_tournament'  => array(),
        ));
    }
    
    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = TournamentPokemon::model()->findByAttributes(array('id_tournament_player' => Yii::app()->user->id, 'id' => $id));
        if(isset($model)){      
            if (isset($_POST['TournamentPokemon'])) {
                $model->attributes = $_POST['TournamentPokemon'];
                if ($model->save()){
                    $this->redirect(array('/torneo/verPokemon/', 'id' => $model->id));
                }
            }
            /*
            $array_tournament   = CHtml::listData(Tournament::model()->findAll(), 'id', 'name');
            $array_tournament   = $array_tournament + array('-1' => 'No agrear a ningún torneo');    
            TODO CHeck this */

            $this->render('update', array(
                'model'             => $model,
                'array_tournament'  => array(),
            ));
        }else{
            $model = TournamentPokemon::model()->findByAttributes(array('id' => $id));
            if(isset($model))
                throw new CHttpException(403, 'No estás autorizado a editar Pokémon de otros jugadores.');
            else
                throw new CHttpException(404, 'El Pokémon que estás intentando modificar no existe.');
        }
    }
    
    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $model = TournamentPokemon::model()->findByAttributes(array('id_tournament_player' => Yii::app()->user->id, 'id' => $id));
        if(isset($model)){
            $transaction = Yii::app()->db->beginTransaction();
            try {
                $pokemons_in_tournament = TournamentPlayerPokemon::model()->findAllByAttributes(array('id_tournament_player' => Yii::app()->user->id, 'id_tournament_pokemon' => $id));
                foreach($pokemons_in_tournament as $pokemon_in_tournament){
                    $pokemon_in_tournament->delete();
                }
                $this->loadModel($id)->delete();
               $transaction->commit();
                Yii::app()->user->setFlash("success","Se borró a ".$model->pokemonName." con éxito");
                $this->redirect(array('/torneo/menuUsuario'));
            }catch(CException $e) {
                    $transaction->rollback();
                    Yii::app()->user->setFlash('error',"Ha ocurrido un error con el borrado. Por favor inténtalo nuevamente.");
                    $this->redirect(array('/torneo/verPokemon/', 'id' =>$id));
            }
        } else
            throw new CHttpException(403, 'No puedes borrar Pokémon de otros jugadores.');
    }
    
    /**
     * Lists all models and 
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('TournamentPokemon', array(
        'criteria'=>array(
            'condition'=>'id_tournament_player = '.Yii::app()->user->id
        )));
        $this->render('index', array(
            'dataProvider' => $dataProvider
        ));
    }
    
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = TournamentPokemon::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }
    
    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'tournament-pokemon-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    
    /**
     *  Display the admin form to see the team of an specific player.
     */
    public function actionViewPlayerTeam()
    {
        $team = null;
        $player = null;
        $id_tournament = Tournament::model()->getNextTournament()->id;
        
        if(isset($_POST['id_folio'])){
            $id_folio = intval($_POST['id_folio']);
            $id_player = TournamentPlayerFolio::model()->findByAttributes(array(
                'folio' => $id_folio, 
                'id_tournament' => $id_tournament
            ))->id_tournament_player;
            $player = Users::model()->findByPk($id_player);
            $team = TournamentPlayerPokemon::model()->findAllByAttributes(array(
                'id_tournament' => $id_tournament, 
                'id_tournament_player' => $id_player
            ));
        }

        $this->render('viewPlayerTeam', array(
            'team'          => $team,
            'id_tournament' => $id_tournament,
            'player'        => $player
        ));
    }
}
