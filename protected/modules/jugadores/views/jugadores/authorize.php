<h2> Jugadores aún no autorizados </h2>

<?php
    $this->widget('bootstrap.widgets.TbGridView',
    array(
	    'dataProvider' => $gridDataProvider,
	    'template' => "{items}",
	    'columns' => $gridColumns,
    )
    );
?>
