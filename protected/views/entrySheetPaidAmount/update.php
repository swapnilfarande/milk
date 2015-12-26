<?php
/* @var $this EntrySheetPaidAmountController */
/* @var $model EntrySheetPaidAmount */

$this->breadcrumbs=array(
	'Entry Sheet Paid Amounts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List EntrySheetPaidAmount', 'url'=>array('index')),
	array('label'=>'Create EntrySheetPaidAmount', 'url'=>array('create')),
	array('label'=>'View EntrySheetPaidAmount', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage EntrySheetPaidAmount', 'url'=>array('admin')),
);
?>

<h1>Update EntrySheetPaidAmount <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>