<?php
/* @var $this StudyController */
/* @var $model Study */

$this->breadcrumbs=array(
	'Studies'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Study', 'url'=>array('index')),
	array('label'=>'Manage Study', 'url'=>array('admin')),
);
?>

<div class="col-lg-12">
    <section  class="panel panel-primary">
        <div class="panel-body">
           <h1>Add</h1> 
<?php echo $this->renderPartial('_form', array('model' => $model)); ?>
        </div>
    </section>
</div>



