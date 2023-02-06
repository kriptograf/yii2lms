<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "blog".
 *
 * @property int                      $id
 * @property int|null                 $category_id
 * @property int|null                 $author_id
 * @property string|null              $title
 * @property string|null              $slug
 * @property string|null              $image
 * @property string|null              $description
 * @property string|null              $meta_description
 * @property string|null              $content
 * @property int|null                 $visit_count
 * @property int|null                 $enable_comment
 * @property string|null              $status
 * @property string|null              $created_at
 * @property string|null              $updated_at
 *
 * @property User                     $author
 * @property BlogCategories           $category
 * @property-read \yii\db\ActiveQuery $comments
 * @property integer                  $commentsCount
 */
class Blog extends \yii\db\ActiveRecord
{
    const STATUS_PENDING = 'pending';
    const STATUS_PUBLISH = 'publish';

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'blog';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['category_id', 'author_id', 'visit_count',], 'integer'],
            [['enable_comment'], 'boolean'],
            [['description', 'meta_description', 'content'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'slug', 'image', 'status'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['author_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlogCategories::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'author_id' => 'Author ID',
            'title' => 'Title',
            'slug' => 'Slug',
            'image' => 'Image',
            'description' => 'Description',
            'meta_description' => 'Meta Description',
            'content' => 'Content',
            'visit_count' => 'Visit Count',
            'enable_comment' => 'Enable Comment',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::class, ['id' => 'author_id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\BlogCategoriesQuery
     */
    public function getCategory()
    {
        return $this->hasOne(BlogCategories::class, ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function getComments(): \yii\db\ActiveQuery
    {
        return $this->hasMany(Comments::class, ['blog_id' => 'id']);
    }

    /**
     * @return bool|int|string|null
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function getCommentsCount()
    {
        return $this->hasMany(Comments::class, ['blog_id' => 'id'])->count();
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\BlogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\BlogQuery(get_called_class());
    }
}
