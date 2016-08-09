


<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'login-form',
    'enableClientValidation' => true,
    'htmlOptions' => array(
        'class' => 'form-signin',
    ),
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
        ));
?>
<h2 class="form-signin-heading"><img style="margin-bottom: -10px"src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png"  > UDSM</h2>
<div class="login-wrap">
    <div class="user-login-info">
        <?php echo $form->textField($model, 'username', array('placeholder' => 'Enter username', 'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'username'); ?>

<?php echo $form->passwordField($model, 'password', array('placeholder' => 'Enter Password', 'class' => 'form-control')); ?>
<?php echo $form->error($model, 'password'); ?>


    </div>

    <button class="btn btn-lg btn-login btn-block" type="submit">Log in</button>



</div>



<?php $this->endWidget(); ?>


