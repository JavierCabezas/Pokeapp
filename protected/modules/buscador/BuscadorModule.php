<?php

class BuscadorModule extends CWebModule
{
	public function init()
	{
		$this->registerCore();
		// import the module-level models and components
		$this->setImport(array(
			'buscador.models.*',
			'buscador.components.*',
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
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/buscador.css');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/buscador.js');
    }
}
