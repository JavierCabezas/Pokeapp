<div id="holder_items"></div>

        <script>
                var r = Raphael("holder_items", 800, 500),
                    pie = r.piechart(230, 220, 200, 
                    	[
                    		<?php
                    			$i=0; 
                    			foreach($items as $item){
                    				if($i==10) break;
						        	echo $item;
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
		                    			foreach($items as $item_id=>$item_quantity){
		                    				if($i==10) break;
								        	echo '"%%.%% ('.$item_quantity.') - '.Items::model()->findByPk($item_id)->itemName.'"';
								        	echo ($i != 9)?',':'';
								        	$i=$i+1;        			
		                    			}
		                    		?> 
                    			], 
                    		legendpos: "east"
                    	}
                   );

                r.text(560, 120, "10 Objetos más utilizados").attr({ font: "20px sans-serif" });
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
        </script>

<h3> Los objetos que le siguen fueron ... </h3>
<?php $i=0;
foreach($items as $item_id=>$item_quantity): ?>
	<?php if($i>22) break; ?>
	<?php if($i>10): ?>
		<div class='item_followup'>
			<p> Usado <b><?php echo $item_quantity ?></b> veces </p>
			<div class='item_pic'>
				<?php echo Items::model()->findByPk($item_id)->itemName ?> 
			</div>
		</div>
	<?php endif; ?>
	<?php $i = $i +1 ?>
<?php endforeach; ?>

<div class='clear'> </div>