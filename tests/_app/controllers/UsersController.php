<?php
declare(strict_types = 1);

namespace app\controllers;

use app\models\UsersSearch;
use Yii;
use yii\web\Controller;

/**
 * Users controller
 */
class UsersController extends Controller {
	/**
	 * @return string
	 */
	public function actionIndex():string {
		$params = Yii::$app->request->queryParams;
		$searchModel = new UsersSearch();
		$dataProvider = $searchModel->search($params);

		return $this->render('index',[
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider
		]);
	}

}