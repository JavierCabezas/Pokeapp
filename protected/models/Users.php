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
			array('name, mail', 'required'),
			array('folio', 'file', 'types'=>'jpg,gif,png', 'allowEmpty' => false, 'maxSize'=>1024*1024*2, 'tooLarge'=>'El archivo tiene que ser menor a 2MB'),
			array('name', 'length', 'max'=>80),
			array('mail', 'length', 'max'=>100),
			array('mail', 'email'),
			array('mail', 'unique'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, code, created_on', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'name' => 'Nombre',
			'mail' => 'Correo',
			'code' => 'Code',
			'mailcode' => 'Mailcode',
			'created_on' => 'Created On',
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
	 */
    public function validatePassword($password)
    {
        return CPasswordHelper::verifyPassword($password,$this->code);
    }
 
}
