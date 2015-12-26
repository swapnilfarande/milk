<?php
/* @var $this EntrySheetPaidAmountController */
/* @var $model EntrySheetPaidAmount */

$this->breadcrumbs=array(
	'Entry Sheet Paid Amounts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EntrySheetPaidAmount', 'url'=>array('index')),
	array('label'=>'Manage EntrySheetPaidAmount', 'url'=>array('admin')),
);
?>

<h1>Create EntrySheetPaidAmount</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>