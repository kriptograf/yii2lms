<?php

namespace common\repositories;

use common\models\Sales;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * Репозиторий продаж
 *
 * @package common\repositories
 *
 * @author Виталий Москвин <foreach@mail.ru>
 */
class SalesRepository
{
    /**
     * Получить идентификаторы наиболее продаваемых курсов
     * @return array
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function getBestSaleWebinarsIds(): array
    {
        $sales = Sales::find()
            ->select(new Expression('COUNT(id) as cnt, webinar_id'))
            ->where(['not', ['webinar_id' => null]])
            ->groupBy('webinar_id')
            ->orderBy(['cnt' => SORT_DESC])
            ->limit(6)
            ->asArray()
            ->all();

        return \yii2mod\helpers\ArrayHelper::pluck($sales, 'webinar_id');
    }
}