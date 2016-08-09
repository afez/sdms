<?php
/* @var $this PositionController */
/* @var $model Position */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'position-form',
        'enableAjaxValidation' => TRUE,
    ));
    ?>

    <div id="error"></div>
    <section class="panel">

        <div class="form-group col-lg-6" >
            <?php echo $form->labelEx($model, 'Name'); ?>
            <?php echo $form->textField($model, 'position_name', array('class' => 'form-control', 'placeholder' => 'Enter Position level', 'size' => 60, 'maxlength' => 100)); ?>
            <?php echo $form->error($model, 'position_name'); ?>
        </div>

        <div class="form-group col-lg-6">
            <?php echo $form->labelEx($model, 'Description'); ?>
            <?php echo $form->textArea($model, 'descrp', array('class' => 'form-control col-lg-4', 'placeholder' => 'Enter Description', 'size' => 60, 'maxlength' => 100)); ?>
            <?php echo $form->error($model, 'descrp'); ?>
        </div>

        <div style="margin-left: 10px; margin-top: 95px;"class="row buttons">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Add' : 'Add', array('id' => 'ajax', 'class' => 'btn btn-primary'), array('class' => 'btn btn-primary'));
            ?>
        </div>

        <?php $this->endWidget(); ?>
    </section>


</div><!-- form -->

<script>
    jQuery('body').on('click', '#ajax', function (e) {
        jQuery.ajax({
            'name': 'run',
            'class': 'btn btn-info',
            'type': 'POST',
            'url': '/SDMS/index.php/position/position/index',
            'cache': false,
            'data': jQuery(this).parents("form").serialize(),
            'success': function (html) {
                //console.log(html);
                $('#error').html(html);
            }
        });
        return false;
    });
</script>