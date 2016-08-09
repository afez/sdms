<?php
/* @var $this StudyController */
/* @var $model Study */

$this->breadcrumbs=array(
	'Studies'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Study', 'url'=>array('index')),
	array('label'=>'Create Study', 'url'=>array('create')),
	array('label'=>'View Study', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Study', 'url'=>array('admin')),
);
?>

<div class="col-lg-12">
		<section class="panel panel-primary">
			<header style="background:ghostwhite "class="panel-heading">
				<h4 style="color: black  ">Update </h4>
			</header>
			<div class="panel-body">
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
                        </div>
                </section>
        </div>


