<?php
/* @var $this EntrySheetController */
/* @var $model EntrySheet */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'entry-sheet-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'customer_id'); ?>
		<?php //echo $form->textField($model,'customer_id',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->dropDownList($model, 'customer_id', CHtml::listData(Customer::model()->findAll(), 'id', 'name'),array('empty'=>'','class'=>'span5','maxlength'=>20)); ?>
		<?php echo $form->error($model,'customer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'product_id'); ?>
		<?php //echo $form->textField($model,'product_id',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->dropDownList($model, 'product_id', CHtml::listData(Product::model()->findAll(), 'id', 'name'),array('empty'=>'','class'=>'span5','maxlength'=>20)); ?>
		<?php echo $form->error($model,'product_id'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'quantity'); ?>
		<?php echo $form->textField($model,'quantity',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'quantity'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'record_date'); ?>

		<?php 
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'record_date',
			// additional javascript options for the date picker plugin
		    'options'=>array(
		        'dateFormat'=>'dd-M-yy',
		    ),
		    'htmlOptions' => array(
		        'size' => '20',         // textField size
		        'maxlength' => '15',    // textField maxlength
		    ),
		));
		?>

		<?php echo $form->error($model,'record_date'); ?>

	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'amount_paid'); ?>
		<?php echo $form->textField($model,'amount_paid',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'amount_paid'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->