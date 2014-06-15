<?php

class PlayerController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';
    
    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id, $code)
    {
        $this->render('view', array(
            'model'     => $this->loadModel($id),
            'code'      => $code,
        ));
    }
    
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Player;
        $criteria=new CDbCriteria;
        $criteria->addCondition("id != 10001"); //Exclude unkown type
        $criteria->addCondition("id != 10002"); //Exlude shadow type
        $array_types        = CHtml::listData(Types::model()->findAll($criteria), 'id', 'typeName');
        $array_auth_mail    = array('0' => 'No', '1' => 'Sí');
        $array_tiers        = CHtml::listData(Tiers::model()->findAll($criteria), 'id', 'tierName');
        if (isset($_POST['Player'])) {
            $model->attributes = $_POST['Player'];
            $guia_subida     = CUploadedFile::getInstance($model, 'avatar');
            $creation_time   = time();
            $model->created = $creation_time;
            if(isset($guia_subida)){
                $model->pic =  $guia_subida->extensionName;
            }
            if ($model->save()){
                if(isset($guia_subida)){
                    $guia_subida->saveAs('./images/foto_jugadores/'. $model->id . '.' .$model->pic);
                }
                $this->redirect(array(
                    'view',
                    'id'    => $model->id,
                    'code'  => md5($model->created),
                ));
            }
        }
        
        $this->render('create', array(
            'model'             => $model,
            'array_types'       => $array_types,
            'array_auth_mail'   => $array_auth_mail,
            'array_tiers'       => $array_tiers,
        ));
    }
    
    
    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $this->redirect(array('buscador'));
    }
    
    /**
     * Manages all models.
     */
    public function actionBuscador()
    {
        $model = new Player('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Player']))
            $model->attributes = $_GET['Player'];
        
        $this->render('buscador', array(
            'model' => $model
        ));
    }
    
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = Player::model()->findByPk($id);
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'player-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Echoes the information of a certain player.
     * @param integer id the identifier of the player.
     */
    public function actionShowPlayerInfo() {
        if(isset($_POST['id'])){
            $id = (int) $_POST['id'];
            $player = $this->loadModel($id);
            if($player->auth != Player::STATUS_OK)
                return;
            $safari = is_null($player->id_safari_type);

            echo $this->renderPartial('_view', array(
                    'player_nickname'       => $player->nickname,
                    'safari_type'           => ($safari)?'(No ingresado)':$player->idSafariType->typeName,
                    'player_pic'            => is_null($player->pic)?"<img src='/pokeapp/images/sprites/0.png'>":"<img src='/pokeapp/images/foto_jugadores/". $player->id .".". $player->pic ."'>",
                    'pokemon_safari_1'      => ($safari)?'':$player->safariSlot1->pokemonName,
                    'pic_pokemon_1'         => ($safari)?'':"<img src='/pokeapp/images/sugimori/104px-Sugimori_".addZeros($player->safariSlot1->id).".png'>",
                    'pokemon_safari_2'      => ($safari)?'':$player->safariSlot2->pokemonName,
                    'pic_pokemon_2'         => ($safari)?'':"<img src='/pokeapp/images/sugimori/104px-Sugimori_".addZeros($player->safariSlot2->id).".png'>",
                    'pokemon_safari_3'      => ($safari)?'':$player->safariSlot3->pokemonName,
                    'pic_pokemon_3'         => ($safari)?'':"<img src='/pokeapp/images/sugimori/104px-Sugimori_".addZeros($player->safariSlot3->id).".png'>",
                    'friend_code'           => addZeros($player->friendcode_1, 4).' - '.addZeros($player->friendcode_2, 4).' - '.addZeros($player->friendcode_3, 4),
                    'tsv'                   => is_null($player->tsv)?"No ingresado":$player->tsv,
                    'duel_single'           => $player->duel_single,
                    'tier_single'           => is_null($player->tier_single)?null:beautify($player->tierSingle->identifier),
                    'duel_doble'            => $player->duel_doble,
                    'tier_doble'            => is_null($player->tier_doble)?null:beautify($player->tierDoble->identifier),
                    'duel_triple'           => $player->duel_triple,
                    'tier_triple'           => is_null($player->tier_triple)?null:beautify($player->tierTriple->identifier),
                    'duel_rotation'         => $player->duel_rotation,
                    'tier_rotation'         => is_null($player->tier_rotation)?null:beautify($player->tierRotation->identifier),
                    'skype'                 => ($player->skype == '')?'No ingresado':$player->skype,
                    'whatsapp'              => ($player->whatsapp == '')?'No ingresado':$player->whatsapp,
                    'facebook'              => ($player->facebook == '')?'No ingresado':$player->facebook,
                    'mail'                  => ($player->public_mail == 0)?'Privado':$player->mail,
                    'others'                => ($player->others == '')?'No ingresado':$player->others,
                    'comment'               => ($player->comment == '')?'No ingresado':$player->comment,
                )
            );
        }   
    }
}