<?php

class SiteController extends Controller
{

	public $layout = "//layouts/admin";

	public function filters()
	{
		return array(
			'accessControl',
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',
				'actions' => array('Login'),
				'users' => array('*'),
			),
			array('allow',
				'users' => array('@'),
			),
			array('deny',
				'users' => array('*'),
			),
		);
	}

	public function actionLogin()
	{
		if (!Yii::app()->user->isGuest)
			$this->redirect(array('/site/index'));

		$model = new LoginForm;
		if (isset($_POST['LoginForm']))
		{
			$model->attributes = $_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if ($model->validate() && $model->login())
			{
				$this->redirect(array('/site/index'));
			}
		}
		// display the login form
		$this->render('login', array('model' => $model));
	}

	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(array('/site/index'));
	}
}
