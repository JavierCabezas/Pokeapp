<?php

/**
 * This is the model class for table "pokemon_shapes".
 *
 * The followings are the available columns in table 'pokemon_shapes':
 * @property integer $id
 * @property string $identifier
 *
 * The followings are the available model relations:
 * @property PokemonSpecies[] $pokemonSpecies
 */
class PokemonShapes extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pokemon_shapes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('identifier', 'required'),
			array('identifier', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, identifier', 'safe', 'on'=>'search'),
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
			'pokemonSpecies' => array(self::HAS_MANY, 'PokemonSpecies', 'shape_id'),
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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PokemonShapes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	*	Returns the shape with correct capitalization. (Example: humanshape Humanoid of humanoid)
	*	@return string the name of the color.
	*/
	public function getShapeName()
	{
		return beautify($this->identifier);
	}

	/** 
	 *	Returns the Pokémon shape list, intended for a dropdown 
	 *	@return array of the listdata of the PokemonShape model.
	 */
	public function dropdownShapes()
	{
        $model = PokemonShapes::model()->findAll();
        return CHtml::listData($model, 'id', 'shapeName');
    }  
}
