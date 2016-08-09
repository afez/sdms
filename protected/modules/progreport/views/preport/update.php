<?php
/* @var $this PreportController */
/* @var $model Preport */

$this->breadcrumbs=array(
	'Preports'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Preport', 'url'=>array('index')),
	array('label'=>'Create Preport', 'url'=>array('create')),
	array('label'=>'View Preport', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Preport', 'url'=>array('admin')),
);
?>

<h1>Update Preport <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>