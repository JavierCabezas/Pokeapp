<?php

class JugadoresController extends Controller
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
    
    public function actionIndex()
    {
        $this->render('index');
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
            $avatar         = CUploadedFile::getInstance($model, 'avatar');
            $model->created = time();
            $model->code = md5(rand(0,100000).time());
            $model->public_mail = 0;
            if(isset($avatar)){
                $model->pic =  $avatar->extensionName;
            }
            if ($model->save()){
                    $link_form      = CHtml::link('formulario de modificación de perfil', $this->createAbsoluteUrl('jugadores/updateForm'));
                    $link_search    = CHtml::link('el buscador de jugadores', $this->createAbsoluteUrl('jugadores/buscador'));
                    $body =         '<p> Se acaba de crear un perfil de jugador en la Pokéapp. Recuerda que el perfil será puesto luego de que sea aceptado por alguno de nuestros administradores. </p>';
                    $body = $body . '<p> Además recuerda que  tu código secreto es <b>'.$model->code.'</b>. Si en cualquier momento quieres hacerle modificaciones a tu perfil puedes hacerlas con ese código en '.$link_form.'</p>';
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
                    'code'  => $model->code,
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
        if(!isset($_POST['mail'], $_POST['code']))
            throw new CHttpException(403, 'No estás autorizado a entrar a esta sección');
        $p = new CHtmlPurifier();
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
                    'code'  => $model->code,
                ));
            }
        }

        $this->render('update',array(
            'model'             => $model,
            'array_types'       => $array_types,
            'array_auth_mail'   => $array_auth_mail,
            'array_tiers'       => $array_tiers,
        ));
    }


    /**
    * Deletes a particular model.
    * If deletion is successful, the browser will be redirected to the 'admin' page.
    * @param integer $id the ID of the model to be deleted
    */
    public function actionDelete($id)
    {/*
        if(Yii::app()->request->isPostRequest){
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    */
    }

    /**
     *  Loads the form to send a new code to the player.
     *  
     */
    public function actionNuevoCodigo()
    {
        if(isset($_POST['mail'])){
            $p = new CHtmlPurifier();
            $mail = $p->purify($_POST['mail']);
            $model=Player::model()->find('mail=:mail',array(':mail'=>$mail));
            if(isset($model)){
                $model->code        = md5(rand(0,100000).time());
                if($model->save()){
                    $link_form = CHtml::link('formulario de modificación de perfil', $this->createAbsoluteUrl('jugadores/updateForm'));
                    $body = '<p> Se acaba de pedir un reseteo del código del buscador de jugadores de la Pokéapp a este correo. </p>';
                    $body = $body . ' <p> El nuevo código es <b>'.$model->code.'</b>.';
                    $body = $body . ' Para editar tu perfil debes de ingresar tu correo y el código en nuestro '.$link_form.' </p>';
                    $body = $body . ' <p> Si tu no hiciste esta petición puedes ignorar este correo. </p>';
                    $body = $body . ' <p> Muchas gracias por usar la Pokéapp!</p>';
                    Mail::sendMail( 
                        Yii::app()->params['adminEmail'], //from 
                        $model->mail, //to
                        'Nuevo código para edición de perfil', //subject
                        'Reseteo código Pokéapp', //mail_title
                        $body//mail body
                    );
                    Yii::app()->user->setFlash('success', "Se envió el correo a ".$model->mail." con éxito");
                }else{
                    Yii::app()->user->setFlash('error', "Ocurrió un error inesperado, por favor inténtalo nuevamente");
                }
            }else{
                Yii::app()->user->setFlash('error', "El correo ".$mail." no está registrado en nuestra base de datos ... ");
            }
        }
        $this->render('nuevoCodigo');
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
}