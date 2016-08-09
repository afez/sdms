<?php
/* @var $this StaffController */
/* @var $model Staff */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    ));
    ?>

    <div class="form-group col-lg-4" >
        <?php echo $form->labelEx($model, ' First Name'); ?>
<?php echo $form->textField($model, 'first_name', array('class' => 'form-control', 'placeholder' => 'Enter first name', 'size' => 60, 'maxlength' => 100)); ?>
<?php echo $form->error($model, 'first_name'); ?>
    </div>

    <div class="form-group col-lg-4">
        <?php echo $form->labelEx($model, 'Middle name'); ?>
<?php echo $form->textField($model, 'middle_name', array('class' => 'form-control col-lg-4', 'placeholder' => 'Enter middle name', 'size' => 60, 'maxlength' => 100)); ?>
        <?php echo $form->error($model, 'middle_name'); ?>
    </div>
   


    <div class="row buttons">
    <?php echo CHtml::submitButton('Search'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->