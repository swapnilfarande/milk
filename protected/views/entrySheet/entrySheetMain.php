<?php
/* @var $this EntrySheetController */

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
	'id'=>'entry-sheet-main',
	'enableAjaxValidation'=>false,
)); ?>

<div class="row">
<strong>Customer:</strong>
 <?php
echo CHtml::dropDownList('customer_id', NULL , CHtml::listData(Customer::model()->findAll(), 'id', 'name'),
array('prompt'=>'Select Customer',
					'ajax' => array(
						'type'=>'GET', //request type
						'url'=>CController::createUrl('entrySheet/entrySheetCustomer'), //url to call.
						'update'=>'#divBulkEntrySheet', //selector to update
						'success'=>'function(data){ 
							
							if($("#customer_id").val()) {
								$("#divBulkEntrySheet").html(data);
								$("#customer_name").html("Customer: " + $("#customer_id option:selected").text());
							}
							else {
								$("#customer_name").html("");
								$("#divBulkEntrySheet").html("");
							}
							CalculateTotal();
						}'						
)
));

?>
</div>
<div class="row"><strong>Date:</strong> <?php
//$bulkmodel = new EntrySheetBulk();
//$bulkmodel->date = date('d-M-y');
 
$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => new EntrySheetBulk(),
			'attribute' => '[0]date',
		    'options'=>array(
		        'dateFormat'=>'dd-M-yy',
),
		    'htmlOptions' => array(
		        'size' => '20',         // textField size
		        'maxlength' => '15',    // textField maxlength
),
));
?></div>

<br />
<h2 id="customer_name"></h2>
<br />
<div id="divBulkEntrySheet"></div>

<?php $this->endWidget(); ?></div>

<!-- form -->
<script type="text/javascript">
	function CalculateTotal() {
		$('.data-quantity').keyup(function(){
			var id = $(this).attr('select-quantity');

			var total_selector= 'input[data-total'+id+']';
			var price_selector= 'input[data-price'+id+']';
			var paid_selector= 'input[data-paid'+id+']';
			//var balace_selector= 'input[data-balance'+id+']';
			
			var quantity = $(this).val();
			var price = $(price_selector).val();
			var paid = $(paid_selector).val();
			
			var total = quantity * price;
			//var balance = total - paid;
			
			$(total_selector).val(total);
			//$(balace_selector).val(balance);

			//Calculate total quantity
			var total_quantity = 0;
			$('.data-quantity').each(
					function(k,v){
						if(!isNaN($(v).val())) {
							total_quantity += parseInt( $(v).val());
						} 
					});
			$('.total_quantity').val(total_quantity);

			var total_amount = 0;
			$('.product_total').each(
					function(k,v){
						if(!isNaN($(v).val())) {
							total_amount += parseInt( $(v).val());
						} 
					});
			$('.total_price').val(total_amount);

			var paid_amount = $('.paid_amount').val();
			if(!isNaN(paid_amount)) {
				$('.balance').val( total_amount - paid_amount );
			}
		});
//		$('.data-paid').keyup(function(){
//			var id = $(this).attr('select-paid');
//
//			var quantity_selector= 'input[data-quantity'+id+']';
//			var total_selector= 'input[data-total'+id+']';
//			var price_selector= 'input[data-price'+id+']';
//			var paid_selector= 'input[data-paid'+id+']';
//			var balace_selector= 'input[data-balance'+id+']';
//			
//			var quantity = $(quantity_selector).val();
//			var price = $(price_selector).val();
//			var paid = $(this).val();
//			
//			var total = quantity * price;
//			var balance = total - paid;
//			
//			$(total_selector).val(total);
//			$(balace_selector).val(balance);
//		});

		$('.paid_amount').keyup(function(){
			var total_amount = $('.total_price').val();

			var paid_amount = $('.paid_amount').val();
			//if(!isNaN(paid_amount) && !isNaN(total_amuont)) {
				$('.balance').val( total_amount - paid_amount );
			//}
		});
	}
</script>
