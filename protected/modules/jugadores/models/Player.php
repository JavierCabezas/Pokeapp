<?php

/**
 * This is the model class for table "player".
 *
 * The followings are the available columns in table 'player':
 * @property integer $id
 * @property integer $id_user
 * @property string $nickname
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
 * @property integer $public_mail
 * @property string $others
 * @property string $comment
 * @property integer $auth
 * @property string @created
 * @property string $modified
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
 * @property Users $idUser
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
	public $mail; //For the Users module.
	public $name;

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
		return array(
			array('id_user, nickname, friendcode_1, friendcode_2, friendcode_3', 'required'),
			array('mail', 'required', 'on' => array('create')),
			array('id_user, friendcode_1, friendcode_2, friendcode_3, id_safari_type, safari_slot_1, safari_slot_2, safari_slot_3, tsv, duel_single, tier_single, duel_doble, tier_doble, duel_triple, tier_triple, duel_rotation, tier_rotation, public_mail, auth', 'numerical', 'integerOnly'=>true),
			array('nickname, skype, whatsapp', 'length', 'max'=>30),
			array('created', 'length', 'max'=>32),
			array('tsv, friendcode_1, friendcode_2, friendcode_3', 'numerical', 'max' => 9999, 'min' => 1),
			array('avatar', 'file', 'types'=>'jpg,gif,png', 'allowEmpty' => true, 'maxSize'=>1024*1024*2, 'tooLarge'=>'El archivo tiene que ser menor a 2MB'), 
			array('name', 'length', 'max'=>80),
			array('mail', 'email'),
			array('id_user', 'unique', 'message' => 'El correo ingresado ya está registrado en nuestra base de datos. Si deseas logearte puedes hacerlo '.CHtml::link('en el siguiente link', array('/jugadores/actualizar')).'.' ),
			array('safari_slot_1, safari_slot_2, safari_slot_3','safariValidation','safari'=>'id_safari_type'), //Must pick a pokémon if the player picked a Safari.
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
	        $this->addError($attribute_name, Yii::t('user', "Si se elige un tipo de safari se tienen que elegir los Pokémon de este"));
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
			'idUser' => array(self::BELONGS_TO, 'Users', 'id_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' 			=> 'ID',
			'id_user' 		=> 'Id User',
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
			'auth' 			=> 'Auth',
			'created' 		=> 'Created',
			'modified' 		=> 'Modified',

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
		$criteria->compare('duel_single',$this->search_duel_single);
		$criteria->compare('duel_doble',$this->search_duel_doble);
		$criteria->compare('duel_triple',$this->search_duel_triple);
		$criteria->compare('duel_rotation',$this->search_duel_rotation);

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

	/**
	 *	Checks if a certain user has a created profile on the players module.
	 *	@param itneger id_player the identifier of the player to check. This parameter is optional.
	 *	In case a id_player value isn't passed and the user is logged in the id of that user is used instead. If its not logged it returns false.
	 *	@return bool true in case the player has a profile and false otherwise.
	 */
	public function hasProfile($id_player = null){
		if(is_null($id_player)){
			if(isset(Yii::app()->user->id)){
				$id_player = Yii::app()->user->id;
			}else{
				return false;
			}
		}
		$model = Player::model()->findByAttributes(array('id_user' => $id_player));
		return isset($model);
	}
}
