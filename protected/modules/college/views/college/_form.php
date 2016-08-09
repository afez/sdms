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

    


	<?php echo $form->errorSummary($model, null, null, array('class' => 'alert alert-danger')) . "<br />"; ?>
        
<div class="form-group col-lg-4" >
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('class'=>'form-control','placeholder'=>'Enter college name','size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

   
        <div style="margin-left: 10px; margin-top: 95px;"class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Add' : 'Update Donor',array('class'=>'btn btn-primary')); ?>
	</div>
	<?php $this->endWidget(); ?>



</div><!-- form -->