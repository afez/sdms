<?php
/* @var $this CollegeController */
/* @var $model College */

//$this->breadcrumbs=array(
//	'Colleges'=>array('index'),
//	'Create',
//);

//$this->menu=array(
//	array('label'=>'List College', 'url'=>array('index')),
//	array('label'=>'Manage College', 'url'=>array('admin')),
//);
?>

<div class="col-lg-12">
		<section class="panel panel-primary">
			<header style="background:ghostwhite "class="panel-heading">
				<h4 style="color: black  ">Add new College </h4>
			</header>
			<div class="panel-body">

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
                        </div>
                </section>
</div>