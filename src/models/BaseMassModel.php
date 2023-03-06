<?php
declare(strict_types = 1);

namespace cusodede\grid\widgets\mass_action\models;

use Yii;
use yii\base\Model;
use yii\base\ViewContextInterface;
use yii\db\ActiveRecordInterface;
use yii\helpers\Html;
use yii\web\JsExpression;

/**
 * Class BaseMassModel
 * @property null|string|ActiveRecordInterface $modelClass Класс, который будет обрабатывать экшен
 * @property string $handleUrl
 * @property string $modalContent
 * @property string $action
 * @property string $permissionAction - экшен, который будет проверяться для доступа
 */
abstract class BaseMassModel extends Model implements MassModelInterface, ViewContextInterface {
	protected string $id;
	public null|string|ActiveRecordInterface $modelClass = null;
	public null|string $handleUrl = null;
	public string $modalContent;
	public null|object $action = null;
	public string $primaryKey = '';//для совместимости с AR
	public null|string $permissionAction = null;
	protected ?array $_modelKeys = null;

	/**
	 * {@inheritDoc}
	 */
	public function rules():array {
		return [
			[['modelKeys'], 'safe'],
			[['modelKeys'], 'required']
		];
	}

	/**
	 * @return string
	 */
	abstract public function getLabel():string;

	/**
	 * @inheritDoc
	 */
	public function init():void {
		parent::init();
		$this->action = $this->action??new JsExpression("javascript:if (0!==jQuery(this).closest('.grid-view').yiiGridView('getSelectedRows').length) {
							jQuery('#{$this->id}-modal').modal('show');
							$('#".Html::getInputId($this, 'modelKeys')."').val(jQuery(this).closest('.grid-view').yiiGridView('getSelectedRows'))
						}");
		$this->modalContent = Yii::$app->view->render($this->id, [
			'model' => $this,
			'id' => $this->id,//здесь обязательно, иначе генерируемая кнопка не сработает. Если форма сама рисует кнопку, можно обойтись
			'handleUrl' => $this->handleUrl,
			'fromUrl' => Yii::$app->request->absoluteUrl
		], $this);
	}

	/**
	 * @return array
	 */
	public function getModels():array {
		/** @noinspection PhpPossiblePolymorphicInvocationInspection Нет класса - нет конфетки */
		return $this->modelClass::findModels($this->_modelKeys);
	}

	/**
	 * @return null|int[]
	 */
	public function getModelKeys():?array {
		return $this->_modelKeys;
	}

	/**
	 * @inheritDoc
	 */
	public function setModelKeys(array|string $keys):void {
		if (is_array($keys)) {
			$this->_modelKeys = $keys;
		} elseif (is_string($keys)) {
			$this->_modelKeys = explode(',', $keys);
		}
		$this->_modelKeys = array_unique($this->_modelKeys);
	}

	/**
	 * @inheritDoc
	 */
	public function getViewPath():string {
		return __DIR__.'/../views/actions';
	}

	/**
	 * @return string
	 */
	public function getId():string {
		return $this->id;
	}

}