<?php
declare(strict_types = 1);

namespace cusodede\grid\widgets\mass_action\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * Simple users support helper model
 */
trait UsersHelper {

	/**
	 * @return IdentityInterface|null Current user identity or null, if not present
	 */
	public static function CurrentUser():?IdentityInterface {
		return (null === $user = Yii::$app->user?->identity)
			?null
			:$user;
	}

}