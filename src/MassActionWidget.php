<?php
declare(strict_types = 1);

namespace cusodede\grid\widgets\mass_action;

use cusodede\grid\widgets\mass_action\models\BaseMassModel;
use cusodede\grid\widgets\mass_action\models\MassModelInterface;
use kartik\bs4dropdown\ButtonDropdown;
use Throwable;
use Yii;
use yii\base\Controller;
use yii\base\InvalidConfigException;
use yii\base\ViewContextInterface;
use yii\base\Widget;
use yii\web\ForbiddenHttpException;
use yii\web\JsExpression;

/**
 * Виджет массового управления
 */
class MassActionWidget extends Widget {
	public array $actions;
	private array $_dropdownItems = [];
	private array $_modals = [];
	private MassActionControllerInterface|ViewContextInterface|Controller $controller;

	/**
	 * @return string|void
	 * @throws Throwable
	 */
	public function run() {
		if (null === $content = $this->getList()) return;
		return $this->render('widget', [
			'label' => 'Масс. упр.',
			'content' => $content,
		]);
	}

	/**
	 * @inheritDoc
	 */
	public function init():void {
		$this->registerController();
		MassActionWidgetAssets::register($this->view);
		$this->initHandler();
		parent::init();
	}

	/**
	 * @throws InvalidConfigException
	 * @throws Throwable
	 */
	private function initHandler():void {
		foreach ($this->actions as $actionConfig) {
			if (is_array($actionConfig)) $actionConfig = new ActionConfig($actionConfig);
			$handlerModel = new $actionConfig->actionHandlerClass([
				'handleUrl' => sprintf('%s%s', $this->getControllerDefaultRouteAction(), 'mass-operation'),
			]);
			if (!($handlerModel instanceof MassModelInterface)) throw new InvalidConfigException("{$handlerModel} должен быть экземпляром MultiModel");
			if (false === $this->isVisible($handlerModel, $actionConfig)) continue;
			$this->_dropdownItems[] = [
				'url' => '#',
				'linkOptions' => array_merge($actionConfig->options, $this->getDropdownDefaultOptions($handlerModel)),
				'label' => $handlerModel->getLabel(),
			];
			if (null !== $handlerModel->modalContent) {
				$this->_modals[] = Yii::$app->view->render('modal_action', [
					'id' => $handlerModel->id,
					'title' => $handlerModel->getLabel(),
					'content' => $handlerModel->modalContent
				], $this);
			}
		}
	}

	/**
	 * @param BaseMassModel $handlerModel
	 * @param ActionConfig $actionConfig
	 * @return bool
	 * @throws InvalidConfigException
	 * @throws Throwable
	 * @throws ForbiddenHttpException
	 * todo: test
	 */
	private function isVisible(MassModelInterface $handlerModel, ActionConfig $actionConfig):bool {
		return (((is_callable($actionConfig->visible) && call_user_func($actionConfig->visible, $this, $handlerModel)) || $actionConfig->visible));
	}

	/**
	 * Generates default dropdown parameters, mostly for modal calling js-button
	 * @param null|MassModelInterface $actionHandler
	 * @return array
	 */
	private function getDropdownDefaultOptions(?MassModelInterface $actionHandler = null):array {
		if (null === $actionHandler) return [];
		return [
			'style' => 'cursor:pointer',
			'onclick' => $actionHandler->action??new JsExpression("javascript:alert('Не задан обработчик!');")
		];
	}

	/**
	 * @return null|string
	 * @throws Throwable
	 */
	private function getList():?string {
		if (empty($this->_modals)) return null;
		return ButtonDropdown::widget([
				'label' => "<i class='fa fa-bars'></i>",
				'encodeLabel' => false,
				'dropdown' => [
					'options' => [
						'class' => 'pull-left',
					],
					'encodeLabels' => false,
					'items' => $this->_dropdownItems,
				],
				'buttonOptions' => ['class' => 'btn-outline-secondary']
			]).implode('', $this->_modals);
	}

	/**
	 * @return void
	 * @throws InvalidConfigException
	 */
	private function registerController():void {
		if (!($this->view->context instanceof ViewContextInterface)) throw new InvalidConfigException("{$this->view->context} должен быть должен быть реализован от ViewContextInterface");
		if (!($this->view->context instanceof Controller)) throw new InvalidConfigException("{$this->view->context} должен быть должен быть экземпляром Controller");
		if (!($this->view->context instanceof MassActionControllerInterface)) throw new InvalidConfigException("{$this->view->context} должен быть реализован от MassActionControllerInterface");
		$this->controller = $this->view->context;
	}

	/**
	 * @return string
	 */
	private function getControllerDefaultRouteAction():string {
		return sprintf("/%s", str_replace($this->controller->action->id, '', $this->controller->route));
	}
}