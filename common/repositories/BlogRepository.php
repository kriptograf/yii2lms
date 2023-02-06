<?php

namespace common\repositories;

use common\models\Blog;

/**
 * Репозиторий блога
 *
 * @package common\repositories
 *
 * @author Виталий Москвин <foreach@mail.ru>
 */
class BlogRepository
{
    /**
     * Получить последние три записи блога для главной страницы
     * @return array
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function getForHomepage(): array
    {
        return Blog::find()
            ->publish()
            ->with(['category', 'author' => function ($query) {
                $query->select('id', 'username');
            }])
            ->with('commentsCount')
            ->orderBy(['updated_at' => SORT_DESC])
            ->limit(3)
            ->all()
        ;
    }
}