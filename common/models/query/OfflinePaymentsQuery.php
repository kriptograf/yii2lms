<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\OfflinePayments]].
 *
 * @see \common\models\OfflinePayments
 */
class OfflinePaymentsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\OfflinePayments[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\OfflinePayments|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
