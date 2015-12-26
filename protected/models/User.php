<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property integer $mobile
 * @property string $created_on
 * @property string $created_by
 * @property string $modified_on
 * @property string $modified_by
 *
 * The followings are the available model relations:
 * @property Customer[] $customers
 * @property Customer[] $customers1
 * @property Customer[] $customers2
 * @property EntrySheet[] $entrySheets
 * @property EntrySheet[] $entrySheets1
 * @property EntrySheetPaidAmount[] $entrySheetPaidAmounts
 * @property EntrySheetPaidAmount[] $entrySheetPaidAmounts1
 * @property Product[] $products
 * @property Product[] $products1
 * @property ProductCustomer[] $productCustomers
 * @property ProductCustomer[] $productCustomers1
 * @property User $createdBy
 * @property User[] $users
 * @property User $modifiedBy
 * @property User[] $users1
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
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
							
			array('mobile', 'numerical', 'integerOnly'=>true),
			array('first_name, last_name', 'length', 'max'=>255),
			array('email', 'length', 'max'=>512),
			array('password', 'length', 'max'=>1024),
			array('created_by, modified_by', 'length', 'max'=>20),
			array('created_on, modified_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, first_name, last_name, email, password, mobile, created_on, created_by, modified_on, modified_by', 'safe', 'on'=>'search'),
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
			'customers' => array(self::HAS_MANY, 'Customer', 'owner_id'),
			'customers1' => array(self::HAS_MANY, 'Customer', 'created_by'),
			'customers2' => array(self::HAS_MANY, 'Customer', 'modified_by'),
			'entrySheets' => array(self::HAS_MANY, 'EntrySheet', 'created_by'),
			'entrySheets1' => array(self::HAS_MANY, 'EntrySheet', 'modified_by'),
			'entrySheetPaidAmounts' => array(self::HAS_MANY, 'EntrySheetPaidAmount', 'created_by'),
			'entrySheetPaidAmounts1' => array(self::HAS_MANY, 'EntrySheetPaidAmount', 'modified_by'),
			'products' => array(self::HAS_MANY, 'Product', 'created_by'),
			'products1' => array(self::HAS_MANY, 'Product', 'modified_by'),
			'productCustomers' => array(self::HAS_MANY, 'ProductCustomer', 'created_by'),
			'productCustomers1' => array(self::HAS_MANY, 'ProductCustomer', 'modified_by'),
			'createdBy' => array(self::BELONGS_TO, 'User', 'created_by'),
			'users' => array(self::HAS_MANY, 'User', 'created_by'),
			'modifiedBy' => array(self::BELONGS_TO, 'User', 'modified_by'),
			'users1' => array(self::HAS_MANY, 'User', 'modified_by'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'email' => 'Email',
			'password' => 'Password',
			'mobile' => 'Mobile',
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
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('mobile',$this->mobile);
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
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
