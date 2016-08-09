<?php
/* @var $this StaffController */
/* @var $model Staff */

$this->breadcrumbs = array(
    'Staffs' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'List Staff', 'url' => array('index')),
    array('label' => 'Create Staff', 'url' => array('create')),
    array('label' => 'Update Staff', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Staff', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Staff', 'url' => array('admin')),
);
?>

<div class="col-lg-12">
    <section  class="panel panel-primary">
        <div class="panel-body">

            <h4>View this Staff </h4>

            <?php
            $this->widget('zii.widgets.CDetailView', array(
                'data' => $model,
                'attributes' => array(
                    'first_name',
                    'middle_name',
                    'last_name',
                    'start_date',
                    'DOB',
                    array('name'=>'college.name',
                        'header'=>'College',
                        ),
                  array('name'=>'department.name',
                        'header'=>'department',
                        ),
                   
                    'status',
                    'phone',
                    'email',
                    'education',
                ),
            ));
            ?>

        </div>
    </section>
</div>

