<?php

/**
 * This is the model class for table "tournament_player".
 *
 * The followings are the available columns in table 'tournament_player':
 * @property integer $id
 * @property string $nombre
 * @property string $mail
 * @property string $code
 *
 * The followings are the available model relations:
 * @property TournamentPlayerFolio[] $tournamentPlayerFolios
 * @property TournamentPlayerIn[] $tournamentPlayerIns
 * @property TournamentPlayerPokemon[] $tournamentPlayerPokemons
 */
class TournamentPlayer extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tournament_player';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, mail, code', 'required'),
			array('nombre, mail', 'length', 'max'=>100),
			array('code', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, mail, code', 'safe', 'on'=>'search'),
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
			'tournamentPlayerFolios' => array(self::HAS_MANY, 'TournamentPlayerFolio', 'id_tournament_player'),
			'tournamentPlayerIns' => array(self::HAS_MANY, 'TournamentPlayerIn', 'id_tournament_player'),
			'tournamentPlayerPokemons' => array(self::HAS_MANY, 'TournamentPlayerPokemon', 'id_tournament_player'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombre' => 'Nombre',
			'mail' => 'Mail',
			'code' => 'Code',
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
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('mail',$this->mail,true);
		$criteria->compare('code',$this->code,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TournamentPlayer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
