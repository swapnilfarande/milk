<?php

/**
 * This is the model class for table "product_customer".
 *
 * The followings are the available columns in table 'product_customer':
 * @property string $id
 * @property string $customer_id
 * @property string $product_id
 * @property double $price
 * @property string $created_on
 * @property string $created_by
 * @property string $modified_on
 * @property string $modified_by
 *
 * The followings are the available model relations:
 * @property EntrySheet[] $entrySheets
 * @property Customer $customer
 * @property Product $product
 * @property User $createdBy
 * @property User $modifiedBy
 */
class ProductCustomer extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product_customer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		$currentUser = Yii::app()->user->id;
		return array(
			array('modified_on','default',
					'value'=>new CDbExpression('NOW()'),
					'setOnEmpty'=>false,'on'=>'update'),
			array('modified_by','default',
					'value'=>$currentUser,
					'setOnEmpty'=>false,'on'=>'update'),
								
			array('created_on,modified_on','default',
						'value'=>new CDbExpression('NOW()'),
						'setOnEmpty'=>false,'on'=>'insert'),
			array('created_by,modified_by','default',
						'value'=>$currentUser,
						'setOnEmpty'=>false,'on'=>'insert'),

			array('customer_id, product_id, price', 'required'),
			array('price', 'numerical'),
			array('customer_id, product_id, created_by, modified_by', 'length', 'max'=>20),
			array('created_on, modified_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, customer_id, product_id, price, created_on, created_by, modified_on, modified_by', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'entrySheets' => array(self::HAS_MANY, 'EntrySheet', 'product_customer_id'),
			'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
			'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
			'createdBy' => array(self::BELONGS_TO, 'User', 'created_by'),
			'modifiedBy' => array(self::BELONGS_TO, 'User', 'modified_by'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'customer_id' => 'Customer',
			'product_id' => 'Product',
			'price' => 'Price',
			'created_on' => 'Created On',
			'created_by' => 'Created By',
			'modified_on' => 'Modified On',
			'modified_by' => 'Modified By',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('customer_id',$this->customer_id,true);
		$criteria->compare('product_id',$this->product_id,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('modified_on',$this->modified_on,true);
		$criteria->compare('modified_by',$this->modified_by,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProductCustomer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
