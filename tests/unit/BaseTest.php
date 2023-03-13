<?php
declare(strict_types = 1);
use app\fixtures\UsersFixture;
use Codeception\Test\Unit;
use Helper\MigrationHelper;
use yii\base\InvalidRouteException;
use yii\web\Application;

/**
 * Base test
 */
class BaseTest extends Unit {

	/**
	 * @return string[]
	 * @throws Exception
	 * @throws InvalidRouteException
	 */
	public function _fixtures():array {
		MigrationHelper::migrateFresh();
		return [
			'users' => UsersFixture::class,
		];
	}

	/**
	 * @return void
	 */
	public function testBasic():void {
		static::assertInstanceOf(Application::class, Yii::$app);
	}

}
