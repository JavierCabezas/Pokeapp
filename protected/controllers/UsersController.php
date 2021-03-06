<?php

class UsersController extends Controller
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
                'allow', 
                'actions' => array(
					'resetCodeForm',
                    'resetCode',
                ),
                'users' => array(
                    '*'
                )
            ),
            array(
                'allow',
                'actions' => array(
                    'changePassword',
                    'changeMail',
                    'confirmMailChange'
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
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = TournamentPlayer::model()->findByPk($id);
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'tournament-player-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     *  Display the admin form to see the team of an specific player.
     */
    public function actionViewTeam(){

        $this->render('viewTeam');
    }
	
	/**
	 *	Displays the view to reset the password for an specific user.
	 *	In case if gets the POST of the form (with the mail) it sends the mail to the user with the instructions to reset the code.
	 */
	public function actionResetCodeForm(){
        
		if(isset($_POST['Users']['mail'])){
            $p = new CHtmlPurifier();
            $mail = $p->purify($_POST['Users']['mail']);
            $model= Users::model()->findByAttributes(array('mail' => $mail));
            if(isset($model)){
                $code = generatePassword();
                $hashedcode = Users::model()->hashPassword($code);
                if(Users::model()->updateByPk($model->id, array(
                        'mailcode' => $hashedcode,
                        'custom_password'   => 0
                    ))){
                    $link = $this->createAbsoluteUrl('/users/resetCode', array('mail' => $mail, 'code' => $hashedcode ));
                    $zelda = CHtml::link('en el siguiente link', $link);
                    $body = '<p> Se acaba de pedir un reseteo del contraseña de la Pokéapp a este correo.';
                    $body = $body . ' Para hacer efectivo el cambio tienes que hacer click '.$zelda.'.</p>';
                    $body = $body . '<p> Si tu no pediste un reseteo de contraseña puedes ignorar este correo </p>';
                    $body = $body . ' <p> Muchas gracias por usar la Pokéapp!</p>';
                    Mail::sendMail( 
                        Yii::app()->params['adminEmail'], //from 
                        $model->mail, //to
                        'Reseteo de clave Pokéapp', //subject
                        'Reseteo código Pokéapp', //mail_title
                        $body//mail body
                    );
                }
            }
            Yii::app()->user->setFlash('notice', "Se recibió el correo ".$mail." con éxito. En caso de que esté registrado en nuestra base de datos se envió un correo con las instrucciones respectivas.");
        }

        $model = new Users;
        if(Yii::app()->request->url == '/pokeapp/jugadores/resetearClave'){
            $module = 'Jugadores';
            $url = array('/jugadores');
        }else{
            $module = 'Torneo';
            $url = array('/torneo');
        }


        $this->render('resetCodeForm', array(
            'model'   => $model,
            'url'     => $url,
            'module'  => $module,  
        ));
	}

    /**
     *  Resets the password of a certain user.
     *  @param string mail the e-mail address asociated to the account
     *  @param string code the hashed code to check 
     */
    public function actionResetCode($mail, $code){
        $p = new CHtmlPurifier();
        $mail = $p->purify($mail);
        $code = $p->purify($code);

        $model = Users::model()->findByAttributes(array(
            'mail'      => $mail,
            'mailcode'  => $code
        ));

        if(isset($model)){
            $code = generatePassword();
            $hashedcode = Users::model()->hashPassword($code);
            if(Users::model()->updateByPk($model->id, array('code' => $hashedcode))){
                $body = '<p> Se acaba de realizar con éxito el reseteo de la clave de la Pokéapp asociada a esta cuenta de correo electrónico.';
                $body = $body . ' Tu nueva contraseña es <b> '.$code.' </p>';
                $body = $body . ' <p> Recuerda que, por razones de seguridad, nosotros no guardaremos esta contraseña por lo que te recomendamos guardar este correo en caso de que lo necesitaras en el futuro. </p>';
                $body = $body . ' <p> Muchas gracias por usar la Pokéapp! </p>';
                Mail::sendMail(
                    Yii::app()->params['adminEmail'], //from 
                    $model->mail, //to
                    'Nueva clave Pokéapp', //subject
                    'Nueva clave Pokéapp', //mail_title
                    $body//mail body
                );
            }

            Yii::app()->user->setFlash('success', "Se reseteó la contraseña con éxito. Se envió un correo con tu nueva clave a tu casilla.");
            $this->redirect(array('/site/login'));
        }else{
            Yii::app()->user->setFlash('error', "El link para reseteo de contraseña no es correcto.");
            $this->redirect(array('/site/index'));
        }
    }

    /**
     *  Renders the password change form for a logged in user. Its intended for a user that wants to use a custom password in the application.
     */
    public function actionChangePassword(){
        $model = new Users('changePassword');
        if(isset($_POST['Users'])){
            $model->attributes = $_POST['Users'];
            $user = Users::model()->findByAttributes(array('id'    => Yii::app()->user->id,));
            if(!$user->validatePassword($_POST['Users']['oldpassword'])){
                Yii::app()->user->setFlash('error', "La contraseña anterior no corresponde con la contraseña que tenemos registrada.");
            }else{
                if($model->validate()){  //Do the validation UPDATE: This is the most useless comment I've ever written. I'll just leave it there anyway.
                    $hashed_code = Users::model()->hashPassword($_POST['Users']['password']);                
                    if(Users::model()->updateByPk($user->id, array(
                        'code'              => $hashed_code,
                        'custom_password'   => 1
                        ))){
                        Yii::app()->user->setFlash('success', "Se realizó el cambio de contraseña con éxito.");
                    }else{
                        Yii::app()->user->setFlash('error', "Ocurrió un error al realizar el cambio de contraseña. Por favor inténtalo nuevamente.");
                    }
                }else
                var_dump($model->getErrors());
            }
        }
        
        $this->render('changePasswordForm', array(
            'model' => $model
        ));
    }

    /**
     *  Renders the mail change form for a logged in user. 
     */
    public function actionChangeMail(){
        $model = new Users('changeMail');
        if(isset($_POST['Users'])){
            $p      = new CHtmlPurifier();
            $mail   = $p->purify($_POST['Users']['mail_change']);
            $model->mail_change = $mail;
            
            if($model->validate()){
                $hashedcode = Users::model()->hashPassword(generatePassword());
                Yii::app()->user->setFlash('success', "Se recibió correctamente la dirección de correo ".$mail.". Se te envió un correo a esa dirección para finalizar el proceso.");
                Users::model()->updateByPk(Yii::app()->user->id, array(
                    'mail_change' => $mail,
                    'mailcode'    => $hashedcode
                ));

                $link =  CHtml::link('el siguiente link', $this->createAbsoluteUrl('usuario/confirmarCorreo', array('mail' => $mail, 'code' => $hashedcode))); 
                $body =         '<p> Alguien (probablemente tu) acaba de pedir un cambio del correo electrónico por defecto para el logeo de la pokéapp. </p>';
                $body = $body . '<p> Para poder hacer efectivo el cambio debes de hacer click en '.$link.'.</p>';
                $body = $body . '<p> Ante cualquier duda no dudes en contactarnos en '.Yii::app()->params['adminEmail'].'.</p>';
                Mail::sendMail(
                    Yii::app()->params['adminEmail'], //from 
                    $mail, //to
                    'Cambio de correo usuario pokéapp', //subject
                    'Cambio de correo', //mail_title
                    $body//mail body
                );
            }
        }
        $this->render('changeMailForm', array(
            'model' => $model
        ));
    }

    /**
     *  Actually does the mail change for a certain user.
     *  To do this it needs the new mail and the code given by the e-email sent by actionChangeMail.
     */
    public function actionConfirmMailChange($mail, $code){    
        $p      = new CHtmlPurifier();
        $mail   = $p->purify($mail);
        $code   = $p->purify($code);

        $model = Users::model()->findByAttributes(array(
            'mail_change' => $mail,
            'mailcode'    => $code
        ));
        $check_repeat_mail = Users::model()->findByAttributes(array(
            'mail' => $mail
        ));
        if(!isset($model)){
            Yii::app()->user->setFlash('error', "El link ingresado es inválido, no se realizó el cambio de correo. ");
        }else if(isset($check_repeat_mail)){
            $link = CHtml::link('en el siguiente link', array('/usuario/cambiarClave'));
            Yii::app()->user->setFlash('error', "El correo ingresado (".$mail.") ya está en uso por otro usuario. Si esa es tu cuenta puedes intentar realizar el reseteo de esa contraseña por medio ".$link);
        }else{
            if(Users::model()->updateByPk($model->id, array('mail_change' => null, 'mail' => $mail))){
                Yii::app()->user->setFlash('success', "Se realizó correctamente el cambio de correo.");
            }else{
                Yii::app()->user->setFlash('error', "Ocurrió un error inesperado. Por favor inténtalo nuevamente y si el error se repite contacta a nuestros administradores.");
            }
        }
        $this->redirect(array('/portada'));
    }
}
