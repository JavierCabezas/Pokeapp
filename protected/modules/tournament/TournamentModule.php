<?php

class TournamentModule extends CWebModule
{
	public function init()
	{
		$this->registerCore();
		
		$this->setImport(array(
			'tournament.models.*',
			'tournament.components.*',
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
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/tournament.css');
    }
}