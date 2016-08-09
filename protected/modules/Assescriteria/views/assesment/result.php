

<div class = "col-sm-12">
    <section class = "panel">
        <header class = "panel-heading">
            <h4 style = "color: black ">Results </h4>



        </header>
        <div class = "panel-body">
            <table  class="display table table-bordered table-striped" id="dynamic-table">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Author</th>
                        <th>Type of Publication</th>
                        <th>Reviewer</th>
                        <th>Average</th>
                        <th>Grade</th>
                        <th>Point</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sn = 1;
                    foreach ($model as $model) {
                        ?>
                        <tr>
                            <td><?php echo $sn; ?></td>
                             <td><?php echo $model->publication->staff->title.' '.$model->publication->staff->first_name.' '.$model->publication->staff->middle_name.' '.$model->publication->staff->last_name; ?></td>
                            <td><?php echo $model->publication->type ?></td>
                            <td><?php echo $model->reviewer->staff->first_name.' '.$model->reviewer->staff->middle_name.' '.$model->reviewer->staff->last_name; ?></td>
                            <td><?php echo $model->average ?></td>
                            <td><?php echo $model->grade; ?></td>
                            <td><?php echo $model->point; ?></td>
                            <td><?php echo $model->remark; ?></td>

                        </tr>
                        <?php
                        $sn++;
                    }
                    ?>

                </tbody>
            </table>

        </div>
        <a style="margin-top: 10px;"target="_blank" href="<?php echo Yii::app()->createUrl('/Assescriteria/assesment/printresult/') ?>" class="btn btn-primary"><i class="fa fa-print">Print</i></a>
    </section>
</div>
<script type="text/javascript" language="javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/data-tables/DT_bootstrap.js"></script>
<!--common script init for all pages-->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/scripts.js"></script>

<!--dynamic table initialization -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/dynamic_table_init.js"></script>
