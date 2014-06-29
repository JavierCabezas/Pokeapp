<h2> Jugadores aún no autorizados </h2>

<?php
    $this->widget('bootstrap.widgets.TbGridView',
    array(
    	'type'=>'striped bordered condensed',
	    'dataProvider' => $gridDataProvider,
	    'columns' => $gridColumns,
    	)
    );
?>
