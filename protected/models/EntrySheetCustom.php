<?php

class EntrySheetCustom extends CFormModel
{
	public $customer_id;
	public $product_id;
	public $quantity;
	public $record_date;
	public $amount_paid;


	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('customer_id, product_id, quantity, record_date', 'required'),
			array('quantity, amount_paid', 'numerical'),
			array('record_date','date', 'format'=>'yyyy-MM-dd'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'customer_id'=>'Customer',
			'product_id'=>'Product',
			'quantity'=>'Quantity',
			'record_date'=>'Date',
			'amount_paid'=>'Amount Paid'
		);
	}

}
