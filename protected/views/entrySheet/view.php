<?php
/* @var $this EntrySheetController */
/* @var $model EntrySheet */

$this->breadcrumbs=array(
	'Entry Sheets'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List EntrySheet', 'url'=>array('index')),
	array('label'=>'Create EntrySheet', 'url'=>array('create')),
	array('label'=>'Update EntrySheet', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete EntrySheet', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EntrySheet', 'url'=>array('admin')),
);
?>

<h1>View EntrySheet #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'product_customer_id',
		'quantity',
		'created_on',
		'created_by',
		'modified_on',
		'modified_by',
	),
)); ?>
