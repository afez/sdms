<?php
/* @var $this PreportController */
/* @var $model Preport */
/* @var $form CActiveForm */
?>

<div class="form">

<?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'preport-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
            'role' => 'form',
            'class' => 'form-horizontal'
        ),
    ));
    ?>

	 <?php echo $form->errorSummary($model, null, null, array('class' => 'alert alert-danger')) . "<br />"; ?>

    <div class="form-group col-lg-6" >
        <?php echo $form->labelEx($model, ' Title'); ?>
        <?php echo $form->textField($model, 'name', array('class' => 'form-control', 'size' => 60, 'maxlength' => 100)); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="form-group col-lg-4">
        <?php echo $form->labelEx($model, 'Upload report here'); ?>
        <?php echo $form->fileField($model, 'report'); ?>
        <?php echo $form->error($model, 'report'); ?>
    </div>


    <div class="form-group col-lg-9" >
        <?php echo $form->labelEx($model, ' Add description here'); ?>
        <?php echo $form->textArea($model, 'description', array('class' => 'form-control', 'size' => 60, 'maxlength' => 100)); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>
	

	
	 <div class="form-group col-lg-6" >
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Save', array('class'=>'btn btn-primary')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->