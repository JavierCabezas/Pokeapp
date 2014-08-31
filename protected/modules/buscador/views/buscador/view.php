<?php 
	/** Renders the view to see the information about a certain pokémon. **/
?>

<h2> Información de <?php echo $pokemon->pokemonName ?> </h2>

<?php echo $pokemon->species->image('moving') ?> 

<h3> Número </h3>
#<?php echo $pokemon->species->id ?> (Generación #<?php echo $pokemon->generation ?>).

<h3> Tamaño: </h3>
<?php echo $pokemon->height/10 ?> [m]

<h3> Peso: </h3>
<?php echo $pokemon->weight/10 ?> [kg]

<h3> Tipo(s): </h3>
<?php foreach($types as $type): ?>
	<?php echo $type->type->image() ?>
<?php endforeach ?>

<h3> Color: </h3>
<?php echo $pokemon->species->color->colorName ?> 

<h3> Forma: </h3>
<?php echo $pokemon->species->shape->shapeName ?> 


<h3> Grupo(s) huevo </h3>
<ul>
<?php foreach($eggies as $eggie): ?>
	<li> <?php echo $eggie->eggGroup->eggGroupName ?> </li>
<?php endforeach ?>
</ul>

<h3> Habilidades </h3>
<ul>
<?php foreach($abilities as $ability): ?>
	<li> <?php echo  $ability->ability->abilityName ?> </li>
<?php endforeach ?>
</ul>

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

