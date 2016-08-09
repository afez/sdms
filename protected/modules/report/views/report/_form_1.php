<?php
/* @var $this CollegeController */
/* @var $model College */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'college-form',
	'enableAjaxValidation'=>false,
)); ?>

    
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model, null, null, array('class' => 'alert alert-danger')) . "<br />"; ?>
        
<div class="form-group col-lg-4" >
		<?php echo $form->labelEx($model,'Name'); ?>
		<?php echo $form->textField($model,'name',array('class'=>'form-control','placeholder'=>'Enter college name','size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="form-group col-lg-4">
		<?php echo $form->labelEx($model,'College Principal'); ?>
		<?php echo $form->textField($model,'hoc',array('class'=>'form-control col-lg-4','placeholder'=>'Enter prnciple of college name','size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'Head'); ?>
	</div>


	
        <div style="margin-left: 10px; margin-top: 20px;"class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Add' : 'Update Donor',array('class'=>'btn btn-info')); ?>
	</div>
	<?php $this->endWidget(); ?>



</div><!-- form -->