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
                    'create', 
                    'tsv',
                    'safari',
                    'duelos',
                    'view',
                ),
                'users' => array(
                    '*'
                )
            ),
            array(
                'allow',
                'actions' => array(
                    'update',
                ),
                'users' => array(
                    '@'
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
        if(Player::model()->hasProfile() ){
            //If the player has a profile redirect to the index
            Yii::app()->user->setFlash('notice', "Ya tienes un perfil asociado a tu cuenta. Si quieres modificar tu perfil puedes hacerlo haciendo click ".CHtml::link('aquí', array('/jugadores/actualizar')).'.');
            $this->redirect('index');
        }
        $model = new Player('create');

        if (isset($_POST['Player'])) {
            $p = new CHtmlPurifier();
            if(isset(Yii::app()->user->id)){
                $user_model = Users::model()->findByPk(Yii::app()->user->id);
                $mail = $user_model->mail;
                $_POST['Player']['name'] = $user_model->name;
            }
            else{
                $mail = $p->purify($_POST['Player']['mail']);
            }

            $nickname   = $p->purify($_POST['Player']['nickname']);
            $name = ($_POST['Player']['name'] != '')?$p->purify($_POST['Player']['name']):$nickname; //Save the nickname if the player didn't enter a name.
            $code = generatePassword();
            $hashed_code = Users::model()->hashPassword($code);
            
            if(Users::model()->checkPlayerExists($mail)){
                $user = Users::model()->findByAttributes(array('mail' => $mail));
                if($user->custom_password == 0){
                    //Don't reset the password in case a player has a custom one.
                    Users::model()->updateByPk($user->id, array('code' => $hashed_code));
                }
            }else{
                //If the player does not have a mail associated with the account create a new one.
                $user               = new Users();
                $user->mail         = $mail;
                $user->name         = $name;
                $user->code         = $hashed_code;
                $user->created_on   = (String)time();
                $user->save();
            }
            //I know this is kind of ugly but...it works. Im not sure what I was thinking when I wrote this.
            $model->attributes      = $_POST['Player'];
            $model->id_user         = $user->id;
            $model->nickname        = $nickname;
            $model->mail            = $user->mail;
            $model->id_safari_type  = (intval($_POST['Player']['id_safari_type']) != 0)?intval($_POST['Player']['id_safari_type']):null;
            $model->safari_slot_1   = isset($_POST['Player']['safari_slot_1'])?intval($_POST['Player']['safari_slot_1']):null;
            $model->safari_slot_2   = isset($_POST['Player']['safari_slot_2'])?intval($_POST['Player']['safari_slot_2']):null;
            $model->safari_slot_3   = isset($_POST['Player']['safari_slot_3'])?intval($_POST['Player']['safari_slot_3']):null;
            $model->tsv             = intval($_POST['Player']['tsv'] != 0)?intval($_POST['Player']['tsv']):null;
            $model->public_mail     = 0;
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
        ));
    }
     
    /**
    * Updates a particular model.
    * If update is successful, the browser will be redirected to the 'view' page.
    */
    public function actionUpdate()
    {
        $model = Player::model()->findByAttributes(array('id_user' => Yii::app()->user->id));
       
        if(isset($_POST['Player'])){
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
                    'code'  => $model->idUser->code,
                ));
            }
        }
            
        $this->render('update',array(
            'model' => $model,
        ));
    }


    /**
    * changes the player status
    * @param integer $id the ID of the model to be accepted or banned
    * @param integer $status the identifier of the new status of the player (as defined on the player module)
    */
    public function actionChangeStatus($jugador, $status)
    {
        Player::model()->updateByPk($jugador, array(
                'auth' => $status
        ));
        $this->redirect( array('authorize'));
    }

    /**
     *  This is the main view for the module. It is, essentialy, a modified default admin view.
     *  It shouws the player search view with all the accepted players on the application.
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
                    'pic_pokemon_1'         => ($safari)?'':$player->safariSlot1->species->image('moving'),
                    'pokemon_safari_2'      => ($safari)?'':$player->safariSlot2->pokemonName,
                    'pic_pokemon_2'         => ($safari)?'':$player->safariSlot2->species->image('moving'),
                    'pokemon_safari_3'      => ($safari)?'':$player->safariSlot3->pokemonName,
                    'pic_pokemon_3'         => ($safari)?'':$player->safariSlot3->species->image('moving'),
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