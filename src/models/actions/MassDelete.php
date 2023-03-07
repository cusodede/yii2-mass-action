<?php
declare(strict_types = 1);

namespace cusodede\grid\widgets\mass_action\models\actions;

use cusodede\grid\widgets\mass_action\models\BaseMassModel;
use yii\db\ActiveRecordInterface;

/**
 * Class MassDelete
 * This is an example of BaseMassModel implementation
 * @property ActiveRecordInterface[] $models
 */
class MassDelete extends BaseMassModel {
	public string $id = 'mass-delete';
	public null|string $permissionAction = 'delete';

	/**
	 * @inheritDoc
	 */
	public function apply(?string $currentUrl = null):?string {
		foreach ($this->models as $model) {
			$model->delete();
		}
		return $currentUrl;
	}

	/**
	 * @inheritDoc
	 */
	public function getLabel():string {
		return 'Удалить выбранные';
	}
}