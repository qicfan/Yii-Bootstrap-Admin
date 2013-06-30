<?php

class AdminuserController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/admin';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
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
		$this->checkAccess('adminuser.manage');
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
		$this->checkAccess('adminuser.create');
		$model=new AdminUser('create');
		$allRole = AdminRole::getAllRole();

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['AdminUser']))
		{
			$model->attributes=$_POST['AdminUser'];
			$model->create_time = time();
			$model->noHashPassword = $model->password;
			if ($model->validate())
			{
				if($model->save())
					$this->redirect(array('view','id'=>$model->id));
			}
			$model->password = $model->noHashPassword;
		}
		
		$this->render('create',array(
			'model'=>$model,
			'allRole'=>$allRole,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$this->checkAccess('adminuser.update');
		$model=$this->loadModel($id);
		$allRole = AdminRole::getAllRole();
		$model->scenario = 'update';
		unset($model->password);
		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['AdminUser']))
		{
			if ($_POST['AdminUser']['password'] == "")
			{
				// 不修改密码，改变场景
				$model->scenario = 'update_role';
			}
			$model->attributes=$_POST['AdminUser'];
			$model->update_time = time();
			$model->noHashPassword = $model->password;
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
			$model->password = $model->noHashPassword;
		}
		$model->password = "";
		$model->password_repeat = "";
		$this->render('update',array(
			'model'=>$model,
			'allRole'=>$allRole,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->checkAccess('adminuser.delete');
		if(Yii::app()->request->isPostRequest)
		{
			if ($id > 1)
			{
				// we only allow deletion via POST request
				$this->loadModel($id)->delete();
			}

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$this->checkAccess('adminuser.manage');
		$model=new AdminUser('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AdminUser']))
			$model->attributes=$_GET['AdminUser'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=AdminUser::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='admin-user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
