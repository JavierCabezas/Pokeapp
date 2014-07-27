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
                ),
                'users' => array(
                    '@'
                )
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
            throw new CHttpException(403, 'No estás autorizado a ver pokémon de otros jugadores.');
    }
    
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new TournamentPokemon;
        $criteria = new CDbCriteria;
        $criteria->addCondition("id < 5000"); //Exclude conquest and gamecube stuff.

        $array_ability      = CHtml::listData(Abilities::model()->findAll($criteria), 'id', 'abilityName');
		$array_moves		= CHtml::listData(Moves::model()->findAll($criteria), 'id', 'moveName');
		$array_pokemon      = CHtml::listData(PokemonSpecies::model()->findAll($criteria), 'id', 'pokemonName');
        $array_nature       = CHtml::listData(Nature::model()->findAll($criteria), 'id', 'natureName');
        $array_item         = CHtml::listData(Items::model()->findAll($criteria), 'id', 'itemName');
        $array_tournament   = CHtml::listData(Tournament::model()->findAll(), 'id', 'name');
        
        if (isset($_POST['TournamentPokemon'])) {
            $model->attributes = $_POST['TournamentPokemon'];
            $model->id_tournament_player = Yii::app()->user->id;
            if ($model->save())
                $this->redirect(array(
                    'view',
                    'id' => $model->id
                ));
        }
        
        $this->render('create', array(
            'model' 			=> $model,
            'array_ability'		=> $array_ability,
            'array_moves'		=> $array_moves,
            'array_pokemon'	    => $array_pokemon,
            'array_nature'      => $array_nature,
            'array_item'        => $array_item,
            'array_tournament'  => $array_tournament,
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
            $criteria = new CDbCriteria;
            $criteria->addCondition("id < 5000"); //Exclude conquest and gamecube stuff.
            $array_ability      = CHtml::listData(Abilities::model()->findAll($criteria), 'id', 'abilityName');
            $array_moves        = CHtml::listData(Moves::model()->findAll($criteria), 'id', 'moveName');
            $array_pokemon      = CHtml::listData(PokemonSpecies::model()->findAll($criteria), 'id', 'pokemonName');
            $array_nature       = CHtml::listData(Nature::model()->findAll($criteria), 'id', 'natureName');
            $array_item         = CHtml::listData(Items::model()->findAll($criteria), 'id', 'itemName');
            $array_tournament   = CHtml::listData(Tournament::model()->findAll(), 'id', 'name');

            if (isset($_POST['TournamentPokemon'])) {
                $model->attributes = $_POST['TournamentPokemon'];
                if ($model->save()){
                    if($_POST['torneo']){
                        echo $_POST['torneo'];
                        //Add the pokémon to the tournament in case the player selected it.
                        $tournament_player_pokemon = new TournamentPlayerPokemon();
                        $tournament_player_pokemon->id_tournament           = $_POST['torneo'];
                        $tournament_player_pokemon->id_tournament_pokemon   = $model->id;
                        $tournament_player_pokemon->id_tournament_player    = Yii::app()->user->id;
                        $tournament_player_pokemon->save();
                    }
                    $this->redirect('torneo/verPokemon/'.$model->id);
                }
            }
            
            $this->render('update', array(
                'model'             => $model,
                'array_ability'     => $array_ability,
                'array_moves'       => $array_moves,
                'array_pokemon'     => $array_pokemon,
                'array_nature'      => $array_nature,
                'array_item'        => $array_item,
                'array_tournament'  => $array_tournament,
            ));
        }else{
             throw new CHttpException(403, 'No estás autorizado a editar pokémon de otros jugadores.');
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
            echo "holi";
            $transaction = Yii::app()->db->beginTransaction();
            try {
                $pokemons_in_tournament = TournamentPlayerPokemon::model()->findAllByAttributes(array('id_tournament_player' => Yii::app()->user->id, 'id_tournament_pokemon' => $id));
                foreach($pokemons_in_tournament as $pokemon_in_tournament){
                    $pokemon_in_tournament->delete();
                }
                $this->loadModel($id)->delete();
               $transaction->commit();
                Yii::app()->user->setFlash("success","Se borró a ".$model->pokemonName." con éxito");
                $this->redirect(array('/torneo/miEquipo'));
            }catch(CException $e) {
                    $transaction->rollback();
                    Yii::app()->user->setFlash('error',"Ha ocurrido un error con el borrado. Por favor inténtalo nuevamente.");
                    $this->redirect(array('/torneo/verPokemon/', 'id' =>$id));
            }
        } else
            throw new CHttpException(400, 'No puedes borrar pokémon de otros jugadores.');
    }
    
    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('TournamentPokemon');
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
}
