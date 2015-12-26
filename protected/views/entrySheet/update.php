<?php
/* @var $this EntrySheetController */
/* @var $model EntrySheet */

$this->breadcrumbs=array(
	'Entry Sheets'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List EntrySheet', 'url'=>array('index')),
	array('label'=>'Create EntrySheet', 'url'=>array('create')),
	array('label'=>'View EntrySheet', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage EntrySheet', 'url'=>array('admin')),
);
?>

<h1>Update EntrySheet <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>