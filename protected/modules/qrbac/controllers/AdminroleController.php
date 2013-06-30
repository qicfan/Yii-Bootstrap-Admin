<?php

class AdminroleController extends Controller
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
		$this->checkAccess('adminrole.mange');
		$model = $this->loadModel($id);
		if ($model->actions != "*")
		{
			$array = explode(',',$model->actions);
			$allActions = AdminActions::getAllActions();
			$actions = array();
			foreach ($array as $item)
			{
				foreach ($allActions as $action)
				{
					if ($action['action'] == $item)
					{
						$actions[] = "<span>{$action['name']}</span>&nbsp;&nbsp;";
					}
				}
			}
			$model->actions = implode('', $actions);
		}
		$this->render('view',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$this->checkAccess('adminrole.create');
		$model=new AdminRole;
		$allActions = AdminActions::getAllActions();
		// 下拉列表
		Tree::$arr = $allActions;
		$tree = Tree::getTree(0,"<label class='checkbox'><input type='checkbox' name='AdminRole[actions][]' id='AdminRole_actions_\$id' data-id='\$id' data-parent-id='\$parent_id' value='\$action' \$selected><label for='AdminRole_actions_\$id'>\$spacer\$name</label></label>",-1,true);
		
		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['AdminRole']))
		{
			print_r($_POST);
			$model->attributes=$_POST['AdminRole'];
			$model->actions = implode(',', $model->actions);
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
			'tree'=>$tree,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$this->checkAccess('adminrole.update');
		$model=$this->loadModel($id);
		if ($id==1 || $model->title == '超级管理员' || $model->actions=='*')
		{
			$this->redirect(array('admin'));
		}
		$array = explode(',', $model->actions);
		$allActions = AdminActions::getAllActions();
		foreach ($allActions as $k=>$action)
		{
			foreach ($array as $item)
			{
				if ($action['action'] == $item)
				{
					$allActions[$k]['selected'] = "checked";
				}
			}
		}
		// 下拉列表
		Tree::$arr = $allActions;
		$tree = Tree::getTree(0,"<label class='checkbox'><input type='checkbox' name='AdminRole[actions][]' id='AdminRole_actions_\$id' data-id='\$id' data-parent-id='\$parent_id' value='\$action' \$selected><label for='AdminRole_actions_\$id'>\$spacer\$name</label></label>",-1,true);
		

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['AdminRole']))
		{
			$model->attributes=$_POST['AdminRole'];
			$model->actions = implode(',', $model->actions);
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
			'tree'=>$tree,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->checkAccess('adminrole.delete');
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

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
		$this->checkAccess('adminrole.mange');
		$model=new AdminRole('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AdminRole']))
			$model->attributes=$_GET['AdminRole'];

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
		$model=AdminRole::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='admin-role-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
