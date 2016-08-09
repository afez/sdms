
<?php
/* @var $this CollegeController */
/* @var $model College */
/* @var $form CActiveForm */
?>


<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'college-form',
        'enableAjaxValidation' => false,
    ));
    ?>



    <?php echo $form->errorSummary($model, null, null, array('class' => 'alert alert-danger')) . "<br />"; ?>
    <div class="form-group col-lg-6">
        <?php echo $form->labelEx($model, 'College'); ?>
        <?php echo $form->dropDownList($model, 'college_id', Department::getCollege(), array('class' => 'form-control', 'empty' => '--select college--')); ?>
        <?php echo $form->error($model, 'college_id'); ?>
    </div>
    <div class="form-group col-lg-4" >
        <?php echo $form->labelEx($model, 'Department Name'); ?>
        <?php echo $form->textField($model, 'name', array('class' => 'form-control', 'placeholder' => 'Enter department name', 'size' => 60, 'maxlength' => 100)); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="form-group col-lg-4">
        <?php echo $form->labelEx($model, 'Head of Department'); ?>
        <?php echo $form->dropDownList($model, 'staff_id', Publication::getStaff(), array('class' => 'form-control col-lg-4', 'empty'=>'--select HoD--')); ?>
        <?php echo $form->error($model, 'staff_id'); ?>
    </div>
    




    <div style="margin-left: 10px; margin-top: 180px;"class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Add' : 'Update College', array('class' => 'btn btn-primary')); ?>
    </div>
    <?php $this->endWidget(); ?>





</div><!-- form -->