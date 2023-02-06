<?php

namespace common\models\query;

use common\models\SpecialOffers;

/**
 * This is the ActiveQuery class for [[\common\models\SpecialOffers]].
 *
 * @see \common\models\SpecialOffers
 */
class SpecialOffersQuery extends \yii\db\ActiveQuery
{
    /**
     * @return \common\models\query\SpecialOffersQuery
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function active(): SpecialOffersQuery
    {
        return $this->andWhere(['status' => SpecialOffers::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\SpecialOffers[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\SpecialOffers|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
