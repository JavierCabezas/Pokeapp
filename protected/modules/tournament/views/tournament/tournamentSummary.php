<?php $this->setPageTitle('Pokéapp - Resumen del torneo'); ?>

<?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    }
?>

<?php
$this->breadcrumbs=array(
	'Torneo'=>array('/torneo'),
	'Menú administradores' => array('/torneo/adminMenu'),
	'Resumen torneo'
);
?>

<h1> Resumen para <?php echo $tournament_name ?> </h1>

<table class='adminTable'>
	<thead>
		<tr>
			<th> # jugador </th>
			<th> Folio asignado </th>
			<th> Nombre jugador </th>
			<th> Correo jugador </th>
			<th> Foto folio </th>
			<th> # Pokémon equipo </th>
			<th> Fecha de registro </th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($players as $player): ?>
			<tr>
				<td> <?php echo $player['folio'] ?> </td>
				<td> <?php echo $player['assigned']?'Sí':'No'; ?> </td>
				<td> <?php echo $player['assigned']? $player['player_name']:'-'; ?> </td>
				<td> <?php echo $player['assigned']? $player['player_mail']:'-'; ?> </td>
				<td> <?php echo $player['assigned']? $player['player_picture']:'-'; ?> </td>
				<td> <?php echo $player['assigned']? $player['number_pokemon']:''; ?> </td>
				<td> <?php echo $player['assigned']? $player['date']:''; ?> </td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>