<?php

namespace common\repositories;

use common\models\FeatureWebinars;

/**
 * Репозиторий популярных вебинаров
 *
 * @package common\repositories
 *
 * @author Виталий Москвин <foreach@mail.ru>
 */
class FeatureWebinarsRepository
{
    /**
     * Получить популярные вебинары для вывода на главной странице
     * @return array|\common\models\FeatureWebinars[]
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function getFeatureForHomePage(): array
    {
        return FeatureWebinars::find()
            ->with([
                'webinar' => function ($query) {
                    $query->with([
                        'teacher' => function ($qu) {
                            $qu->select('id', 'username');
                        },
                        'webinarReviews' => function ($query) {
                            $query->where(['status' => 'active']);
                        },
                        'tickets',
                        'featureWebinars'
                    ]);
                }
            ])
            ->where(['in', 'page', ['home', 'home_categories']])
            ->orderBy(['updated_at' => SORT_DESC])
            ->all();
    }
}