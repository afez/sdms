<?php
/* @var $this ExreviewController */
/* @var $model Exreview */

$this->breadcrumbs=array(
	'Exreviews'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Exreview', 'url'=>array('index')),
	array('label'=>'Manage Exreview', 'url'=>array('admin')),
);
?>


<div class="col-lg-12">
    <section  class="panel panel-primary">
        <div class="panel-body">
            <h3>Add External Reviewer</h3>
<?php echo $this->renderPartial('_form', array('model' => $model)); ?>
        </div>
    </section>
</div>


