
<?php
/* @var $this  StaffController */
/* @var $model Staff */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'staff-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
            'role' => 'form',
            'class' => 'form-horizontal'
        ),
    ));
    ?>

    <div class="main-box-body clearfix">
        <header class="main-box-header clearfix">
            <h3 class="col-lg-6"><?php echo ($model->isNewRecord) ? 'Register New Staff' : 'Update this Staff'; ?></h3>

            <div class="pull-right">

                <a href="<?php echo Yii::app()->createUrl('//staff/staff/index') ?>"><div class = 'btn btn-default'><i class="fa fa-"></i> Academic Staff</div></a>
            </div>
            <div class="pull-right">
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Save Staff' : 'Update Staff', array('class' => 'btn btn-primary')); ?>

            </div>
        </header>
        <div class="main-box-body clearfix">
            <p class="note">Fields with <span class="required">*</span> are required.</p>
            <?php echo $form->errorSummary($model); ?>

            <div class="tabs-wrapper">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-details">Details</a></li>
                    <li><a data-toggle="tab" href="#tab-contact">Contact</a></li>
                    <li><a data-toggle="tab" href="#tab-login">Login Info</a></li>

                </ul>
                <div class="tab-content">
                    <div id="tab-details" class="tab-pane fade in active">
                        <h3><span>Staff Basic Information</span></h3>

                        <div class="form-group col-lg-4" >
                            <?php echo $form->labelEx($model, ' Title *'); ?>
                            <?php echo $form->dropDownList($model, 'title', Staff::getTitle(), array('class' => 'form-control', 'empty' => '--Select title--')); ?>
                            <?php echo $form->error($model, 'title'); ?>
                        </div>
                        <div class="form-group col-lg-4" >
                            <?php echo $form->labelEx($model, ' First Name *'); ?>
                            <?php echo $form->textField($model, 'first_name', array('class' => 'form-control', 'placeholder' => 'Enter first name', 'size' => 60, 'maxlength' => 100)); ?>
                            <?php echo $form->error($model, 'first_name'); ?>
                        </div>



                        <div class="form-group col-lg-4">
                            <?php echo $form->labelEx($model, 'Middle name *'); ?>
                            <?php echo $form->textField($model, 'middle_name', array('class' => 'form-control col-lg-4', 'placeholder' => 'Enter middle name', 'size' => 60, 'maxlength' => 100)); ?>
                            <?php echo $form->error($model, 'middle_name'); ?>
                        </div>

                        <div class="form-group col-lg-4" >
                            <?php echo $form->labelEx($model, 'last_name *'); ?>
                            <?php echo $form->textField($model, 'last_name', array('class' => 'form-control')); ?>
                            <?php echo $form->error($model, 'last_name'); ?>
                        </div>
                        <div class="form-group col-lg-4">
                            <?php echo $form->labelEx($model, 'Staff Image *'); ?>
                            <?php echo $form->fileField($model, 'imagepath'); ?>
                            <?php echo $form->error($model, 'imagepath'); ?>
                        </div>
                        <div class="form-group col-lg-4">
                            <?php echo $form->labelEx($model, 'College name *'); ?>
                            <?php echo $form->dropDownList($model, 'college_id', Department::getCollege(), array('class' => 'form-control', 'empty' => '--select college--')); ?>
                            <?php echo $form->error($model, 'college_id '); ?>
                        </div>


                        <div class="form-group col-lg-4" >
                            <?php echo $form->labelEx($model, ' Department Name *'); ?>
                            <?php echo $form->dropDownList($model, 'department_id', Staff::getDepartment(), array('class' => 'form-control', 'empty' => '--select department--')); ?>
                            <?php echo $form->error($model, 'department_id'); ?>
                        </div>


                        <div class="form-group col-lg-4">
                            <?php echo $form->labelEx($model, 'Education Level'); ?>
                            <?php echo $form->dropDownList($model, 'education', Staff::getLevel(), array('class' => 'form-control', 'empty' => '--select--')); ?>
                            <?php echo $form->error($model, 'education'); ?>
                        </div>
                        <div class="form-group col-lg-4">
                            <?php echo $form->labelEx($model, 'Work status'); ?>
                            <?php echo $form->dropDownList($model, 'status', Staff::getStatus(), array('class' => 'form-control', 'empty' => '--select status--')); ?>
                            <?php echo $form->error($model, 'status'); ?>
                        </div>


                        <div class="form-group col-lg-4" >
                            <?php echo $form->labelEx($model, 'Employment date'); ?>
                            <?php
                            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'name' => 'start_date',
                                'attribute' => 'start_date',
                                'model' => $model,
