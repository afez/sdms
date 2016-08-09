<?php
/* @var $this AssesmentController */
/* @var $model Assesment */

$this->breadcrumbs = array(
    'Assesments' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'List Assesment', 'url' => array('index')),
    array('label' => 'Manage Assesment', 'url' => array('admin')),
);
?>


<div class="col-lg-12">
    <section class="panel">
        <header style="background:ghostwhite "class="panel-heading">
            <h4 style="color: black  ">Assesment Criteria </h4>
        </header>
        <div class="panel-body">
            <?php echo $this->renderPartial('_form', array('model' => $model)); ?>
        </div>
    </section>
</div>