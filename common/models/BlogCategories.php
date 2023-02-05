<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "blog_categories".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $slug
 *
 * @property Blog[] $blogs
 */
class BlogCategories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blog_categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'slug'], 'string', 'max' => 255],
            [['slug'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'slug' => 'Slug',
        ];
    }

    /**
     * Gets query for [[Blogs]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\BlogQuery
     */
    public function getBlogs()
    {
        return $this->hasMany(Blog::class, ['category_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\BlogCategoriesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\BlogCategoriesQuery(get_called_class());
    }
}
