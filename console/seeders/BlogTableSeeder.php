<?php

namespace console\seeders;

use common\models\Blog;
use common\models\BlogCategories;
use common\models\User;
use Faker\Factory;

/**
 * Class BlogTableSeeder
 * Наполнение блога и категорий блога тестовыми данными
 *
 * @package console\seeders
 *
 * @author Виталий Москвин <foreach@mail.ru>
 */
class BlogTableSeeder implements ITableSeeder
{
    /**
     * @inheritDoc
     */
    public function run()
    {
        \Yii::$app->db->createCommand()->truncateTable(BlogCategories::tableName())->execute();
        \Yii::$app->db->createCommand()->truncateTable(Blog::tableName())->execute();

        $faker = Factory::create();

        foreach (range(1, 4) as $index) {
            $blogCategory = new BlogCategories();
            $blogCategory->title = $faker->sentence(2);
            $blogCategory->slug = $faker->slug;
            $blogCategory->save();
        }

        $categories = BlogCategories::find()->all();

        foreach ($categories as $category) {
            foreach (range(1, rand(2, 6)) as $index) {
                $blog = new Blog();
                $blog->title = $faker->sentence;
                $blog->category_id = $category->id;
                $blog->author_id = $this->getFirstAuthor();
                $blog->image = '/img/default/example.png';
                $blog->description = $faker->paragraph(6);
                $blog->content = implode(' \n ',$faker->paragraphs(rand(3, 6)));
                $blog->enable_comment = true;
                $blog->status = Blog::STATUS_PUBLISH;
                if (!$blog->save()) {
                    return false;
                }
            }
        }
    }

    /**
     * Получить идентификатор первого пользователя
     * @return int|mixed|null
     * @author Виталий Москвин <foreach@mail.ru>
     */
    private function getFirstAuthor()
    {
        $user = User::findOne(['username' => 'teacher']);

        return $user->id;
    }
}