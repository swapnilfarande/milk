<?php
/* @var $this ProductCustomerController */
/* @var $model ProductCustomer */

$this->breadcrumbs=array(
	'Product Customers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProductCustomer', 'url'=>array('index')),
	array('label'=>'Manage ProductCustomer', 'url'=>array('admin')),
);
?>

<h1>Assign Product to Customer with Price for that customer</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>