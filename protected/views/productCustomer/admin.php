<?php
/* @var $this ProductCustomerController */
/* @var $model ProductCustomer */

$this->breadcrumbs=array(
	'Product Customers'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ProductCustomer', 'url'=>array('index')),
	array('label'=>'Create ProductCustomer', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#product-customer-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Price of Products for individual Customers</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'product-customer-grid',
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
		array(
			'name'=>'product',
			'header'=>'Original Price',
			'value'=>'$data->product->price'
		),
		'price',
		/*
		'created_on',
		'created_by',
		'modified_on',
		'modified_by',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
