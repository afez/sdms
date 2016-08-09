<div class = "col-sm-12">
    <section class = "panel">
        <header class = "panel-heading">

            <h4 style = "color: black ">Assigned Publications</h4>

        </header>
        <div class = "panel-body">
            <table  class="display table table-bordered table-striped" id="dynamic-table">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Author</th>
                        <th>TiTle</th>
                        <th>Type of publication</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sn = 1;
                    foreach ($model as $models) {
                        ?>
                        <tr>
                            <td><?php echo $sn; ?></td>
                            <td><?php echo $models->publication->staff->title . ' ' . $models->publication->staff->first_name . '' . $models->publication->staff->middle_name . ' ' . $models->publication->staff->last_name; ?></td>
                            <td><?php echo $models->publication->name; ?></td>
                            <td><?php echo $models->publication->type; ?></td>

                            <td class="center">
                                <a href="<?php echo $this->createUrl('/Assescriteria/assesment/assess', ['id' => $models->publication_id]); ?>" class="btn btn-primary"><i class="fa fa-thumbs-up">Review</i></a>
                            </td>

                            <td class="center">
                                <a target="_blank" href="<?php echo Yii::app()->baseUrl . '/publication/' . $model->docupload ?>" class="btn btn-default"><i class="fa fa-download">Download</i></a>

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


