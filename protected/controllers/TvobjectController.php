<?php

class TvobjectController extends Controller
{
	/**
	* @var string set pageTitle
	*/
	public $pageTitle='Športovisko';

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
			'postOnly + delete', // we only allow deletion via POST request
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
		if(Yii::app()->user->checkAccess('createTvobject'))
		{
			$model=new Tvobject;
	
			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);
	
			if(isset($_POST['Tvobject']))
			{
				$model->attributes=$_POST['Tvobject'];
				$model->sports=$model->sportIds;
				if($model->save())
					$this->redirect(array('view','id'=>$model->id));
			}
	
			$this->render('create',array(
				'model'=>$model,
			));
		}
		else
		{
			Yii::app()->user->setFlash('error', 'Nemáte dostatočné práva!');
			Yii::app()->user->loginRequired();
		}
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		if(Yii::app()->user->checkAccess('updateTvobject'))
		{
			$model=$this->loadModel($id);
	
			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);
	
			if(isset($_POST['Tvobject']))
			{
				$model->attributes=$_POST['Tvobject'];
				$model->sports=$model->sportIds;
				if($model->save())
					$this->redirect(array('view','id'=>$model->id));
			}
	
			$this->render('update',array(
				'model'=>$model,
			));
		}
		else
		{
			Yii::app()->user->setFlash('error', 'Nemáte dostatočné práva!');
			Yii::app()->user->loginRequired();
		}
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->user->checkAccess('deleteTvobject'))
		{
			$this->loadModel($id)->delete();
	
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
		{
			Yii::app()->user->setFlash('error', 'Nemáte dostatočné práva!');
			Yii::app()->user->loginRequired();
		}	
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Tvobject');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		if(Yii::app()->user->checkAccess('updateTvobject'))
		{
			$model=new Tvobject('search');
			$model->unsetAttributes();  // clear any default values
			if(isset($_GET['Tvobject']))
				$model->attributes=$_GET['Tvobject'];
	
			$this->render('admin',array(
				'model'=>$model,
			));
		}
		else
		{
			Yii::app()->user->setFlash('error', 'Nemáte dostatočné práva!');
			Yii::app()->user->loginRequired();
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Tvobject the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Tvobject::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'Požadovaná stránka nebola nájdená.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Tvobject $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tvobject-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
