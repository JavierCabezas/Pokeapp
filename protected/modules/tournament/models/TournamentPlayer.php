<?php

/**
 * This is the model class for table "tournament_player".
 *
 * The followings are the available columns in table 'tournament_player':
 * @property integer $id
 * @property integer $id_user
 *
 * The followings are the available model relations:
 * @property TournamentPokemon[] $tournamentPokemons
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
			array('id_user', 'required'),
			array('id_user', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_user', 'safe', 'on'=>'search'),
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
				'id_user' => 'Id User',
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
		$criteria->compare('id_user',$this->id_user);

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

	/** 
	 *	Returns the number of players that have finished the online registration for an specific tournament and those who have selected pokémon but not the complete party of 6.
	 *	@param integer the identifier of the tournament.
	 *	@return integer array in the format $out['complete'] = players with 6 pokémon in their teams and $out['incomplete'] the players with more than 0 pokémon but less than 6.
	 *
	 *	@todo Do this in a intelligent way. Frankly I don't know how to do this decently.
	 */
	public function completePlayers($id_tournament)
	{
		$criteria=new CDbCriteria;
		$criteria->addCondition('folio > 0');
		$criteria->addCondition('id_tournament = '.$id_tournament);
		$players  = TournamentPlayerFolio::model()->findAll($criteria);
		
		$complete = 0;
		$between_one_and_four = 0;
		$exactly_four = 0;
		$other = 0;
		$zero = 0;

		foreach($players as $player){
			$pokenumber = $player->numberPokemon;
			if($pokenumber == 6)
				$complete = $complete +1;
			elseif(($pokenumber > 0)&&($pokenumber < 3))
				$between_one_and_four = $between_one_and_four + 1;
			elseif(($pokenumber == 4))
				$exactly_four = $exactly_four + 1;
			elseif($pokenumber == 0)
				$zero = $zero +1;
			else
				$other = $other +1;
		}
		$out = array();
		$out['complete'] 			 = $complete;
		$out['between_one_and_four'] = $between_one_and_four;
		$out['exactly_four']		 = $exactly_four;
		$out['other']				 = $other;
		$out['zero']			     = $zero;
		$out['folio_ok'] 			 = count($players);

		return $out;		
	}
}
