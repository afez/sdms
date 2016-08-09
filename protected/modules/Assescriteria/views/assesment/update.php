<?php
/* @var $this AssesmentController */
/* @var $model Assesment */

$this->breadcrumbs=array(
	'Assesments'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Assesment', 'url'=>array('index')),
	array('label'=>'Create Assesment', 'url'=>array('create')),
	array('label'=>'View Assesment', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Assesment', 'url'=>array('admin')),
);
?>

<h1>Update Assesment <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>