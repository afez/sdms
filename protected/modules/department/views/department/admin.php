<?php
/* @var $this DepartmentController */
/* @var $model Department */

$this->breadcrumbs = array(
    'Departments' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Department', 'url' => array('index')),
    array('label' => 'Create Department', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#department-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>	


<div class="col-md-12">
    <section class="panel">
        <header style="background:ghostwhite "class="panel-heading">
            <h4 style="color: black  ">UDSM Departments </h4>
        </header>
        <div class="panel-body">
            <?php
            $this->widget('zii.widgets.grid.CGridView', array(
                'id' => 'department-grid',
                'dataProvider' => $model->search(),
                //'filter'=>$model,
                'columns' => array(
                    'name',
                
                    'email',
                
               
            array('name'=>'college.name',
                     'header'=>'College',
                     
                     ),
                    array(
                        'class' => 'CButtonColumn',
                    ),
                ),
            ));
            ?>

        </div>
    </section>






