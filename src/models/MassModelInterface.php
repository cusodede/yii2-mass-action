<?php
declare(strict_types = 1);

namespace cusodede\grid\widgets\mass_action\models;

/**
 *
 * Interface MultiModel
 * Определение интерфейса модели, обрабатывающей списки других моделей
 * @property string $id
 * @property null|string $handleUrl
 * @property null|int[] $modelKeys
 * @property null|string $modalContent
 * @property string $action
 */
interface MassModelInterface {

	/**
	 * same as Model::load()
	 * @param array $data
	 * @param null|string $formName
	 * @return bool
	 * @noinspection ReturnTypeCanBeDeclaredInspection
	 */
	public function load(array $data, ?string $formName = null);

	/**
	 * Принимает список идентификаторов моделей на обработку
	 * @param array|string $keys
	 */
	public function setModelKeys(array|string $keys):void;

	/**
	 * Применяет установленные параметры ко всем моделям целей
	 * @param null|string $currentUrl  необязательный параметр адреса, с которого был вызван обработчик (чтобы он мог вернуться к тому же URL, при необходимости)
	 * @return null|string может вернуть необязательный url перехода
	 */
	public function apply(?string $currentUrl = null):?string;

}