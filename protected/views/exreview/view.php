<?php
/* @var $this ExreviewController */
/* @var $model Exreview */

$this->breadcrumbs=array(
	'Exreviews'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Exreview', 'url'=>array('index')),
	array('label'=>'Create Exreview', 'url'=>array('create')),
	array('label'=>'Update Exreview', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Exreview', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Exreview', 'url'=>array('admin')),
);
?>

<h1>View Exreview #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'qualification',
		'department',
		'first_name',
		'middle_name',
		'last_name',
	),
)); ?>
