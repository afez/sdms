<?php
/* @var $this StudyController */
/* @var $model Study */

$this->breadcrumbs=array(
	'Staff'=>array('index'),
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
            
<?php echo $this->renderPartial('_form', array('model' => $model)); ?>
        </div>
    </section>
</div>