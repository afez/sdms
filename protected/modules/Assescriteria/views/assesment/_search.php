<?php
/* @var $this AssesmentController */
/* @var $model Assesment */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'coverag'); ?>
		<?php echo $form->textField($model,'coverag'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'originality'); ?>
		<?php echo $form->textField($model,'originality'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Contribut'); ?>
		<?php echo $form->textField($model,'Contribut'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'academic_discipline'); ?>
		<?php echo $form->textField($model,'academic_discipline'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'specialize'); ?>
		<?php echo $form->textField($model,'specialize'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'presentation'); ?>
		<?php echo $form->textField($model,'presentation'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'overall_quality'); ?>
		<?php echo $form->textField($model,'overall_quality'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->