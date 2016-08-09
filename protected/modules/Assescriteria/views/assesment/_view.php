<?php
/* @var $this AssesmentController */
/* @var $data Assesment */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('coverag')); ?>:</b>
	<?php echo CHtml::encode($data->coverag); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('originality')); ?>:</b>
	<?php echo CHtml::encode($data->originality); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Contribut')); ?>:</b>
	<?php echo CHtml::encode($data->Contribut); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('academic_discipline')); ?>:</b>
	<?php echo CHtml::encode($data->academic_discipline); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('specialize')); ?>:</b>
	<?php echo CHtml::encode($data->specialize); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('presentation')); ?>:</b>
	<?php echo CHtml::encode($data->presentation); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('overall_quality')); ?>:</b>
	<?php echo CHtml::encode($data->overall_quality); ?>
	<br />

	*/ ?>

</div>