<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\TrendCategories]].
 *
 * @see \common\models\TrendCategories
 */
class TrendCategoriesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\TrendCategories[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\TrendCategories|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
