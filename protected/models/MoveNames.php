<?php

/**
 * This is the model class for table "move_names".
 *
 * The followings are the available columns in table 'move_names':
 * @property integer $id
 * @property integer $move_id
 * @property integer $local_language_id
 * @property string $name
 *
 * The followings are the available model relations:
 * @property Languages $localLanguage
 * @property Moves $move
 */
class MoveNames extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'move_names';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('move_id, local_language_id, name', 'required'),
			array('move_id, local_language_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>25),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, move_id, local_language_id, name', 'safe', 'on'=>'search'),
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
			'localLanguage' => array(self::BELONGS_TO, 'Languages', 'local_language_id'),
			'move' => array(self::BELONGS_TO, 'Moves', 'move_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'move_id' => 'Move',
			'local_language_id' => 'Local Language',
			'name' => 'Name',
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
		$criteria->compare('move_id',$this->move_id);
		$criteria->compare('local_language_id',$this->local_language_id);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MoveNames the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
