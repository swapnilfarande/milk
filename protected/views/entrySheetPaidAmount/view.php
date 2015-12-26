<?php
/* @var $this EntrySheetPaidAmountController */
/* @var $model EntrySheetPaidAmount */

$this->breadcrumbs=array(
	'Entry Sheet Paid Amounts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List EntrySheetPaidAmount', 'url'=>array('index')),
	array('label'=>'Create EntrySheetPaidAmount', 'url'=>array('create')),
	array('label'=>'Update EntrySheetPaidAmount', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete EntrySheetPaidAmount', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EntrySheetPaidAmount', 'url'=>array('admin')),
);
?>

<h1>View EntrySheetPaidAmount #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'entry_sheet_id',
		'paid_amount',
		'created_on',
		'created_by',
		'modified_on',
		'modified_by',
	),
)); ?>
