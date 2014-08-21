<?php

/**
 * This is the model class for table "tournament_player_folio".
 *
 * The followings are the available columns in table 'tournament_player_folio':
 * @property integer $id
 * @property integer $id_tournament_player
 * @property integer $id_tournament
 * @property string $folio_photo
 * @property integer $folio
 *
 * The followings are the available model relations:
 * @property Users $idTournamentPlayer
 * @property Tournament $idTournament
 */
class TournamentPlayerFolio extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'tournament_player_folio';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_tournament_player, id_tournament, folio_photo', 'required'),
            array('id_tournament_player, id_tournament, folio', 'numerical', 'integerOnly'=>true),
            array('folio_photo', 'length', 'max'=>25),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, id_tournament_player, id_tournament, folio_photo, folio', 'safe', 'on'=>'search'),
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
            'idTournamentPlayer' => array(self::BELONGS_TO, 'Users', 'id_tournament_player'),
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
            'id_tournament_player' => 'Id Tournament Player',
            'id_tournament' => 'Id Tournament',
            'folio_photo' => 'Folio Photo',
            'folio' => 'Folio',
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
        $criteria->compare('id_tournament_player',$this->id_tournament_player);
        $criteria->compare('id_tournament',$this->id_tournament);
        $criteria->compare('folio_photo',$this->folio_photo,true);
        $criteria->compare('folio',$this->folio);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return TournamentPlayerFolio the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     *      Returns an array (intended for a drop down list) with the remaining folio numbers avaiable for an specific tournament
     *      @param integer $id_tournament the identifier of the tournament 
     *      @param integer $starting_from first folio number avaible for that specific tournament.
     *      @return array the array with the data using the format array('-1' => 'Ban player', 'n' => n, 'n+1' => n+1 ...)
     */
    public function getRemainingFolio($id_tournament, $starting_from = 1){
        $tournament         = Tournament::model()->findByPk($id_tournament);
        $tournament_folios  = TournamentPlayerFolio::model()->findAllByAttributes(array('id_tournament' => $id_tournament));
        
        $out = array();
        $out = range($starting_from-1, $starting_from + $tournament->total_folio_number);
        unset($out[0]); //Start array from 1, not from 0.
        
        foreach($tournament_folios as $tournament_folio){
            if( ($tournament_folio->folio != null) &&  ($tournament_folio->folio != -1) ){
                $key = array_search($tournament_folio->folio, $out);
                unset($out[$key]); //Remove folios that are already in use.
            }
        }
        $out = array(-1 => 'Rechazar jugador') + $out; //Prepend the ""
    
        return $out;
    }

    /**
     *  Returns an array (intended for a dropdownlist) with all the registered folios for an specific tournament.
     *  @param integer $id_tournament the identifier of the tournament.
     *  @return array all the registered folios in the format array('n' => n, 'n+1' => n+1 ...)
     */
    public function getAllFolio($id_tournament){
        $tournament_folios  = TournamentPlayerFolio::model()->findAllByAttributes(array('id_tournament' => $id_tournament));
        $out = array();
        foreach($tournament_folios as $tournament_folio){
            if( ($tournament_folio->folio != null) &&  ($tournament_folio->folio != -1) ){
                $out[$tournament_folio->folio] = $tournament_folio->folio. ' ('.$tournament_folio->idTournamentPlayer->name.', '.$tournament_folio->idTournamentPlayer->mail.')';
            }
        }
        ksort($out);
        return $out;
    }

    /**
     *  Returns the number of pokémon for the current player in the current tournament.
     *  @return integer exactly that.
     */
    public function getNumberPokemon(){
        return count(TournamentPlayerPokemon::model()->findAllByAttributes(array(
            'id_tournament_player'  => $this->id, 
            'id_tournament'         => $this->id_tournament
        )));
    }
}