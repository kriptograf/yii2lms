<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "advertising_banners".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $position
 * @property string|null $image
 * @property int|null $size
 * @property string|null $link
 * @property int|null $published
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class AdvertisingBanners extends \yii\db\ActiveRecord
{
    /** @var array|string[]  */
    public static array $positions = [
        'home1', 'home2', 'course', 'course_sidebar'
    ];

    /** @var string[]  */
    public static array $size = [
        '12' => 'full',
        '6' => '1/2',
        '4' => '1/3',
        '3' => '1/4'
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'advertising_banners';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['size', 'published'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'position', 'image', 'link'], 'string', 'max' => 255],
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
            'position' => 'Position',
            'image' => 'Image',
            'size' => 'Size',
            'link' => 'Link',
            'published' => 'Published',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\AdvertisingBannersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\AdvertisingBannersQuery(get_called_class());
    }
}
