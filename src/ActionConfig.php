<?php
declare(strict_types = 1);

namespace cusodede\grid\widgets\mass_action;

use yii\base\Model;

/**
 * Class ActionConfig
 * Конфиг для пункта выпадающего меню MultiActionColumn
 * @property array $options html-опции пункта меню
 * @property string $actionHandlerClass Название экземпляра класса MultiModel, производящего обработку действия
 * @property bool|callable $visible Включение отображения пункта меню
 */
class ActionConfig extends Model {
	public string $actionHandlerClass;
	/**
	 * @var callable|bool
	 */
	public mixed $visible = true;
	public array $options = [];

	/**
	 * @inheritDoc
	 */
	public function rules():array {
		return [
			[['visible'], 'safe'],
			[['actionHandlerClass'], 'string'],
			[['options'], 'safe'],
			[['id', 'class'], 'required']
		];
	}

	/**
	 * @return string
	 */
	public function getActionHandlerClass():string {
		return $this->actionHandlerClass;
	}

	/**
	 * @param string $class
	 */
	public function setActionHandlerClass(string $class):void {
		$this->actionHandlerClass = $class;
	}

	/**
	 * @return bool|callable
	 */
	public function getVisible():bool|callable {
		return $this->visible;
	}

	/**
	 * @param bool|callable $visible
	 */
	public function setVisible(bool|callable $visible):void {
		$this->visible = $visible;
	}

	/**
	 * @return array
	 */
	public function getOptions():array {
		return $this->options;
	}

	/**
	 * @param array $options
	 */
	public function setOptions(array $options):void {
		$this->options = $options;
	}

}