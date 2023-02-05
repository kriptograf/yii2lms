<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Verifications]].
 *
 * @see \common\models\Verifications
 */
class VerificationsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Verifications[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Verifications|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
