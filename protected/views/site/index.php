<?php $this->setPageTitle('Pokéapp - Inicio'); ?>

<?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    }
?>

<?php if(false): ?>
	<h2> Menú de admin </h2>
	<?php echo CHtml::link('Autorizar jugadores', array('jugadores/authorize')) ?>
<?php endif; ?>

<?php
//echo Users::model()->hashPassword('2em8lcgrszpr'); 
?>

<div class="page-header">   <h1>Pokéapp </h1></div>
<p> 
	La pokéapp es un compilado de aplicaciones hechas por <?php echo CHtml::link('un fan', array('/sobre_mi')) ?> de pokémon y pensada para otros fans. 
	Las aplicaciones las hice pensando en algo que me fuese a servir a mi en el juego así que espero que a ustedes también les sean útiles.
</p> 

<p> 
	Las aplicaciones que componen a la pokéapp son las siguientes: 
</p>


<div id='coin-slider'>
<?php foreach ($items_slider as $item_slider): ?>
		<a href="<?php echo $item_slider['link'] ?>" target="_blank">
			<img src="<?php echo Yii::app()->baseUrl ?>/images/carrousel/<?php echo $item_slider['image'] ?>" alt="<?php echo $item_slider['title'] ?>" />
			<span>
				<b> <?php echo $item_slider['title'] ?> </b><br />
				<?php echo $item_slider['caption'] ?> 
			</span>
		</a>
<?php endforeach; ?>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#coin-slider').coinslider({width: 830, height: 400, navigation: true, delay: 5000, hoverPause:true , links:true, sDelay: 30, spw: 7, sph: 5});
	});
</script> <!-- end of coinslider -->