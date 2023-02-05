<?php

namespace console\seeders;

use common\models\Categories;
use common\models\FilterOptions;
use common\models\Filters;
use common\models\Tags;
use common\models\WebinarFilterOption;
use common\models\Webinars;
use common\rbac\RolesEnum;
use Faker\Factory;
use Yii;

class WebinarsTableSeeder implements ITableSeeder
{
    /**
     * @inheritDoc
     */
    public function run()
    {
        \Yii::$app->db->createCommand()->truncateTable(Webinars::tableName())->execute();
        \Yii::$app->db->createCommand()->truncateTable(Tags::tableName())->execute();

        /** @var  $faker */
        $faker = Factory::create();

        /** @var \yii\rbac\DbManager $auth */
        $auth = Yii::$app->authManager;

        $teachers = $auth->getUserIdsByRole(RolesEnum::ROLE_TEACHER);

        foreach ($teachers as $teacher) {
            $categories = Categories::find()->where(['not', ['parent_id' => null]])->all();

            foreach ($categories as $category) {
                $start_date = $faker->dateTimeBetween('-3 week', 'now')->format('Y-m-d H:i:s');

                $webinar = new Webinars();
                $webinar->teacher_id = $teacher;
                $webinar->creator_id = $teacher;
                $webinar->category_id = $category->id;
                $webinar->title = $faker->sentence;
                $webinar->start_date = $start_date;
                $webinar->duration = rand(10, 160);
                $webinar->seo_description = $faker->sentence;
                $webinar->image_cover = 'https://picsum.photos/id/' . rand(1000, 1050) . '/1600/600';
                $webinar->thumbnail = 'https://picsum.photos/id/' . rand(1000, 1050) . '/400/300';
                $webinar->video_demo = null;
                $webinar->description = $faker->paragraph(6);
                $webinar->capacity = random_int(1, 30);
                $webinar->price = random_int(0, 99);
                $webinar->support = random_int(0, 1);
                $webinar->downloadable = random_int(0, 1);
                $webinar->partner_instructor = false;
                $webinar->subscribe = false;
                $webinar->status = Webinars::STATUS_ACTIVE;
                if (!$webinar->save()) {
                    return false;
                }

                $filters = Filters::find()->all();

                foreach ($filters as $filter) {
                    $filterOptions = FilterOptions::find()->where(['filter_id' => $filter->id])->all();

                    foreach ($filterOptions as $filterOption) {
                        $webinarFilterOption = new WebinarFilterOption();
                        $webinarFilterOption->webinar_id = $webinar->id;
                        $webinarFilterOption->filter_option_id = $filterOption->id;
                        $webinarFilterOption->save();
                    }
                }

                foreach (range(1, random_int(2, 4)) as $index) {
                    $tag = new Tags();
                    $tag->webinar_id = $webinar->id;
                    $tag->title = $faker->word;
                    $tag->save();
                }
            }
        }
    }
}