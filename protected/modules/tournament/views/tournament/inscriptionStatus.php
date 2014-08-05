<?php $this->setPageTitle('Pokéapp - Ver estado de inscripción'); ?>

<?php
$this->breadcrumbs=array(
	'Torneo'=>array('/torneo'),
	'Menú de usuario' => array('/torneo/menuUsuario'),
	'Estado de inscripción'
);
?>

<h1> Estado de mi inscripción en línea</h1>

<table>
	<tr>
		<th> Criterio de inscripción </th>
		<th> Estado </th>
		<th> Comentario </th>
	</tr>
	<tr> <!-- Pokémon team -->
		<td class='<?php echo $team_class ?>'> ¿El equipo registrado está completo? </td>
		<td class='<?php echo $team_class ?>'> <?php echo $team_short ?> </td>
		<td class='<?php echo $team_class ?>'> <?php echo $team_status ?> </td>
	</tr>
	<tr> <!-- Administrator approval -->
		<td class='<?php echo $folio_class ?>'>  Autorización de folio por un administrador </td>
		<td class='<?php echo $folio_class ?>'> <?php echo $folio_short ?> </td>
		<td class='<?php echo $folio_class ?>'> <?php echo $folio_status ?> </td>
</table>

<?php if($complete_inscription): ?>
	<p> Dado que ambas faces del proceso están finalizadas tu proceso de inscripción en línea está completo. </p>
<?php else: ?>
	<p> No están completados ambos requerimientos para la inscripción online por lo que tu inscripción aún no está lista. </p>
<?php endif; ?>

	<p> <?php echo CHtml::link('Volver al perfil de usuario', array('/torneo/menuUsuario')) ?> </p>