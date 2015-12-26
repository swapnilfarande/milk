<?php
/* @var $this EntrySheetController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Entry Sheets',
);

$this->menu=array(
	array('label'=>'Create EntrySheet', 'url'=>array('create')),
	array('label'=>'Manage EntrySheet', 'url'=>array('admin')),
);
?>

<h1>Entry Sheets</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
