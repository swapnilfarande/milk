<?php
/* @var $this EntrySheetController */
/* @var $model EntrySheet */

$this->breadcrumbs=array(
	'Entry Sheets'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List EntrySheet', 'url'=>array('index')),
	array('label'=>'Create EntrySheet', 'url'=>array('create')),
);

?>

<h1>Entry Sheets of <?php echo '"' .$customer->name .'"'; ?></h1>


<?php 
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'a-grid-id',
    'dataProvider' => $model,
    'ajaxUpdate' => true, //false if you want to reload aentire page (useful if sorting has an effect to other widgets)
    'filter' => null, //if not exist search filters      
    'columns'=>array(
        'id',
        'Customer',
        'Product',
        'addedon',
        'quantity',
        'price',
        'total',
        'paid_amount',
        'remaining'
    )  
));
?>
