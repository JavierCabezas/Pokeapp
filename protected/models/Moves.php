<?php

/**
 * This is the model class for table "moves".
 *
 * The followings are the available columns in table 'moves':
 * @property integer $id
 * @property string $identifier
 * @property integer $generation_id
 * @property integer $type_id
 * @property integer $power
 * @property integer $pp
 * @property integer $accuracy
 * @property integer $priority
 * @property integer $target_id
 * @property integer $damage_class_id
 * @property integer $effect_id
 * @property integer $effect_chance
 *
 * The followings are the available model relations:
 * @property MoveNames[] $moveNames
 * @property Generations $generation
 * @property Types $type
 * @property MoveTargets $target
 * @property MoveEffects $effect
 * @property MoveDamageClasses $damageClass
 * @property PokemonMoves[] $pokemonMoves
 */
class Moves extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'moves';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('identifier, generation_id, type_id', 'required'),
			array('generation_id, type_id, power, pp, accuracy, priority, target_id, damage_class_id, effect_id, effect_chance', 'numerical', 'integerOnly'=>true),
			array('identifier', 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, identifier, generation_id, type_id, power, pp, accuracy, priority, target_id, damage_class_id, effect_id, effect_chance', 'safe', 'on'=>'search'),
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
			'moveNames' => array(self::HAS_MANY, 'MoveNames', 'move_id'),
			'generation' => array(self::BELONGS_TO, 'Generations', 'generation_id'),
			'type' => array(self::BELONGS_TO, 'Types', 'type_id'),
			'target' => array(self::BELONGS_TO, 'MoveTargets', 'target_id'),
			'effect' => array(self::BELONGS_TO, 'MoveEffects', 'effect_id'),
			'damageClass' => array(self::BELONGS_TO, 'MoveDamageClasses', 'damage_class_id'),
			'pokemonMoves' => array(self::HAS_MANY, 'PokemonMoves', 'move_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'identifier' => 'Identifier',
			'generation_id' => 'Generation',
			'type_id' => 'Type',
			'power' => 'Power',
			'pp' => 'Pp',
			'accuracy' => 'Accuracy',
			'priority' => 'Priority',
			'target_id' => 'Target',
			'damage_class_id' => 'Damage Class',
			'effect_id' => 'Effect',
			'effect_chance' => 'Effect Chance',
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
		$criteria->compare('identifier',$this->identifier,true);
		$criteria->compare('generation_id',$this->generation_id);
		$criteria->compare('type_id',$this->type_id);
		$criteria->compare('power',$this->power);
		$criteria->compare('pp',$this->pp);
		$criteria->compare('accuracy',$this->accuracy);
		$criteria->compare('priority',$this->priority);
		$criteria->compare('target_id',$this->target_id);
		$criteria->compare('damage_class_id',$this->damage_class_id);
		$criteria->compare('effect_id',$this->effect_id);
		$criteria->compare('effect_chance',$this->effect_chance);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Moves the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 *	Returns the name of the move with capitalization, spacing and with the spanish name in parenthesis.
	 *  Ex: Calm Mind (Paz mental) instead of calm-mind.
	 *	@return string the name of the move.
	 */
	public function getMoveName()
	{
		$spanish = 7;
		$move = MoveNames::model()->findByAttributes(array('move_id' => $this->id, 'local_language_id' => $spanish));
		if(isset($move))
			return beautify($this->identifier)." (".utf8_decode(beautify($move->name)).")";
		else
			return beautify($this->identifier);
	}
}
