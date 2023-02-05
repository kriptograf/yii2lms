<?php
namespace common\rbac;

/**
 * Class RolesEnum
 * Перечисление ролей для использования в RBAC
 *
 * @package common\rbac
 *
 * @author Виталий Москвин <foreach@mail.ru>
 */
class RolesEnum
{
    const ROLE_ADMIN = 'admin';
    const ROLE_STUDENT = 'student';
    const ROLE_TEACHER = 'teacher';
    const ROLE_ORGANIZATION = 'organization';
}