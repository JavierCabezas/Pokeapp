<?php
$this->breadcrumbs=array(
	'Tournament Players'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List TournamentPlayer','url'=>array('index')),
	array('label'=>'Create TournamentPlayer','url'=>array('create')),
	array('label'=>'View TournamentPlayer','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage TournamentPlayer','url'=>array('admin')),
	);
	?>

	<h1>Update TournamentPlayer <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>