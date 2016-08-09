<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */
?>


<div class="col-sm-12">
    <section class="panel">
        <header class="panel-heading">

            <h4 style="color:black  ">Users </h4>

        </header>
        <div class="panel-body">
         <table  class="display table table-bordered table-striped" id="dynamic-table">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Username</th>
                        <th>Role</th>
                        <?php if ((User::loggedUser()->role_id != 2) AND ( User::loggedUser()->role_id != 3) AND ( User::loggedUser()->role_id != 7)) : ?>
                            <th>Action</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sn = 1;
                    foreach ($models as $model) {
                        ?>
                        <tr>
                            <td><?php echo $sn; ?></td>
                            <td><?php echo $model->username; ?></td>
                            <td><?php echo $model->role->name; ?></td>

                            <td class="center">

                                                               <?php if ((User::loggedUser()->role_id != 2) AND (User::loggedUser()->role_id != 3) AND (User::loggedUser()->role_id != 7)) : ?>
                                    <a class="btn btn-primary" href="<?php echo Yii::app()->createUrl('/user/update/id/' . $model->id) ?>">
                                        <i class="glyphicon glyphicon-edit icon-white"></i>
                                        Edit
                                    </a>
                                    <a class="btn btn-danger" href="<?php echo Yii::app()->createUrl('/user/delete/id/' . $model->id) ?>">
                                        <i class="glyphicon glyphicon-trash icon-white"></i>
                                        Delete
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

