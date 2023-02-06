<?php

namespace common\repositories;

use common\models\AdvertisingBanners;

/**
 * Репозиторий рекламных баннеров
 *
 * @package common\repositories
 *
 * @author Виталий Москвин <foreach@mail.ru>
 */
class AdvertisingBannerRepository
{
    /**
     * Получить баннеры для главной страницы
     * @return array
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function getForHomepage(): array
    {
        return AdvertisingBanners::find()
            ->where(['in', 'position', ['home1', 'home2']])
            ->published()
            ->all()
        ;
    }
}