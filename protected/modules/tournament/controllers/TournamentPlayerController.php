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
                    'viewTeam',
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
            $model->code = $model->hashPassword($code);
            if ($model->save()){

                $playerFolio = new TournamentPlayerFolio();
                $id_tournament                      = 1; //TODO: FIX THIS
                $playerFolio->folio_photo           = $id_tournament . "_" . $model->id . "." . $folio->extensionName;
                $playerFolio->id_tournament         = $id_tournament;
                $playerFolio->id_tournament_player  = $model->id;
                if($playerFolio->save())
                    $folio->saveAs('./images/foto_folio/'. $playerFolio->folio_photo);

                $body =         '<p> Se acaba de crear tu perfil de usuario en la pokéapp asociada a esta cuenta de correo electrónico. </p>';
                $body = $body . '<p> Para finalizar la inscripción online se requieren dos pasos:
                                    <ul> <li> El primero es el registro online de tu equipo. Para ello tienes que dirigirte a <a href="http://www.pokedaisuki.cl/pokeapp/torneo"> a la sección de torneos de la pokéapp </a>
                                         e ingresar con tu nombre de usuario (que vendría siendo tu correo, '.$model->mail.') y con la contraseña <b>'.$code.'</b>. Por favor guarda este correo dado que esta contraseña
                                         será encriptada y no tendremos forma de obtenerla posteriormente. </li>
                                         <li> El otro paso será la aprobación de algún administrador del evento  de la foto de la entrada (con el folio visible) que subiste al registrarte. 
                                         Se te avisará por este mismo medio del estado de la aprobación del mismo en el corto plazo. </li>
                                      </ul> </p>';
                $body = $body . '<p> El proceso de inscripción online se considera finalizado una vez que el equipo está creado en el sitio web y el folio de la entrada es aprobado. </p>';
                $body = $body . '<p> Muchas gracias por usar nuestro sistema online y ,ante cualquier duda, siéntete libre de responder este correo. Estaremos atentos! </p>';
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
}
