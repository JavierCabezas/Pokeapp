<?php 
	/** Renders the view to see the information about a certain pokémon. **/
?>

<div id="pkmn_title">
	<div class="avatar">
		<?php echo $pokemon->species->image('moving') ?> 
	</div>
	<div class="info">
		#<?php echo $pokemon->species->id ?> (Generación #<?php echo $pokemon->generation ?>).
		<h2> <?php echo $pokemon->pokemonName ?> </h2>
		<div class="info1">
			<h4> Tamaño: </h4>
			<?php echo $pokemon->height/10 ?> [m]
		</div>
		<div class="info2">
			<h4> Peso: </h4>
			<?php echo $pokemon->weight/10 ?> [kg]
		</div>
		<div class="info3">
			<h4> Tipo(s): </h4>
			<?php foreach($types as $type): ?>
				<?php echo $type->type->image() ?>
			<?php endforeach ?>
		</div>
	</div>
	<div class="other">
		<div class="info1">
			<h4> Color: </h4>
			<?php echo $pokemon->species->color->colorName ?> 
		</div>
		<div class="info2">
			<h4> Forma: </h4>
			<?php echo $pokemon->species->shape->shapeName ?> 
		</div>
		<div class="info3">
			<h4> Grupo(s) huevo </h4>
			<ul>
				<?php foreach($eggies as $eggie): ?>
				<li> <?php echo $eggie->eggGroup->eggGroupName ?> </li>
				<?php endforeach ?>
			</ul>
		</div>
	</div>
	<div class="hab">
		<h3> Habilidades </h3>
		<ul>
		<?php foreach($abilities as $ability): ?>
			<li> <?php echo  $ability->ability->abilityName ?> </li>
		<?php endforeach ?>
		</ul>
	</div>
</div>



<h3> Resistencias e inmunidades: </h3>
<table class='typeTable'>
	<thead>
		<tr>
			<th> Tipo </th>
			<th> Efectividad </th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($resistances as $res): ?>
			<tr>	
				<td> <?php echo $res['name'] ?> </td>
				<td> x<?php echo $res['number'] ?> </td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

