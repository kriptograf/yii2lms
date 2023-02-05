<?php

namespace console\seeders;

use common\models\Roles;
use common\rbac\RolesEnum;
use Yii;

/**
 * Class RolesTableSeeder
 * Наполнение таблицы ролей
 *
 * @package console\seeders
 *
 * @author Виталий Москвин <foreach@mail.ru>
 */
class RolesTableSeeder implements ITableSeeder
{
    /**
     * @inheritDoc
     * @throws \yii\base\Exception
     */
    public function run()
    {
        \Yii::$app->db->createCommand()->truncateTable('auth_assignment')->execute();
        \Yii::$app->db->createCommand()->truncateTable('auth_item_child')->execute();
        \Yii::$app->db->createCommand()->truncateTable('auth_item')->execute();
        \Yii::$app->db->createCommand()->truncateTable('auth_rule')->execute();

        /** @var \yii\rbac\DbManager $auth */
        $auth = Yii::$app->authManager;

        // -- Роли
        $student = $auth->createRole(RolesEnum::ROLE_STUDENT);
        $student->description = 'Студент';
        $auth->add($student);

        $teacher = $auth->createRole(RolesEnum::ROLE_TEACHER);
        $teacher->description = 'Преподаватель';
        $auth->add($teacher);

        $organization = $auth->createRole(RolesEnum::ROLE_ORGANIZATION);
        $organization->description = 'Организация';
        $auth->add($organization);

        $admin = $auth->createRole(RolesEnum::ROLE_ADMIN);
        $admin->description = 'Администратор';
        $auth->add($admin);

        // -- Разрешения
        $createSection = $auth->createPermission('createSection');
        $createSection->description = 'Создание раздела';
        $auth->add($createSection);

        $updateSection = $auth->createPermission('updateSection');
        $updateSection->description = 'Редактирование раздела';
        $auth->add($updateSection);

        $deleteSection = $auth->createPermission('deleteSection');
        $deleteSection->description = 'Удаление раздела';
        $auth->add($deleteSection);

        $viewSection = $auth->createPermission('viewSection');
        $viewSection->description = 'Просмотр раздела';
        $auth->add($viewSection);

        // -- Назначение разрешений ролям
        $auth->addChild($admin, $createSection);
        $auth->addChild($admin, $updateSection);
        $auth->addChild($admin, $deleteSection);
        $auth->addChild($admin, $viewSection);
        $auth->addChild($admin, $student);
        $auth->addChild($admin, $teacher);
        $auth->addChild($admin, $organization);
    }
}