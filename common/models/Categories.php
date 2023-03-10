<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string|null $title
 * @property int|null $order
 * @property string|null $icon
 *
 * @property Filters[] $filters
 * @property TrendCategories[] $trendCategories
 * @property UsersOccupations[] $usersOccupations
 * @property Webinars[] $webinars
 * @property Categories[] $subCategories
 *
 * @property string $url
 */
class Categories extends \yii\db\ActiveRecord
{
    public string $url;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'order'], 'integer'],
            [['title', 'icon'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'title' => 'Title',
            'order' => 'Order',
            'icon' => 'Icon',
        ];
    }

    /**
     * Прикручиваем дополнительные атрибуты для возврата rest клиенту
     * @return array|false|int[]|string[]
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function fields()
    {
        $fields = parent::fields();

        $fields['url'] = function () {
            return '/categories/' . str_replace(' ', '-', $this->title);
        };

        $fields['subCategories'] = function () {
            return $this->subCategories;
        };

        return $fields;
    }

    /**
     * Gets query for [[Filters]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\FiltersQuery
     */
    public function getFilters()
    {
        return $this->hasMany(Filters::class, ['category_id' => 'id']);
    }

    /**
     * Gets query for [[TrendCategories]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\TrendCategoriesQuery
     */
    public function getTrendCategories()
    {
        return $this->hasMany(TrendCategories::class, ['category_id' => 'id']);
    }

    /**
     * Gets query for [[UsersOccupations]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UsersOccupationsQuery
     */
    public function getUsersOccupations()
    {
        return $this->hasMany(UsersOccupations::class, ['category_id' => 'id']);
    }

    /**
     * Gets query for [[Webinars]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\WebinarsQuery
     */
    public function getWebinars()
    {
        return $this->hasMany(Webinars::class, ['category_id' => 'id']);
    }

    public function getCountWebinars()
    {
        return $this->hasMany(Webinars::class, ['category_id' => 'id'])->count();
    }

    public function getSubCategories()
    {
        return $this->hasMany(Categories::class, ['parent_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\CategoriesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CategoriesQuery(get_called_class());
    }
}
