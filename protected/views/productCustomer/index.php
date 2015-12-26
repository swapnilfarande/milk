<?php
/* @var $this ProductCustomerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Product Customers',
);

$this->menu=array(
	array('label'=>'Create ProductCustomer', 'url'=>array('create')),
	array('label'=>'Manage ProductCustomer', 'url'=>array('admin')),
);
?>

<h1>Product Customers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
