<?php
declare(strict_types = 1);
use app\fixtures\UsersFixture;
use app\models\Users;
use Codeception\Exception\ModuleException;
use Helper\MigrationHelper;
use yii\base\InvalidRouteException;

/**
 *
 */
class UsersCest {

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
	 * @param FunctionalTester $I
	 * @return void
	 * @throws ModuleException
	 */
	public function TestIndex(FunctionalTester $I):void {
		$user = Users::find()->where(['id' => 1])->one();
		$I->assertNotNull($user);

		$I->amLoggedInAs($user);
		$I->amOnRoute('users/index');
		$I->seeResponseCodeIs(200);

	}

}