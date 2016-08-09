<?php
/* @var $this AssesmentController */
/* @var $model Assesment */
/* @var $form CActiveForm */
?>

<div class="alert alert-info fade in">
    <button data-dismiss="alert" class="close close-sm" type="button">
        <i class="fa fa-times"></i>
    </button>
    <strong class="btn btn-primary">ATTENTION!</strong> Grade the publication out of 100%. 

</div>
<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'assesment-form',
        'enableAjaxValidation' => false,
    ));
    ?>


    <?php echo $form->errorSummary($model, null, null, array('class' => 'alert alert-danger')) . "<br />"; ?>

    <div class="form-group col-lg-6">
        <?php echo $form->labelEx($model, 'Coverage of subject matter'); ?>
        <?php echo $form->textField($model, 'coverag', array('class' => 'form-control', 'placeholder' => 'out of 100%')); ?>
        <?php echo $form->error($model, 'coverag'); ?>
    </div>
    <div class="form-group col-lg-6">
        <?php echo $form->labelEx($model, 'Originality'); ?>
        <?php echo $form->textField($model, 'originality', array('class' => 'form-control', 'placeholder' => 'out of 100%')); ?>
        <?php echo $form->error($model, 'originality'); ?>
    </div>
    <div class="form-group col-lg-6">
        <?php echo $form->labelEx($model, 'Contribution to knowledge'); ?>
        <?php echo $form->textField($model, 'Contribut', array('class' => 'form-control', 'placeholder' => 'out of 100%')); ?>
        <?php echo $form->error($model, 'Contribut'); ?>
    </div>
    <div class="form-group col-lg-6">
        <?php echo $form->labelEx($model, 'Relevance to academic discipline'); ?>
        <?php echo $form->textField($model, 'academic_discipline', array('class' => 'form-control', 'placeholder' => 'out of 100%')); ?>
        <?php echo $form->error($model, 'academic_discipline'); ?>
    </div>
    <div class="form-group col-lg-6">
        <?php echo $form->labelEx($model, 'Relevance to individual’s own specialisation in an academic displine '); ?>
        <?php echo $form->textField($model, 'specialize', array('class' => 'form-control', 'placeholder' => 'out of 100%')); ?>
        <?php echo $form->error($model, 'specialize'); ?>
    </div>
    <div class="form-group col-lg-6">
        <?php echo $form->labelEx($model, 'Presentation'); ?>
        <?php echo $form->textField($model, 'presentation', array('class' => 'form-control', 'placeholder' => 'out of 100%')); ?>
        <?php echo $form->error($model, 'presentation'); ?>
    </div>

    <div class="form-group col-lg-6">
        <?php echo $form->labelEx($model, 'Overall quality'); ?>
        <?php echo $form->textField($model, 'overall_quality', array('class' => 'form-control', 'placeholder' => 'out of 100%')); ?>
        <?php echo $form->error($model, 'overall_quality'); ?>
    </div>

 <div class="form-group col-lg-12">
        <?php echo $form->labelEx($model, 'Any other comment, suggestion or recommendations'); ?>
        <?php echo $form->textArea($model, 'remark', array('class' => 'form-control', 'rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'remark'); ?>
    </div>

    <div class="form-group col-lg-12">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Save', array('class' => 'btn btn-primary')); ?>
    </div>


    <?php $this->endWidget(); ?>

</div><!-- form -->
