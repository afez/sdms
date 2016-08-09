<?php ?>

<!--<h1>Positions</h1>-->

<?php
?>
<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading no-border">
                <?php if ((User::loggedUser()->role_id != 2) AND ( User::loggedUser()->role_id != 3) AND ( User::loggedUser()->role_id != 7)) : ?>
                    <div class = "pull-right"><button type="button"  class="btn btn-primary">
                            <?php
                            echo CHtml::link('Add New Detail', '#', array(
                                'onclick' => '$("#mydialog").dialog("open"); return false;',
                            ));
                            ?>
                        </button>

                        <br>
                        <br>
                    </div>
                <?php endif; ?>
                <h3>Academic Ranks</h3>

            </header>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Description</th>
                            <?php if ((User::loggedUser()->role_id != 2) AND ( User::loggedUser()->role_id != 3) AND ( User::loggedUser()->role_id != 7)) : ?>
                                <th>Action</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sn = 1;
                        foreach ($model as $models) {
                            ?>
                            <tr>
                                <td><?php echo $sn; ?></td>
                                <td><?php echo $models->position_name ?></td>
                                <td><?php echo $models->descrp ?></td>
                                <?php if ((User::loggedUser()->role_id != 2) AND ( User::loggedUser()->role_id != 3) AND ( User::loggedUser()->role_id != 7)) : ?>
                                    <td class="center"> 
                                        <a class="btn btn-primary" href="<?php echo Yii::app()->createUrl('/position/position/update/id/' . $models->id) ?>">
                                            <i class="glyphicon glyphicon-edit icon-white"></i>
                                            Edit
                                        </a>
                                    </td>
                                <?php endif; ?>
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
</div>
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'mydialog',
    // additional javascript options for the dialog plugin
    'options' => array(
        'title' => 'Add New Detail',
        'autoOpen' => false,
        'modal' => true,
        'width' => 550,
        'height' => 400,
    ),
));



$this->renderPartial('_form', array('model' => $mod));



$this->endWidget('zii.widgets.jui.CJuiDialog');

// the link that may open the dialog
?>