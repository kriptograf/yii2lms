<?php

namespace common\repositories;

use Carbon\Carbon;
use common\models\SpecialOffers;
use common\models\Tickets;
use common\models\WebinarReviews;
use common\models\Webinars;
use yii\db\Expression;

/**
 * Репозиторий вебинаров
 *
 * @package common\repositories
 *
 * @author Виталий Москвин <foreach@mail.ru>
 */
class WebinarsRepository
{
    /**
     * Получить последние шесть активных вебинаров
     * @return array
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function getLatest(): array
    {
        return Webinars::find()
            ->where(['status' => Webinars::STATUS_ACTIVE])
            ->andWhere(['private' => false])
            ->with([
                'teacher' => function ($qu) {
                    $qu->select('id', 'username');
                },
                'webinarReviews' => function ($query) {
                    $query->where(['status' => 'active']);
                },
                'tickets',
                'featureWebinars'
            ])
            ->orderBy(['updated_at' => SORT_DESC])
            ->limit(6)
            ->all();
    }

    /**
     * Получить наиболее продаваемые вебинары
     *
     * @param array $salesIdx
     *
     * @return array
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function getBestSales(array $salesIdx): array
    {
        return Webinars::find()
            ->where(['in', 'id', $salesIdx])
            ->active()
            ->noPrivate()
            ->with([
                'teacher' => function ($qu) {
                    $qu->select('id', 'username');
                },
                'webinarReviews' => function ($query) {
                    $query->where(['status' => 'active']);
                },
                'sales',
                'tickets',
                'featureWebinars'
            ])
            ->all();
    }

    /**
     * Получить шесть лучших вебинаров
     * @return array
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function getBestRate(): array
    {
        return Webinars::find()
            ->select(['webinars.*', 'webinar_reviews.rates', 'webinar_reviews.status', new Expression('avg(rates) as avg_rates')])
            ->innerJoin(WebinarReviews::tableName(), 'webinars.id = webinar_reviews.webinar_id')
            ->where(['webinars.status' => Webinars::STATUS_ACTIVE])
            ->andWhere(['webinars.private' => false])
            ->andWhere(['webinar_reviews.status' => WebinarReviews::STATUS_ACTIVE])
            ->groupBy('teacher_id')
            ->orderBy(['avg_rates' => SORT_DESC])
            ->with([
                'teacher' => function ($qu) {
                    $qu->select('id', 'username');
                }
            ])
            ->limit(6)
            ->all()
        ;
    }

    /**
     * Получить вебинары со скидкой
     * @return array
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function getHasDiscountWebinars(): array
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');

        $webinarIdsHasDiscount = [];

        $tickets = Tickets::find()
            ->where(['<', 'start_date', $now])
            ->andWhere(['>', 'end_date', $now])
            ->all()
        ;

        foreach ($tickets as $ticket) {
            if ($ticket->isValid()) {
                $webinarIdsHasDiscount[] = $ticket->webinar_id;
            }
        }

        $specialOffersWebinarIds = SpecialOffers::find()
            ->select('webinar_id')
            ->active()
            ->where(['<', 'from_date', $now])
            ->where(['>', 'to_date', $now])
            ->asArray()
            ->all();
        ;

        $webinarIdsHasDiscount = array_merge($specialOffersWebinarIds, $webinarIdsHasDiscount);

        return Webinars::find()
            ->where(['in', 'id', array_unique($webinarIdsHasDiscount)])
            ->active()
            ->noPrivate()
            ->with([
                'teacher' => function ($qu) {
                    $qu->select('id', 'username');
                },
                'webinarReviews' => function ($query) {
                    $query->where(['status' => 'active']);
                },
                'sales',
                'tickets',
                'featureWebinars'
            ])
            ->limit(6)
            ->all()
        ;
    }

    /**
     * Получить бесплатные курсы/вебинары
     * @return array
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function getFree(): array
    {
        return Webinars::find()
            ->active()
            ->noPrivate()
            ->andWhere(['is', 'price',  null])
            ->orWhere(['price' => 0])
            ->with([
                'teacher' => function ($qu) {
                    $qu->select('id', 'username');
                },
                'webinarReviews' => function ($query) {
                    $query->where(['status' => 'active']);
                },
                'tickets',
                'featureWebinars'
            ])
            ->orderBy(['updated_at' => SORT_DESC])
            ->limit(6)
            ->all()
        ;
    }

    /**
     * Получить количество активных вебинаров
     * @return bool|int|string|null
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function getLiveClassCount()
    {
        return Webinars::find()
            ->where(['type' => Webinars::TYPE_WEBINAR])
            ->active()
            ->count()
        ;
    }

    /**
     * Получить количество офлайн курсов
     * @return bool|int|string|null
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function getOfflineCourseCount()
    {
        return Webinars::find()
            ->where(['in', 'type', ['course', 'text_lesson']])
            ->active()
            ->count()
        ;
    }
}