<?php
/* @var $this CommentController */
/* @var $data Comment */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->comment_id), array('view', 'id'=>$data->comment_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('publication_quality')); ?>:</b>
	<?php echo CHtml::encode($data->publication_quality); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('merit_promotion')); ?>:</b>
	<?php echo CHtml::encode($data->merit_promotion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('other_comment')); ?>:</b>
	<?php echo CHtml::encode($data->other_comment); ?>
	<br />


</div>