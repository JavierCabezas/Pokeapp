<?php

/**
 * This is the model class for table "tournament_player_in".
 *
 * The followings are the available columns in table 'tournament_player_in':
 * @property integer $id
 * @property integer $id_tournament
 * @property integer $id_tournament_player
 *
 * The followings are the available model relations:
 * @property TournamentPlayer $idTournamentPlayer
 * @property Tournament $idTournament
 */
class TournamentPlayerIn extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tournament_player_in';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_tournament, id_tournament_player', 'required'),
			array('id_tournament, id_tournament_player', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_tournament, id_tournament_player', 'safe', 'on'=>'search'),
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
			'idTournamentPlayer' => array(self::BELONGS_TO, 'TournamentPlayer', 'id_tournament_player'),
			'idTournament' => array(self::BELONGS_TO, 'Tournament', 'id_tournament'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_tournament' => 'Id Tournament',
			'id_tournament_player' => 'Id Tournament Player',
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
		$criteria->compare('id_tournament',$this->id_tournament);
		$criteria->compare('id_tournament_player',$this->id_tournament_player);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TournamentPlayerIn the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
