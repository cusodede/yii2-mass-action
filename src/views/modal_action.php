<?php
declare(strict_types = 1);

/**
 * @var string $id
 * @var string $title
 * @var string $content
 */
use yii\bootstrap4\Html;
use yii\bootstrap4\Modal;

?>

<?php Modal::begin([
	'id' => $id.'-modal',
	'title' => "<div class='modal-title'>{$title}</div>",
	'footer' => Html::submitButton('<i class="fa fa-check"></i> Применить', ['class' => 'btn btn-success', 'form' => $id]),//post button outside the form
	'clientOptions' => ['backdrop' => false],
	'options' => [
		'tabindex' => false, // important for Select2 to work properly
		'class' => 'modal-dialog-large'
	]
]); ?>
<?= $content ?>
<?php Modal::end(); ?>
