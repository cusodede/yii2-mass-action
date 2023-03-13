<?php
declare(strict_types = 1);

namespace app\models;

use yii\data\ActiveDataProvider;

/**
 * Users search model
 */
class UsersSearch extends Users {

	/**
	 * @param array $params
	 * @return ActiveDataProvider
	 */
	public function search(array $params):ActiveDataProvider {
		$query = self::find();

		$dataProvider = new ActiveDataProvider([
			'query' => $query
		]);

		$dataProvider->setSort([
			'defaultOrder' => ['id' => SORT_ASC],
			'attributes' => [
				'id',
				'username',
				'login',
			]
		]);

		$this->load($params);

		if (!$this->validate()) return $dataProvider;

		$query->distinct();

		$query->andFilterWhere(['id' => $this->id])
			->andFilterWhere(['like', 'username', $this->username])
			->andFilterWhere(['like', 'login', $this->login]);

		return $dataProvider;

	}

}