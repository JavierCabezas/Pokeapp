<?php

class JugadoresModule extends CWebModule
{
	public function init()
	{
		$this->registerCore();
		$this->setImport(array(
			'jugadores.models.*',
			'jugadores.components.*',
			'jugadores.controllers.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}

	protected function registerCore()
    {
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/jugadores.css');
    }
}
