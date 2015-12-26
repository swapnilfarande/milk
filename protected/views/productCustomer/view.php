<?php
/* @var $this ProductCustomerController */
/* @var $model ProductCustomer */

$this->breadcrumbs=array(
	'Product Customers'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ProductCustomer', 'url'=>array('index')),
	array('label'=>'Create ProductCustomer', 'url'=>array('create')),
	array('label'=>'Update ProductCustomer', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ProductCustomer', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProductCustomer', 'url'=>array('admin')),
);
?>

<h1>View ProductCustomer #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'customer_id',
		'product_id',
		'price',
		'created_on',
		'created_by',
		'modified_on',
		'modified_by',
	),
)); ?>
