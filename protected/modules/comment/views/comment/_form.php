<?php
/* @var $this CommentController */
/* @var $model Comment */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'comment-form',
        'enableAjaxValidation' => false,
    ));
    ?>


    
        <?php if (Yii::app()->user->hasFlash('contact')): ?>

            <div class="flash-success ">
                <?php echo Yii::app()->user->getFlash('contact'); ?>
            </div>

        <?php endif; ?> 
    </div>


    <?php echo $form->errorSummary($model, null, null, array('class' => 'alert alert-danger')) . "<br />"; ?>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'Whether the quality of publications assed in general reflect the authors current academic rank '); ?>
        <?php echo $form->dropDownList($model, 'publication_quality', Comment::getOption(), array('empty' => '--select--', 'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'publication_quality'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'Whether the quality of publications assed merit promotion of the author to the next academic rank'); ?>
        <?php echo $form->dropDownList($model, 'merit_promotion', Comment::getOption(), array('empty' => '--select--', 'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'merit_promotion'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'Any other comment, suggestion or recommendations'); ?>
        <?php echo $form->textArea($model, 'other_comment', array('class' => 'form-control', 'rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'other_comment'); ?>
    </div>

    <div style="margin-left: -10px; margin-top: 20px;"class="form-group col-lg-6">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Save', array('class' => 'btn btn-info')); ?>
    </div>


    <?php $this->endWidget(); ?>

</div><!-- form -->

<div style="margin-left: 200px; margin-top:-65px;"class="form-group col-lg-6">
    <a href="<?php echo $this->createUrl('/Assescriteria/assesment/index'); ?>">  <button class="btn btn-default">  << Go Back</button> </a>

</div>