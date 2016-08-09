<?php
/* @var $this CollegeController */
/* @var $model College */

$this->breadcrumbs = array(
    'Colleges' => array('index'),
    $model->name => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('label' => 'List College', 'url' => array('index')),
    array('label' => 'Create College', 'url' => array('create')),
    array('label' => 'View College', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'Manage College', 'url' => array('admin')),
);
?>

<div class="col-lg-12">
    <section class="panel">
        <header style="background:ghostwhite "class="panel-heading">
            <h4 style="color: black  ">Add new Department </h4>
        </header>
        <div class="panel-body">

            <?php echo $this->renderPartial('_form', array('model' => $model)); ?>
        </div>
    </section>