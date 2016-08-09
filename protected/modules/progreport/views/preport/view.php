<?php
/* @var $this PreportController */
/* @var $model Preport */

$this->breadcrumbs=array(
	'Preports'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Preport', 'url'=>array('index')),
	array('label'=>'Create Preport', 'url'=>array('create')),
	array('label'=>'Update Preport', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Preport', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Preport', 'url'=>array('admin')),
);
?>

<h1>View Preport #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'report',
		'description',
		'status',
	),
)); ?>
