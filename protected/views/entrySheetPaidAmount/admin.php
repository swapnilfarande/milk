<?php
/* @var $this EntrySheetPaidAmountController */
/* @var $model EntrySheetPaidAmount */

$this->breadcrumbs=array(
	'Entry Sheet Paid Amounts'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List EntrySheetPaidAmount', 'url'=>array('index')),
	array('label'=>'Create EntrySheetPaidAmount', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#entry-sheet-paid-amount-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Entry Sheet Paid Amounts</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'entry-sheet-paid-amount-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'entry_sheet_id',
		'paid_amount',
		'created_on',
		'created_by',
		'modified_on',
		/*
		'modified_by',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
