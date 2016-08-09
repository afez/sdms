<?php ?>



<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading">
                <div class = "pull-right">
                    <a href = "<?php echo $this->createUrl('/study/study/create', array("id" => $id)); ?>"> <button type = "button" class = "btn btn-primary"><i class = "fa fa-plus-square"></i> Add  </button></a>
                </div>
                Academic Staffs on Studies

            </header>
            <div class="panel-body">
                <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                        <tfoot>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>University</th>
                                <th>Year of Study</th>
                                <th class="hidden-phone">Level of Study</th>
                                <th class="hidden-phone">status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($model as $models) : ?>
                                <tr class="gradeX">
                                    <td><?php echo $models->staff->title . ' ' . $models->staff->first_name . ' ' . $models->staff->middle_name . ' ' . $models->staff->last_name; ?></td>
                                    <td><?php echo $models->university; ?></td>
                                    <td><?php echo $models->year_of_study; ?></td>
                                    <td class="center hidden-phone"><?php echo $models->level; ?></td>
                                    <td class="center hidden-phone"><?php echo $models->status; ?></td>
                                    <td class="center">
                                        <?php if (User::loggedUser()->role != "Staff") : ?>
                                            <a class="btn btn-primary" href="<?php echo Yii::app()->createUrl('/study/study/update/id/' . $models->id) ?>">
                                                <i class="glyphicon glyphicon-edit icon-white"></i>
                                                Edit
                                            </a>
                                        <?php endif; ?>


                                    </td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    </tfoot>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>
<script type="text/javascript" language="javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/data-tables/DT_bootstrap.js"></script>
<!--common script init for all pages-->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/scripts.js"></script>

<!--dynamic table initialization -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/dynamic_table_init.js"></script>
