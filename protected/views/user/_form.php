<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>
<a href="<?php echo Yii::app()->createUrl('/user/index') ?>"> <button class = 'btn btn-group'><i class="fa fa-users"></i> Users</button></a>
<div class="position-center">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'user-form',
        'enableAjaxValidation' => false,
    ));
    ?>




    <?php echo $form->errorSummary($model, null, null, array('class' => 'alert alert-danger')) . "<br />"; ?>

    <div class="form-group ">
        <?php echo $form->labelEx($model, 'username'); ?>
        <?php echo $form->textField($model, 'username', array('class' => 'form-control col-lg-6', 'placeholder' => 'Enter username', 'size' => 60, 'maxlength' => 100)); ?>
        <?php echo $form->error($model, 'username'); ?>
    </div>

<!--    <div class="form-group">
        <?php //echo $form->labelEx($model, 'password'); ?>
        <?php //echo $form->passwordField($model, 'password', array('class' => 'form-control', 'placeholder' => 'Enter password', 'size' => 60, 'maxlength' => 100)); ?>
        <?php //echo $form->error($model, 'password'); ?>
    </div>-->


    <div class="form-group">
        <?php echo $form->labelEx($model, 'Role'); ?>
        <?php echo $form->dropDownList($model, 'role_id', User::getRole(), array('class' => 'form-control', 'empty' => '--Assign role--')); ?>
        <?php echo $form->error($model, 'role_id'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary')); ?>
    </div>
    <?php $this->endWidget(); ?>

</div>