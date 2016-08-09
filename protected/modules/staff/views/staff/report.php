<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>



<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'user-form',
    'enableAjaxValidation' => false,
        ));
?>
<div class="col-lg-12">
    <section class="panel">
        <header style="background:ghostwhite "class="panel-heading">
            <h4 style="color: black  ">View Report </h4>
        </header>
        <div class="panel-body">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'Select Format'); ?>
                <?php
                echo $form->dropDownList($model, 'output', $model->getOutputs(), array('class' => 'form-control'));
                ?>
                <?php echo $form->error($model, 'output'); ?></div>

            <div style="margin-left: 20px;" class="row buttons">
                <?php echo CHtml::submitButton('View', array('class' => 'btn btn-primary')); ?>
            </div>
            <?php $this->endWidget(); ?>

        </div><!-- form -->

    </section>
</div>



