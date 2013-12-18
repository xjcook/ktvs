<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Používateľia',
);

$this->menu=array(
	array('label'=>'Vytvoriť používateľa', 'url'=>array('create')),
	array('label'=>'Spraovať používateľov', 'url'=>array('admin')),
);
?>

<h1>Používatelia</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>