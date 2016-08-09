<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);


?>
	<div class="col-lg-12">
		<section class="panel">
			<header style="background:ghostwhite "class="panel-heading">
				<h4 style="color: black  ">Add new User </h4>
			</header>
			<div class="panel-body">

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

			</div>
		</section>

	</div>