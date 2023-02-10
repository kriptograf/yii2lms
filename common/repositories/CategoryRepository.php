<?php

namespace common\repositories;

use common\models\Categories;

/**
 * Репозиторий категорий
 *
 * @package common\repositories
 *
 * @author Виталий Москвин <foreach@mail.ru>
 */
class CategoryRepository
{
    /**
     * Получить категории для верхнего меню
     * @return mixed
     * @throws \Throwable
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function getForHomepage()
    {
        \Yii::$app->cache->flush();
        return Categories::getDb()->cache(function ($db) {
            return Categories::find()
                ->where(['parent_id' => null])
                ->with('subCategories')
                ->orderBy(['order' => SORT_ASC])
                ->all();
        }, 24 * 60 * 60);
    }
}