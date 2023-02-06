<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\AdvertisingBanners]].
 *
 * @see \common\models\AdvertisingBanners
 */
class AdvertisingBannersQuery extends \yii\db\ActiveQuery
{
    /**
     * @return \common\models\query\AdvertisingBannersQuery
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function published(): AdvertisingBannersQuery
    {
        return $this->andWhere(['published' => true]);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\AdvertisingBanners[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\AdvertisingBanners|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
