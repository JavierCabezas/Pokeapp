<?php

class TournamentPlayerController extends Controller
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
                    'create',
                    'view'
                ),
                'users' => array(
                    '*'
                )
            ),
            array(
                'allow',
                'actions' => array(
                    'view',
                ),
                'users' => array(
                    '@'
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
     * Displays the confirmation for the profile creation (that rhymes!)
     * @param string $id the mail of the account.
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'mail' => $id
        ));
    }
    
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new TournamentPlayer;       
        $next_tournament = Tournament::model()->findByAttributes(array('active' => 1));

        if (isset($_POST['TournamentPlayer'])) {
            $folio         = CUploadedFile::getInstance($model, 'folio');
            $model->attributes = $_POST['TournamentPlayer'];
            $code = generatePassword();
            $model->code = hash('sha512', $code);
            if ($model->save()){

                $playerFolio = new TournamentPlayerFolio();
                $id_tournament                      = 1; //TODO: FIX THIS
                $playerFolio->folio_photo           =  $id_tournament . "_" . $model->id . "." . $folio->extensionName;
                $playerFolio->id_tournament         = $id_tournament;
                $playerFolio->id_tournament_player  = $model->id;
                if($playerFolio->save())
                    $folio->saveAs('./images/foto_folio/'. $playerFolio->folio_photo);

                $body =         '<p> Se acaba de crear tu perfil de usuario en la pokéapp asociada a esta cuenta de correo electrónico. </p>';
                $body = $body . '<p> Tu perfil será revisado por un administrador de la comunidad (por el asunto del folio de la entrada) y, una vez que este lo haya autorizado, 
                                     se te avisará por este mismo medio para que puedas inscribir a tu equipo.</p>';
                $body = $body . '<p> Tu código (contraseña) para entrar al sistema es <b>'.$code.'</b>, por lo que te pedimos que guardes este correo para tener una futura referencia. </p>';
                $body = $body . '<p> Se te explicará toda la información sobre como continuar el proceso de inscripción en el corto plazo, tras autorizar tu perfil. </p>';
                $body = $body . '<p> Muchas gracias por usar nuestro sistema online y ,ante cualquier duda, siéntete libre de responder este correo. </p>';
                Mail::sendMail( 
                    Yii::app()->params['adminEmail'], //from 
                        $model->mail, //to
                        'Confirmación de creación de nuevo jugador de torneo', //subject
                        '¡Bienvenido!', //mail_title
                        $body//mail body
                );
                $this->redirect(array('/torneo/jugador/'.$model->mail));
            }
        }
        
        $this->render('create', array(
            'model'      => $model,
            'next_event' => $next_tournament->name,
        ));
    }
    
    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        
        if (isset($_POST['TournamentPlayer'])) {
            $model->attributes = $_POST['TournamentPlayer'];
            if ($model->save())
                $this->redirect(array(
                    'view',
                    'id' => $model->id
                ));
        }
        
        $this->render('update', array(
            'model' => $model
        ));
    }
    
    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();
            
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array(
                    'admin'
                ));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }
    
    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('TournamentPlayer');
        $this->render('index', array(
            'dataProvider' => $dataProvider
        ));
    }
    
    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new TournamentPlayer('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['TournamentPlayer']))
            $model->attributes = $_GET['TournamentPlayer'];
        
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
}
