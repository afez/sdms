<?php
/* @var $this DepartmentController */
/* @var $model Department */

$this->breadcrumbs=array(
	'Departments'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Department', 'url'=>array('index')),
	array('label'=>'Create Department', 'url'=>array('create')),
	array('label'=>'Update Department', 'url'=>array('update', 'id'=>$model->id), 'class'=>'btn btn-info'),
	array('label'=>'Delete Department', 'url'=>'#', 'class'=>'btn btn-info','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Department', 'url'=>array('admin')),
);
?>
<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            <h4 style="color: black  ">Details </h4>
        </header>
        <div class="panel-body">


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		
		'name',
		'hod',
            'college_id',
	),
)); ?>
        </div>
    </section>
        </div>
  