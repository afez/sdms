<?php
/* @var $this CommentController */
/* @var $model Comment */

$this->breadcrumbs = array(
    'Comments' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'List Comment', 'url' => array('index')),
    array('label' => 'Manage Comment', 'url' => array('admin')),
);
?>
<div class="col-lg-12">
    <section class="panel">
        <header style="background:ghostwhite "class="panel-heading">
            <h4 style="color: black  ">Give your comments </h4>
        </header>
        <div class="panel-body">

            <?php echo $this->renderPartial('_form', array('model' => $model)); ?>

        </div>
    </section>

</div>