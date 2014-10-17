<?php

class SiteController extends Controller
{
    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction'
            )
        );
    }
    
    /** 
     *  Renders the main view for the pokéapp.
     *  Registers the scripts for the coinslider, adds the images and info to the array for the coinslider and shuffles the array afterwards (so the order of the items of the slider its random)
     */    
    public function actionIndex()
    {
        Yii::app()->clientScript->registerMetaTag('La pokéapp es la aplicación oficial de Pokémon Daisuki. Cuenta con calculadora de captura, calculadora de stats, sección para búsqueda de jugadores entre otras aplicaciones. ', 'description');
        $baseUrl = Yii::app()->baseUrl; 
        $scr = Yii::app()->getClientScript();
        $scr->registerScriptFile($baseUrl.'/js/coin-slider.min.js');
        $scr->registerCssFile($baseUrl.'/css/coin-slider-styles.css');


        $array_carrousel = array();

        $array_carrousel[1]['image']    = 'capture_calculator_';
        $array_carrousel[1]['title']    = 'Calculadora de captura';
        $array_carrousel[1]['caption']  = '¿Mewtwo congelado y 1 de HP no entra a tus masterball? Calcula la probabilidad y cuántas pokéballs necesitas en promedio.';
        $array_carrousel[1]['link']     = Yii::app()->createAbsoluteUrl('/pokeball');
        $array_carrousel[1]['items']    = 3;
        
        $array_carrousel[2]['image']    = 'stats_calculator_';
        $array_carrousel[2]['title']    = 'Calculadora de stats';
        $array_carrousel[2]['caption']  = 'Si necesitas calcular cuantos EV asignar y que naturaleza usar velocidad necesitas para pasar a un pokémon en específico puedes usar nuestra calculadora de stats.';
        $array_carrousel[2]['link']     = Yii::app()->createAbsoluteUrl('/stats');
        $array_carrousel[2]['items']    = 2;        

        $array_carrousel[3]['image']  = 'tournament_inscription_';
        $array_carrousel[3]['title']    = 'Sistema online para torneos';
        $array_carrousel[3]['caption']  = 'La pokéapp es el medio oficial para la inscripción de distintos torneos precenciales que se realizarán en la región de Santiago de Chile.';
        $array_carrousel[3]['link']     = Yii::app()->createAbsoluteUrl('/torneo');
        $array_carrousel[3]['items']    = 1;
        
        /*$array_carrousel[4]['image']  = 'player_search_';
        $array_carrousel[4]['title']    = 'Sistema de búsqueda de otros jugadores';
        $array_carrousel[4]['caption']  = 'Próximamente estará implementado un sistema de búsqueda de jugadores para poder agendar duelos o intercambios.';
        $array_carrousel[4]['link']     = Yii::app()->createAbsoluteUrl('/index');
        $array_carrousel[4]['items']   = 2;
        */
        shuffle($array_carrousel);

        $this->render('index', array(
            'is_admin'      => Admin::model()->isAdmin(),
            'items_slider'  => $array_carrousel
        ));
    }
    
    /**
     *	This view renders the "about" page from the main menu.
     */
    public function actionAbout()
    {
        $foto_yo   = CHtml::image(Yii::app()->request->baseUrl . '/images/yotrabajando.jpg', "Yo trabajando", array("class" => "yo"));
        $foto_mail = CHtml::image(Yii::app()->request->baseUrl . '/images/correo.gif', "mail");
        $this->render('about', array(
            'foto_yo' 	=> $foto_yo,
            'foto_mail' => $foto_mail
        ));
    }
    
    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        $model = new LoginForm;
        
        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        
        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login', array(
            'model' => $model
        ));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

}