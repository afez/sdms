<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */
?>


<div class="col-sm-12">
    <section class="panel">
        <header class="panel-heading">

            <h4>Progress Reports List</h4>
        </header>
        <div class="panel-body">
            <table  class="display table table-bordered table-striped" id="dynamic-table">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Title</th>
                        <th>Report</th>
                        <th>Uploaded By</th>

                        <th>Action</th>

                    </tr>
                </thead>
                <tbody style="margin-top: 10px">
                    <?php
                    $sn = 1;
                    foreach ($model as $model) {
                        ?>
                        <tr>
                            <td><?php echo $sn; ?></td>
                            <td><?php echo $model->name; ?></td>
                            <td><?php echo $model->report; ?></td>
                            <td><?php echo $model->uploadby->username; ?></td>



                            <td class="center">
                                <a target="_blank" href="<?php echo Yii::app()->baseUrl . '/report/' . $model->report ?>" class="btn btn-default"><i class="fa fa-download">Download</i></a>

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
