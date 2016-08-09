<?php
/* @var $this StaffController */
/* @var $data Staff */
?>
<div class="view">
    <div class="col-md-12">
        <section class="panel">
            <div class="panel-body profile-information">
                <div class="col-md-3">
                    <div class="profile-pic text-center">
                        <?php echo CHtml::image(Yii::app()->getBaseUrl() . '/profile/' . $data->imagepath); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="profile-desk">
                        <b><?php echo CHtml::encode($data->getAttributeLabel('first_name')); ?>:</b>
                        <?php echo CHtml::encode($data->first_name); ?>
                        <br />
                        <b><?php echo CHtml::encode($data->getAttributeLabel('middle_name')); ?>:</b>
                        <?php echo CHtml::encode($data->middle_name); ?>
                        <br />

                        <b><?php echo CHtml::encode($data->getAttributeLabel('last_name')); ?>:</b>
                        <?php echo CHtml::encode($data->last_name); ?>
                        <br />
                        <a href="#" class="btn btn-primary">View Profile</a>
                    </div>
                </div>

            </div>
        </section>
    </div>
    <div class="view">


        <?php echo CHtml::image(Yii::app()->getBaseUrl() . '/profile/' . $data->imagepath); ?>
        <br />
        <b><?php echo CHtml::encode($data->getAttributeLabel('first_name')); ?>:</b>
        <?php echo CHtml::encode($data->first_name); ?>
        <br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('middle_name')); ?>:</b>
        <?php echo CHtml::encode($data->middle_name); ?>
        <br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('last_name')); ?>:</b>
        <?php echo CHtml::encode($data->last_name); ?>
        <br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('start_date')); ?>:</b>
        <?php echo CHtml::encode($data->start_date); ?>
        <br />


        <b><?php echo CHtml::encode($data->getAttributeLabel('DOB')); ?>:</b>
        <?php echo CHtml::encode($data->DOB); ?>
        <br />

        <?php /*
          <b><?php echo CHtml::encode($data->getAttributeLabel('college')); ?>:</b>
          <?php echo CHtml::encode($data->college); ?>
          <br />

          <b><?php echo CHtml::encode($data->getAttributeLabel('department')); ?>:</b>
          <?php echo CHtml::encode($data->department); ?>
          <br />

          <b><?php echo CHtml::encode($data->getAttributeLabel('descrpt')); ?>:</b>
          <?php echo CHtml::encode($data->descrpt); ?>
          <br />

          <b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
          <?php echo CHtml::encode($data->phone); ?>
          <br />

          <b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
          <?php echo CHtml::encode($data->email); ?>
          <br />



          <b><?php echo CHtml::encode($data->getAttributeLabel('education')); ?>:</b>
          <?php echo CHtml::encode($data->education); ?>
          <br />

          <b><?php echo CHtml::encode($data->getAttributeLabel('exprience')); ?>:</b>
          <?php echo CHtml::encode($data->exprience); ?>
          <br />

          <b><?php echo CHtml::encode($data->getAttributeLabel('phone2')); ?>:</b>
          <?php echo CHtml::encode($data->phone2); ?>
          <br />

          <b><?php echo CHtml::encode($data->getAttributeLabel('email2')); ?>:</b>
          <?php echo CHtml::encode($data->email2); ?>
          <br />

         */ ?>

    </div>