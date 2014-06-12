<?php

/**
 * This is the model class for table "Player".
 *
 * The followings are the available columns in table 'Player':
 * @property integer $id
 * @property string $nickname
 * @property string $name
 * @property string $pic
 * @property integer $friendcode_1
 * @property integer $friendcode_2
 * @property integer $friendcode_3
 * @property integer $id_safari_type
 * @property integer $tsv
 * @property integer $duel_single
 * @property integer $tier_single
 * @property integer $duel_doble
 * @property integer $tier_doble
 * @property integer $duel_triple
 * @property integer $tier_triple
 * @property integer $duel_rotation
 * @property integer $tier_rotation
 * @property string $skype
 * @property string $whatsapp
 * @property string $facebook
 * @property string $mail
 * @property integer $public_mail
 * @property string $others
 * @property string $comment
 * @property integer $auth
 *
 * The followings are the available model relations:
 * @property Tiers $tierRotation
 * @property Types $idSafariType
 * @property Tiers $tierSingle
 * @property Tiers $tierDoble
 * @property Tiers $tierTriple
 * @property PlayerPokemon[] $playerPokemons
 */
class Player extends CActiveRecord
{
	public $avatar;
	const STATUS_PENDING 	= 0;
	const STATUS_OK			= 1;
	const STATUS_BANNED 	= 2;
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Player';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('nickname, friendcode_1, friendcode_2, friendcode_3, mail, public_mail', 'required'),
			array('friendcode_1, friendcode_2, friendcode_3, id_safari_type, tsv, duel_single, tier_single, duel_doble, tier_doble, duel_triple, tier_triple, duel_rotation, tier_rotation, public_mail, auth', 'numerical', 'integerOnly'=>true),
			array('nickname, skype, whatsapp', 'length', 'max'=>30),
			array('tsv, friendcode_1, friendcode_2, friendcode_3', 'numerical', 'max' => 9999, 'min' => 1),
			array('avatar', 'file', 'types'=>'jpg,gif,png', 'allowEmpty' => true, 'maxSize'=>1024*1024, 'tooLarge'=>'El archivo tiene que ser menor a 1MB'), 
			array('name', 'length', 'max'=>80),
			array('mail', 'email'),
			array('mail', 'unique'),
			array('pic, facebook, mail, others', 'length', 'max'=>100),
			array('comment', 'length', 'max'=>999),
			array('id, nickname, name, friendcode_1, friendcode_2, friendcode_3, id_safari_type, tsv, duel_single, tier_single, duel_doble, tier_doble, duel_triple, tier_triple, duel_rotation, tier_rotation, skype, whatsapp, facebook, mail, public_mail, others, comment, auth', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'tierRotation' => array(self::BELONGS_TO, 'Tiers', 'tier_rotation'),
			'idSafariType' => array(self::BELONGS_TO, 'Types', 'id_safari_type'),
			'tierSingle' => array(self::BELONGS_TO, 'Tiers', 'tier_single'),
			'tierDoble' => array(self::BELONGS_TO, 'Tiers', 'tier_doble'),
			'tierTriple' => array(self::BELONGS_TO, 'Tiers', 'tier_triple'),
			'playerPokemons' => array(self::HAS_MANY, 'PlayerPokemon', 'id_player'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' 			=> 'ID',
			'nickname' 		=> 'Nickname (sobrenombre)',
			'name' 			=> 'Nombre real',
			'pic' 			=> 'Foto',
			'friendcode_1' 	=> 'Código amigo 1',
			'friendcode_2' 	=> 'Código amigo 2',
			'friendcode_3' 	=> 'Código amigo 3',
			'id_safari_type'=> 'Tipo de Safari',
			'tsv' 			=> 'TSV',
			'duel_single' 	=> 'Duelos single',
			'tier_single' 	=> 'Tier Single',
			'duel_doble' 	=> 'Duelos dobles',
			'tier_doble' 	=> 'Tier Doble',
			'duel_triple' 	=> 'Duelos triples',
			'tier_triple' 	=> 'Tier Triple',
			'duel_rotation' => 'Duelos rotación',
			'tier_rotation' => 'Tier Rotation',
			'skype' 		=> 'Skype',
			'whatsapp' 		=> 'Whatsapp',
			'facebook' 		=> 'Facebook',
			'mail' 			=> 'Correo electrónico',
			'public_mail' 	=> '¿Autorizas a se publique tu correo electrónico?',
			'others' 		=> 'Otros',
			'comment' 		=> 'Deja algún comentario para los que lean tu perfil...',
			'auth' 			=> 'Auth',
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
		$criteria->compare('duel_single',$this->duel_single);
		$criteria->compare('tier_single',$this->tier_single);
		$criteria->compare('duel_doble',$this->duel_doble);
		$criteria->compare('tier_doble',$this->tier_doble);
		$criteria->compare('duel_triple',$this->duel_triple);
		$criteria->compare('tier_triple',$this->tier_triple);
		$criteria->compare('duel_rotation',$this->duel_rotation);
		$criteria->compare('tier_rotation',$this->tier_rotation);
		$criteria->compare('skype',$this->skype,true);
		$criteria->compare('whatsapp',$this->whatsapp,true);
		$criteria->compare('facebook',$this->facebook,true);
		$criteria->compare('mail',$this->mail,true);
		$criteria->compare('public_mail',$this->public_mail);
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
