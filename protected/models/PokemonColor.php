<?php

/**
 * This is the model class for table "pokemon_color".
 *
 * The followings are the available columns in table 'pokemon_color':
 * @property integer $id
 * @property string $color
 *
 * The followings are the available model relations:
 * @property PokemonSpecies[] $pokemonSpecies
 */
class PokemonColor extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pokemon_color';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('color', 'required'),
			array('color', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, color', 'safe', 'on'=>'search'),
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
			'pokemonSpecies' => array(self::HAS_MANY, 'PokemonSpecies', 'color_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'color' => 'Color',
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
		$criteria->compare('color',$this->color,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PokemonColor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	*	Returns the pokémon color with correct capitalization and the spanish name in () . (Example: Black (negro) instead of black)
	*	@return string the name of the color.
	*/
	public function getColorName()
	{
		$out = beautify($this->color);
		switch($this->id){
			case 1:
				return $out . '(negro)';
			case 2:
				return $out . '(azul)';
			case 3:
				return $out . '(café)';
			case 4:
				return $out . '(griz)';
			case 5:
				return $out . '(green)';
			case 6:
				return $out . '(pink)';
			case 7:
				return $out . '(purple)';
			case 8:
				return $out . '(red)';
			case 9:
				return $out . '(blanco)';
			case 10:
				return $out . '(rosa)';
		}
	}

	/** 
	 *	Returns the color list intended for a dropdown.
	 *	This function is hand made but, since the colors aren't likely to change, I consider this way the correct way to do it.
	 *	@return array in the format of a listData function for the color class.
	 */
	public function dropdownColor()
	{
		return array('1' => 'Black (negro)', '2' => 'Blue (azul)', '3' => 'Brown (café)', 	 '4' => 'Gray (griz)', 
					 '5' => 'Green (verde)', '6' => 'Pink (rosa)', '7' => 'Purple (morado)', '8' => 'Red (rojo)', 
					 '9' => 'White (blanco)', '10' => 'Yellow (amarillo)');
	}
}
