<?php /* @var $this Controller */ ?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="es" />
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/profile.css" />
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

</head>

<body>
	<script> <!-- google analytics -->
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	  ga('create', 'UA-53567823-1', 'auto');
	  ga('send', 'pageview');
	</script><!-- google analytics -->

<div class="container" id="page">

	<div id="header">
		<a href="<?php echo Yii::app()->request->baseUrl ?>"> 
			<div id="logo"> 
				<img src="<?php echo Yii::app()->request->baseUrl ?>/images/nav/header_app.png" />
			</div>
		</a>
	</div><!-- header -->

	<div id="mainmenu">
		<nav>
			<ul>
				<li><?php echo CHtml::link('<img src="'.Yii::app()->request->baseUrl.'/images/nav/pokecalc.png" width="220" height="100" />',  Yii::app()->createurl('/pokeball')) ?> </li>
				<li><?php echo CHtml::link('<img src="'.Yii::app()->request->baseUrl.'/images/nav/stats.png" width="220" height="100" />',  Yii::app()->createurl('/stats'))?> </li>
				<li><?php echo CHtml::link('<img src="'.Yii::app()->request->baseUrl.'/images/nav/jugadores.png" width="220" height="100" />', array('/jugadores')) ?></li>
				<li><?php echo CHtml::link('<img src="'.Yii::app()->request->baseUrl.'/images/nav/deathmatch.png" width="220" height="100" />', array('/torneo')) ?></li>
				<li><?php echo CHtml::link('<img src="'.Yii::app()->request->baseUrl.'/images/nav/autor.png" width="220" height="100" />', array('/sobre_mi')) ?></li>
			</ul>
		</nav>

		<?php if(Admin::model()->isAdmin()): //Administrator logged in ?>
			<p class="login_bloq"> Estás logeado como admin con nombre <?php echo beautify(Yii::app()->user->name) ?>. <?php echo CHtml::link('Deslogear', array('/logout'))?></p>
		<?php endif;?>

		<?php if( (!Admin::model()->isAdmin()) && ( isset(Yii::app()->user->id) )): //Normal user logged in?>
			<p class="login_bloq"> Estás logeado/a como <b><?php echo beautify(Yii::app()->user->name) ?>. <?php echo CHtml::link('Cambiar correo', array('/usuario/cambiarCorreo'))?> <?php echo CHtml::link('Cambiar contraseña', array('/usuario/cambiarClave'))?> <?php echo CHtml::link('Deslogear', array('/logout'))?></p>
		<?php endif;?>

		<?php if(!isset(Yii::app()->user->id)): //Visitor (not logged in) ?>
			<p class="login_bloq"> No estás logeado en el sitio. <b><?php echo CHtml::link('Login', array('/login'))?></b> </p>
		<?php endif;?>
	
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
