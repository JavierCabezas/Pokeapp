	    <!-- START OF SEARCH CRITERIA -->
    	<div class='search_criteria'>
			<h3> Quiero un Pokémon que... </h3>
	    	<div class="accordion-group">
				<div class='height'>
					<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc_height">	
							<h4> Tamaño (metros) </h4>
						</a>
					</div>
					<div id="acc_height" class="accordion-body collapse">
						<div class="accordion-inner">
							<p> Tenga un tamaño de... </p>
							<p> Mínimo: 0.1[m] - Máximo: 14.5[m] </p>
							<label> Desde: </label>
							<input type="number" class='height_form' name="height_min" id='height_min' min="0.1" max="14.5" step="0.1" >
							<label> Hasta: </label>
							<input type="number" class='height_form' name="height_max" id='height_max' min="0.1" max="14.5" step="0.1">
						</div>
					</div>
				</div> <!-- end of height -->

				<div class='weight'>
					<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc_weight">	
							<h4> Peso (Kilogramos) </h4>
						</a>
					</div>
					<div id="acc_weight" class="accordion-body collapse">
						<div class="accordion-inner">
							<p> Tenga un peso de ... </p>			
							<p> Mínimo: 0.1[kg] - Máximo: 950[kg] </p>
							<label> Desde: </label>
							<input type="number" class='weigth_form' name="weight_min" id='weight_min' min="0.1" max="950" step='0.1'>
							<label> Hasta: </label>
							<input type="number" class='weigth_form' name="weight_max" id='weight_max' min="0.1" max="950" step='0.1'>
						</div>
					</div>
				</div> 	<!-- end of weight -->

				<?php $dropdown_types = Types::model()->dropdownTypes() ?>
				<div class='type'>
					<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc_type">				
							<h4> Tipo(s) </h4>
						</a>
					</div>
					<div id="acc_type" class="accordion-body collapse">
						<div class="accordion-inner">
							<p> Que cuyo(s) tipo(s) sea(n) ... </p>
							<label> Tipo 1: </label>
							<?php echo CHtml::dropDownList('type_1', null, $dropdown_types, array('empty' => '(Ingresar tipo 1)', 'class' => 'type_dropdown'));  ?>
							<label> Tipo 2: </label>
							<?php echo CHtml::dropDownList('type_2', null, $dropdown_types, array('empty' => '(Ingresar tipo 2)', 'class' => 'type_dropdown'));  ?>
						</div>
					</div>				
				</div>	<!-- end of type -->
			
				<div class='inmunity'>
					<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc_inmunity">				
							<h4> Inmune al tipo </h4>
						</a>
					</div>
					<div id="acc_inmunity" class="accordion-body collapse">
						<div class="accordion-inner">
							<label> Que sea inmune a ... </label>
							<?php echo CHtml::dropDownList('type_inmunity', null, Types::model()->dropdownTypes(true), array('empty' => '(Ingresar tipo)', 'class' => 'inmunity_dropdown'));  ?>
						</div>
					</div>				
				</div>	<!-- end of inmunity -->

				<div class='gen'>
					<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc_gen">				
							<h4> Generaciones </h4>
						</a>
					</div>
					<div id="acc_gen" class="accordion-body collapse">
						<div class="accordion-inner">
							<p> Que pertenezca a las generaciones ... </p>
							<input type="checkbox" class="gen_checkbox" id='gen_checkbox_1' value="1"> Primera <br>
							<input type="checkbox" class="gen_checkbox" id='gen_checkbox_2' value="2"> Segunda <br>
							<input type="checkbox" class="gen_checkbox" id='gen_checkbox_3' value="3"> Tercera <br>
							<input type="checkbox" class="gen_checkbox" id='gen_checkbox_4' value="4"> Cuarta <br>
							<input type="checkbox" class="gen_checkbox" id='gen_checkbox_5' value="5"> Quinta <br>
							<input type="checkbox" class="gen_checkbox" id='gen_checkbox_6' value="6"> Sexta  <br>
						</div>
					</div>
				</div> 	<!-- end of gen -->

				<div class='color'>
					<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc_color">				
							<h4> Color </h4>
						</a>
					</div>
					<div id="acc_color" class="accordion-body collapse">
						<div class="accordion-inner">
							<p> Cuyo principal color sea ... </p>
							<?php echo CHtml::dropDownList('color_dropdown', '', PokemonColor::model()->dropdownColor() , array('empty' => '(Seleccionar color)')); ?>
						</div>
					</div>
				</div> <!-- end of color -->

				<div class='egg'>
					<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc_egg">				
							<h4> Grupo huevo </h4>
						</a>
					</div>
					<div id="acc_egg" class="accordion-body collapse">
						<div class="accordion-inner">
							<p> Que pertenezca al grupo huevo .... </p>
							<?php echo CHtml::dropDownList('eggie_dropdown', '', EggGroups::model()->dropdownEggs(), array('empty' => '(Seleccionar grupo)')); ?>
						</div>
					</div>
				</div> <!-- End of eggs (hehe) -->

				<div class='shape'>
					<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc_form">				
							<h4> Forma </h4>
						</a>
					</div>
					<div id="acc_form" class="accordion-body collapse">
						<div class="accordion-inner">
							<p> Cuya forma sea... </p>
							<?php echo CHtml::dropDownList('shape', '', PokemonShapes::model()->dropdownShapes(), array('empty' => '(Seleccionar forma)')); ?>
						</div>
					</div>
				</div> <!-- end of shape -->

				<div class='ability'>
					<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc_ability">
							<h4> Habilidad </h4>
						</a>
					</div>
					<div id="acc_ability" class="accordion-body collapse">
						<div class="accordion-inner">
								<label for='ability'> Que pueda tener de habilidad a ...  </label>
								<?php
									$this->widget('bootstrap.widgets.TbSelect2',
										array(
											'name' => 'ability',
											'data' => Abilities::model()->dropdownAbility(),
											'options' 		=> array(
												'allowClear'=>true,
												'placeholder' => 'Elige una habilidad'
											),
										)
									);
								?>
							</p>
						</div>
					</div>
				</div> <!-- end of ability -->
				<?php $array_moves = Moves::model()->dropdownMoves() ?>
				<div class='moves'>
					<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc_moves">
							<h4> Movimientos </h4>
						</a>
					</div>
					<div id="acc_moves" class="accordion-body collapse">
						<div class="accordion-inner">
							<p> Que aprenda ... </p>
							<p>
								<label for='moves_1'> Movimiento 1 </label>
								<?php
									$this->widget('bootstrap.widgets.TbSelect2',
										array(
											'name' => 'moves_1',
											'data' => $array_moves,
											'options' 		=> array(
												'allowClear'=>true,
												'placeholder' => 'Elige un movimiento'
											),
										)
									);
								?>
							</p>
							<p>
								<label for='moves_2'> Movimiento 2 </label>
								<?php
									$this->widget('bootstrap.widgets.TbSelect2',
										array(
											'name' => 'moves_2',
											'data' => $array_moves,
											'options' 		=> array(
												'allowClear'=>true,
												'placeholder' => 'Elige un movimiento'
											),
										)
									);
								?>
							</p>
							<p>
								<label for='moves_3'> Movimiento 3 </label>
								<?php
									$this->widget('bootstrap.widgets.TbSelect2',
										array(
											'name' => 'moves_3',
											'data' => $array_moves,
											'options' 		=> array(
												'allowClear'=>true,
												'placeholder' => 'Elige un movimiento'
											),
										)
									);
								?>

							</p>
							<p>
								<label for='moves_4'> Movimiento 4 </label>
								<?php
									$this->widget('bootstrap.widgets.TbSelect2',
										array(
											'name' => 'moves_4',
											'data' => $array_moves,
											'options' 		=> array(
												'allowClear'	=> true,
												'placeholder' 	=> 'Elige un movimiento',
											),
										)
									);
								?>
							</p>
						</div>
					</div>
				</div> <!-- end of ability -->


				<div class='stats'> <!-- Starting stats -->
					<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc_stats">
							<h4> Stats </h4>
						</a>
					</div>
					<div id="acc_stats" class="accordion-body collapse">
						<div class="accordion-inner">
								<label for='ability'> Stats </label>
								<p> Que, al nivel xxxx, pueda alcanzar de stats ... </p>
								<?php
									$this->widget('bootstrap.widgets.TbSelect2',
										array(
											'name' => 'ability',
											'data' => Abilities::model()->dropdownAbility(),
											'options' 		=> array(
												'allowClear'=>true,
												'placeholder' => 'Elige una habilidad'
											),
										)
									);
								?>
							</p>
						</div>
					</div>
				</div> <!-- end of stats -->


			</div> <!-- end of accordeon -->
		
			<div style="width:40%; margin-right:auto; margin-left:auto">
				<input id="search-data" type="submit" value="Mostrar resultados!" />
			</div> <!-- End of search button -->
		
		</div> <!-- END OF SEARCH CRITERIA -->