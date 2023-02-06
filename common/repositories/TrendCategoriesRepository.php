<?php

namespace common\repositories;

use common\models\TrendCategories;

/**
 * Репозиторий категорий направлений
 *
 * @package common\repositories
 *
 * @author Виталий Москвин <foreach@mail.ru>
 */
class TrendCategoriesRepository
{
    /**
     * Получить категории направлений для главной страницы
     * @return array
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function getForHomepage(): array
    {
        return TrendCategories::find()
            ->with(['category' => function ($query) {
                $query->with('countWebinars');
            }])
            ->orderBy(['created_at' => SORT_DESC])
            ->limit(6)
            ->all()
        ;
    }
}