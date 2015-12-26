<?php
/* @var $this EntrySheetController */
/* @var $model EntrySheet */

$this->breadcrumbs=array(
	'Entry Sheets'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List EntrySheet', 'url'=>array('index')),
	array('label'=>'Create EntrySheet', 'url'=>array('entrySheetMain')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#entry-sheet-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Entry Sheets</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'entry-sheet-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		array(
			'name'=>'customer',
			'header'=>'Customer',
			'value'=>'$data->customer->name'
		),
		array(
			'name'=>'product',
			'header'=>'Product',
			'value'=>'$data->product->name'
		),
		'quantity',
		'price',
		array(
			'header'=>'Total',
			'value'=>'$data->quantity*$data->price'
		),
		'added_on',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
