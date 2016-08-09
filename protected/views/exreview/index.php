<?php
/* @var $this ExreviewController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Exreviews',
);

$this->menu=array(
	array('label'=>'Create Exreview', 'url'=>array('create')),
	array('label'=>'Manage Exreview', 'url'=>array('admin')),
);
?>

<h1>Exreviews</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
