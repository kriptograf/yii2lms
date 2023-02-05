<?php

namespace console\seeders;

use common\models\User;
use Yii;

/**
 * Class UsersTableSeeder
 * Наполнение таблицы пользователей первичными данными
 *
 * @package console\seeders
 *
 * @author Виталий Москвин <foreach@mail.ru>
 */
class UsersTableSeeder implements ITableSeeder
{
    /**
     * @inheritDoc
     * @throws \yii\db\Exception
     */
    public function run()
    {
        \Yii::$app->db->createCommand()->truncateTable(User::tableName())->execute();

        $items = $this->getData();

        $auth = Yii::$app->authManager;

        foreach ($items as $item) {
            $user = new User();
            $user->username = $item['username'];
            $user->email = $item['email'];
            $user->setPassword($item['password']);
            $user->generateAuthKey();
            $user->generateEmailVerificationToken();
            $user->status = User::STATUS_ACTIVE;
            if ($user->save()) {
                $role = $auth->getRole($item['role']);
                $auth->assign($role, $user->getId());
            }
        }
    }

    /**
     * @return \string[][]
     * @author Виталий Москвин <foreach@mail.ru>
     */
    private function getData(): array
    {
        return [
            [
                'username'  => 'admin',
                'email'      => 'admin@gmail.com',
                'password'   => '123456',
                'role' => 'admin',
            ],
            [
                'username'  => 'user',
                'email'      => 'user@gmail.com',
                'password'   => '123456',
                'role' => 'student',
            ],
            [
                'username'  => 'teacher',
                'email'      => 'teacher@gmail.com',
                'password'   => '123456',
                'role' => 'teacher',
            ],
            [
                'username'  => 'organ',
                'email'      => 'organ@gmail.com',
                'password'   => '123456',
                'role' => 'organization'
            ],
        ];
    }
}