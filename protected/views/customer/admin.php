<?php
/* @var $this CustomerController */
/* @var $model Customer */

$this->breadcrumbs=array(
	'Customers'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Customer', 'url'=>array('index')),
	array('label'=>'Create Customer', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#customer-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h1>Manage Customers</h1>
<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'customer-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'address',
// 		'owner',
			array(
					'name'=>'owner',
					'header'=>'Contact Person',
					'value'=>function($data,$row) { 
						return $data->owner->first_name. ' '. $data->owner->last_name;
					}
			),
			array(
					'name'=>'owner',
					'header'=>'Mobile',
					'value'=>function($data,$row) { 
						return $data->owner->mobile;
					}
			),
			'created_on',
		'created_by',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
