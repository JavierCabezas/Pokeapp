<?php

/**
 * This is the model class for table "player".
 *
 * The followings are the available columns in table 'player':
 * @property integer $id
 * @property string $nickname
 * @property string $name
 * @property integer $friendcode_1
 * @property integer $friendcode_2
 * @property integer $friendcode_3
 * @property integer $id_safari_type
 * @property integer $tsv
 * @property string $skype
 * @property string $whatsapp
 * @property string $facebook
 * @property string $mail
 * @property string $others
 * @property string $comment
 * @property integer $auth
 *
 * The followings are the available model relations:
 * @property Types $idSafariType
 * @property PlayerPokemon[] $playerPokemons
 */
class Player extends CActiveRecord
{
	//Variables for the auth variable.
	public $created = 0;
	public $allowed = 1;
	public $banned  = 2;

	public $created 
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'player';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nickname, friendcode_1, friendcode_2, friendcode_3, id_safari_type, tsv', 'required'),
			array('friendcode_1, friendcode_2, friendcode_3, id_safari_type, tsv, auth', 'numerical', 'integerOnly'=>true),
			array('nickname, skype, whatsapp', 'length', 'max'=>30),
			array('name', 'length', 'max'=>80),
			array('facebook, mail, others', 'length', 'max'=>100),
			array('comment', 'length', 'max'=>999),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nickname, name, friendcode_1, friendcode_2, friendcode_3, id_safari_type, tsv, skype, whatsapp, facebook, mail, others, comment, auth', 'safe', 'on'=>'search'),
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
			'idSafariType' => array(self::BELONGS_TO, 'Types', 'id_safari_type'),
			'playerPokemons' => array(self::HAS_MANY, 'PlayerPokemon', 'id_player'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nickname' => 'Nick',
			'name' => 'Nombre',
			'friendcode_1' => 'Código amigo 1',
			'friendcode_2' => 'Código amigo 2',
			'friendcode_3' => 'Código amigo 3',
			'id_safari_type' => 'Tipo Safari',
			'tsv' => 'TSV',
			'skype' => 'Skype',
			'whatsapp' => 'Whatsapp',
			'facebook' => 'Facebook',
			'mail' => 'Mail',
			'others' => 'Others',
			'comment' => 'Comment',
			'auth' => 'Auth',
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
		$criteria->compare('nickname',$this->nickname,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('friendcode_1',$this->friendcode_1);
		$criteria->compare('friendcode_2',$this->friendcode_2);
		$criteria->compare('friendcode_3',$this->friendcode_3);
		$criteria->compare('id_safari_type',$this->id_safari_type);
		$criteria->compare('tsv',$this->tsv);
		$criteria->compare('skype',$this->skype,true);
		$criteria->compare('whatsapp',$this->whatsapp,true);
		$criteria->compare('facebook',$this->facebook,true);
		$criteria->compare('mail',$this->mail,true);
		$criteria->compare('others',$this->others,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('auth',$this->auth);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Player the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
