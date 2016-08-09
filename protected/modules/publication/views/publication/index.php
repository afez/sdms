<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */
?>
<section class="panel panel-primary">

    <div class="panel-body">
        <div class="container col-lg-12">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Publications</a></li>
                <li><a data-toggle="tab" href="#menu1">Overall Assesment</a></li>

            </ul>


            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <h4>Publications</h4>
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Publication Title</th>
                                <th>Publication Type</th>
                                <th>Author</th>
                                <th>Year of Publication</th>
<!--                                <th>Uploaded By</th>-->
                                <?php if (User::loggedUser()->role != "Staff") : ?>
                                    <th>Status</th>
                                <?php endif; ?>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sn = 1;
                            foreach ($models as $model) {
                                ?>
                                <tr>
                                    <td><?php echo $sn; ?></td>
                                    <td><?php echo $model->name; ?></td>
                                    <td><?php echo $model->type; ?></td>
                                    <td></td>
                                    <td></td>
    <!--                                    <td><?php //echo $model->uploadby->username;   ?></td>-->

                                    <?php if (User::loggedUser()->role != "Staff") : ?>
                                        <td class="center">
                                            <a href="<?php echo $this->createUrl('/Assescriteria/assesment/assess', ['id' => $model->id]); ?>" class="btn btn-danger"><i class="fa fa-thumbs-up">Assesment</i></a>
                                        <?php endif; ?>
                                    <td class="center">
                                        <a target="_blank" href="<?php echo Yii::app()->baseUrl . '/publication/' . $model->docupload ?>" class="btn btn-primary"><i class="fa fa-download">Download</i></a>

                                    </td>
                                </tr>
                                <?php
                                $sn++;
                            }
                            ?>

                        </tbody>
                    </table>

                </div>

                <div id="menu1" class="tab-pane fade">
                    <h3>Assesment</h3>
                    <p>Some content in assesment.</p>
                </div>

            </div>
        </div>
    </div></section>