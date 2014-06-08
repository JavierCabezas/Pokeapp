<?php
$this->breadcrumbs=array(
	'Players'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List Player','url'=>array('index')),
array('label'=>'Create Player','url'=>array('create')),
array('label'=>'Update Player','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Player','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Player','url'=>array('admin')),
);
?>

<h1>View Player #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'nickname',
		'name',
		'friendcode_1',
		'friendcode_2',
		'friendcode_3',
		'id_safari_type',
		'tsv',
		'skype',
		'whatsapp',
		'facebook',
		'mail',
		'others',
		'comment',
		'auth',
),
)); ?>
