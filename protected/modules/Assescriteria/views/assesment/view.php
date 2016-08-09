<?php
/* @var $this AssesmentController */
/* @var $model Assesment */

$this->breadcrumbs=array(
	'Assesments'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Assesment', 'url'=>array('index')),
	array('label'=>'Create Assesment', 'url'=>array('create')),
	array('label'=>'Update Assesment', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Assesment', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Assesment', 'url'=>array('admin')),
);
?>

<h1>View Assesment #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'coverag',
		'originality',
		'Contribut',
		'academic_discipline',
		'specialize',
		'presentation',
		'overall_quality',
	),
)); ?>
