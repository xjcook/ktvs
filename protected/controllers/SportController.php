<?php

class SportController extends Controller
{
	/**
	* @var string set pageTitle
	*/
	public $pageTitle='Športy';

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
		$dataProvider=new CActiveDataProvider('News', array(
			'criteria'=>array(
				'with'=>array('sport'=>array(
					'on'=>'sport.id=' .$id,
					'together'=>true,
					'joinType'=>'INNER JOIN',
				)),
			),
		));
		
		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		if(Yii::app()->user->checkAccess('createSport'))
		{
			$model=new Sport;
	
			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);
	
			if(isset($_POST['Sport']))
			{
				$model->attributes=$_POST['Sport'];
				$model->users=$model->userIds;
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
		if(Yii::app()->user->checkAccess('updateSport'))
		{
			$model=$this->loadModel($id);
	
			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);
	
			if(isset($_POST['Sport']))
			{
				$model->attributes=$_POST['Sport'];
				$model->users=$model->userIds;
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
		if(Yii::app()->user->checkAccess('deleteSport'))
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
		$dataProvider=new CActiveDataProvider('Sport');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		if(Yii::app()->user->checkAccess('updateSport'))
		{
			$model=new Sport('search');
			$model->unsetAttributes();  // clear any default values
			if(isset($_GET['Sport']))
				$model->attributes=$_GET['Sport'];
	
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
	 * @return Sport the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Sport::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'Požadovaná stránka nebola nájdená.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Sport $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='sport-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
