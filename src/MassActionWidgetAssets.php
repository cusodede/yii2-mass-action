<?php
declare(strict_types = 1);

namespace cusodede\mass_action;

use yii\web\AssetBundle;

/**
 * Class MassActionWidgetAssets
 */
class MassActionWidgetAssets extends AssetBundle {
	/**
	 * @inheritdoc
	 */
	public function init():void {
		$this->sourcePath = __DIR__.'/assets';
		$this->css = [
			'css/mass_action_widget.css'
		];
		parent::init();
	}
}