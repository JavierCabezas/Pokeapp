<div class="view">

	<div class='basic_info'>
		<div class='nickname'>
			Nickname: <?php echo $player_nickname ?>
		</div>

		<div class ='avatar'>
			<?php echo $player_pic ?>
		</div>

		<div class='friend_code'>
			Código amigo: <b> <?php echo $friend_code ?> </b>
		</div>

		<div class='tsv'>
			TSV: <?php echo $tsv ?>
		</div>
	</div> <!-- end of basic info -->

	<div class='safari'>
		<div class='type'>
			Safari: <?php echo $safari_type ?>
		</div>

		<?php if($safari_type != '(No asignado)'): //Just show the safari pokémon if the safari is defined ?>
			<div class='safari_pokemon' id='1'>
				<?php echo $pokemon_safari_1 ?>
				<?php echo $pic_pokemon_1 ?>
			</div>

			<div class='safari_pokemon' id='2'>
				<?php echo $pokemon_safari_2 ?>
				<?php echo $pic_pokemon_2 ?>
			</div>
			
			<div class='safari_pokemon' id='3'>
				<?php echo $pokemon_safari_3 ?>
				<?php echo $pic_pokemon_3 ?>
			</div>
			
		<?php endif; ?>
	</div> <!-- end of safari -->

	<div class='duel'>
		<div class='single_<?php echo $duel_single?>'>
			<?php if(!is_null($tier_single)): ?>
				<?php echo $tier_single ?>
			<?php endif; ?>
		</div>
		<div class='doble_<?php echo $duel_doble?>'>
			<?php if(!is_null($tier_doble)): ?>
				<?php echo $tier_doble ?>
			<?php endif; ?>
		</div>
		<div class='triple_<?php echo $duel_triple?>'>
			<?php if(!is_null($tier_triple)): ?>
				<?php echo $tier_triple ?>
			<?php endif; ?>
		</div>
		<div class='rotation_<?php echo $duel_triple?>'>
			<?php if(!is_null($tier_rotation)): ?>
				<?php echo $tier_rotation ?>
			<?php endif; ?>
		</div>
	</div> <!-- end of duels  -->

	<div class='contact'>
		<div class='skype'>
			<?php echo $skype ?>
		</div>
	
		<div class='whatsapp'>
			<?php echo $whatsapp ?>
		</div>

		<div class='facebook'>
			<?php echo $facebook ?>
		</div>

		<div class='mail'>
			<?php echo $mail ?>
		</div>

		<div class='others'>
			<?php echo $others ?>
		</div> <!-- end of contact info -->

	</div>

	<div class='comments'>
		<?php echo $comment ?>
	</div>
</div>
