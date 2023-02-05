<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\FilterOptions]].
 *
 * @see \common\models\FilterOptions
 */
class FilterOptionsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\FilterOptions[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\FilterOptions|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
