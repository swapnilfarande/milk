<?php
/* @var $this EntrySheetPaidAmountController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Entry Sheet Paid Amounts',
);

$this->menu=array(
	array('label'=>'Create EntrySheetPaidAmount', 'url'=>array('create')),
	array('label'=>'Manage EntrySheetPaidAmount', 'url'=>array('admin')),
);
?>

<h1>Entry Sheet Paid Amounts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
