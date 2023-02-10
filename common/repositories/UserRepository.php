<?php

namespace common\repositories;

use common\models\Notifications;
use common\models\User;
use common\rbac\RolesEnum;

/**
 * Репозиторий пользователя
 *
 * @package common\repositories
 *
 * @author Виталий Москвин <foreach@mail.ru>
 */
class UserRepository
{
    /**
     * Получить преподавателей
     * @return array
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function getInstructors(): array
    {
        $teacherIds = \Yii::$app->authManager->getUserIdsByRole(RolesEnum::ROLE_TEACHER);

        return User::find()
            ->select(['id', 'username'])
            ->where(['in', 'id', $teacherIds])
            ->andWhere(['status' => User::STATUS_ACTIVE])
            ->limit(8)
            ->all()
        ;
    }

    /**
     * Получить организации
     * @return array
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function getOrganizations(): array
    {
        $result = [];

        $organizationIds = \Yii::$app->authManager->getUserIdsByRole(RolesEnum::ROLE_ORGANIZATION);

        $users = User::find()
            //->select(['id', 'username'])
            //->with(['countWebinars'])
            ->where(['in', 'id', $organizationIds])
            ->andWhere(['status' => User::STATUS_ACTIVE])
            ->limit(6)
            ->all()
        ;

        foreach ($users as $key => $user) {
            $result[$key]['id'] = $user->id;
            $result[$key]['username'] = $user->username;
            $result[$key]['countWebinars'] = $user->countWebinars;
        }

        return $result;
    }

    /**
     * Получить количество опытных преподавателей
     * @return bool|int|string|null
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function getSkillfulTeachersCount()
    {
        $teacherIds = \Yii::$app->authManager->getUserIdsByRole(RolesEnum::ROLE_TEACHER);

        return User::find()
            ->where(['in', 'id', $teacherIds])
            ->andWhere(['status' => User::STATUS_ACTIVE])
            ->count()
        ;
    }

    /**
     * Получить количество студентов
     * @return bool|int|string|null
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function getStudentCount()
    {
        $studentIds = \Yii::$app->authManager->getUserIdsByRole(RolesEnum::ROLE_STUDENT);

        return User::find()
            ->where(['in', 'id', $studentIds])
            ->andWhere(['status' => User::STATUS_ACTIVE])
            ->count()
        ;
    }

    public function getUnReadNotifications()
    {
        // -- @todo Только непрочитанные получать
        // -- @todo Разделить потом по статусам, ролям и группам
        return Notifications::find()->where(['user_id' => \Yii::$app->user->id])->all();
    }
}