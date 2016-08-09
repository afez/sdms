<?php
/* @var $this DepartmentController */
/* @var $model Department */

$this->breadcrumbs=array(
	'Departments'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Department', 'url'=>array('index')),
	array('label'=>'Create Department', 'url'=>array('create')),
	array('label'=>'View Department', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Department', 'url'=>array('admin')),
);
?>


		<section class="panel">
			<header style="background:ghostwhite "class="panel-heading">
				<h4 style="color: black  ">Update Department </h4>
			</header>
			<div class="panel-body">

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
                        </div>
                </section>