<?php 
	/** Renders the view to see the information about a certain pokémon. **/
?>

<div id="pkmn_title">
	<div class="avatar">
		<?php echo $pokemon->species->image('moving') ?>
		<div class="name">
			<p>#<?php echo $pokemon->species->id ?> (Generación #<?php echo $pokemon->generation ?>) </p>
			<h2> <?php echo $pokemon->pokemonName ?> </h2>
		</div>
	</div>
	<div class="info">
		<div class="type">
			<h5> Tipo(s) </h5>
			<?php foreach($types as $type): ?>
				<?php echo $type->type->image() ?>
			<?php endforeach ?>
		</div>
		<div class="others">
			<h5> Tamaño </h5>
			<?php echo $pokemon->height/10 ?> [m]
		</div>
		<div class="others">
			<h5> Peso </h5>
			<?php echo $pokemon->weight/10 ?> [kg]
		</div>
		<div class="others">
			<h5> Color </h5>
			<?php echo $pokemon->species->color->colorName ?> 
		</div>
		<div class="others">
			<h5> Forma </h5>
			<?php echo $pokemon->species->shape->shapeName ?> 
		</div>
		<div class="egg">
			<h5> Grupo(s) huevo </h5>
			<ul>
				<?php foreach($eggies as $eggie): ?>
				<li> <?php echo $eggie->eggGroup->eggGroupName ?> </li>
				<?php endforeach ?>
			</ul>
		</div>
	</div>
	<div class="hab">
		<h3> Habilidades </h3>
		<div class="info">
			<ul>
			<?php foreach($abilities as $ability): ?>
				<li> <?php echo  $ability->ability->abilityName ?> </li>
			<?php endforeach ?>
			</ul>
		</div>
	</div>
</div>

<h3 class="effective"> Resistencias e inmunidades </h3>
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

