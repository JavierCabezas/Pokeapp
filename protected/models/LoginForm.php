<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
	public $username;
	public $password;
	public $rememberMe;
	public $correo;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password', 'required'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// password needs to be authenticated
			array('password', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe' =>'Recordarme la próxima vez',
			'correo' 	 => 'Correo electrónico',
			'username' 	 => 'Correo electrónico',
			'password'	 => 'Código (contraseña)'
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
        if(!$this->hasErrors())
        {
            $this->_identity=new UserIdentity($this->username,$this->password);
            if(!$this->_identity->authenticate())
            {
                if($this->_identity->errorCode == 1 )
                    $this->addError('password',Yii::t('zii','El correo ingresado no está registrado en nuestra base de datos'));
                elseif($this->_identity->errorCode == 2 )
                    $this->addError('password',Yii::t('zii','Error con la contraseña'));
                elseif($this->_identity->errorCode == 3 )
                    $this->addError('password',Yii::t('zii','El correo no está activado en el sitio. Por favor revisa el código que te enviamos por correo o '.CHtml::link('solicita que se te envie otro','',array('submit'=>array('site/CodigoEmail'),'params'=>array('email'=>$this->username))).'.'));
                else
                    $this->addError('username',Yii::t('zii','Exepción inválida'));
            }
        }
    }


	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}
}
