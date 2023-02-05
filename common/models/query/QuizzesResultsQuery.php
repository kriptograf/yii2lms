<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\QuizzesResults]].
 *
 * @see \common\models\QuizzesResults
 */
class QuizzesResultsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\QuizzesResults[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\QuizzesResults|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
