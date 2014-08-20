<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $name
 * @property string $mail
 * @property string $code
 * @property string $mailcode
 * @property string $created_on
 *
 * The followings are the available model relations:
 * @property Player[] $players
 * @property TournamentPlayerFolio[] $tournamentPlayerFolios
 * @property TournamentPlayerIn[] $tournamentPlayerIns
 * @property TournamentPlayerPokemon[] $tournamentPlayerPokemons
 * @property TournamentPokemon[] $tournamentPokemons
 */
class Users extends CActiveRecord
{
	public $folio;
	public $oldpassword;
	public $password;
	public $repeatpassword;
	public $mail_change;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mail_change', 'required', 'on' => 'changeMail'), //For the changeMail action we just need the new mail.
			array('name, mail', 'required', 'except' => 'changePassword, changeMail'),
			array('oldpassword, password, repeatpassword', 'required', 'on' => 'changePassword'),
			array('password, oldpassword, repeatpassword', 'length', 'max'=>100),
            array('repeatpassword', 'compare', 'compareAttribute'=>'password', 'on' => array('changePassword'), 'message'=>"Las contraseñas no coinciden"),
			array('folio', 'file', 'types'=>'jpg,gif,png', 'allowEmpty' => true, 'maxSize'=>1024*1024*2, 'tooLarge'=>'El archivo tiene que ser menor a 2MB'),
			array('name', 'length', 'max'=>80),
			array('mail, mail_change', 'length', 'max'=>100),
			array('mail, mail_change', 'email'),
			array('mail', 'unique'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'players' => array(self::HAS_MANY, 'Player', 'id_user'),
			'tournamentPlayerFolios' => array(self::HAS_MANY, 'TournamentPlayerFolio', 'id_tournament_player'),
			'tournamentPlayerIns' => array(self::HAS_MANY, 'TournamentPlayerIn', 'id_tournament_player'),
			'tournamentPlayerPokemons' => array(self::HAS_MANY, 'TournamentPlayerPokemon', 'id_tournament_player'),
			'tournamentPokemons' => array(self::HAS_MANY, 'TournamentPokemon', 'id_tournament_player'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' 			 => 'ID',
			'name' 			 => 'Nombre',
			'mail' 			 => 'Correo',
			'mail_change'    => 'Nuevo correo',
			'code' 			 => 'Code',
			'mailcode' 		 => 'Mailcode',
			'created_on' 	 => 'Created On',
			'password'		 => 'Nueva contraseña',
			'oldpassword'	 => 'Contraseña actual',
			'repeatpassword' => 'Nueva contraseña (confirmación)'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('created_on',$this->created_on);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

 	/**
 	 *	Hashes (encrypts) the password given by argument. Its inteded to be checked later with the validatePassword method.
 	 *	@param password the password to be hashed.
 	 *	@return string(128) the hashed password. 
 	 */
    public function hashPassword($password)
    {
        return CPasswordHelper::hashPassword($password);
    }

	/** 
	 *	Validates the password given by argument. Its intended to be used with componets/UserIdentity.php
	 *	@param string $password the password to be verified
	 *	@return boolean if the password given by argument matches the one saved on this particular object.
	 *	Since most of the login attempts are going to be from copying the password from the email, and its really easy to copy an extra space,
	 *  it checks the password both with and without spaces. 
	 */
    public function validatePassword($password)
    {
        return CPasswordHelper::verifyPassword($password,$this->code)||CPasswordHelper::verifyPassword(str_replace(' ', '', $password),$this->code);
    }
 	
 	/**
 	 *	Check if the mail passed by argument exists on the user database.
	 *	@param string $mail the e-mail to check in the database.
 	 *	@return bool true in case the player exists and false otherwise.
 	 */
 	public function checkPlayerExists($mail)
 	{
 		$player = Users::model()->findByAttributes(array('mail' => $mail));
 		return isset($player->id);
 	}
}