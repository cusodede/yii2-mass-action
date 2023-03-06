<?php
declare(strict_types = 1);
/**
 * @var View $this
 * @var MassPasswordReset $model
 * @var string $handleUrl
 * @var string $fromUrl
 * @var string $id
 */

use cusodede\grid\widgets\mass_action\models\actions\MassPasswordReset;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

?>
<?php $form = ActiveForm::begin(['id' => $id, 'action' => $handleUrl]); ?>
	<div class="row kv-align-left">
		<div class="col-md-12">
			<?= Html::hiddenInput('handlerClass', get_class($model)) ?>
			<?= Html::hiddenInput('fromUrl', $fromUrl) ?>
			<?= $form->field($model, 'modelKeys')->hiddenInput()->label(false) ?>
			Сгенерировать пользователям новые пароли и отправить их на почту.
			<?= $form->field($model, 'unban')->checkbox() ?>
		</div>
	</div>

<?php ActiveForm::end(); ?>