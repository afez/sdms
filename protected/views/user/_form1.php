
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'change-password-form',
        'enableClientValidation' => true,
        'htmlOptions' => array('class' => 'well'),
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    ?>

    <?php echo $form->errorSummary($model, null, null, array('class' => 'alert alert-danger')) . "<br />"; ?>

    <div class="form-group col-lg-4" >
        <?php echo $form->labelEx($model, 'old_password'); ?>
        <?php echo $form->textField($model, 'old_password', array('class' => 'form-control col-lg-4')); ?>
        <?php echo $form->error($model, 'old_password'); ?> </div>

   <div class="form-group col-lg-4" >
        <?php echo $form->labelEx($model, 'new_password'); ?> 
        <?php echo $form->textField($model, 'new_password', array('class' => 'form-control col-lg-4')); ?>
        <?php echo $form->error($model, 'new_password'); ?> </div>

  <div class="form-group col-lg-4" >
        <?php echo $form->labelEx($model, 'repeat_password'); ?>
        <?php echo $form->textField($model, 'repeat_password', array('class' => 'form-control col-lg-4')); ?>
        <?php echo $form->error($model, 'repeat_password'); ?> </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Update' : 'Save', array('class' => 'btn btn-primary')); ?>
    </div>
    <?php $this->endWidget(); ?>
</div>
