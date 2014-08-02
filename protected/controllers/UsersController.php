<?php

class UsersController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';
    
    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl' // perform access control for CRUD operations
        );
    }
    
    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array(
                'allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array(
					'resetCode',
                ),
                'users' => array(
                    '*'
                )
            ),
            array(
                'deny', // deny all users
                'users' => array(
                    '*'
                )
            )
        );
    }
    
            
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = TournamentPlayer::model()->findByPk($id);
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'tournament-player-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     *  Display the admin form to see the team of an specific player.
     */
    public function actionViewTeam(){

        $this->render('viewTeam');
    }
	
	/**
	 *	Displays the view to reset the password for an specific user.
	 *	In case if gets the POST of the form (with the mail) it sends the mail to the user with the instructions to reset the code.
	 */
	public function resetCode(){
		if(!isset($_POST)){

        }
        $this->render('resetCode');
	}
}
