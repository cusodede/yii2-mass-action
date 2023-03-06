<?php
declare(strict_types = 1);

namespace cusodede\grid\widgets\mass_action\models\actions;

use app\components\db\ActiveRecordTrait;
use cusodede\grid\widgets\mass_action\models\BaseMassModel;
use yii\db\ActiveRecord;

/**
 * Class MassDelete
 *
 * @property ActiveRecordTrait[]|ActiveRecord[] $models
 *
 */
class MassDelete extends BaseMassModel {
	public string $id = 'mass-delete';
	public null|string $permissionAction = 'delete';

	/**
	 * @inheritDoc
	 */
	public function apply(?string $currentUrl = null):?string {
		foreach ($this->models as $model) {
			$model->safeDelete();
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