<?php

class JugadoresController extends Controller
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
                    'ShowPlayerInfo',
                    'buscador', 
                    'update',
                    'create', 
                    'updateForm', 
                    'view',
                    'tsv',
                    'safari',
                    'duelos',

                ),
                'users' => array(
                    '*'
                )
            ),
            array(
                'allow',
                'actions' => array(
                    'authorize',
                    'changeStatus',
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
		$this->render('index');
	}

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id, $code = null)
    {
        $model = $this->loadModel($id);
        if ( ($code == $model->idUser->code) || Admin::model()->isAdmin() ){
            $this->render('view', array(
                'model'     => $model,
            ));
        }else{
            $this->render('index');
        }
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
            $p = new CHtmlPurifier();
            $mail       = $p->purify($_POST['Player']['mail']);
            $nickname   = $p->purify($_POST['Player']['nickname']);
            $name = ($_POST['Player']['name'] != '')?$p->purify($_POST['Player']['name']):$nickname; //Save the nickname if the player didn't enter a name.
            $code = generatePassword();
            $hashed_code = Users::model()->hashPassword($code);
            
            if(Users::model()->checkPlayerExists($mail)){
                $user = Users::model()->findByAttributes(array('mail' => $mail));
                if($user->custom_password == 0){
                    Users::model()->updateByPk($user->id, array('code' => $hashed_code));
                }
            }else{
                $user               = new Users();
                $user->mail         = $mail;
                $user->name         = $name;
                $user->code         = $hashed_code;
                $user->created_on   = (String)time();
                $user->save();
            }
            //I know this is kind of ugly but...it works. Im not sure what I was thinking when I wrote this.
            $model->id_user         = $user->id;
            $model->nickname        = $nickname;
            $model->mail            = $user->mail;       
            $model->friendcode_1    = intval($_POST['Player']['friendcode_1']);
            $model->friendcode_2    = intval($_POST['Player']['friendcode_2']);
            $model->friendcode_3    = intval($_POST['Player']['friendcode_3']);
            $model->id_safari_type  = (intval($_POST['Player']['id_safari_type']) != 0)?intval($_POST['Player']['id_safari_type']):null;
            $model->safari_slot_1   = isset($_POST['Player']['safari_slot_1'])?intval($_POST['Player']['safari_slot_1']):null;
            $model->safari_slot_2   = isset($_POST['Player']['safari_slot_2'])?intval($_POST['Player']['safari_slot_2']):null;
            $model->safari_slot_3   = isset($_POST['Player']['safari_slot_3'])?intval($_POST['Player']['safari_slot_3']):null;
            $model->tsv             = intval($_POST['Player']['tsv'] != 0)?intval($_POST['Player']['tsv']):null;
            $model->duel_single     = intval($_POST['Player']['duel_single']);
            $model->tier_single     = isset($_POST['Player']['tier_single'])?intval($_POST['Player']['tier_single']):null;
            $model->duel_doble      = intval($_POST['Player']['duel_doble']);
            $model->tier_doble      = isset($_POST['Player']['tier_doble'])?intval($_POST['Player']['tier_doble']):null;
            $model->duel_triple     = intval($_POST['Player']['duel_triple']);
            $model->tier_triple     = isset($_POST['Player']['tier_triple'])?intval($_POST['Player']['tier_triple']):null;
            $model->duel_rotation   = intval($_POST['Player']['duel_rotation']);
            $model->tier_rotation   = isset($_POST['Player']['tier_rotation'])?intval($_POST['Player']['tier_rotation']):null;
            $model->skype           = $_POST['Player']['skype'];
            $model->whatsapp        = $_POST['Player']['whatsapp'];
            $model->facebook        = $_POST['Player']['facebook'];
            $model->public_mail     = 0;
            $model->others          = $_POST['Player']['others'];
            $model->comment         = $_POST['Player']['comment'];
            $model->auth            = 0;
            $model->created         = time();
            $model->modified        = time();

            $avatar                 = CUploadedFile::getInstance($model, 'avatar');
            if(isset($avatar)){
                $model->pic =  $avatar->extensionName;
            }
            if ($model->save()){
                    $link_form      = CHtml::link('formulario de modificación de perfil', $this->createAbsoluteUrl('jugadores/updateForm'));
                    $link_search    = CHtml::link('el buscador de jugadores', $this->createAbsoluteUrl('jugadores/buscador'));
                    $link_login     = CHtml::link('el siguiente link', $this->createAbsoluteUrl('/login'));
                    $body =         '<p> Se acaba de crear un perfil de jugador en la Pokéapp. Recuerda que el perfil será público luego de que sea aceptado por alguno de nuestros administradores. </p>';
                    if($user->custom_password == 0)
                        $body = $body . '<p> Además recuerda que  tu clave es <b>'.$code.'</b> y puedes logear desde '.$link_login.'. Si en cualquier momento quieres hacerle modificaciones a tu perfil puedes hacerlas con ese código en '.$link_form.'</p>';
                    else
                        $body = $body . '<p> Dado que hiciste cambio de clave previo (probablemente en el módulo de torneos) tu clave se mantiene y puedes ingresar desde '.$link_login.'. Si en cualquier momento quieres hacerle modificaciones a tu perfil puedes hacerlas con ese código en '.$link_form.'</p>';
                    $body = $body . '<p> Ahora te invitamos a buscar a otros jugadores en '.$link_search.' </p>';
                    $body = $body . '<p> ¡Muchas gracias por usar nuestra aplicación! </p>';
                    //Send the email to the player
                    Mail::sendMail( 
                        Yii::app()->params['adminEmail'], //from 
                        $model->mail, //to
                        'Confirmación de creación de nuevo jugador en la pokéapp', //subject
                        'Bievenido!', //mail_title
                        $body//mail body
                    );

                    //Send the email to me <3
                    Mail::sendMail( 
                        Yii::app()->params['adminEmail'], //from 
                        Yii::app()->params['adminEmail'], //to
                        'Se agregó un jugador en la pokéapp', //subject
                        'Se registro un nuevo jugador', //mail_title
                        '<p>Apúrate y acéptalo. Su mail es '.$model->mail.'</p>'//mail body
                    );

                if(isset($avatar)){
                    $avatar->saveAs('./images/foto_jugadores/'. $model->id . '.' .$model->pic);
                }
                $this->redirect(array(
                    'view',
                    'id'    => $model->id,
                    'code'  => $user->code,
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
     *  Loads the form that calls the update method.
     */
    public function actionUpdateForm(){
        $model = new Player;
        $this->render('updateForm', array(
            'model' => $model
        ));
    }

    /**
    * Updates a particular model.
    * If update is successful, the browser will be redirected to the 'view' page.
    * @param integer $mail the email the model to be updated
    * @param integer $code, the "password" to edit a profile.
    */
    public function actionUpdate()
    {
        $p = new CHtmlPurifier();
        if(isset($_POST['Player'], $_POST['mail'], $_POST['code'])){
            $mail = $p->purify($_POST['mail']);
            $code = $p->purify($_POST['code']);
            $model = Player::model()->findByAttributes(array('mail' => $mail, 'code' => $code));
            $model->attributes  = $_POST['Player'];
            $model->modified    = time();
            $model->auth        = Player::STATUS_PENDING;
            $avatar             = CUploadedFile::getInstance($model, 'avatar');
            if(isset($avatar)){
                $model->pic =  $avatar->extensionName;
            }
            if ($model->save()){
                if(isset($avatar)){
                    $avatar->saveAs('./images/foto_jugadores/'. $model->id . '.' .$model->pic);
                }
                $this->redirect(array(
                    'view',
                    'id'    => $model->id,
                    'code'  => $model->code,
                ));
            }
        }

        if(!(isset($_POST['mail'], $_POST['code'])))
            throw new CHttpException(403, 'No estás autorizado a entrar a esta sección.');
        $mail = $p->purify($_POST['mail']);
        $code = $p->purify($_POST['code']);
        sleep(1);

        $model=Player::model()->find('mail=:mail',array(':mail'=>$mail));
        $code = str_replace(' ', '', $code); //Remove the spaces from the code
        if($model->code != $code){
            $error_text = '<p>El código ingresado no corresponde al correo. Puedes intentarlo nuevamente haciendo click en ';
            $error_text = $error_text .  CHtml::link('el siguiente link', array('jugadores/updateForm')).'.</p>';
            $error_text = $error_text . '<p>Los datos que ingresaste fueron:'; 
            $error_text = $error_text . '<ul><li>Mail: ' . $mail . '</li><li> Código: ' . $code . '</li> </ul>'; 
            throw new CHttpException(403, $error_text);
        }
        $criteria=new CDbCriteria;
        $criteria->addCondition("id != 10001"); //Exclude unkown type
        $criteria->addCondition("id != 10002"); //Exlude shadow type
        $array_types        = CHtml::listData(Types::model()->findAll($criteria), 'id', 'typeName');
        $array_auth_mail    = array('0' => 'No', '1' => 'Sí');
        $array_tiers        = CHtml::listData(Tiers::model()->findAll($criteria), 'id', 'tierName');
            
        $this->render('update',array(
            'model'             => $model,
            'array_types'       => $array_types,
            'array_auth_mail'   => $array_auth_mail,
            'array_tiers'       => $array_tiers,
            'code'              => $code,
            'mail'              => $mail
        ));
    }


    /**
    * changes the player status
    * @param integer $id the ID of the model to be banned
    */
    public function actionChangeStatus($jugador, $status)
    {
        Player::model()->updateByPk($jugador, array(
                'auth' => $status
        ));
        $this->redirect( array('authorize'));
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
                    'others'                => ($player->others == '')?'No ingresado':$player->others,
                    'comment'               => ($player->comment == '')?'No ingresado':$player->comment,
                )
            );
        }   
    }

    public function actionAuthorize(){
        $pending_players = Player::model()->findAllByAttributes(array('auth' => Player::STATUS_PENDING));
        $pending_provider = new CArrayDataProvider($pending_players);

        $gridColumns = array(
            array('name'=>'id', 'header'=>'#', 'htmlOptions'=>array('style'=>'width: 60px')),
            array('name'=>'nickname', 'header'=>'Nickname'),
            array('name'=>'mail', 'header'=>'Mail'),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{view} {add} {remove}',
            'buttons'=>array(
                'view' => array
                (
                    'label'=>'Ver detalles',
                    'icon'=>'search',
                    'options'=>array(
                        'class'=>'btn btn-small',
                    ),
                ),
                            'add' => array
                (
                    'label'=>'Autorizar jugador',
                    'icon'=>'plus',
                    'url'=>'Yii::app()->createUrl("jugadores/changeStatus", array("jugador"=>$data->id, "status" => 1))',
                    'options'=>array(
                        'class'=>'btn btn-small',
                    ),
                ),

                'remove' => array
                (
                    'label'=>'Banear jugador',
                    'icon'=>'minus',
                    'url'=>'Yii::app()->createUrl("jugadores/changeStatus", array("jugador"=>$data->id, "status" => 2))',
                    'options'=>array(
                        'class'=>'btn btn-small',
                    ),
                ),
            ),
            'htmlOptions'=>array(
                'style'=>'width: 220px',
            ),
        ) 
        );

        $this->render('authorize', array(
            'gridDataProvider'  => $pending_provider,
            'gridColumns'       => $gridColumns,
        ));
    }

    public function actionTsv(){
        $this->render('tsv');
    }

    public function actionSafari(){
        $gridColumns = array(
            array(
                'name' => 'id_pokemon',
                'header' => 'Pokémon',
                'value' => '$data->idPokemon->pokemonName',
            ),
            array(
              'type' => 'raw',
              'value' => 'CHtml::image(Yii::app()->baseUrl . "/images/sprites/".$data->id_pokemon.".png")'

           ),
            array(
                'name' => 'slot',
                'header' => 'Ranura',
                'value' => '$data->slot',
            ),
        );
        $types = Types::model()->findAll(); 

        $data_providers = array();
        foreach($types as $type){
            $data_providers[$type->identifier] = new CActiveDataProvider('PokemonFriendSafari', array(
                'criteria' => array(
                    'condition' => 'id_type=' . $type->id)
                )
            );
        }

        $this->render('safari', array(
            'data_providers'    => $data_providers,
            'gridColumns'       => $gridColumns,
            'types'             => $types,
        ));
    }

    public function actionDuelos(){
        $this->render('duels');
    }
}