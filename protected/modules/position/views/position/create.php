<?php
/* @var $this PositionController */
/* @var $model Position */

$this->breadcrumbs = array(
    'Positions' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'List Position', 'url' => array('index')),
    array('label' => 'Manage Position', 'url' => array('admin')),
);
?>

<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            <h4 style="color: black  ">Add new Details </h4>
        </header>
        <div class="panel-body">

            <?php echo $this->renderPartial('_form', array('model' => $model)); ?>
        </div>
    </section>
</div>