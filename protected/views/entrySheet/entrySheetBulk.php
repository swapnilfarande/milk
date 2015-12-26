<?php
/* @var $this EntrySheetController */
/* @var $model EntrySheetBulk */

$this->breadcrumbs=array(
	'Entry Sheets'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List EntrySheet', 'url'=>array('index')),
array('label'=>'Manage EntrySheet', 'url'=>array('admin')),
);
?>
<div class="form"><?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'entry-sheet-form',
// Please note: When you enable ajax validation, make sure the corresponding
// controller action is handling ajax validation correctly.
// There is a call to performAjaxValidation() commented in generated controller code.
// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


<div>

<table border="1px" cellpadding="10">
	<tr>
		<th>Select</th>
		<th>Product</th>
		<th>Price</th>
		<th>Quantity</th>
		<th>Total</th>
		<!--		<th>Amount Paid</th>-->
		<!--		<th>Balance</th>-->
	</tr>
	<?php
	echo CHtml::hiddenField('customer_id', $customer_id);

	foreach($models as $i=>$model) {
		echo CHtml::activeHiddenField($model, "[$i]product_id");
		echo CHtml::activeHiddenField($model, "[$i]price",array("data-price$i"=>$i));

		?>

	<tr>
		<td><?php echo CHtml::activeCheckBox($model, "[$i]selected") ?></td>
		<td><?php echo $model->product_name; ?></td>
		<td><?php echo $model->price; ?></td>

		<td><?php echo CHtml::activeTextField($model, "[$i]quantity", array("select-quantity"=>$i,"data-quantity$i"=>$i,'class'=>'data-quantity')) ?></td>
		<td><?php echo CHtml::activeTextField($model, "[$i]total", array("data-total$i"=>$i,'readonly'=>'readonly', 'class'=>'product_total')) ?></td>
		<!--<td><?php //echo CHtml::activeTextField($model, "[$i]amount_paid",array("select-paid"=>$i,"data-paid$i"=>$i,'class'=>'data-paid')) ?></td>
		<td><?php //echo CHtml::activeTextField($model, "[$i]balance",array("data-balance$i"=>$i,'readonly'=>'readonly')) ?></td>-->
	</tr>


	<?php
	}
	?>
	<tr>
		<th colspan="5">
		<hr/>
</th>
	</tr>
	<tr>
		<th colspan="3">Total</th>

		<td><?php echo CHtml::textField('total_quantity', 0,array('class'=>'total_quantity','readonly'=>'readonly')) ?></td>
		<td><?php echo CHtml::textField('total_price', 0,array('class'=>'total_price','readonly'=>'readonly')) ?></td>
	</tr>
</table>

<div class="row">
	<label>Amount Paid </label>
	<?php echo $form->textField($entrySheetPaidAmount,'paid_amount',array('size'=>20,'maxlength'=>20, 'class'=>'paid_amount')); ?>
</div>


<div class="row">
	<label>Balance</label>
	<?php echo CHtml::textField('balance', 0,array('class'=>'balance','readonly'=>'readonly')) ; ?>
</div>


<div class="row buttons"><?php echo CHtml::submitButton('Save'); ?></div>
</div>

	<?php $this->endWidget(); ?></div>
<!-- form -->
