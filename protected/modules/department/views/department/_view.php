<?php
/* @var $this DepartmentController */
/* @var $data Department */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
    <?php echo CHtml::encode($data->name); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('hod')); ?>:</b>
    <?php echo CHtml::encode($data->hod); ?>
    <br />
    <b><?php echo CHtml::encode($data->getAttributeLabel('college')); ?>:</b>
    <?php echo CHtml::encode($data->collage); ?>
    <br />

</div>