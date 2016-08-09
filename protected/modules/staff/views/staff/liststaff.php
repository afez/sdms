

<div class = "col-sm-12">
    <section class = "panel">
        <header class = "panel-heading">
            <h4 style = "color: black ">Academic Staff Publication </h4>



        </header>
        <div class = "panel-body">
            <table  class="display table table-bordered table-striped" id="dynamic-table">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Author</th>
                        <th>College</th>
                        <th>Department</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sn = 1;
                    foreach ($models as $model) {
                  if($model->department_id!=User::loggedUser()->staff->department_id) {
                      continue;
                    }
                            ?>
                        <tr>
                            <td><?php echo $sn; ?></td>
                            <td><?php echo $model->title . ' ' . $model->first_name . ' ' . $model->middle_name . ' ' . $model->last_name; ?></td>
                            <td><?php echo $model->college->name; ?></td>
                            <td><?php echo $model->department->name; ?></td>


                            <td class="center">


                                <a class="btn btn-primary" href="<?php echo Yii::app()->createUrl('/publication/publication/list/', array("id" => $model->id)) ?>">
                                    <i class="glyphicon glyphicon-edit icon-white"></i>
                                    Publications
                                </a>

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
