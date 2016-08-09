<?php
/* @var $this ExreviewController */
/* @var $model Exreview */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'exreview-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

        <?php echo $form->errorSummary($model); ?>
    <div class="form-group col-lg-4" >
        <?php echo $form->labelEx($model, 'title *'); ?>
<?php echo $form->dropDownList($model, 'title', Staff::getTitle(), array('class' => 'form-control', 'empty' => '--select title--')); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>
    <div class="form-group col-lg-4" >
        <?php echo $form->labelEx($model, 'first_name'); ?>
<?php echo $form->textField($model, 'first_name', array('class' => 'form-control', 'size' => 60, 'maxlength' => 100)); ?>
<?php echo $form->error($model, 'first_name'); ?>
    </div>

    <div class="form-group col-lg-4" >
        <?php echo $form->labelEx($model, 'middle_name'); ?>
<?php echo $form->textField($model, 'middle_name', array('class' => 'form-control', 'size' => 60, 'maxlength' => 100)); ?>
<?php echo $form->error($model, 'middle_name'); ?>
    </div>

    <div class="form-group col-lg-4" >
        <?php echo $form->labelEx($model, 'last_name'); ?>
<?php echo $form->textField($model, 'last_name', array('class' => 'form-control', 'size' => 60, 'maxlength' => 100)); ?>
        <?php echo $form->error($model, 'last_name'); ?>
    </div>
    <div class="form-group col-lg-4" >
        <?php echo $form->labelEx($model, 'department *'); ?>
<?php echo $form->dropDownList($model, 'department_id', Staff::getDepartment(), array('class' => 'form-control', 'empty' => '--select department--')); ?>
        <?php echo $form->error($model, 'department_id'); ?>
    </div>
    <div class="form-group col-lg-4" >
        <?php echo $form->labelEx($model, 'username'); ?>
<?php echo $form->textField($model, 'username', array('class' => 'form-control', 'size' => 60, 'maxlength' => 100)); ?>
<?php echo $form->error($model, 'username'); ?>
    </div>

    <div class="form-group col-lg-12" >
        <?php echo $form->labelEx($model, 'qualification'); ?>
<?php echo $form->textArea($model, 'qualification', array('class' => 'form-control', 'rows' => 6, 'cols' => 50)); ?>
<?php echo $form->error($model, 'qualification'); ?>
    </div>



    <div class="form-group col-lg-12" >
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Save', array('class' => 'btn btn-primary')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->