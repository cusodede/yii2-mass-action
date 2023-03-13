<?php
declare(strict_types = 1);
/**
 * @var View $this
 * @var MassDelete $model
 * @var string $handleUrl
 * @var string $fromUrl
 * @var string $id
 */

use cusodede\mass_action\models\actions\MassDelete;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

?>
<?php $form = ActiveForm::begin(['id' => $id, 'action' => $handleUrl]); ?>
	<div class="row">
		<div class="col-md-12">
			<?= Html::hiddenInput('handlerClass', get_class($model)) ?>
			<?= Html::hiddenInput('fromUrl', $fromUrl) ?>
			<?= $form->field($model, 'modelKeys')->hiddenInput()->label(false) ?>
			Удалить отмеченные записи?
		</div>
	</div>
<?php ActiveForm::end(); ?>