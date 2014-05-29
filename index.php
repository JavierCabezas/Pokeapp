<?php
//Include the global functions file.
$globals = dirname(__FILE__).'/protected/globals.php';
require_once($globals);

// change the following paths if necessary
$yii=dirname(__FILE__).'/../Yii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

require_once($yii);
Yii::createWebApplication($config)->run();
