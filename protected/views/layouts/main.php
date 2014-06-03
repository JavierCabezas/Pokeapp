<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/stats.css" />
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<nav>
			<ul>
				<li><?php echo CHtml::link('<img src="'.Yii::app()->request->baseUrl.'/images/nav/pokeball.png" width="300" height="100" />',  Yii::app()->createurl('pokeball/pokeball/index')) //Module/controller/view ?> </li>
				<li><?php echo CHtml::link('<img src="'.Yii::app()->request->baseUrl.'/images/nav/breed.png" width="300" height="100" />',  Yii::app()->createurl('stats/stats/index'))?> </li>
				<li><?php echo CHtml::link('<img src="'. Yii::app()->request->baseUrl .'/images/nav/about.png" width="300" height="100" />', array('/site/about')) ?></li>
			</ul>
		</nav>
	</div><!-- mainmenu -->
	
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Contenido de Fans para Fans<br/>
		Agradecemos dar créditos respectivos al compartir las Apps.<br/>
		PokéDaisuki.cl
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
