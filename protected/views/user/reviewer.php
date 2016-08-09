<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */
?>


<div class="col-sm-12">
    <section class="panel">
        <header class="panel-heading">

            <h4 style="color:black  ">Assign Reviewers </h4>

        </header>
        <div class="panel-body">
            <table  class="display table table-bordered table-striped" id="dynamic-table">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>

                    <?php
                    $sn = 1;
                    foreach ($model as $model) {
                        if($model->staff){
                            $r=$model->staff;
                        }elseif ($model->reviewer) {
                            $r=$model->reviewer;
                         }else{
                             //invalid user
                         }
                        if ($r->department_id != User::loggedUser()->staff->department_id)
                            continue;
                        ?>
                        <tr>
                            <td><?php echo $sn; ?></td>
                        
                            <td><?php echo $r->first_name . '' . $r->middle_name . ' ' . $r->last_name; ?></td>
                            <td><?php echo $r->department->name; ?></td> 
                            <td class="center">

                                <a class="btn btn-primary" href="<?php echo $this->createUrl('/publication/publication/assign', ['rid' => $model->id, 'pid' => $id]); ?>">
                                    <i class="glyphicon glyphicon-edit icon-white"></i>
                                    Assign
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

