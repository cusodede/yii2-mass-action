<?php
declare(strict_types = 1);
use yii\web\View;

/**
 * @var View $this
 * @var string $label
 * @var string $content
 */

?>

<div class='mass-action-widget' data-toggle="tooltip" title="Массовое управление">
	<label>
		<div class="mass-action-label-padding"><?= $label ?></div>
		<div class="content"><?= $content ?></div>
	</label>
</div>
