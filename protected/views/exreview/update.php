<?php
/* @var $this ExreviewController */
/* @var $model Exreview */

$this->breadcrumbs=array(
	'Exreviews'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Exreview', 'url'=>array('index')),
	array('label'=>'Create Exreview', 'url'=>array('create')),
	array('label'=>'View Exreview', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Exreview', 'url'=>array('admin')),
);
?>

<h1>Update Exreview <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>