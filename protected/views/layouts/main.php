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
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/profile.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><a href="#"><?php echo CHtml::encode(Yii::app()->name); ?></a></div>
	</div><!-- header -->

	<div id="mainmenu">
		<nav>
			<ul>
				<li><?php echo CHtml::link('<img src="'.Yii::app()->request->baseUrl.'/images/nav/pokecalc.png" width="220" height="100" />',  Yii::app()->createurl('/pokeball')) ?> </li>
				<li><?php echo CHtml::link('<img src="'.Yii::app()->request->baseUrl.'/images/nav/stats.png" width="220" height="100" />',  Yii::app()->createurl('/stats'))?> </li>
				<li><?php echo CHtml::link('<img src="'.Yii::app()->request->baseUrl.'/images/nav/jugadores.png" width="220" height="100" />', array('/jugadores')) ?></li>
				<li><?php echo CHtml::link('<img src="'.Yii::app()->request->baseUrl.'/images/nav/autor.png" width="220" height="100" />', array('/sobre_mi')) ?></li>
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
		Contenido de Fans para Fans. Agradecemos dar créditos respectivos al compartir las Apps.<br/>
		PokéDaisuki.cl
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
