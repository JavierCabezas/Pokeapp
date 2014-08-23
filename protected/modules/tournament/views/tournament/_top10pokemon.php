<div id="holder"></div>
        <script>
            window.onload = function () {
                var r = Raphael("holder", 800, 600),
                    pie = r.piechart(230, 220, 200, 
                    	[
                    		<?php
                    			$i=0; 
                    			foreach($pokemon as $poke){
                    				if($i==10) break;
						        	echo $poke;
						        	echo ($i != 9)?',':'';
						        	$i=$i+1;        			
                    			}
                    		?> 
                    	], 
                    	{ 
                    		legend: 
                    			[
                    			    <?php
		                    			$i=0; 
		                    			foreach($pokemon as $poke_id=>$poke_quantity){
		                    				if($i==10) break;
								        	echo '"%%.%% ('.$poke_quantity.') - '.PokemonSpecies::model()->findByPk($poke_id)->pokemonName.'"';
								        	echo ($i != 9)?',':'';
								        	$i=$i+1;        			
		                    			}
		                    		?> 
                    			], 
                    		legendpos: "east"
                    	}
                   );

                r.text(560, 120, "10 Pokémon más usados").attr({ font: "20px sans-serif" });
                pie.hover(function () {
                    this.sector.stop();
                    this.sector.scale(1.1, 1.1, this.cx, this.cy);

                    if (this.label) {
                        this.label[0].stop();
                        this.label[0].attr({ r: 7.5 });
                        this.label[1].attr({ "font-weight": 800 });
                    }
                }, function () {
                    this.sector.animate({ transform: 's1 1 ' + this.cx + ' ' + this.cy }, 500, "bounce");

                    if (this.label) {
                        this.label[0].animate({ r: 5 }, 500, "bounce");
                        this.label[1].attr({ "font-weight": 400 });
                    }
                });
            };
        </script>