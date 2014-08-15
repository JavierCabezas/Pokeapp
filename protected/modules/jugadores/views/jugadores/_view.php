<div class="view">

	<div class="basic_info">
		<div class="avatar">
			<?php echo $player_pic ?>
		</div>

		<div class="data">
			<div class="nickname">
				<?php echo $player_nickname ?>
			</div>

			<div class="friend_code">
				Friend Code: <b> <?php echo $friend_code ?> </b>
			</div>

			<div class="tsv">
				TSV: <?php echo $tsv ?>
			</div>

			<div class="comments">
				<?php echo $comment ?>
			</div>
		</div>

		<div class="contact">
			<div class="skype">
				Skype:
				<?php echo $skype ?>
			</div>
	
			<div class="whatsapp">
				WhatsApp:
				<?php echo $whatsapp ?>
			</div>

			<div class="facebook">
				Facebook:
				<?php echo $facebook ?>
			</div>

			<div class="others">
				Otros:
				<?php echo $others ?>
			</div> <!-- end of contact info -->
		</div>
	</div> <!-- end of basic info -->

	<div class="safari">
		<div class="type">
			Safari: <?php echo $safari_type ?>
		</div>
		<?php if($safari_type != '(No ingresado)'): //Just show the safari pokémon if the safari is defined ?>
				<div class="pokes">
					<div class="safari_pokemon" id="1">
						<?php echo $pokemon_safari_1 ?>
						<?php echo $pic_pokemon_1 ?>
					</div>

					<div class="safari_pokemon" id="2">
						<?php echo $pokemon_safari_2 ?>
						<?php echo $pic_pokemon_2 ?>
					</div>
					
					<div class="safari_pokemon" id="3">
						<?php echo $pokemon_safari_3 ?>
						<?php echo $pic_pokemon_3 ?>
					</div>
				</div>
			<?php else: ?>
				<div class="no_safari"></div>
			<?php endif; ?>
	</div> <!-- end of safari -->

	<div class="duel">
		<div class="title">Interés de duelos</div>
		<div class="single_<?php echo $duel_single?>">
			<h5>Single:</h5>
			<?php if(!is_null($tier_single)): ?>
				<p><?php echo $tier_single ?></p>
			<?php endif; ?>
		</div>
		<div class="doble_<?php echo $duel_doble?>">
			<h5>Doble:</h5>
			<?php if(!is_null($tier_doble)): ?>
				<p><?php echo $tier_doble ?></p>
			<?php endif; ?>
		</div>
		<div class="triple_<?php echo $duel_triple?>">
			<h5>Triple:</h5>
			<?php if(!is_null($tier_triple)): ?>
				<p><?php echo $tier_triple ?></p>
			<?php endif; ?>
		</div>
		<div class="rotation_<?php echo $duel_triple?>">
			<h5>Rotation:</h5>
			<?php if(!is_null($tier_rotation)): ?>
				<p><?php echo $tier_rotation ?></p>
			<?php endif; ?>
		</div>
	</div> <!-- end of duels  -->


	
</div>
