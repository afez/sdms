<?php
/* @var $this StaffController */
/* @var $model Staff */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'publication-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
            'role' => 'form',
            'class' => 'form-horizontal'
        ),
    ));
    ?>


    <?php echo $form->errorSummary($model, null, null, array('class' => 'alert alert-danger')) . "<br />"; ?>
    <div class="form-group col-lg-4" >
        <?php echo $form->labelEx($model, ' Author'); ?>
        <?php echo $form->dropDownList($model,  'staff_id', Publication::getStaff(), array('class' => 'form-control','empty'=>'--select staff--')); ?>
        <?php echo $form->error($model, 'staff_id'); ?>
    </div>
  


    <div class="form-group col-lg-4" >
        <?php echo $form->labelEx($model, ' Title'); ?>
        <?php echo $form->textField($model, 'name', array('class' => 'form-control', 'size' => 60, 'maxlength' => 100)); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>
    <div class="form-group col-lg-4" >
        <?php echo $form->labelEx($model, ' Year of Publication'); ?>
        <?php echo $form->textField($model, 'year', array('class' => 'form-control', 'size' => 60, 'maxlength' => 100)); ?>
        <?php echo $form->error($model, 'year'); ?>
    </div>
    <div class="form-group col-lg-4">
        <?php echo $form->labelEx($model, 'Type of publication'); ?>
        <?php echo $form->dropDownList($model, 'type', Publication::getType(), array('empty' => '--select type of publication--', 'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'type'); ?>
    </div>
    <div class="form-group col-lg-4">
        <?php echo $form->labelEx($model, 'Upload File here'); ?>
        <?php echo $form->fileField($model, 'docupload'); ?>
        <?php echo $form->error($model, 'docupload'); ?>
    </div>


    <div class="form-group col-lg-6" >
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Save', array('class' => 'btn btn-primary')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->