//		'value' => $model->created_at,
                                // additional javascript options for the date picker plugin
                                'options' => array(
                                    'showAnim' => 'fold',
                                    'dateFormat' => 'yy-mm-dd',
                                ),
                                'htmlOptions' => array(
                                    'placeholder' => 'format yyyy-mm-dd',
                                    'class' => 'form-control'
                                ),
                            ))
                            ?>
                            <?php echo $form->error($model, 'start_date'); ?>
                        </div>
                        <br/>
                        <div class="form-group col-lg-4" >
                            <?php echo $form->labelEx($model, 'Date of Birth'); ?>
                            <?php
                            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'name' => 'DOB',
                                'attribute' => 'DOB',
                                'model' => $model,
//		'value' => $model->created_at,
                                // additional javascript options for the date picker plugin
                                'options' => array(
                                    'showAnim' => 'fold',
                                    'dateFormat' => 'yy-mm-dd',
                                ),
                                'htmlOptions' => array(
                                    'placeholder' => 'format yyyy-mm-dd',
                                    'class' => 'form-control'
                                ),
                            ))
                            ?>
                            <?php echo $form->error($model, 'DOB'); ?>
                        </div>
                        <br/>


                    </div>

                    <div id="tab-contact" class="tab-pane fade">
                        <h3><span>Contact Details</span></h3>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <?php echo $form->labelEx($model, 'Email *'); ?>
                                <?php echo $form->textField($model, 'email', array('class' => 'form-control col-lg-4', 'placeholder' => 'Enter email', 'size' => 60, 'maxlength' => 100)); ?>
                                <?php echo $form->error($model, 'email'); ?>
                            </div>
                            <div class="form-group col-lg-6">
                                <?php echo $form->labelEx($model, 'Alternative Email'); ?>
                                <?php echo $form->textField($model, 'email2', array('class' => 'form-control col-lg-4', 'placeholder' => 'Enter email', 'size' => 60, 'maxlength' => 100)); ?>
                                <?php echo $form->error($model, 'email2'); ?>
                            </div>

                            <div class="form-group col-lg-6">
                                <?php echo $form->labelEx($model, 'Phone Number'); ?>
                                <?php echo $form->textField($model, 'phone', array('class' => 'form-control col-lg-4', 'placeholder' => 'Enter Phone Number eg 255768 567 890', 'size' => 60, 'maxlength' => 100)); ?>
                                <?php echo $form->error($model, 'phone'); ?>
                            </div>
                            <div class="form-group col-lg-6">
                                <?php echo $form->labelEx($model, 'Alternative Phone Number'); ?>
                                <?php echo $form->textField($model, 'phone2', array('class' => 'form-control col-lg-4', 'placeholder' => 'Enter Phone Number eg 255768 567 89', 'size' => 60, 'maxlength' => 100)); ?>
                                <?php echo $form->error($model, 'phone2'); ?>
                            </div>

                        </div>


                    </div>

                    <div id="tab-login" class="tab-pane fade">
                        <h3><span>Login Info</span></h3>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <?php echo $form->labelEx($model, 'Username *'); ?>
                                <?php echo $form->textField($model, 'username', array('class' => 'form-control col-lg-4', 'placeholder' => 'Enter username')); ?>
                                <?php echo $form->error($model, 'username'); ?>
                            </div>
                        </div>
                    </div>
                </div></div>

        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>

