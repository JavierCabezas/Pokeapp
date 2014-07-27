<?php

/**
 * This is the model class for table "pokemon_search_criteria".
 *
 * The followings are the available columns in table 'pokemon_search_criteria':
 * @property integer $id
 * @property integer $id_pokemon
 * @property integer $haircut
 * @property integer $clothes
 * @property integer $weird_sex
 * @property integer $object
 * @property integer $cute
 * @property integer $animal
 * @property integer $myth
 * @property integer $moustache
 * @property integer $hurr
 * @property integer $rough
 * @property integer $fluffy
 *
 * The followings are the available model relations:
 * @property Pokemon $idPokemon
 */
class PokemonSearchCriteria extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pokemon_search_criteria';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_pokemon', 'required'),
			array('id_pokemon, haircut, clothes, weird_sex, object, cute, animal, myth, moustache, hurr, rough, fluffy', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_pokemon, haircut, clothes, weird_sex, object, cute, animal, myth, moustache, hurr, rough, fluffy', 'safe', 'on'=>'search'),
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
			'idPokemon' => array(self::BELONGS_TO, 'Pokemon', 'id_pokemon'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_pokemon' => 'Id Pokemon',
			'haircut' => 'Haircut',
			'clothes' => 'Clothes',
			'weird_sex' => 'Weird Sex',
			'object' => 'Object',
			'cute' => 'Cute',
			'animal' => 'Animal',
			'myth' => 'Myth',
			'moustache' => 'Moustache',
			'hurr' => 'Hurr',
			'rough' => 'Rough',
			'fluffy' => 'Fluffy',
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
		$criteria->compare('id_pokemon',$this->id_pokemon);
		$criteria->compare('haircut',$this->haircut);
		$criteria->compare('clothes',$this->clothes);
		$criteria->compare('weird_sex',$this->weird_sex);
		$criteria->compare('object',$this->object);
		$criteria->compare('cute',$this->cute);
		$criteria->compare('animal',$this->animal);
		$criteria->compare('myth',$this->myth);
		$criteria->compare('moustache',$this->moustache);
		$criteria->compare('hurr',$this->hurr);
		$criteria->compare('rough',$this->rough);
		$criteria->compare('fluffy',$this->fluffy);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PokemonSearchCriteria the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	/**
	 *  Creates the entries for all the pokémon on the database. All the pokémon start as "false" with all parameters.
	 */
	public function ini(){
		$pokeymans = Pokemon::model()->findAll();
		/*foreach($pokeymans as $pokeyman){
			$model = new PokemonSearchCriteria;
			$model->id_pokemon 	= $pokeyman->id;
			$model->haircut		= false;
			$model->clothes		= false;
			$model->weird_sex	= false;
			$model->object		= false;
			$model->cute		= false;
			$model->animal		= false;
			$model->myth		= false;
			$model->moustache	= false;
			$model->hurr		= false;
			$model->rough		= false;
			$model->fluffy		= false;
			if($model->save())
				echo "<p> Added ".$pokeyman->identifier."</p>";
			else
				echo "<p> ERROR ON ".$pokeyman->identifier."</p>"; //wtf
		}*/
	}
}
