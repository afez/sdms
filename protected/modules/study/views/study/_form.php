<?php
/* @var $this StudyController */
/* @var $model Study */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'study-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group col-lg-6">
		<?php echo $form->labelEx($model,'staff_id'); ?>
		<?php echo $form->dropDownList($model, 'staff_id', Publication::getStaff(), array('class' => 'form-control', 'empty'=>'--select staff--')); ?>
		<?php echo $form->error($model,'staff_id'); ?>
	</div>


	<div class=" form-group col-lg-6">
		<?php echo $form->labelEx($model,'level'); ?>
		<?php echo $form->textField($model, 'level', array('class' => 'form-control')); ?>
		<?php echo $form->error($model,'level'); ?>
	</div>

	
	<div class="form-group col-lg-6">
		<?php echo $form->labelEx($model,'university'); ?>
		<?php echo $form->textField($model, 'university', array('class' => 'form-control')); ?>
		<?php echo $form->error($model,'university'); ?>
	</div>

<div class=" form-group col-lg-6">
		<?php echo $form->labelEx($model,'status'); ?>
			<?php echo $form->textField($model, 'status', array('class' => 'form-control')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

<div class="form-group col-lg-6">
		<?php echo $form->labelEx($model,'year_of_study'); ?>
		<?php echo $form->textField($model, 'year_of_study', array('class' => 'form-control')); ?>
		<?php echo $form->error($model,'year_of_study'); ?>
	</div>

	<div class=" form-group col-lg-6">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->