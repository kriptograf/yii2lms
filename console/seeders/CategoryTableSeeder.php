<?php

namespace console\seeders;

use common\models\Categories;
use Faker\Factory;

/**
 * Class CategoryTableSeeder
 * Наполнение категорий фейковыми данными
 *
 * @package console\seeders
 *
 * @author Виталий Москвин <foreach@mail.ru>
 */
class CategoryTableSeeder implements ITableSeeder
{
    /**
     * @inheritDoc
     * @throws \Exception
     */
    public function run()
    {
        \Yii::$app->db->createCommand()->truncateTable(Categories::tableName())->execute();

        $faker = Factory::create();

        for($i = 0; $i < 10; $i++) {
            $category = new Categories();
            $category->parent_id = null;
            $category->title = $faker->sentence(2);
            $category->save();
        }
        
        $categories = Categories::find()->all();

        foreach ($categories as $cat) {
            foreach (range(1, random_int(2, 6)) as $index) {
                $category = new Categories();
                $category->parent_id = $cat->id;
                $category->title = $faker->sentence(2);
                $category->save();
            }
        }
    }
}