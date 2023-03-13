<?php
declare(strict_types = 1);

namespace cusodede\mass_action;

use yii\base\InvalidConfigException;
use yii\web\Response;

/**
 * Интерфейс действий массового управления
 */
interface MassActionControllerInterface {
	/**
	 * Экшен обработки множественных операций на согласование
	 * @return Response
	 * @throws InvalidConfigException
	 */
	public function actionMassOperation():Response;
}