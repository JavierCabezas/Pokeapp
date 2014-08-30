<?php 
	/** Renders the view to see the information about a certain pokémon. **/
?>

<h2> Información de <?php echo $pokemon->pokemonName ?> </h2>

<?php echo $pokemon->species->image('moving') ?> 

<p> Tamaño: </p>
<?php echo $pokemon->height/10 ?> [m]

<p> Peso: </p>
<?php echo $pokemon->weight/10 ?> [kg]

<p> Tipo(s): </p>
<?php foreach($types as $type): ?>
	<?php echo $type->type->image() ?>
<?php endforeach ?>

<p> Grupo(s) huevo </p>
<ul>
<?php foreach($eggies as $eggie): ?>
	<li> <?php echo $eggie->eggGroup->eggGroupName ?> </li>
<?php endforeach ?>
</ul>

<p> Resistencias e inmunidades: </p>
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

