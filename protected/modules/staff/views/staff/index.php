<?php
/* @var $this StaffController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Staffs',
);

$this->menu = array(
    array('label' => 'Create Staff', 'url' => array('create')),
    array('label' => 'Manage Staff', 'url' => array('admin')),
);
?>
<div class="col-lg-12">
    <section class="panel panel-primary">
        <header style="background:ghostwhite "class="panel-heading">
            <h4 style="color: black  ">UDSM Academic Staff <a href="<?php echo $this->createUrl('/staff/staff/index'); ?>"<i style="margin-left: 400px" class="fa fa-refresh"></i></a>
                <div class="col-lg-3 pull-right">
                     
                    <form method="get">
                     
                        <input type="search" placeholder="search for..." name="q" class="form-control" class="input-group-btn"

                               value="<?= isset($_GET['q']) ? CHtml::encode($_GET['q']) : '';
                              ?>" />
                        <input  style="margin-top: -56px; margin-left: 150px;"type="submit" value="search"class="btn btn-primary" />
                    </form>
                          
                      </div>
            </h4>
        </header>
        <div class="panel-body">
            <?php
            $this->widget('zii.widgets.CListView', array(
                'dataProvider' => $dataProvider,
                'itemView' => '_view',
            ));
            ?>
        </div>
    </section>
</div>
