<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\CommentsReports]].
 *
 * @see \common\models\CommentsReports
 */
class CommentsReportsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\CommentsReports[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\CommentsReports|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
