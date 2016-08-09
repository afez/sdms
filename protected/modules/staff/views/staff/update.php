<?php
/* @var $this StaffController */
/* @var $model Staff */

$this->breadcrumbs=array(
	'Staffs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Staff', 'url'=>array('index')),
	array('label'=>'Create Staff', 'url'=>array('create')),
	array('label'=>'View Staff', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Staff', 'url'=>array('admin')),
);
?>

<div class="col-lg-12">
		<section class="panel">
			<header style="background:ghostwhite "class="panel-heading">
				<h4 style="color: black  ">Update Staff Information</h4>
			</header>
			<div class="panel-body">

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>