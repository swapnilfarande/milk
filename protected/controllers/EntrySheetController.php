<?php

class EntrySheetController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
		array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
		),
		array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'details','entrySheetCustomer','entrySheetMain'),
				'users'=>array('@'),
		),
		array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('@'),
		),
		array('deny',  // deny all users
				'users'=>array('*'),
		),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new EntrySheetCustom;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);



		if(isset($_POST['EntrySheetCustom']))
		{
			$model->attributes=$_POST['EntrySheetCustom'];
			$model->record_date = DateTime::createFromFormat('Y-m-d', $model->record_date);
			if($model->record_date !== false) {
				$model->record_date->setTime(0, 0, 0);
				$model->record_date = $model->record_date->getTimestamp();
				$model->record_date = date('Y-m-d', $model->record_date);
			}
			if($model->validate()) {

				$modelEntrySheet = new EntrySheet;

				$modelPrice = ProductCustomer::model()->findByAttributes(array(
					'customer_id'=>$model->customer_id,
					'product_id'=>$model->product_id
				));

				if($modelPrice === null) {
					$modelPrice = Product::model()->findByPk($model->product_id);
				}

				$entrySheet = new EntrySheet();
				$entrySheet->customer_id = $model->customer_id;
				$entrySheet->product_id = $model->product_id;
				$entrySheet->quantity = $model->quantity;
				$entrySheet->price = $modelPrice->price;
				$entrySheet->added_on = $model->record_date;

				$entrySheet->save();

				if($model->amount_paid !== '') {
					$entrySheetAmountPaid = new EntrySheetPaidAmount;
					$entrySheetAmountPaid->entry_sheet_id = $entrySheet->id;
					$entrySheetAmountPaid->paid_amount = $model->amount_paid;
					$entrySheetAmountPaid->save();
				}

				$this->redirect(array('index'));
			}

		}
		if(empty($model->record_date)) {
			$model->record_date = date('Y-m-d');
		}
		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['EntrySheet']))
		{
			$model->attributes=$_POST['EntrySheet'];
			if($model->save())
			$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
		$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$sql = "select customer_id, Customer, Product, sum(quantity) as Quantity, sum(total) as Total, sum(paid_amount) as Paid_amount, sum(remaining) as Remaining
from
(select es.id as id, c.id as customer_id, p.id as product_id, c.name as Customer, p.name as Product , date_format(es.added_on, '%d-%M-%Y') as `added on`, es.quantity, es.price, (es.quantity * es.price)  as total, sum(espa.paid_amount) as paid_amount, ((es.quantity * es.price) - sum(espa.paid_amount)) remaining
from entry_sheet es 
inner join entry_sheet_paid_amount espa on es.id = espa.entry_sheet_id
inner join customer c on es.customer_id = c.id
inner join product p on es.product_id = p.id
group by espa.entry_sheet_id) as esc
group by esc.customer_id";

		$rawData = Yii::app()->db->createCommand($sql); //or use ->queryAll(); in CArrayDataProvider
		$count = Yii::app()->db->createCommand('SELECT COUNT(*) FROM (' . $sql . ') as count_alias')->queryScalar();

		$model = new CSqlDataProvider($rawData, array( //or $model=new CArrayDataProvider($rawData, array(... //using with querAll...
                    'keyField' => 'customer_id', 
                    'totalItemCount' => $count,

		//if the command above use PDO parameters
		//'params'=>array(
		//':param'=>$param,
		//),


                    'sort' => array(
                        'attributes' => array(
                            'customer_id','Customer', 'Product', 'total', 'remaining'
                            ),
                        'defaultOrder' => array(
                            'customer_id' => CSort::SORT_ASC, //default sort value
                            ),
                            ),
                    'pagination' => array(
                        'pageSize' => 10,
                            ),
                            ));

                            $this->render('anActionView', array(
            'model' => $model,
                            ));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new EntrySheet('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['EntrySheet']))
		$model->attributes=$_GET['EntrySheet'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return EntrySheet the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=EntrySheet::model()->findByPk($id);
		if($model===null)
		throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param EntrySheet $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='entry-sheet-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionDetails($id) {
		$sql = "
			select es.id as id, c.id as customer_id, p.id as product_id, c.name as Customer, p.name as Product , date_format(es.added_on, '%d-%M-%Y') as `addedon`, es.quantity, es.price, (es.quantity * es.price)  as total, sum(espa.paid_amount) as paid_amount, ((es.quantity * es.price) - sum(espa.paid_amount)) remaining
			from entry_sheet es 
			inner join entry_sheet_paid_amount espa on es.id = espa.entry_sheet_id
			inner join customer c on es.customer_id = c.id
			inner join product p on es.product_id = p.id
			where es.customer_id = 1
			group by espa.entry_sheet_id";

		$customer = Customer::model()->findByPk($id);

		$rawData = Yii::app()->db->createCommand($sql)->queryAll();

		$count = Yii::app()->db->createCommand('SELECT COUNT(*) FROM (' . $sql . ') as count_alias')->queryScalar(array(':customer_id'=>$id));


		$model = new CArrayDataProvider($rawData, array( //or $model=new CArrayDataProvider($rawData, array(... //using with querAll...
                    'keyField' => 'id', 
                    'totalItemCount' => $count,

		//if the command above use PDO parameters
		//'params'=>array(
		//':param'=>$param,
		//),


                    'sort' => array(
                        'attributes' => array(
                            'id','Customer', 'Product', 'total', 'remaining'
                            ),
                        'defaultOrder' => array(
                            'id' => CSort::SORT_ASC, //default sort value
                            ),
                            ),
                    'pagination' => array(
                        'pageSize' => 10,
                            ),
                            ));


                            $this->render('details', array(
            'model' => $model,
            'customer'=>$customer
                            ));
	}

	public function actionEntrySheetMain() {
		if(isset($_POST['EntrySheetBulk'])) {

			foreach($_POST['EntrySheetBulk'] as $i=>$item)
			{
				$model = new EntrySheetBulk();
				$model->attributes= $_POST['EntrySheetBulk'][$i];
				if($model->selected && $model->quantity > 0) {
					CVarDumper::dump($_POST['EntrySheetBulk'][0]['date'],10,true);
					$model->date = date("Y-m-d",strtotime($_POST['EntrySheetBulk'][0]['date']));


					$modelEntrySheet = new EntrySheet;

					$entrySheet = new EntrySheet();
					$entrySheet->customer_id = $_POST['customer_id'];
					$entrySheet->product_id = $model->product_id;
					$entrySheet->quantity = $model->quantity;
					$entrySheet->price = $model->price;
					$entrySheet->added_on = $model->date;
					$entrySheet->save();
				}
				if(isset($_POST['EntrySheetPaidAmount'])) {
					$entrySheetAmountPaid = new EntrySheetPaidAmount;
					$entrySheetAmountPaid->attributes = $_POST['EntrySheetPaidAmount'];
					$entrySheetAmountPaid->customer_id = $_POST['customer_id'];
					$entrySheetAmountPaid->added_on = $model->date;
					$entrySheetAmountPaid->save();
				}
			}
			$this->redirect(array('entrySheet/admin'));
		}

		$this->render('entrySheetMain');
	}

	public function actionEntrySheetCustomer($customer_id) {
		$sql = "select PC.customer_id as customer_id, P.id as  product_id, P.name as name,
				P.price as product_price, PC.price as customer_price
				 from product P left join product_customer PC on P.id = PC.product_id and customer_id =:customer_id";

		$rawData = Yii::app()->db->createCommand($sql)->queryAll(true, array(':customer_id'=>$customer_id));
		$entrySheetModels = array();
		for($i = 0; $i< count($rawData); $i++) {
			$model = new EntrySheetBulk();
			$model->product_id = $rawData[$i]['product_id'];
			$model->customer_id = $rawData[$i]['customer_id'];
			$model->product_name = $rawData[$i]['name'];

			if(!empty($rawData[$i]['customer_price']))
			{
				$model->price = $rawData[$i]['customer_price'];
			}
			else {
				$model->price = $rawData[$i]['product_price'];
			}
			$model->quantity = 0;
			$model->amount_paid = 0;
			$model->selected = true;
			array_push($entrySheetModels, $model);
		}

		$entrySheetPaidAmount = new EntrySheetPaidAmount();

		$this->renderPartial('entrySheetBulk', array(
            'models' => $entrySheetModels,
			'customer_id' => $customer_id,
			'entrySheetPaidAmount' => $entrySheetPaidAmount
		));
	}
}
