<?php
/* @var $this EntrySheetController */
/* @var $model EntrySheet */

$this->breadcrumbs=array(
	'Entry Sheets'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EntrySheet', 'url'=>array('index')),
	array('label'=>'Manage EntrySheet', 'url'=>array('admin')),
);
?>

<h1>Create EntrySheet</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>