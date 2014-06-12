<?php

class PlayerController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';
    
    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id)
        ));
    }
    
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Player;
        $this->performAjaxValidation($model);
        $criteria=new CDbCriteria;
        $criteria->addCondition("id != 10001"); //Exclude unkown type
        $criteria->addCondition("id != 10002"); //Exlude shadow type
        $array_types        = CHtml::listData(Types::model()->findAll($criteria), 'id', 'typeName');
        $array_auth_mail    = array('0' => 'No', '1' => 'Sí');
        $array_tiers        = CHtml::listData(Tiers::model()->findAll($criteria), 'id', 'tierName');
        if (isset($_POST['Player'])) {
            $model->attributes = $_POST['Player'];
            echo "";
            /*if ($model->save())
                $this->redirect(array(
                    'view',
                    'id' => $model->id
                ));*/
        }
        
        $this->render('create', array(
            'model'             => $model,
            'array_types'       => $array_types,
            'array_auth_mail'   => $array_auth_mail,
            'array_tiers'       => $array_tiers,
        ));
    }
    
    
    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $criteria = new CDbCriteria(array(
            'condition' => 'auth !=' . Player::STATUS_BANNED
        ));
        
        $dataProvider = new CActiveDataProvider('Player', array(
            'criteria' => $criteria
        ));
        
        $this->render('index', array(
            'dataProvider' => $dataProvider
        ));
    }
    
    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Player('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Player']))
            $model->attributes = $_GET['Player'];
        
        $this->render('admin', array(
            'model' => $model
        ));
    }
    
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = Player::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }
    
    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'player-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
