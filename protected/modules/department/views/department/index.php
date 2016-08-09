



<div class = "col-sm-12">
    <section class = "panel">
        <header class = "panel-heading">
            <?php if ((User::loggedUser()->role_id != 2) AND ( User::loggedUser()->role_id != 3) AND ( User::loggedUser()->role_id != 7)) : ?>
                <div class = "pull-right">
                    <a href = "<?php echo $this->createUrl('/department/department/create'); ?>"> <button type = "button" class = "btn btn-primary"><i class = "fa fa-plus-square"></i> Add New Deparment </button></a>
                    <br>
                </div>
            <?php endif; ?>
            <h4 style = "color: black ">Departments </h4>




        </header>
        <div class = "panel-body">
            <table  class="display table table-bordered table-striped" id="dynamic-table">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Department Name</th>
                        <th>Head of Department</th>

                        <th>College</th>
                        <?php if ((User::loggedUser()->role_id != 2) AND ( User::loggedUser()->role_id != 3) AND ( User::loggedUser()->role_id != 7)) : ?>
                            <th>Action</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sn = 1;
                    foreach ($model as $model) {
                        ?>
                        <tr>
                            <td><?php echo $sn; ?></td>
                            <td><?php echo $model->name; ?></td>
                            <td><?php echo $model->staff->title . ' ' . $model->staff->first_name . ' ' . $model->staff->middle_name . ' ' . $model->staff->last_name; ?></td>
                            <td><?php echo $model->college->name; ?></td>
                            <?php if ((User::loggedUser()->role_id != 2) AND ( User::loggedUser()->role_id != 3) AND ( User::loggedUser()->role_id != 7)) : ?>
                                <td class="center">

                                    <a class="btn btn-primary" href="<?php echo Yii::app()->createUrl('/department/department/update/id/' . $model->id) ?>">
                                        <i class="glyphicon glyphicon-edit icon-white"></i>
                                        Edit
                                    </a>
                                <?php endif; ?>


                            </td>
                        </tr>
                        <?php
                        $sn++;
                    }
                    ?>

                </tbody>
            </table>

        </div>
    </section>
</div>
<script type="text/javascript" language="javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/data-tables/DT_bootstrap.js"></script>
<!--common script init for all pages-->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/scripts.js"></script>

<!--dynamic table initialization -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/dynamic_table_init.js"></script>
