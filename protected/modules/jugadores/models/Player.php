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
 * @property integer $safari_slot_1
 * @property integer $safari_slot_2
 * @property integer $safari_slot_3
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
 * @property string @created
 *
 * The followings are the available model relations:
 * @property Tiers $tierRotation
 * @property Types $idSafariType
 * @property Tiers $tierSingle
 * @property Tiers $tierDoble
 * @property Tiers $tierTriple
 * @property Pokemon $safariSlot1
 * @property Pokemon $safariSlot2
 * @property Pokemon $safariSlot3
 */
class Player extends CActiveRecord
{
	//Contants
	const STATUS_PENDING 	= 0;
	const STATUS_OK			= 1;
	const STATUS_BANNED 	= 2;


	//Variables for the search functions.
	public $search_nickname;
	public $search_safari;
	public $search_tsv;
	public $search_duel_single;
	public $search_duel_doble;
	public $search_duel_triple;
	public $search_duel_rotation;
	public $search_poke_1;
	public $search_poke_2;
	public $search_poke_3;
	

	public $avatar; //To store the avatar when creating the profile.
		

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
			array('nickname, friendcode_1, friendcode_2, friendcode_3, mail', 'required'),
			array('friendcode_1, friendcode_2, friendcode_3, id_safari_type, safari_slot_1, safari_slot_2, safari_slot_3, tsv, duel_single, tier_single, duel_doble, tier_doble, duel_triple, tier_triple, duel_rotation, tier_rotation, public_mail, auth', 'numerical', 'integerOnly'=>true),
			array('nickname, skype, whatsapp', 'length', 'max'=>30),
			array('created, code', 'length', 'max'=>32),
			array('tsv, friendcode_1, friendcode_2, friendcode_3', 'numerical', 'max' => 9999, 'min' => 1),
			array('avatar', 'file', 'types'=>'jpg,gif,png', 'allowEmpty' => true, 'maxSize'=>1024*1024, 'tooLarge'=>'El archivo tiene que ser menor a 1MB'), 
			array('name', 'length', 'max'=>80),
			array('mail', 'email'),
			array('mail', 'unique'),
			array('safari_slot_1','safariValidation','safari'=>'id_safari_type'), //Must pick a pokémon if the player picked a Safari.
			array('safari_slot_2','safariValidation','safari'=>'id_safari_type'), //Must pick a pokémon if the player picked a Safari.
			array('safari_slot_3','safariValidation','safari'=>'id_safari_type'), //Must pick a pokémon if the player picked a Safari.
			array('pic, facebook, mail, others', 'length', 'max'=>100),
			array('comment', 'length', 'max'=>999),
			array('search_nickname, search_safari, search_poke_1, search_poke_2, search_poke_3, search_tsv, search_duel_single, search_duel_doble, search_duel_triple, search_duel_rotation', 'safe', 'on'=>'search'),
		);
	}

	/*
	 * Does the conditional validation for the safari pokémon (if the player has chosen a safari it must pick the pokémon on them)
	 */
	public function safariValidation($attribute_name, $params)
	{
	    if (empty($this->$attribute_name) && !empty($this->$params['safari'])) {
	        $this->addError($attribute_name, Yii::t('user', "Si se elige un tipo de safari se tienen que elegir los pokémon de este"));
	        return false;
	    }
	    return true;
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
			'tierRotation' => array(self::BELONGS_TO, 'Tiers', 'tier_rotation'),
			'safariSlot1' => array(self::BELONGS_TO, 'Pokemon', 'safari_slot_1'),
			'safariSlot2' => array(self::BELONGS_TO, 'Pokemon', 'safari_slot_2'),
			'safariSlot3' => array(self::BELONGS_TO, 'Pokemon', 'safari_slot_3'),
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
			'pic' 			=> 'Foto de avatar',
			'friend_code' 	=> 'Código amigo',
			'friendcode_1' 	=> 'Código amigo 1',
			'friendcode_2' 	=> 'Código amigo 2',
			'friendcode_3' 	=> 'Código amigo 3',
			'id_safari_type'=> 'Tipo de Safari',
			'safari_slot_1' => 'Pokémon safari 1',
			'safari_slot_2' => 'Pokémon safari 2',
			'safari_slot_3' => 'Pokémon safari 3',
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
			'public_mail' 	=> '¿Autorizas a se publique tu correo electrónico en el buscador?',
			'others' 		=> 'Otras formas de contacto',
			'comment' 		=> 'Deja algún comentario para los que lean tu perfil...',
			'created'		=> 'Fecha de creación',
			'code'			=> 'Código',
			'auth' 			=> 'Auth',

			'search_nickname'		=> 'Nickname',
			'search_safari'			=> 'Tipo Safari',
			'search_tsv'			=> 'TSV',
			'search_duel_single'	=> 'Duelos single',
			'search_duel_doble'		=> 'Duelos doble',
			'search_duel_triple'	=> 'Duelos triple',
			'search_duel_rotation'	=> 'Duelos rotation',
			'search_poke_1'			=> 'Pókemon 1',
			'search_poke_2'			=> 'Pókemon 2',
			'search_poke_3'			=> 'Pókemon 3',
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
		$criteria=new CDbCriteria(array( //Just show aproved players.
            'condition' => 'auth =' . Player::STATUS_OK
        ));

        $criteria->with = array(
            'idSafariType',
        	'safariSlot1',
    		'safariSlot2',
			'safariSlot3',
        );

		$criteria->compare('nickname',$this->search_nickname,true);
		$criteria->compare('idSafariType.identifier', $this->search_safari, true);
		$criteria->compare('idSafariType.name_es', $this->search_safari, true, 'OR');
		$criteria->compare('safariSlot1.identifier',$this->search_poke_1,true);
		$criteria->compare('safariSlot2.identifier',$this->search_poke_2,true);
		$criteria->compare('safariSlot3.identifier',$this->search_poke_3,true);
		$criteria->compare('tsv',$this->search_tsv);
		switch (strlen($this->search_duel_single)) {
			case 0: //Show all results
				break;
			case 1: //Compare "n" with "no" and "s" with "si" (yes)
				if(strcasecmp($this->search_duel_single, 'n')==0){
					$criteria->compare('duel_single',0); break;}
				if(strcasecmp($this->search_duel_single, 's')==0){
					$criteria->compare('duel_single',1); break;}
			case 2:
				if(strcasecmp($this->search_duel_single,"no")==0){
					$criteria->compare('duel_single',0); break;}
				if(strcasecmp($this->search_duel_single,"si")==0||strcasecmp($this->search_duel_single,"sí")==0||strcasecmp($this->search_duel_single,"sÍ")==0){
					$criteria->compare('duel_single',1, '>'); break;}
			default: //Don't show anything.
				$criteria->compare('duel_single',2); break;
		}
		
		switch (strlen($this->search_duel_doble)) {
			case 0: 
				break;
			case 1:
				if(strcasecmp($this->search_duel_doble, 'n')==0){
					$criteria->compare('duel_doble',0); break;}
				if(strcasecmp($this->search_duel_doble, 's')==0){
					$criteria->compare('duel_doble',1); break;}
			case 2:
				if(strcasecmp($this->search_duel_doble,"no")==0){
					$criteria->compare('duel_doble',0); break;}
				if(strcasecmp($this->search_duel_doble,"si")==0||strcasecmp($this->search_duel_doble,"sí")==0||strcasecmp($this->search_duel_doble,"sÍ")==0){
					$criteria->compare('duel_doble',1, '>'); break;}
			default:
				$criteria->compare('duel_doble',2); break;
		}

		switch (strlen($this->search_duel_triple)) {
			case 0: 
				break;
			case 1:
				if(strcasecmp($this->search_duel_triple, 'n')==0){
					$criteria->compare('duel_triple',0); break;}
				if(strcasecmp($this->search_duel_triple, 's')==0){
					$criteria->compare('duel_triple',1); break;}
			case 2:
				if(strcasecmp($this->search_duel_triple,"no")==0){
					$criteria->compare('duel_triple',0); break;}
				if(strcasecmp($this->search_duel_triple,"si")==0||strcasecmp($this->search_duel_triple,"sí")==0||strcasecmp($this->search_duel_triple,"sÍ")==0){
					$criteria->compare('duel_triple',1, '>'); break;}
			default:
				$criteria->compare('duel_triple',2); break;
		}

		switch (strlen($this->search_duel_rotation)) {
			case 0: 
				break;
			case 1:
				if(strcasecmp($this->search_duel_rotation, 'n')==0){
					$criteria->compare('duel_rotation',0); break;}
				if(strcasecmp($this->search_duel_rotation, 's')==0){
					$criteria->compare('duel_rotation',1); break;}
			case 2:
				if(strcasecmp($this->search_duel_rotation,"no")==0){
					$criteria->compare('duel_rotation',0); break;}
				if(strcasecmp($this->search_duel_rotation,"si")==0||strcasecmp($this->search_duel_rotation,"sí")==0||strcasecmp($this->search_duel_rotation,"sÍ")==0){
					$criteria->compare('duel_rotation',1, '>'); break;}
			default:
				$criteria->compare('duel_rotation',2); break;
		}


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
