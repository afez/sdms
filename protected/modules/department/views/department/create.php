<?php
/* @var $this DepartmentController */
/* @var $model Department */

//$this->breadcrumbs=array(
//	'Departments'=>array('index'),
//	'Create',
//);
//
//$this->menu=array(
//	array('label'=>'List Department', 'url'=>array('index')),
//	array('label'=>'Manage Department', 'url'=>array('admin')),
//);
?>


	<div class="col-lg-12">
		<section class="panel">
			<header style="background:ghostwhite "class="panel-heading">
				<h4 style="color: black  ">Add new Department </h4>
			</header>
			<div class="panel-body">
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
                        </div>
                </section>
        </div>