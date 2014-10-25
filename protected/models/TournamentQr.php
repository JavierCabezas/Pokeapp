<?php

/**
 * This is the model class for table "tournament_qr".
 *
 * The followings are the available columns in table 'tournament_qr':
 * @property integer $id
 * @property string $code
 * @property string $qr
 * @property string $expected_qr
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property TournamentPlayerFolio[] $tournamentPlayerFolios
 */
class TournamentQr extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tournament_qr';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, qr', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('code', 'length', 'max'=>15),
			array('qr, expected_qr', 'length', 'max'=>32),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, code, qr, expected_qr, status', 'safe', 'on'=>'search'),
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
			'tournamentPlayerFolios' => array(self::HAS_MANY, 'TournamentPlayerFolio', 'id_qr'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'code' => 'Code',
			'qr' => 'Qr',
			'expected_qr' => 'Expected Qr',
			'status' => 'Status',
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
		$criteria->compare('code',$this->code,true);
		$criteria->compare('qr',$this->qr,true);
		$criteria->compare('expected_qr',$this->expected_qr,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TournamentQr the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
