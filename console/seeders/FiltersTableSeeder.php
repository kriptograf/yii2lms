<?php

namespace console\seeders;

use common\models\Categories;
use common\models\FilterOptions;
use common\models\Filters;
use Faker\Factory;

/**
 * Class FiltersTableSeeder
 * Заполнить фильтры фейковыми данными
 *
 * @package console\seeders
 *
 * @author Виталий Москвин <foreach@mail.ru>
 */
class FiltersTableSeeder implements ITableSeeder
{
    /**
     * @inheritDoc
     */
    public function run()
    {
        \Yii::$app->db->createCommand()->truncateTable(Filters::tableName())->execute();
        \Yii::$app->db->createCommand()->truncateTable(FilterOptions::tableName())->execute();

        $faker = Factory::create();

        $categories = Categories::find()->where('parent_id IS NOT NULL')->all();

        foreach ($categories as $category) {
            foreach (range(1, 4) as $index) {
                $filter = new Filters();
                $filter->category_id = $category->id;
                $filter->title = $faker->sentence(2);
                $filter->save();
            }
        }

        $filters = Filters::find()->all();

        foreach ($filters as $filter) {
            foreach (range(1, random_int(3, 6)) as $index) {
                $filterOption = new FilterOptions();
                $filterOption->filter_id = $filter->id;
                $filterOption->title = $faker->sentence(2);
            }
        }
    }
}