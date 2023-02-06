<?php

namespace common\repositories;

use common\models\Testimonials;

/**
 * Репозиторий отзывов клиентов
 *
 * @package common\repositories
 *
 * @author Виталий Москвин <foreach@mail.ru>
 */
class TestimonialsRepository
{
    /**
     * Получить все активные отзывы
     * @return array
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function getAllActive(): array
    {
        return Testimonials::find()->active()->all();
    }
}