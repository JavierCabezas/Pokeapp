<?php
/*
 * This partial is called by the action Calculate Stats from the stats controller to show the information of each pokémon.
 */
?>

<?php if(!is_null($pokemon)): ?>
	<?php $hp=0; $atk=1; $def=2; $spa=3; $spd=4; $spe=5; ?>
	<h3>Resultado de cálculo de Stats</h3>

	<h4> <?php echo $pokemon ?> </h4>
	<div class="poke">
		<?php echo $poke_pic ?> 
		<table>
			<tr>
				<td> Nivel </td>
				<td> <?php echo $level ?> </td>
			</tr>
			<tr>
				<td> Naturaleza </td>
				<td> <?php echo $nature ?> (<?php echo $nature_stats ?>)</td>
			</tr>
			<tr>
				<td> Item </td>
				<td> <?php echo $item ?> </td>
			</tr>
		</table>
	</div>

	<div class="stats">
		<h4> Stats </h4>
		<table>
			<tr>
				<th> Stat </th>
				<th> Base </th>
				<th> EV </th>
				<th> IV </th>
				<th> Item </th>
				<th> Cambio de stats </th>
				<th> <b> Resultado </b> </th>
			</tr>
			<tr>
				<td class="title"> Puntos de impacto </td>
				<td> <?php echo $base_stats[$hp] ?> </td>
				<td> <?php echo $evs[$hp] ?> </td>
				<td> <?php echo $ivs[$hp] ?> </td>
				<td> d </td>
				<td> <?php echo signify($stat_changes[$hp]) ?> </td>
				<td> <b> <?php echo $final_stats[$hp] ?> </b> </td>
			</tr>
			<tr>
				<td class="title"> Ataque </td>
				<td> <?php echo $base_stats[$atk] ?> </td>
				<td> <?php echo $evs[$atk] ?> </td>
				<td> <?php echo $ivs[$atk] ?> </td>
				<td> d </td>
				<td> <?php echo signify($stat_changes[$atk]) ?> </td>
				<td> <b> <?php echo $final_stats[$atk] ?>  </b> </td>
			</tr>
			<tr>
				<td class="title"> Defensa </td>
				<td> <?php echo $base_stats[$def] ?> </td>
				<td> <?php echo $evs[$def] ?> </td>
				<td> <?php echo $ivs[$def] ?> </td>
				<td> d </td>
				<td> <?php echo signify($stat_changes[$def]) ?> </td>
				<td> <b> <?php echo $final_stats[$def] ?>  </b> </td>
			</tr>
			<tr>
				<td class="title"> Ataque especial </td>
				<td> <?php echo $base_stats[$spa] ?> </td>
				<td> <?php echo $evs[$spa] ?> </td>
				<td> <?php echo $ivs[$spa] ?> </td>
				<td> d </td>
				<td> <?php echo signify($stat_changes[$spa]) ?> </td>
				<td> <b> <?php echo $final_stats[$spa] ?>  </b> </td>
			</tr>
			<tr>
				<td class="title"> Defensa especial </td>
				<td> <?php echo $base_stats[$spd] ?> </td>
				<td> <?php echo $evs[$spd] ?> </td>
				<td> <?php echo $ivs[$spd] ?> </td>
				<td> d </td>
				<td> <?php echo signify($stat_changes[$spd]) ?> </td>
				<td> <b> <?php echo $final_stats[$spd] ?>  </b> </td>
			</tr>
			<tr>
				<td class="title"> Velocidad </td>
				<td> <?php echo $base_stats[$spe] ?> </td>
				<td> <?php echo $evs[$spe] ?> </td>
				<td> <?php echo $ivs[$spe] ?> </td>
				<td> d </td>
				<td> <?php echo signify($stat_changes[$spe]) ?> </td>
				<td> <b> <?php echo $final_stats[$spe] ?>  </b> </td>
			</tr>
		</table>
	</div>

<?php endif; ?>
