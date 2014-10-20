<?php

/**
 * This is the model class for table "tournament".
 *
 * The followings are the available columns in table 'tournament':
 * @property integer $id
 * @property integer $id_ruleset
 * @property string $name
 * @property string $date
 * @property integer $total_folio_number
 * @property ineger $folio_starting_from
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property TournamentRuleset $idRuleset
 * @property TournamentPlayerFolio[] $tournamentPlayerFolios
 * @property TournamentPlayerIn[] $tournamentPlayerIns
 * @property TournamentPlayerPokemon[] $tournamentPlayerPokemons
 */
class Tournament extends CActiveRecord
{
	public $photo_folio_upload;
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tournament';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, date', 'required', 'on' => 'create'),
			array('id_ruleset, total_folio_number, folio_starting_from, active', 'numerical', 'integerOnly'=>true),
            array('photo_folio_upload', 'file', 'allowEmpty'=>false, 'safe'=>true, 'types'=>'jpg,png,gif', 'on' => 'uploadPhoto', 'message' => 'Se debe de subir una foto en formato jpg, png o gif.'),
			array('name', 'length', 'max'=>30),
			array('date', 'length', 'max'=>32),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_ruleset, name, date, total_folio_number, active', 'safe', 'on'=>'search'),
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
			'idRuleset' => array(self::BELONGS_TO, 'TournamentRuleset', 'id_ruleset'),
			'tournamentPlayerFolios' => array(self::HAS_MANY, 'TournamentPlayerFolio', 'id_tournament'),
			'tournamentPlayerIns' => array(self::HAS_MANY, 'TournamentPlayerIn', 'id_tournament'),
			'tournamentPlayerPokemons' => array(self::HAS_MANY, 'TournamentPlayerPokemon', 'id_tournament'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_ruleset' => 'Id Ruleset',
			'name' => 'Name',
			'date' => 'Date',
			'total_folio_number' => 'Total Folio Number',
			'folio_starting_from' => 'Folio parte en',
			'active' => 'Active',
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
		$criteria->compare('id_ruleset',$this->id_ruleset);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('total_folio_number',$this->total_folio_number);
		$criteria->compare('folio_starting_from', $this->folio_starting_from);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tournament the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 *	Returns the model of the next tournament (in case it exists)
	 *	@return Tournament model of the next tournament (in case it exists)
	 */
	public function getNextTournament(){
		return Tournament::model()->findByAttributes(array('active' => 1));
	}

    /**
     *  Returns the number of confirmed players for this tournament.
     *  @return integer the number of confirmed player (that means, that have a value of folio assgined) for that particular tournament.
     */
    public function getNumberPlayers(){
        $criteria=new CDbCriteria;
        $criteria->addCondition('folio > 0');
        $criteria->addCondition('id_tournament = '.$this->id);
        return count(TournamentPlayerFolio::model()->findAll($criteria));
    }
}
