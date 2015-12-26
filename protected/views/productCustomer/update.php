<?php
/* @var $this ProductCustomerController */
/* @var $model ProductCustomer */

$this->breadcrumbs=array(
	'Product Customers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProductCustomer', 'url'=>array('index')),
	array('label'=>'Create ProductCustomer', 'url'=>array('create')),
	array('label'=>'View ProductCustomer', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ProductCustomer', 'url'=>array('admin')),
);
?>

<h1>Update ProductCustomer <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>