
<div class="col-md-6">
    <section class="panel">
        <div class="panel-body profile-information">
            <div class="col-md-6"style="background-color: #1FB5AD;">
                <div class="profile-pic text-center">
                    <?php echo CHtml::image(Yii::app()->getBaseUrl() . '/profile/' . $data->imagepath); ?>
                </div>
            </div>
            <div style="margin-top: 20px;"class="col-lg-6">

                <b><?php echo CHtml::encode($data->getAttributeLabel('Name')); ?>:</b>
                <?php echo CHtml::encode($data->title . '  ' . $data->first_name . ' ' . $data->middle_name . ' ' . $data->last_name); ?>
                <br />

                <b><?php echo CHtml::encode($data->getAttributeLabel('College')); ?>:</b>
                <?php echo CHtml::encode($data->college->name); ?>
                <br />
                <b><?php echo CHtml::encode($data->getAttributeLabel('Department')); ?>:</b>
                <?php echo CHtml::encode($data->department->name); ?>
                <br />
                <b><?php echo CHtml::encode($data->getAttributeLabel('Employment Date')); ?>:</b>
                <?php echo CHtml::encode($data->start_date); ?>   <br />
                <b><?php echo CHtml::encode($data->getAttributeLabel('Phone')); ?>:</b>
                <?php echo CHtml::encode($data->phone); ?>   <br />
                <b><?php echo CHtml::encode($data->getAttributeLabel('Email')); ?>:</b>
                <?php echo CHtml::encode($data->email); ?>
                <br />
                <br>
                <?php if ((User::loggedUser()->role_id != 2) AND ( User::loggedUser()->role_id != 3) AND ( User::loggedUser()->role_id != 7)) : ?>
                    <a href="<?php echo $this->createUrl('/staff/staff/update', ['id' => $data->id]); ?>" class="pull-right btn btn-primary fa fa-edit">Edit</a>
                <?php endif; ?>

            </div>

        </div>
    </section>
</div>
