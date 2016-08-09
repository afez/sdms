<div class = "col-sm-12">
    <section class = "panel">
        <header class = "panel-heading">
            <?php if ((User::loggedUser()->role_id != 2) AND ( User::loggedUser()->role_id != 7)) : ?>
                <div class = "pull-right">

                    <a href = "<?php echo $this->createUrl('/publication/publication/create', array("id" => $id)); ?>"> <button type = "button" class = "btn btn-primary"><i class = "fa fa-plus-square"></i> Add Publication</button></a>
                    <br>
                </div>
            <?php endif; ?>
            <h4 style = "color: black "><?php echo $model->id; ?> Publications</h4>

        </header>
        <div class = "panel-body">
            <table  class="display table table-bordered table-striped" id="dynamic-table">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Author</th>
                        <th>Publication's TiTle</th>
                          <th>Publication's Type</th>
                        <th>Year of publication </th>
                        <?php if ((User::loggedUser()->role_id != 2) AND ( User::loggedUser()->role_id != 7)) : ?>
                            <th></th>
                        <?php endif; ?>

                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sn = 1;
                    foreach ($model as $model) {
                        ?>
                        <tr>
                            <td><?php echo $sn; ?></td>
                            <td><?php echo $model->staff->title . ' ' . $model->staff->first_name . '  ' . $model->staff->middle_name . '  ' . $model->staff->last_name; ?></td>
                            <td><?php echo $model->name; ?></td>

                            <td><?php echo $model->type; ?></td>
                            <td><?php echo $model->year; ?></td>
                            <?php if ((User::loggedUser()->role_id != 2) AND ( User::loggedUser()->role_id != 7)) : ?>
                                <td class="center">
                                    <a href="<?php echo $this->createUrl('/user/reviewer', ['id' => $model->id]); ?>"class="btn btn-primary"><i class="fa fa-plus-square-o">Assign Reviewer</i></a>
                                </td>
                            <?php endif; ?>

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
