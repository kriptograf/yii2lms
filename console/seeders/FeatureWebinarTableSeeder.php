<?php

namespace console\seeders;

use common\models\FeatureWebinars;
use common\models\Webinars;

/**
 * Class FeatureWebinarTableSeeder
 *
 *
 * @package console\seeders
 *
 * @author Виталий Москвин <foreach@mail.ru>
 */
class FeatureWebinarTableSeeder implements ITableSeeder
{

    /**
     * @inheritDoc
     */
    public function run()
    {
        \Yii::$app->db->createCommand()->truncateTable(FeatureWebinars::tableName())->execute();

        $pages = FeatureWebinars::$pages;

        $status = [FeatureWebinars::STATUS_PUBLISH, FeatureWebinars::STATUS_PENDING];

        $webinars = Webinars::find()->select(['id'])->all();

        foreach ($webinars as $webinar) {
            $featureWebinar = new FeatureWebinars();
            $featureWebinar->webinar_id = $webinar->id;
            $featureWebinar->page = $pages[array_rand($pages)];
            $featureWebinar->status = $status[array_rand($status)];
            $featureWebinar->save();
        }
    }
}